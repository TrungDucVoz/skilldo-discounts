<?php
function discount_product_detail($object) {
    $discounts = Discount::gets(['where' => [
        'time_start <=' => time(),
        'status' => 'run'
    ]]);

    if(!have_posts($object)) $cartItems = Scart::getItems();

    foreach ($discounts as $key => $item) {

        //Hết hạn
        if($item->time_status == 0 && $item->time_end <= time()) {
            unset($discounts[$key]); continue;
        }

        //Hết số lần sử dụng
        if($item->discount_count_infinity == 0 && $item->discount_count == $item->discount_use) {
            unset($discounts[$key]); continue;
        }

        if($item->discount_condition == 'products') {

            $item->discount_condition_value = unserialize($item->discount_condition_value);

            if(have_posts($object)) {
                if(in_array($object->id, $item->discount_condition_value) === false) {
                    unset($discounts[$key]); continue;
                }
            }
            if(!empty($cartItems)) {
                $unIsset = true;
                foreach ($cartItems as $cartItem) {
                    $idCheck = (!empty($cartItem['variable'])) ? $cartItem['variable'] : $cartItem['id'];
                    if(in_array($idCheck, $item->discount_condition_value) !== false) {
                        $unIsset = false;
                        break;
                    }
                }
                if($unIsset == true) {
                    unset($discounts[$key]); continue;
                }
            }
        }

        if(($item->discount_customer == 'customer-login' || $item->discount_customer == 'customer-user') && !Auth::check()) {
            unset($discounts[$key]); continue;
        }

        if($item->discount_customer == 'customer-user') {
            if(!empty($item->discount_customer_value)) {
                $item->discount_customer_value = trim($item->discount_customer_value, ',');
                $item->discount_customer_value = explode(',', $item->discount_customer_value);
            }
            if(in_array(Auth::userID(), $item->discount_customer_value) === false) {
                unset($discounts[$key]); continue;
            }
        }
    }

    if(have_posts($discounts)) {
        Plugin::partial(DISCOUNT_NAME, 'product-detail', ['discounts' => $discounts]);
    }
}

add_action('product_detail_info', 'discount_product_detail', 25);