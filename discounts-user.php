<?php
function user_page_discount_action_links( $args ) {
    $newArgs = array();
    foreach ($args as $key => $value) {
        if( $key == 'logout' ) {
            $newArgs['discount'] = array(
                'label' => __('Voucher giảm giá'),
                'icon'  => '<i class="fal fa-tags"></i>',
                'url'	=> Url::account().'/discount',
            );
        }
        $newArgs[$key] = $value;
    }
    return $newArgs;
}
add_filter('my_action_links', 'user_page_discount_action_links');

function user_page_discount_view( $view ) {

    $ci =& get_instance();

    $method = Url::segment(3);

    $lang = Url::segment(1);

    if( (Language::default() != Language::current() || $lang ==  Language::default()) && $lang == Language::current()) $method = Url::segment(4);

    $user = Auth::user();

    $discounts = Discount::gets([
        'where_like' => ['discount_customer_value' => array(','.$user->id.',')],
        'where'      => ['discount_customer' => 'customer-user', 'status <>' => 'stop']
    ]);

    foreach ($discounts as $discount) {
        $status = discount::status($discount);
        if($status != $discount->status) {
            $discount->status = $status;
            Discount::insert((array)$discount);
        }
    }

    $discounts = Discount::gets([
        'where_like' => ['discount_customer_value' => array(','.$user->id.',')],
        'where'      => ['discount_customer' => 'customer-user']
    ]);

    $ci->data['my_discounts'] = $discounts;

    $view = Path::theme(DISCOUNT_PATH.'user/discount');

    if(!file_exists($view) ) $view = DISCOUNT_PATH.'/template/user/discount';

    return $view;
}
add_filter('my_account_view_discount', 'user_page_discount_view');