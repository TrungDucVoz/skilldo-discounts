<?php
Class Discounts_Admin {
    static public function navigation() {
        if(Auth::hasCap('discount_role')) {
            if(class_exists('marketing_online')) {
                AdminMenu::addSub('marketing', 'discounts', 'Mã giảm giá', 'plugins?page=discounts', ['callback' => 'Discounts_Admin::page']);
            }
            else {
                AdminMenu::addSub('products', 'discounts', 'Mã giảm giá', 'plugins?page=discounts', ['callback' => 'Discounts_Admin::page']);
            }
        }
    }
    static public function page() {
        $view = InputBuilder::get('view');
        $view = (empty($view)) ? 'index' : $view;
        if( $view == 'index' ) {

            $page_status = InputBuilder::get('status');

            $args = [];

            if($page_status == 'stop') {
                $args['where'] = ['status' => 'stop'];
            }
            else {
                $args['where'] = ['status <>' => 'stop'];
            }

            $discounts   = Discount::gets($args);

            include 'admin/views/discounts-index.php';
        }
        if( $view == 'add' ) {

            include 'admin/views/discounts-add.php';
        }
        if( $view == 'detail' ) {

            $id = (int)InputBuilder::get('id');

            $discount = Discount::get($id);

            if(have_posts($discount)) {
                include 'admin/views/discounts-detail.php';
            }
            else {
                echo notice('error', 'Mã giảm giá này chưa được tạo hoặc đã bị xóa.', false, 'Mã giảm giá không tồn tại');
            }
        }
    }
    static public function buttonActionBar($module) {
        $view   = ( empty(str::clear(InputBuilder::get('view'))) ) ? 'index' : str::clear(InputBuilder::get('view'));
        $class  = Template::getClass();
        $page   = InputBuilder::get('page');

        if($class == 'plugins' && $page == 'discounts' && $view == 'index') {
            echo '<div class="pull-left">'; echo '</div>';
            echo '<div class="pull-right">';
            ?>
            <a href="<?php echo Url::admin('plugins?page=discounts&view=add');?>" class="btn btn-icon btn-green"><?php echo Admin::icon('add');?> Thêm mã khuyến mãi</a>
            <?php
            echo '</div>';
        }

        if($class == 'plugins' && $page == 'discounts' && $view == 'add') {
            echo '<div class="pull-left">'; echo '</div>';
            echo '<div class="pull-right">';
            ?>
            <button name="save" class="btn btn-icon btn-green" form="discount_form_add"><?php echo Admin::icon('save');?> Lưu</button>
            <a href="<?php echo Url::admin('plugins?page=discounts');?>" class="btn btn-icon btn-blue"><?php echo Admin::icon('back');?> Quay lại</a>
            <?php
            echo '</div>';
        }

        if($class == 'plugins' && $page == 'discounts' && $view == 'detail') {
            echo '<div class="pull-left">'; echo '</div>';
            echo '<div class="pull-right">';
            ?>
            <button name="save" class="btn btn-icon btn-green" form="discount_form_edit"><?php echo Admin::icon('save');?> Lưu</button>
            <a href="<?php echo Url::admin('plugins?page=discounts');?>" class="btn btn-icon btn-blue"><?php echo Admin::icon('back');?> Quay lại</a>
            <?php
            echo '</div>';
        }
    }
}
add_action('action_bar_before', 'Discounts_Admin::buttonActionBar', 10 );
add_action('admin_init', 'Discounts_Admin::navigation', 30);

if(!class_exists('Product_Variable_Popover')) {
    Class Product_Variable_Popover {
        static public function registerSearch($search) {
            if($search == 'products-variable') return 'Product_Variable_Popover::search';
            return $search;
        }
        static public function registerLoad($search) {
            if($search == 'products-variable') return 'Product_Variable_Popover::load';
            return $search;
        }
        static public function search($ci, $model) {
            $result['message'] 	= 'Không có kết quả nào.';
            $result['status'] 	= 'error';
            $result['items']     = [];
            if(InputBuilder::post()) {
                $keyword    = Str::ascii(trim(InputBuilder::post('keyword')));
                $page       = (int)InputBuilder::post('page') - 1;
                $limit      = (int)InputBuilder::post('limit');
                $objects    = Product::gets([
                    'where'         => ['trash' => 0],
                    'params'        => ['select' => 'id, title, image, price, price_sale, parent_id', 'limit' => $limit, 'start' => $page*$limit],
                    'where_like'    => ['title' => array($keyword)]
                ]);
                if(have_posts($objects)) {
                    foreach ($objects as $value) {
                        $variables = Variation::gets(['product' => $value->id]);
                        if(have_posts($variables)) {
                            foreach ($variables as $variable) {
                                $attr_name = '';
                                foreach ($variable->items as $attr_id) {
                                    $attr = Attribute::getItem($attr_id);
                                    if( have_posts($attr)) {
                                        $attr_name .= ' - <span style="font-weight: bold">'.$attr->title.'</span>';
                                    }
                                }
                                $variable->title .= $attr_name;
                                $item = [
                                    'id'    => $variable->id,
                                    'image' => (!empty($variable->image)) ? Template::imgLink($variable->image) : Template::imgLink($value->image),
                                    'name'  => $variable->title,
                                ];
                                $item['data'] = htmlentities(json_encode($item));
                                $result['items'][]  = $item;
                            }
                        }
                        else {
                            $item = [
                                'id'    => $value->id,
                                'image' => Template::imgLink($value->image),
                                'name'  => $value->title,
                            ];
                            $item['data'] = htmlentities(json_encode($item));
                            $result['items'][]  = $item;
                        }
                    }
                    $result['status'] 	= 'success';
                }
                $result['total'] = count($result['items']);
            }
            echo json_encode($result);
        }
        static public function load($listID, $taxonomy) {
            $items = [];
            if(have_posts($listID)) {
                $objects    = Product::gets([
                    'params'    => ['select' => 'id, title, image, price, price_sale, type, parent_id'],
                    'where'     => ['trash' => 0, 'type <>' => 'trash'],
                    'where_in'  => ['field' => 'id', 'data' => $listID]
                ]);
                foreach ($objects as $value) {
                    if($value->type == 'product') {
                        $item = [
                            'id'    => $value->id,
                            'image' => Template::imgLink($value->image),
                            'name'  => $value->title,
                        ];
                        $items[]  = $item;
                    }
                    else {
                        $value = Variation::get($value->id);
                        if(empty($value->image)) {
                            $product = Product::get(['where' => ['id' => $value->parent_id], 'select' => 'id, title, image']);
                        }
                        $attr_name = '';
                        if(!empty($value->items)) {
                            foreach ($value->items as $attr_id) {
                                $attr = Attribute::getItem($attr_id);
                                if( have_posts($attr)) {
                                    $attr_name .= ' - <span style="font-weight: bold">'.$attr->title.'</span>';
                                }
                            }
                        }
                        $value->title .= $attr_name;
                        $item = [
                            'id'    => $value->id,
                            'image' => (!empty($value->image)) ? Template::imgLink($value->image) : Template::imgLink($product->image),
                            'name'  => $value->title,
                        ];
                        $items[]  = $item;
                    }
                }
            }
            return $items;
        }
    }
    add_filter('popover_advance_search_custom', 'Product_Variable_Popover::registerSearch');
    add_filter('popover_advance_load_custom', 'Product_Variable_Popover::registerLoad');
    Ajax::admin('Product_Variable_Popover::search');
}