<?php
if (!function_exists( 'discounts_input_checkout_review')) {

    function discounts_input_checkout_review() {
        $discount_code = '';
        $discount_price = 0;
        if( InputBuilder::post() ) {
            $discount_code = trim(InputBuilder::post('discount_code'));
            $discount_price = discount::price($discount_code);
            if( is_skd_error($discount_price) ) {?>
                <div class="discount-alert">
                    <?php foreach ($discount_price->errors as $errors): ?>
                        <?php echo notice('error', $errors[0], false, __('Lỗi', 'discount_error'));?>
                    <?php endforeach ?>
                </div>
            <?php }
        }
        Plugin::partial(DISCOUNT_NAME, 'checkout/discount-form', ['discount_code' => $discount_code, 'discount_price' => $discount_price]);
        discount_product_detail([]);
    }
    add_action('checkout_review_order_after', 	'discounts_input_checkout_review', 2);
}

if (!function_exists('discounts_price_checkout_review')) {
    function discounts_price_checkout_review() {
        $discount_code = '';
        $discount_price = '';
        if(InputBuilder::post()) {
            $discount_code  = InputBuilder::post('discount_code');
            $discount_price = discount::price($discount_code);
        }
        Plugin::partial(DISCOUNT_NAME, 'checkout/discount-price-review', ['discount_code' => $discount_code, 'discount_price' => $discount_price]);
    }
    add_action('checkout_review_order', 	'discounts_price_checkout_review', 2);
}

if (!function_exists( 'discounts_total_checkout_review' )) {

    function discounts_total_checkout_review( $total ) {
        if(InputBuilder::post()) {
            $discount_code = trim(InputBuilder::post('discount_code'));
            $discount_price = discount::price($discount_code);
            if( !is_skd_error($discount_price) ) {
                $total = $total - $discount_price;
            }
        }
        return $total;
    }
    add_action('order_total', 	'discounts_total_checkout_review');
}

if (!function_exists('discounts_checkout_save')) {

    function discounts_checkout_save( $id ) {

        $order = order::get( $id, false, true );

        $discount_code = InputBuilder::post('discount_code');

        $discount       = Discount::get(['where' => array('code' => $discount_code)]);

        $discount_price = discount::price($discount);

        if( !empty($discount_price) && !is_skd_error($discount_price) ) {

            Order::updateMeta($id, '_discount_price', $discount_price );

            Order::updateMeta($id, '_discount_code', $discount_code );

            $discount->discount_use = $discount->discount_use + 1;

            if($discount->discount_customer == 'customer-user') {
                $customer_count = unserialize($discount->discount_customer_use);
                $user_current   = Auth::user();
                $customer_count[$user_current->id]['use'] = $customer_count[$user_current->id]['use'] + 1;
                $discount->discount_customer_use = serialize($customer_count);
            }
            
            Discount::insert((array)$discount);
            $order->total -= $discount_price;
            Order::insert((array)$order);
        }
    }
    add_action( 'checkout_order_after_save', 'discounts_checkout_save', 10, 1 );
}

if (!function_exists('discounts_item_totals')) {
    function discounts_item_totals( $totals, $order ) {
        if( isset($order->_discount_code) ) {
            $totals[2]['label'] = __('Mã Khuyến mãi', 'discount_code');
            $totals[2]['value'] = $order->_discount_code;
            $totals[3]['label'] = __('Khuyến mãi', 'discount');
            $totals[3]['value'] = number_format($order->_discount_price)._price_currency();
        }
        return $totals;
    }
    add_filter( 'get_order_item_totals', 'discounts_item_totals', 10, 2 );
}