<?php if(!empty($discount_price) && !is_skd_error($discount_price) ) {?>
    <tr class="discount-price">
        <td><?php echo __('Khuyến mãi','discount_promotion');?></td>
        <td><strong><?php echo number_format($discount_price)._price_currency();?></strong></td>
    </tr>
<?php } else { ?>
    <tr class="discount-price">
        <td><?php echo __('Khuyến mãi','discount');?></td>
        <td><strong>0<?php echo _price_currency();?></strong></td>
    </tr>
<?php } ?>