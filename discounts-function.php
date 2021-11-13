<?php
class Discount {
    static public function get($args = []) {
        $model = get_model('home')->settable('discounts')->settable_metabox('discounts_metadata');
        if(is_numeric($args))   $args = ['where' => array('id' => (int)$args)];
        if(!have_posts($args))  $args = [];
        $args = array_merge(['where' => [], 'params' => []], $args);
        $discounts = $model->get_data($args);
        if(have_posts($discounts)) {
            if(!empty($discounts->discount_customer_value)) {
                $discounts->discount_customer_value = trim($discounts->discount_customer_value, ',');
                $discounts->discount_customer_value = explode(',', $discounts->discount_customer_value);
            }
            if(!empty($discounts->discount_customer_use) && is_serialized($discounts->discount_customer_use)) {
                $discounts->discount_customer_use = unserialize($discounts->discount_customer_use);
            }
            if(!empty($discounts->discount_condition_value) && is_serialized($discounts->discount_condition_value)) {
                $discounts->discount_condition_value = unserialize($discounts->discount_condition_value);
            }
        }
        return apply_filters('get_discounts', $discounts, $args);
    }
    static public function getBy( $field, $value, $params = [] ) {
        $field = Str::clear( $field );
        $value = Str::clear( $value );
        $args = array( 'where' => array( $field => $value ) );
        if( have_posts($params) ) $arg['params'] = $params;
        return apply_filters('get_discounts_by', static::get($args), $field, $value );
    }
    static public function gets( $args = [] ) {
        $model 	= get_model('home')->settable('discounts')->settable_metabox('metabox');
        if(!have_posts($args)) $args = [];
        $args = array_merge( ['where' => [], 'params' => []], $args );
        $discounts = $model->gets_data($args);
        return apply_filters( 'gets_discounts', $discounts, $args );
    }
    static public function getsBy( $field, $value, $params = [] ) {
        $field = Str::clear( $field );
        $value = Str::clear( $value );
        $args = array('where' => array( $field => $value ) );
        if( have_posts($params) ) $arg['params'] = $params;
        return apply_filters( 'gets_discounts_by', static::gets($args), $field, $value );
    }
    static public function count( $args = [] ) {
        if( is_numeric($args) ) $args = array( 'where' => array('id' => (int)$args ) );
        if( !have_posts($args) ) $args = [];
        $args = array_merge( ['where' => [], 'params' => []], $args );
        $model = get_model('home')->settable('discounts')->settable_metabox('discounts_metadata');
        $discounts = $model->count_data($args);
        return apply_filters('count_discounts', $discounts, $args );
    }
    static public function insert( $discounts = [] ) {

        $model = get_model('home')->settable('discounts');

        if (!empty( $discounts['id'])) {
            $id            = (int) $discounts['id'];
            $update        = true;
            $old_discounts = static::get($id);
            if (!$old_discounts) return new SKD_Error('invalid_discounts_id', __('ID mã giảm giá không chính xác.'));
            $discounts['image']                      = (!empty($discounts['image'])) ? FileHandler::handlingUrl(Str::clear($discounts['image'])) : $old_discounts->image;
            $discounts['name']                       = (!empty($discounts['name']))  ? Str::clear($discounts['name']) : $old_discounts->name;
            $discounts['excerpt']                    = (!empty($discounts['excerpt'])) ? xss_clean($discounts['excerpt']) : $old_discounts->excerpt;
            $discounts['discount_count_infinity']    = (isset($discounts['discount_count_infinity'])) ? (int)$discounts['discount_count_infinity'] : $old_discounts->discount_count_infinity;
            $discounts['discount_count']             = (isset($discounts['discount_count'])) ? (int)$discounts['discount_count'] : $old_discounts->discount_count;
            $discounts['discount_use']               = (isset($discounts['discount_use'])) ? (int)Str::clear($discounts['discount_use']) : $old_discounts->discount_use;
            $discounts['discount_type']              = (!empty($discounts['discount_type'])) ? Str::clear($discounts['discount_type']) : $old_discounts->discount_type;
            $discounts['discount_value']             = (!empty($discounts['discount_value'])) ? (int)Str::clear($discounts['discount_value']) : $old_discounts->discount_value;
            $discounts['time_start']                 = (!empty($discounts['time_start'])) ? Str::clear($discounts['time_start']) : $old_discounts->time_start;
            $discounts['time_end']                   = (!empty($discounts['time_start'])) ? Str::clear($discounts['time_end']) : $old_discounts->time_end;
            $discounts['time_status']                = (isset($discounts['time_status'])) ? (int)Str::clear($discounts['time_status']) : $old_discounts->time_status;
            $discounts['discount_condition']         = (!empty($discounts['discount_condition'])) ? Str::clear($discounts['discount_condition']) : $old_discounts->discount_condition;
            $discounts['discount_condition_value']   = (!empty($discounts['discount_condition_value'])) ? Str::clear($discounts['discount_condition_value']) : $old_discounts->discount_condition_value;
            $discounts['discount_type_maximum']      = (isset($discounts['discount_type_maximum'])) ? (int)Str::clear($discounts['discount_type_maximum']) : $old_discounts->discount_type_maximum;
            $discounts['discount_value_maximum']     = (!empty($discounts['discount_value_maximum'])) ? Str::clear($discounts['discount_value_maximum']) : $old_discounts->discount_value_maximum;
            $discounts['discount_value_minimize']    = (isset($discounts['discount_value_minimize'])) ? (int)Str::clear($discounts['discount_value_minimize']) : $old_discounts->discount_value_minimize;
            $discounts['discount_type_minimize']     = (!empty($discounts['discount_type_minimize'])) ? Str::clear($discounts['discount_type_minimize']) : $old_discounts->discount_type_minimize;
            $discounts['discount_customer_count']    = (isset($discounts['discount_customer_count'])) ? (int)Str::clear($discounts['discount_customer_count']) : $old_discounts->discount_customer_count;
            $discounts['discount_customer']          = (!empty($discounts['discount_customer'])) ? Str::clear($discounts['discount_customer']) : $old_discounts->discount_customer;
            $discounts['discount_customer_value']    = (!empty($discounts['discount_customer_value'])) ? Str::clear($discounts['discount_customer_value']) : $old_discounts->discount_customer_value;
            $discounts['discount_customer_use']      = (!empty($discounts['discount_customer_use'])) ? Str::clear($discounts['discount_customer_use']) : $old_discounts->discount_customer_use;
            $discounts['status']                     = (!empty($discounts['status'])) ? Str::clear($discounts['status']) : $old_discounts->status;
        }
        else {
            $update = false;
        }

        if(!$update) {
            if (empty($discounts['code'])) return new SKD_Error('empty_discounts_code', __('Mã giảm giá không thể để trống.'));
            $code = Str::clear($discounts['code']);
        }
        else {
            $code = empty($discounts['code']) ? $old_discounts->code : Str::clear($discounts['code']);
        }

        $image      = (!empty($discounts['image'])) ? process_file(Str::clear($discounts['image'])) : '';
        $name       = (!empty($discounts['name']))  ? Str::clear($discounts['name']) : '';
        $excerpt    = (!empty($discounts['excerpt'])) ? xss_clean($discounts['excerpt']) : '';

        //Số lần sử dụng mã giảm giá
        $discount_count_infinity    =  (isset($discounts['discount_count_infinity'])) ? (int)$discounts['discount_count_infinity'] : 0;
        $discount_count             =  (isset($discounts['discount_count'])) ? (int)$discounts['discount_count'] : 0;
        $discount_use               =  (isset($discounts['discount_use'])) ? (int)Str::clear($discounts['discount_use']) : 0;

        //Hình thức khuyến mãi
        $discount_type     =  (!empty($discounts['discount_type'])) ? Str::clear($discounts['discount_type']) : '';
        $discount_value    =  (!empty($discounts['discount_value'])) ? (int)Str::clear($discounts['discount_value']) : '';

        //thời gian giảm giá
        $time_start        =  (!empty($discounts['time_start'])) ? Str::clear($discounts['time_start']) : '';
        $time_end          =  (!empty($discounts['time_end'])) ? Str::clear($discounts['time_end']) : 0;
        $time_status       =  (isset($discounts['time_status'])) ? (int)Str::clear($discounts['time_status']) : 0;

        //Áp dụng cho
        $discount_condition         =  (!empty($discounts['discount_condition'])) ? Str::clear($discounts['discount_condition']) : '';
        $discount_condition_value   =  (!empty($discounts['discount_condition_value'])) ? Str::clear($discounts['discount_condition_value']) : '';

        //Mức giảm giá tối đa
        $discount_type_maximum    =  (isset($discounts['discount_type_maximum'])) ? (int)Str::clear($discounts['discount_type_maximum']) : 0;
        $discount_value_maximum   =  (!empty($discounts['discount_value_maximum'])) ? Str::clear($discounts['discount_value_maximum']) : 0;

        //Yêu cầu tối thiểu
        $discount_value_minimize    =  (isset($discounts['discount_value_minimize'])) ? (int)Str::clear($discounts['discount_value_minimize']) : 0;
        $discount_type_minimize     =  (!empty($discounts['discount_type_minimize'])) ? Str::clear($discounts['discount_type_minimize']) : '';

        //Áp dụng cho khách hàng
        $discount_customer_count    =  (isset($discounts['discount_customer_count'])) ? (int)Str::clear($discounts['discount_customer_count']) : 0;
        $discount_customer          =  (!empty($discounts['discount_customer'])) ? Str::clear($discounts['discount_customer']) : '';
        $discount_customer_value    =  (!empty($discounts['discount_customer_value'])) ? Str::clear($discounts['discount_customer_value']) : '';
        $discount_customer_use      =  (!empty($discounts['discount_customer_use'])) ? Str::clear($discounts['discount_customer_use']) : '';

        $status  =  (!empty($discounts['status'])) ? Str::clear($discounts['status']) : 'run';

        if(empty($discounts['status']) && !$update) {
            $time = time();
            $status = 'run';
            //Chưa chạy
            if( $time < $time_start ) {
                $status = 'wait';
            }
            else if( $time_status == 0 && $time > $time_end ) {
                $status = 'stop';
            }
        }
        
        if (!is_serialized($discount_condition_value)){
            $discount_condition_value    = serialize($discount_condition_value);
        }

        $data = compact( 'code','image', 'name', 'excerpt', 'discount_count_infinity', 'status', 'discount_count', 'discount_use', 'discount_type', 'discount_value', 'time_start', 'time_end', 'time_status', 'discount_condition', 'discount_condition_value', 'discount_type_maximum', 'discount_value_maximum', 'discount_type_minimize', 'discount_value_minimize', 'discount_customer', 'discount_customer_value', 'discount_customer_use', 'discount_customer_count');
        $data = apply_filters( 'pre_insert_discounts_data', $data, $discounts, $update ? (int) $id : null );

        if ( $update ) {
            $model->settable('discounts');
            $model->update_where( $data, compact( 'id' ) );
            $discounts_id = (int) $id;

        } else {
            $model->settable('discounts');
            $discounts_id = $model->add( $data );
        }

        $model->settable('discounts');
        $discounts_id  = apply_filters( 'after_insert_discounts', $discounts_id, $discounts, $data, $update ? (int) $id : null  );
        return $discounts_id;
    }
    static public function delete( $discountsID = 0) {
        $ci =& get_instance();
        $discountsID = (int)Str::clear($discountsID);
        if( $discountsID == 0 ) return false;
        $model = get_model('home')->settable('discounts');
        $discounts  = static::get( $discountsID );
        if( have_posts($discounts) ) {
            $ci->data['module']   = 'discounts';
            do_action('delete_discounts', $discountsID );
            if($model->delete_where(['id'=> $discountsID])) {
                do_action('delete_discounts_success', $discountsID );
                return [$discountsID];
            }
        }
        return false;
    }
    static public function deleteList( $discountsID = []) {
        if(have_posts($discountsID)) {
            $model      = get_model('home');
            $model->settable('discounts');
            $discountss = static::gets(['where_in' => ['field' => 'id', 'data' => $discountsID]]);
            if($model->delete_where_in(['field' => 'id', 'data' => $discountsID])) {
                $where_in = ['field' => 'object_id', 'data' => $discountsID];
                do_action('delete_discounts_list_trash_success', $discountsID );
                //delete language
                $model->settable('language')->delete_where_in($where_in, ['object_type' => 'discounts']);
                //delete router
                $model->settable('routes')->delete_where_in($where_in, ['object_type' => 'discounts']);
                //delete router
                foreach ($discountss as $key => $discounts) {
                    delete_gallery_by_object($discounts->id, 'discounts');
                    delete_metadata_by_mid('discounts', $discounts->id);
                }
                //delete menu
                $model->settable('menu')->delete_where_in($where_in, ['object_type' => 'discounts']);
                //xóa liên kết
                $model->settable('relationships')->delete_where_in($where_in, ['object_type' => 'discounts']);
                return $discountsID;
            }
        }
        return false;
    }
    static public function getMeta( $discounts_id, $key = '', $single = true) {
        return Metadata::get('discounts', $discounts_id, $key, $single);
    }
    static public function updateMeta($discounts_id, $meta_key, $meta_value) {
        return Metadata::update('discounts', $discounts_id, $meta_key, $meta_value);
    }
    static public function unit( $type ) {
        if( $type == 'percent') return '%';
        if( $type == 'money') return _price_currency();
        return _price_currency();
    }
    static public function status( $discount ) {
        //Hết số lần sử dụng
        if( $discount->discount_count_infinity == 0 && $discount->discount_count <= $discount->discount_use ) {
            return 'out-of-use';
        }
        $time = time();
        //Chưa chạy
        if( $discount->time_status == 1 && $time < $discount->time_start ) {
            return 'wait';
        }
        if( $time < $discount->time_start ) {
            return 'wait';
        }
        if( $discount->time_status == 0 && $time > $discount->time_end ) {
            return 'stop';
        }
        return 'run';
    }
    static public function statusLabel( $discount ) {
        $status = static::status($discount);
        if($status == 'out-of-use') return __('Hết lượt');
        if($status == 'wait') return __('Chưa chạy');
        if($status == 'stop') return __('Hết hạn');
        return __('Đang chạy');
    }
    static public function condition( $key = '' ) {
        $discount_condition = [
            'order'                 => 'Tất cả các đơn hàng',
            'product_categories'    => 'Danh mục sản phẩm',
            'products'              => 'Sản phẩm cụ thể',
        ];
        if(!empty($key)) return $discount_condition[$key];
        return $discount_condition;
    }
    static public function customer( $key = '' ) {
        $discount_condition = [
            'customer'         => 'Tất cả khách hàng',
            'customer-login'   => 'Khách hàng đã đăng nhập',
            'customer-user'    => 'Khách hàng cụ thể',
        ];
        if(!empty($key)) return $discount_condition[$key];
        return $discount_condition;
    }
    static public function validation( $discount ) {
        //Kiểm tra thời gian sử dụng
        $time = time();
        //Chưa chạy
        if($discount->time_status == 1 && $time < $discount->time_start) return 'wait';
        if($time < $discount->time_start) return 'wait';
        if($discount->time_status == 0 && $time > $discount->time_end) return 'stop';
        //Kiểm tra đối tượng áp dụng
        if(($discount->discount_customer == 'customer-login' || $discount->discount_customer == 'customer-user') && !Auth::check()) {
            return 'no-login';
        }
        if($discount->discount_customer == 'customer-user') {

            $user_current   = Auth::user();

            $listID         = $discount->discount_customer_value;

            if(!have_posts($listID) || in_array($user_current->id, $listID) === false) {
                return 'no-user';
            }

            if($discount->discount_count_infinity == 0 && $discount->discount_customer_count == 0) {
                $customer_count = $discount->discount_customer_use[$user_current->id];
                if($customer_count['count'] <= $customer_count['use']) return 'customer-out-of-use';
            }

            if($discount->discount_count_infinity == 0 && $discount->discount_customer_count == 1) {
                if($discount->discount_count <= $discount->discount_use) return 'out-of-use';
            }
        }
        else if($discount->discount_count_infinity == 0) {
            if($discount->discount_count <= $discount->discount_use) return 'out-of-use';
        }
        if($discount->discount_condition == 'order') {
            if($discount->discount_type_minimize == 'money') {
                $total = Scart::total();
                if($total < $discount->discount_value_minimize) {
                    return 'order-not-sufficient-money';
                }
            }
            if($discount->discount_type_minimize == 'quantity') {
                $qty = Scart::totalQty();
                if($qty < $discount->discount_value_minimize) {
                    return 'order-not-sufficient-quantity';
                }
            }
        }
        if($discount->discount_condition == 'products') {
            $list_products = $discount->discount_condition_value;
            $cart       = Scart::getItems();
            $total      = 0;
            $quantity   = 0;
            $cart_products = [];
            foreach ($cart as $pr) {
                if(!empty($pr['variable'])) {
                    if(in_array($pr['variable'], $list_products) === false) continue;
                }
                else {
                    if(in_array($pr['id'], $list_products) === false) continue;
                }
                $total      += $pr['subtotal'];
                $quantity   += $pr['qty'];
            }
            if($quantity != 0) {
                if($discount->discount_type_minimize == 'money') {
                    if($total < $discount->discount_value_minimize) {
                        return 'products-not-sufficient-money';
                    }
                }
                if($discount->discount_type_minimize == 'quantity') {
                    if($quantity < $discount->discount_value_minimize) {
                        return 'products-not-sufficient-quantity';
                    }
                }
            }
            else {
                return 'no-products';
            }
        }
        return 'run';
    }
    static public function price( $discount_code ) {

        if(empty($discount_code)) return 0;

        if(is_string($discount_code)) {
            $discount = Discount::get(['where' => array('code' => $discount_code)]);
        }
        else {
            $discount = $discount_code;
        }

        if( !have_posts($discount) ) {
            return new SKD_Error( 'discount_empty', __('Mã khuyến mãi không đúng.', 'discount_error_not_found'));
        }

        $status = discount::validation($discount);

        if( $status == 'wait' ) {
            return new SKD_Error( 'discount_empty', __('Mã khuyến mãi chưa được kích hoạt', 'discount_error_active'));
        }

        if( $status == 'stop' ) {
            return new SKD_Error( 'discount_empty', __('Mã khuyến mãi đã hết hạn sử dụng', 'discount_error_expiry'));
        }

        if( $status == 'no-login' ) {
            return new SKD_Error( 'discount_empty', __('Mã khuyến mãi chỉ áp dụng cho thành viên', 'discount_error_user'));
        }

        if( $status == 'no-user' ) {
            return new SKD_Error( 'discount_empty', __('Mã khuyến mãi chỉ áp dụng cho thành viên được cấp quyền sử dụng', 'discount_error_user_role'));
        }

        if( $status == 'customer-out-of-use' || $status == 'out-of-use' ) {
            return new SKD_Error( 'discount_empty', __('Mã khuyến mãi đã hết số lần sử dụng', 'discount_error_number_use'));
        }

        if( $status == 'order-not-sufficient-money' ) {
            return new SKD_Error( 'discount_empty', __('Tổng giá trị đơn hàng chưa đủ điều kiện sử dụng mã khuyến mãi này', 'discount_error_total_price'));
        }

        if( $status == 'order-not-sufficient-quantity' ) {
            return new SKD_Error( 'discount_empty', __('Tổng số lượng sản phẩm chưa đủ điều kiện sử dụng mã khuyến mãi này', 'discount_error_total_product'));
        }

        if( $status == 'no-products' ) {
            return new SKD_Error( 'discount_empty', __('Đơn hàng của bạn không chứa sản phẩm được khuyến mãi', 'discount_error_have_product'));
        }

        if( $status == 'products-not-sufficient-money' ) {
            return new SKD_Error( 'discount_empty', __('Tổng giá trị sản phẩm được khuyến mãi chưa đủ điều kiện sử dụng mã khuyến mãi này', 'discount_error_total_price_product'));
        }

        if( $status == 'products-not-sufficient-quantity' ) {
            return new SKD_Error( 'discount_empty', __('Tổng số lượng sản phẩm được khuyến mãi chưa đủ điều kiện sử dụng mã khuyến mãi này', 'discount_error_total_number_product'));
        }

        $coupon = 0;

        if($discount->discount_condition == 'products') {

            $list_products = $discount->discount_condition_value;

            $cart       = Scart::getItems();

            $total      = 0;

            foreach ($cart as $pr) {

                if(!empty($pr['variable'])) {
                    if(in_array($pr['variable'], $list_products) === false) continue;
                }
                else {
                    if(in_array($pr['id'], $list_products) === false) continue;
                }

                $total      += $pr['subtotal'];
            }
        }
        else {

            $total = Scart::total();

            if( $discount->discount_type == 'percent' ) {
                $coupon = round($total*$discount->discount_value/100);
            }
        }

        if($discount->discount_type == 'percent') {
            $coupon = round($total*$discount->discount_value/100);
        }

        if( $discount->discount_type == 'money' ) {
            $coupon = $discount->discount_value;
        }

        if( $discount->discount_type_maximum == 0 ) {
            if($coupon > $discount->discount_value_maximum) $coupon = $discount->discount_value_maximum;
        }

        return $coupon;
    }
}
//================================ search customer ===========================================//
function popover_customer_search($object, $keyword) {
    $object = User::gets([
        'where_like' => ['CONCAT( firstname,  " ", lastname )' => array($keyword)],
        'where'      => ['username <>' => '']
    ]);
    return $object;
}
add_filter('input_popover_customer_search', 'popover_customer_search', 10, 2);

function popover_customer_template($str, $item, $active) {
    return popover_discount_template_customer($item, $active);
}
add_filter('input_popover_customer_search_template', 'popover_customer_template', 10, 3);

function popover_discount_template_customer($item, $active = '') {
    $str = '';
    $image = 'https://bizweb.dktcdn.net/assets/admin/images/create_customer.svg';
    $fullname = 'Thêm mới khách hàng';
    $email = '';
    $id = 0;
    if (have_posts($item)) {
        $item->image = 'https://i0.wp.com/bizweb.dktcdn.net/assets/images/customper-noavatar.png?ssl=1';
        $image = $item->image;
        $fullname = $item->firstname . ' ' . $item->lastname;
        $email = $item->email;
        $id = $item->id;
    }
    $str .= '
    <li class="option option-' . $id . ' ' . $active . '" data-key="' . $id . '" data-customer="' . htmlentities(json_encode($item)) . '">
        <span class="label-option hidden">' . $fullname . ' - ' . $email . '</span>
        <div class="item-us">
            <div class="item-us__img">
                <img src="' . $image . '">
            </div>
            <div class="item-us__title">
                <span>' . $fullname . '</span>
                <p>' . $email . '</p>
            </div>
        </div>
    </li>';
    return $str;
}
//================================ search products ===========================================//
function popover_discounts_product_search($object, $keyword) {
    $object = gets_product([
        'where_like' => ['title' => array($keyword),],
    ]);
    return $object;
}
add_filter('input_popover_discounts_product_search', 'popover_discounts_product_search', 10, 2);

function popover_discounts_product_template($str, $item, $active) {
    return popover_discounts_template_product($item, $active);
}
add_filter('input_popover_discounts_product_search_template', 'popover_discounts_product_template', 10, 3);

function popover_discounts_template_product($item, $active = '') {

    $products_variations = gets_variations(['product' => $item->id]);

    $object[] = $item;

    if( have_posts($products_variations) ) {

        foreach ($products_variations as $variation) {

            $variation->price 		= $variation->price;

            $variation->price_sale 	= $variation->price_sale;

            if(empty($variation->image) ) $variation->image = $item->image;

            $attr_name = '';

            foreach ($variation->items as $attr_id) {

                $attr = get_attribute_item($attr_id);

                if( have_posts($attr)) {
                    $attr_name .= $attr->title .' / ';
                }
            }

            $variation->attr_name = trim( $attr_name, ' / ');

            $object[] = $variation;
        }

    }

    $str = '';

    foreach ($object as $item) {

        $item->image = get_img_fontend_link($item->image);

        $str .= '
        <li class="option option-'.$item->id.' '.$active.'" data-key="'.$item->id.'" data-product="'.htmlentities(json_encode($item)).'">
            <span class="label-option hidden">' . $item->title . ((!empty($item->attr_name)) ? ' - <small style="font-size:11px;color: #29bc94;">'.$item->attr_name.'</small>' : '') . '</span>
            <div class="item-pr">
                <div class="item-pr__img">
                    <img src="'.$item->image.'">
                </div>
                <div class="item-pr__title">
                    <span>'.$item->title.((!empty($item->attr_name)) ? ' <small style="font-size:11px;color: #29bc94;">'.$item->attr_name.'</small>' : '').'</span>
                </div>
                <div class="item-pr__price">';
        if($item->price_sale == 0) {
            $str .= '<span>'.number_format($item->price).'đ</span>';
        } else {
            $str .= '<span style="padding-right:10px;">'.number_format($item->price_sale).'đ</span>';
            $str .= '<span><del>'.number_format($item->price).'đ</del></span>';
        }
        $str .= '</div>
            </div>
        </li>';
    }

    return $str;
}
