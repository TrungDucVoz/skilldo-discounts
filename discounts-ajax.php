<?php
Class Discount_Admin_Ajax {
    public static function add($ci, $model) {

        $result['status'] = 'error';

        $result['message'] = 'Thêm dữ liệu không thành công!';

        if(InputBuilder::post()) {

            $discount = array();

            $discount['code']           = trim(InputBuilder::post('discount_code'));

            if(empty($discount['code'])) {
                $result['message']  = 'Mã giảm giá không thể để trống!';
                echo json_encode( $result );
                return false;
            }

            if(Discount::count(['where' => array('code' => $discount['code'])]) != 0) {
                $result['message']  = 'Mã giảm giá này đã được sử dụng.';
                echo json_encode( $result );
                return false;
            }

            $discount['image']           = trim(InputBuilder::post('discount_image'));

            $discount['name']           = trim(InputBuilder::post('discount_name'));

            $discount['excerpt']        = trim(InputBuilder::post('discount_excerpt'));

            //Số lần sử dụng mã giảm giá
            $discount['discount_count_infinity']           = (int)InputBuilder::post('discount_count_infinity');

            if($discount['discount_count_infinity'] == 0) {

                $discount['discount_count'] = (int)InputBuilder::post('discount_count');

                if($discount['discount_count'] <= 0) {
                    $result['message']  = 'Số lần sử dụng mã giảm giá không thể nhỏ hơn 1';
                    echo json_encode( $result );
                    return false;
                }
            }

            //Hình thức khuyến mãi
            $discount['discount_type']  = trim(InputBuilder::post('discount_type'));

            $discount['discount_value']  = (int)InputBuilder::post('discount_value');

            if($discount['discount_value'] <= 0 || ($discount['discount_type'] == 'percent' && ($discount['discount_value'] <= 0 || $discount['discount_value'] > 100))) {
                $result['message']  = 'Giá trị giảm giá của mã không hợp lệ';
                echo json_encode( $result );
                return false;
            }

            //Mức giảm giá tối đa
            $discount['discount_type_maximum']           = (int)InputBuilder::post('discount_type_maximum');

            if($discount['discount_type_maximum'] == 0) {

                $discount['discount_value_maximum'] = (int)InputBuilder::post('discount_value_maximum');

                if($discount['discount_value_maximum'] <= 1000) {
                    $result['message']  = 'Mức giảm tối đa không thể nhỏ hơn 1000';
                    echo json_encode( $result );
                    return false;
                }
            }

            //Thời gian khuyến mãi
            $discount['time_start']  = trim(InputBuilder::post('discount_time_start'));

            if(empty($discount['time_start'])) {
                $result['message']  = 'Thời gian bắt đầu khuyến mãi không được để trống';
                echo json_encode( $result );
                return false;
            }

            $discount['time_start'] = strtotime($discount['time_start'].' 00:00:00');

            if($discount['time_start'] < (time() - 24*60*60)) {
                $result['message']  = 'Thời gian bắt đầu không được nhỏ hơn thời gian hiện tại';
                echo json_encode($result);
                return false;
            }

            $discount['time_status'] = (int)InputBuilder::post('discount_time_status');

            if($discount['time_status'] == 0) {

                $discount['time_end'] = trim(InputBuilder::post('discount_time_end'));

                if(empty($discount['time_end'])) {
                    $result['message']  = 'Thời gian kết thúc khuyến mãi không được để trống';
                    echo json_encode( $result );
                    return false;
                }

                $discount['time_end']       = strtotime($discount['time_end'].' 23:59:59');

                if($discount['time_end'] <= $discount['time_status']) {
                    $result['message']  = 'Thời gian kết thúc khuyến mãi không được nhỏ hơn thời gian bắt đầu.';
                    echo json_encode( $result );
                    return false;
                }
            }

            //Áp dụng cho
            $discount['discount_condition']  = trim(InputBuilder::post('discount_condition'));

            if($discount['discount_condition'] == 'products') {

                $discount['discount_condition_value'] = InputBuilder::post('discount_condition_value_products');

                if(have_posts($discount['discount_condition_value'])) {
                    foreach ($discount['discount_condition_value'] as $key => $item) {
                        $discount['discount_condition_value'][$key] = (int)$item;
                        if($discount['discount_condition_value'][$key] == 0) {
                            $result['message']  = 'ID sản phẩm chưa đúng.';
                            echo json_encode( $result );
                            return false;
                        }
                    }
                }
                else {
                    $result['message']  = 'Bạn chưa chọn sản phẩm nào.';
                    echo json_encode( $result );
                    return false;
                }

                $discount['discount_condition_value']    = serialize($discount['discount_condition_value']);
            }

            //Yêu cầu tối thiểu
            $discount['discount_type_minimize'] = trim(InputBuilder::post('discount_type_minimize'));

            if($discount['discount_type_minimize'] == 'money') {

                $discount['discount_value_minimize'] = (int)InputBuilder::post('discount_value_minimize_money');
            }

            if($discount['discount_type_minimize'] == 'quantity') {

                $discount['discount_value_minimize'] = (int)InputBuilder::post('discount_value_minimize_quantity');
            }

            if(isset($discount['discount_value_minimize']) && $discount['discount_value_minimize'] < 1) {
                $result['message']  = 'Yêu cầu tối thiểu không thể nhỏ hơn 1';
                echo json_encode( $result );
                return false;
            }

            //Áp dụng cho khách hàng
            $discount['discount_customer'] = trim(InputBuilder::post('discount_customer'));

            if($discount['discount_customer'] == 'customer-user') {

                $discount['discount_customer_value'] = InputBuilder::post('discount_customer_user');

                if(have_posts($discount['discount_customer_value'])) {
                    foreach ($discount['discount_customer_value'] as $key => $item) {
                        $discount['discount_customer_value'][$key] = (int)$item;
                        if($discount['discount_customer_value'][$key] == 0) {
                            $result['message']  = 'ID Khách hàng chưa đúng.';
                            echo json_encode( $result );
                            return false;
                        }
                    }
                }
                else {
                    $result['message']  = 'Bạn chưa chọn khách hàng nào.';
                    echo json_encode( $result );
                    return false;
                }

                $discount['discount_customer_count'] = (int)InputBuilder::post('discount_customer_count');

                if($discount['discount_customer_count'] == 0) {

                    $count = 0;

                    if($discount['discount_count_infinity'] == 1) {

                        $discount['discount_count'] = 0;
                    }

                    $discount['discount_customer_use'] = [];

                    foreach ($discount['discount_customer_value'] as $key => $item) {

                        if($discount['discount_count_infinity'] == 0) {

                            $discount['discount_customer_use'][$item] = [
                                'count' => $discount['discount_count'],
                                'use'   => 0
                            ];

                            $count += $discount['discount_count'];
                        }
                        else {
                            $discount['discount_customer_use'][$item] = [
                                'count' => 0,
                                'use'   => 0
                            ];
                        }

                    }

                    $discount['discount_count'] = $count;
                }

                $discount['discount_customer_value']  = implode(',', $discount['discount_customer_value']);
                $discount['discount_customer_value']  = ','.$discount['discount_customer_value'].',';
                $discount['discount_customer_use']    = serialize($discount['discount_customer_use']);
            }

            $id = Discount::insert($discount);

            if( !is_skd_error($id)) {

                $result['location'] = Url::admin('plugins?page=discounts');

                $result['status'] = 'success';

                $result['message'] = 'Thêm dữ liệu thành công!';
            }
        }

        echo json_encode( $result );

        return false;
    }
    public static function save($ci, $model) {

        $result['status'] = 'error';

        $result['message'] = 'Thêm dữ liệu không thành công!';

        if(InputBuilder::post()) {

            $discount = array();

            $discount['id']           = (int)InputBuilder::post('id');

            $discount_old = Discount::get($discount['id']);

            if(!have_posts($discount_old)) {
                $result['message']  = 'Mã giảm giá không tồn tại!';
                echo json_encode( $result );
                return false;
            }

            $discount['image']          = trim(InputBuilder::post('discount_image'));

            $discount['name']           = trim(InputBuilder::post('discount_name'));

            $discount['excerpt']        = trim(xss_clean(InputBuilder::post('discount_excerpt')));

            //Mức giảm giá tối đa
            $discount['discount_type_maximum'] = (int)InputBuilder::post('discount_type_maximum');

            if($discount['discount_type_maximum'] == 0) {

                $discount['discount_value_maximum'] = (int)InputBuilder::post('discount_value_maximum');

                if($discount['discount_value_maximum'] <= 1000) {
                    $result['message']  = 'Mức giảm tối đa không thể nhỏ hơn 1000';
                    echo json_encode( $result );
                    return false;
                }
            }

            //Thời gian khuyến mãi
            $discount['time_status'] = (int)InputBuilder::post('discount_time_status');

            if($discount['time_status'] == 0) {

                $discount['time_end'] = trim(InputBuilder::post('discount_time_end'));

                if(empty($discount['time_end'])) {
                    $result['message']  = 'Thời gian kết thúc khuyến mãi không được để trống';
                    echo json_encode( $result );
                    return false;
                }

                $discount['time_end']       = strtotime($discount['time_end'].' 23:59:59');

                if($discount['time_end'] <= $discount_old->time_start) {
                    $result['message']  = 'Thời gian kết thúc khuyến mãi không được nhỏ hơn thời gian bắt đầu.';
                    echo json_encode( $result );
                    return false;
                }
            }

            //Yêu cầu tối thiểu
            $discount['discount_type_minimize'] = trim(InputBuilder::post('discount_type_minimize'));

            if($discount['discount_type_minimize'] == 'money') {

                $discount['discount_value_minimize'] = (int)InputBuilder::post('discount_value_minimize_money');
            }

            if($discount['discount_type_minimize'] == 'quantity') {

                $discount['discount_value_minimize'] = (int)InputBuilder::post('discount_value_minimize_quantity');
            }

            if(isset($discount['discount_value_minimize']) && $discount['discount_value_minimize'] < 1) {
                $result['message']  = 'Yêu cầu tối thiểu không thể nhỏ hơn 1';
                echo json_encode( $result );
                return false;
            }

            //Áp dụng cho
            $discount['discount_condition']  = trim(InputBuilder::post('discount_condition'));

            if($discount['discount_condition'] == 'products') {

                $discount['discount_condition_value'] = InputBuilder::post('discount_condition_value_products');

                if(have_posts($discount['discount_condition_value'])) {
                    foreach ($discount['discount_condition_value'] as $key => $item) {
                        $discount['discount_condition_value'][$key] = (int)$item;
                        if($discount['discount_condition_value'][$key] == 0) {
                            $result['message']  = 'ID sản phẩm chưa đúng.';
                            echo json_encode( $result );
                            return false;
                        }
                    }
                }
                else {
                    $result['message']  = 'Bạn chưa chọn sản phẩm nào.';
                    echo json_encode( $result );
                    return false;
                }

                $discount['discount_condition_value']    = serialize($discount['discount_condition_value']);
            }

            $id = Discount::insert($discount);

            if( !is_skd_error($id)) {

                $result['location'] = Url::admin('plugins?page=discounts');

                $result['status'] = 'success';

                $result['message'] = 'Cập nhật dữ liệu thành công!';
            }
        }

        echo json_encode( $result );

        return false;
    }
    public static function delete($ci, $model) {

        $result['status'] = 'error';

        $result['message'] = 'Xóa dữ liệu không thành công!';

        if(InputBuilder::post()) {

            $id           = (int)InputBuilder::post('id');

            $discount_old = Discount::get($id);

            if(!have_posts($discount_old)) {
                $result['message']  = 'Mã giảm giá không tồn tại!';
                echo json_encode( $result );
                return false;
            }

            Discount::delete($id);

            $result['status'] = 'success';

            $result['message'] = 'Xóa dữ liệu thành công!';
        }

        echo json_encode( $result );

        return false;
    }
}

Ajax::admin('Discount_Admin_Ajax::add');
Ajax::admin('Discount_Admin_Ajax::save');
Ajax::admin('Discount_Admin_Ajax::delete');