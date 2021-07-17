<div class="page-cart-box">
    <div class="discount" style="position: relative">
        <p><?php echo __('Mã giảm giá', 'discount_code');?> / <?php echo __('Quà tặng', 'discount_gift');?></p>
        <?php if( !empty($discount_price) && !is_skd_error($discount_price) ) { $discount = Discount::get(['where' => array('code' => $discount_code)]); ?>
            <div class="">
                <strong>
                    <div class="discount-value">
                        <div class="value">
                            <span class="text"><?php echo __('Khuyến mãi', 'discount_promotion');?> <?php echo number_format($discount->discount_value).Discount::unit($discount->discount_type);?> <?php if($discount->discount_type_maximum == 0) { echo __('giảm tối đa', 'discount_minimize'); echo number_format($discount->discount_value_maximum)._price_currency(); } else { ?> off <?php } ?></span>
                            <p class="price">
                                <?php echo $discount->code;?>
                            </p>
                        </div>
                    </div>
                </strong>
                <input type="hidden" name="discount_code" class="form-control" value="<?php echo $discount_code;?>">
            </div>
            <div class="discount_button">
                <button class="btn" type="button" id="discount_remove"><?php echo __('đổi mã', 'discount_changecode');?></button>
            </div>
        <?php } else { ?>
            <div class="discount_input">
                <input type="text" name="discount_code" class="form-control" value="<?php echo $discount_code;?>">
            </div>
            <div class="discount_button">
                <button class="btn btn-white" type="button" id="discount_apply"><?php echo __('áp dụng', 'discount_apply');?></button>
            </div>
        <?php } ?>
    </div>
</div>
<style>
    .discount { overflow:hidden; }
    .discount p { margin-bottom:10px!important; }
    .discount_input, .discount_button { float:left; }
    .discount_button { width:80px; }
    .discount_button .btn {
        -webkit-box-shadow: none;
        box-shadow: none;
        margin-bottom:0;
    }
    .discount_input { width:calc(100% - 80px); padding-right:20px; }
    .discount_input input.form-control { background-color:#F0F2F5;border-radius:5px;margin-bottom:0; }
    .discount .discount-value {
        background-color: #c11e2f;
        color:#fff;
        padding:10px;
        position: relative;
        border-right: 1px dashed #fff;
        border-left: 2px dashed #c11e2f;
    }
    .discount .discount-value:before {
        content: '';
        position: absolute; top: -22px; right: -17px; width: 30px; height: 30px; border-radius: 50%; display: inline-block;
        z-index: 9; background-color: #fff;
    }
    .discount .discount-value:after {
        content: '';
        position: absolute; bottom: -22px; right: -17px; width: 30px; height: 30px; border-radius: 50%; display: inline-block;
        z-index: 9; background-color: #fff;
    }
    .discount .discount-value .value {
        text-align: center;
    }
    .discount .discount-value .value .text {
        font-size: 13px;
        font-weight: bold; display: block;
        color:#fff;
        padding:5px 10px;
    }
    .discount .discount-value .value .text-2 {
        font-size: 20px;
        font-weight: bold; display: block;
        color:#fff;
    }
    .discount .discount-value .value .price {
        font-size: 35px; font-weight: bold; display: block;
    }
    .discount .discount-value .icon-cut {
        font-size: 18px;
        position: absolute; right: -8px;
        bottom:0;
        color: #231f20;
        z-index: 10;
    }

    #discount_remove {
        position: absolute; top:0; right:0;
        width:100px; font-size: 13px;
        padding:5px 10px;
        margin: 0;
        line-height: 15px;
        height: 25px;
    }
    .object-detail { overflow: inherit;}
</style>
<script type="text/javascript">
    $('#discount_apply').click(function(){
        update_order_review();
    });
    $('#discount_remove').click(function(){
        $('input[name="discount_code"]').remove();
        update_order_review();
    });
</script>