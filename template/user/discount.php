<h1 class="user-header-title">Voucher của bạn</h1>
<?php foreach ($my_discounts as $discount) { ?>
    <div class="coupon-item" data-id="<?= $discount->id;?>" data-title="<?= $discount->name;?>" data-code="<?= $discount->code;?>">
        <div class="coupon-mgg-wrap">
            <div class="mgg-code">
                <?php if(!empty($discount->image)) {?>
                    <div class="store-thumb thumb-img">
                        <a class="thumb-padding" href="#"> <?= get_img($discount->image);?> </a>
                    </div>
                <?php } else { ?>
                <div class="discount-value">
                    <div class="value">
                        <span class="text">Khuyến mãi</span>
                        <p class="price">
                            <?php echo number_format($discount->discount_value).Discount::unit($discount->discount_type);?>
                            <?php if($discount->discount_type_maximum == 0) {?>
                                <span class="text-2" style="font-size:13px;">Giảm tối đa <?php echo number_format($discount->discount_value_maximum);?>đ</span>
                            <?php }  else { ?>
                                <span class="text-2">off</span>
                            <?php } ?>
                        </p>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="latest-coupon">
                <a href="#" class="offer-label"> Mã giảm giá </a>
                <h3 class="coupon-title">
                    <a class="coupon-link js_voucher_get_code" href="#" title="<?= $discount->name;?>"><?= $discount->name;?></a>
                </h3>
                <div class="c-type exp">Hạn SD: <?= ($discount->time_status == 0) ? date('d/m/Y', $discount->time_end) : 'Vô thời hạn';?></div>
            </div>
            <div class="coupon-detail">
                <a rel="nofollow" class="coupon-button coupon-code coupon-mgg-show js_voucher_get_code">
                    <span class="code-text" rel="nofollow"><?= $discount->code;?></span>
                    <span class="get-code">Lấy Mã</span>
                </a>
                <a class="reveal-detail-open text-right" href="#" title="Điều kiện">Điều kiện <i class="fal fa-chevron-down"></i></a>
            </div>
        </div>
        <div class="coupon-footer coupon-listing-footer">
            <div class="reveal-content reveal-detail">
                <p>Áp dụng cho: <?php echo discount::condition($discount->discount_condition);?></p>
                <p>Dành cho: <?php echo discount::customer($discount->discount_customer);?></p>
                <?php if($discount->discount_type_minimize == 'money') {?>
                    <p>Mức tối thiểu: <?php echo number_format($discount->discount_value_minimize);?>đ</p>
                <?php } ?>
                <?php if($discount->discount_type_minimize == 'quantity') {?>
                    <p>SL sản phẩm tối thiểu: <?php echo number_format($discount->discount_value_minimize);?>đ</p>
                <?php } ?>
                <?php echo $discount->excerpt;?>
            </div>
        </div>
    </div>
<?php } ?>

<style>
    .coupon-item {
        padding-bottom: 0;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.05);
        -moz-box-shadow: 0 1px 1px 0 rgba(0,0,0,.05);
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.05);
        background: #FFF;
        margin-bottom: 20px;
    }
    .coupon-mgg-wrap {
        position: relative;
        display: table;
        width: 100%;
        background-color: #f0f6f5;
    }
    .coupon-mgg-wrap .mgg-code, .coupon-mgg-wrap .latest-coupon, .coupon-mgg-wrap .coupon-detail {
        display: table-cell;
        vertical-align: top;
        text-align: left;
        padding-right: 20px;
        padding-bottom: 10px;
    }
    .coupon-mgg-wrap .mgg-code {
        background: #fff;
        vertical-align: middle;
        width: 160px;
        padding: 0 0px;
        border-right: 1px dashed #d5d5d5;
        display: table-cell;
        text-align: left;
    }
    .coupon-mgg-wrap .mgg-code .store-thumb {
        min-height: auto;
    }
    .coupon-mgg-wrap .mgg-code .store-thumb a {
        padding: 0;
        text-align: center;
        overflow: hidden;
        display: block;
        width: 100%;
    }

    .coupon-item .discount-value {
        float: left; width: 100%; height: 130px;
        background-color: #c11e2f;
        color:#fff;
        padding:10px;
        position: relative;
        border-right: 1px dashed #fff;
    }

    .coupon-item .discount-value .value {
        text-align: center; position: absolute; top:0; left:0; width:100%; height: 100%;
    }
    .coupon-item .discount-value .value .text {
        font-size: 13px;
        font-weight: bold; display: block;
        color:#fff;
        padding:5px 10px;
    }
    .coupon-item .discount-value .value .text-2 {
        font-size: 20px;
        font-weight: bold; display: block;
        color:#fff;
    }
    .coupon-item .discount-value .value .price {
        font-size: 35px; font-weight: bold; display: block;
    }


    .coupon-mgg-wrap .mgg-code::before, .coupon-mgg-wrap .mgg-code::after {
        display: block;
        content: " ";
        width: 26px;
        height: 18px;
        background: #fff;
        position: absolute;
        left: 147px;
        top: -9px;
        z-index: 9;
        border-radius: 50%;
    }
    .coupon-mgg-wrap .mgg-code::after {
        top: auto;
        bottom: -12px;
    }
    .coupon-mgg-wrap .latest-coupon {
        max-width: 100%;
        padding: 0 15px;
    }
    .coupon-mgg-wrap .latest-coupon .offer-label {
        font-size: 15px;
        line-height: 1.6;
        font-weight: 400;
        flex: 0 0 auto;
        padding-top: 15px;
        display: block;
        color: #10b48a;
    }
    .coupon-mgg-wrap .latest-coupon .coupon-title {
        font-size: 16px;
        margin-bottom: 10px;
        font-weight: 600;
        line-height: 1.5;
        margin-top: 5px;
    }
    .coupon-mgg-wrap .latest-coupon .coupon-title .coupon-link {
        color: #444;
    }
    .coupon-mgg-wrap .c-type.exp, .coupon-mgg-wrap .c-type.used {
        font-size: 14px;
        color: #757575;
    }
    .coupon-item .coupon-detail {
        padding-top: 25px;
        float: right;
    }
    .coupon-item .coupon-detail .coupon-code {
        color: #444;
        background: linear-gradient(315deg,rgba(0,0,0,.06) 10%,rgba(0,0,0,0) 15%,rgba(0,0,0,0) 35%,rgba(0,0,0,.06) 40%,rgba(0,0,0,.06) 60%,rgba(0,0,0,0) 65%,rgba(0,0,0,0) 85%,rgba(0,0,0,.06) 90%) repeat scroll 0 0/6px 6px rgba(0,0,0,0);
        text-align: right;
        padding: 10px 12px;
        font-size: 20px;
        border: 2px solid #DDD;
        position: relative;
        margin-bottom: 10px;
        font-weight: 600;
        display: inline-block;
        letter-spacing: 1px;
        text-transform: uppercase;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        min-width: 195px;
        width: 100%;
    }
    .coupon-item .coupon-detail .coupon-code .get-code {
        position: absolute;
        left: -2px;
        top: -2px;
        background-color: #f30;
        color: #FFF;
        font-size: 16px;
        padding: 12px 15px 12px 14px;
        border-top-left-radius: 2px;
        border-bottom-left-radius: 2px;
        transition: all .5s ease;
        min-width: 60%;
        text-align: left;
        cursor: pointer;
    }
    .coupon-item .coupon-detail .coupon-code .get-code:after {
        content: "";
        display: block;
        width: 0;
        height: 0;
        border-top: 49px solid transparent;
        border-left: 49px solid #f30;
        position: absolute;
        right: -49px;
        top: 0px;
    }

    .coupon-item .reveal-detail-open {
        display: block; text-align: right;
    }

    .coupon-item .coupon-listing-footer .reveal-content {
        padding: 12px 20px;
        border-top: 1px dashed #d5d5d5;
        margin: 0;
        display: none;
        position: relative;
        border-bottom-left-radius: 4px;
        border-bottom-right-radius: 4px;
        background: #ffffd2;
    }
    .coupon-item .coupon-listing-footer .reveal-content.active {
        display: block;
    }
</style>

<script>
    $(function () {
        $('.reveal-detail-open').click(function () {
            $(this).closest('.coupon-item').find('.coupon-footer .reveal-detail').toggle();
            return false;
        });

        $('.coupon-detail .js_voucher_get_code').click(function () {
            $(this).find('.get-code').remove();
            return false;
        });
    })
</script>
