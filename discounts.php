<?php
/**
Plugin name     : Discounts
Plugin class    : discounts
Plugin uri      : http://sikido.vn
Description     : Ứng dụng Tạo mã giảm giá sẽ là trợ thủ đắc lực giúp bạn nhanh chóng tạo ra nhiều mã khuyến mãi  trong khi có thể quản lý hiệu quả và tùy chỉnh dễ dàng các mã ấy.
Author          : Nguyễn Hữu Trọng
Version         : 2.2.1
 */
define('DISCOUNT_NAME', 'discounts');

define('DISCOUNT_PATH', Path::plugin(DISCOUNT_NAME));

define('DISCOUNT_VERSION', '2.2.1');

class discounts {

    private $name = 'discounts';

    function __construct() {}

    public function active() {
        if(!class_exists('sicommerce_cart')) {
            echo notice('error', 'Bạn phải cài đặt plugins <b>GIỎ HÀNG</b> trước khi cài đặt plugin mã giảm giá!', true);
            die;
        }
        Discount_Activator::activate();
    }

    public function uninstall() {
        Discount_Deactivator::uninstall();
    }
}

include 'discounts-active.php';
include 'discounts-function.php';
include 'discounts-ajax.php';
if(Admin::is()) include 'discounts-admin.php';
include 'discounts-checkout.php';
include 'discounts-user.php';
include 'discounts-product-detail.php';