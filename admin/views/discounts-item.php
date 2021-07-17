<?php
    $status = discount::status($discount);
    if($status != $discount->status) {
        $discount->status = $status;
        Discount::insert((array)$discount);
    }
?>

<div class="discount-item discount-item-<?php echo discount::status($discount);?>">
    <div class="ribbon ribbon-top-left ribbon-<?php echo discount::status($discount);?>"><span><?php echo discount::statusLabel($discount);?></span></div>
    <div class="discount-value">
        <?php if(!empty($discount->image)) {?>
        <div class="image">
            <?php Template::img($discount->image);?>
        </div>
        <?php } else { ?>
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
        <?php } ?>
        <span class="icon-cut"><i class="fad fa-cut fa-rotate-270"></i></span>
    </div>
    <div class="discount-content">
        <h3><?php echo $discount->name;?></h3>
        <p>Áp dụng cho: <?php echo discount::condition($discount->discount_condition);?></p>
        <p>Dành cho cho: <?php echo discount::customer($discount->discount_customer);?></p>
        <?php if($discount->discount_type_minimize == 'money') {?>
        <p>Mức tối thiểu: <?php echo number_format($discount->discount_value_minimize);?>đ</p>
        <?php } ?>
        <?php if($discount->discount_type_minimize == 'quantity') {?>
        <p>SL sản phẩm tối thiểu: <?php echo number_format($discount->discount_value_minimize);?>đ</p>
        <?php } ?>
    </div>
    <div class="discount-time text-center">
        <div style="display: inline-block;">
            <p class="time-start">
                <i class="far fa-calendar-alt"></i> Bắt đầu:
                <span><?php echo date('d/m/Y', $discount->time_start);?></span>
            </p>
            <p class="time-end"><i class="fas fa-calendar-alt"></i> Kết thúc:
                <?php if($discount->time_status == 1) {?>
                    <span>Không hết hạn</span>
                <?php }  else { ?>
                    <span><?php echo date('d/m/Y', $discount->time_end);?></span>
                <?php } ?>
            </p>
        </div>
    </div>
    <div class="discount-info">
        <span class="discount-code"><?php echo $discount->code;?></span>
        <p class="text-center">Số lần sử dụng: <?php echo $discount->discount_use;?>/<?php echo ($discount->discount_count_infinity == 1) ? '∞' : $discount->discount_count;?></p>
    </div>
    <div class="discount-action text-right">
        <a href="<?php echo URL_ADMIN;?>/plugins?page=discounts&view=detail&id=<?php echo $discount->id;?>" class="btn btn-blue">Chi tiết</a>
        <?php if(Auth::hasCap('delete_discount_role') ) { ?>
            <button class="btn btn-red delete-discount" data-id="<?php echo $discount->id;?>"><?php echo Admin::icon('delete');?></button>
        <?php } ?>
    </div>
    <div class="clearfix"></div>
</div>