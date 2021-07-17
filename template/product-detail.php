<div class="product-detail-discount-box">
    <div class="product-detail-discount__title">
        <p>Mã giảm giá</p>
    </div>
    <div class="product-detail-discount__item">
        <?php foreach ($discounts as $item) { ?>
            <div class="coupon__tag">Giảm <?php echo number_format($item->discount_value).Discount::unit($item->discount_type);?></div>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <div class="product-detail-discount__popover">
        <div class="product-detail-discount__popover_heading">Mã giảm giá của Shop</div>
        <div class="product-detail-discount__popover_sub_heading">Tiết kiệm hơn khi áp dụng mã giảm giá của Shop. Liên hệ với Shop nếu gặp trục trặc về mã giảm giá do Shop tự tạo.</div>
        <div class="product-detail-discount__popover_list">
            <?php foreach ($discounts as $item) { ?>
                <div class="coupon__item">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 400 132" class="coupon-bg"><g fill="none" fill-rule="evenodd"><g><g><g><g><g><g transform="translate(-3160 -2828) translate(3118 80) translate(42 2487) translate(0 140) translate(0 85) translate(0 36)"><path fill="#FFF" d="M392 0c4.418 0 8 3.582 8 8v116c0 4.418-3.582 8-8 8H140.5c0-4.419-3.582-8-8-8s-8 3.581-8 8H8c-4.418 0-8-3.582-8-8V8c0-4.418 3.582-8 8-8h116.5c0 4.418 3.582 8 8 8s8-3.582 8-8H392z"></path><g stroke="#EEE" stroke-dasharray="2 4" stroke-linecap="square" mask="url(#14s2l20tnb)"><path d="M0.5 0L0.5 114" transform="translate(132 11)"></path></g></g></g></g></g></g></g></g></svg>
                    <div class="coupon__item_box">
                        <div class="coupon__item_img">
                            <?php if(empty($item->image)) $item->image = Option::get('logo_header');?>
                            <?php Template::img($item->image, 'coupon');?>
                        </div>
                        <div class="coupon__item_info">
                            <button class="coupon__item_info_detail" style="position: absolute; top: 12px; right: 12px; transform: translate(8px, -8px);">
                                <img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20width%3D%2220%22%20height%3D%2220%22%20viewBox%3D%220%200%2020%2020%22%3E%20%20%20%20%3Cdefs%3E%20%20%20%20%20%20%20%20%3Cpath%20id%3D%224gg7gqe5ua%22%20d%3D%22M8.333%200C3.738%200%200%203.738%200%208.333c0%204.595%203.738%208.334%208.333%208.334%204.595%200%208.334-3.739%208.334-8.334S12.928%200%208.333%200zm0%201.026c4.03%200%207.308%203.278%207.308%207.307%200%204.03-3.278%207.308-7.308%207.308-4.03%200-7.307-3.278-7.307-7.308%200-4.03%203.278-7.307%207.307-7.307zm.096%206.241c-.283%200-.512.23-.512.513v4.359c0%20.283.23.513.512.513.284%200%20.513-.23.513-.513V7.78c0-.283-.23-.513-.513-.513zm.037-3.114c-.474%200-.858.384-.858.858%200%20.473.384.857.858.857s.858-.384.858-.857c0-.474-.384-.858-.858-.858z%22%2F%3E%20%20%20%20%3C%2Fdefs%3E%20%20%20%20%3Cg%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%20%20%20%20%20%20%20%20%3Cg%3E%20%20%20%20%20%20%20%20%20%20%20%20%3Cg%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Cg%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Cg%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Cg%20transform%3D%22translate%28-2808%20-4528%29%20translate%282708%2080%29%20translate%2852%204304%29%20translate%2848%20144%29%20translate%281.667%201.667%29%22%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Cuse%20fill%3D%22%23017FFF%22%20xlink%3Ahref%3D%22%234gg7gqe5ua%22%2F%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3C%2Fg%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3C%2Fg%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3C%2Fg%3E%20%20%20%20%20%20%20%20%20%20%20%20%3C%2Fg%3E%20%20%20%20%20%20%20%20%3C%2Fg%3E%20%20%20%20%3C%2Fg%3E%3C%2Fsvg%3E" alt="info-icon">
                            </button>
                            <div class="coupon__item_info_content" style="padding-right: 28px;">
                                <h4><?php echo $item->name;?></h4>
                                <p><strong><?php echo $item->code;?></strong></p>
                            </div>
                            <div class="coupon__item_info_footer">
                                <?php if($item->time_status == 1) {?>
                                    <p style="padding-right: 8px;">HSD: Không hết hạn</p>
                                <?php }  else { ?>
                                    <p style="padding-right: 8px;">HSD:<?php echo date('d/m/Y', $item->time_end);?></p>
                                <?php } ?>
                                <button class="js_coupon_btn__copy" data-code="<?php echo $item->code;?>" style="margin-left: auto; white-space: nowrap;">
                                    <img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%3E%20%20%20%20%3Cdefs%3E%20%20%20%20%20%20%20%20%3Cpath%20id%3D%22labrj0lkfa%22%20d%3D%22M6.527%202.099c.521%200%20.946.425.949.948v8.004c0%20.524-.425.949-.949.949H.95C.425%2012%200%2011.575%200%2011.051V3.047C0%202.524.425%202.1.949%202.1zm-.002.663H.946c-.157%200-.285.128-.285.285v8.002c0%20.157.128.285.285.285h5.579c.157%200%20.285-.128.285-.285V3.047c0-.157-.128-.285-.285-.285zM8.66%200c.524%200%20.949.425.949.949v8.004c0%20.523-.425.948-.949.948-.184%200-.332-.147-.332-.331%200-.185.148-.332.332-.332.158%200%20.285-.128.285-.285V.949c0-.158-.127-.285-.285-.285H3.082c-.158%200-.285.127-.285.285%200%20.184-.148.331-.332.331-.184%200-.332-.147-.332-.331%200-.524.425-.949.949-.949z%22%2F%3E%20%20%20%20%3C%2Fdefs%3E%20%20%20%20%3Cg%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%20%20%20%20%20%20%20%20%3Cg%3E%20%20%20%20%20%20%20%20%20%20%20%20%3Cg%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Cg%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Cg%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Cg%20transform%3D%22translate%28-2760%20-4524%29%20translate%282708%2080%29%20translate%2852%204304%29%20translate%280%20140%29%22%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Ccircle%20cx%3D%2212%22%20cy%3D%2212%22%20r%3D%2212%22%20fill%3D%22%23E5F2FF%22%2F%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Cg%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Cg%20transform%3D%22translate%286%206%29%20translate%281%29%22%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Cmask%20id%3D%22n5b3eobj0b%22%20fill%3D%22%23fff%22%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Cuse%20xlink%3Ahref%3D%22%23labrj0lkfa%22%2F%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3C%2Fmask%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Cuse%20fill%3D%22%23787878%22%20xlink%3Ahref%3D%22%23labrj0lkfa%22%2F%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Cg%20fill%3D%22%23017FFF%22%20mask%3D%22url%28%23n5b3eobj0b%29%22%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Cpath%20d%3D%22M0%200H12V12H0z%22%20transform%3D%22translate%28-1%29%22%2F%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3C%2Fg%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3C%2Fg%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3C%2Fg%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3C%2Fg%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3C%2Fg%3E%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3C%2Fg%3E%20%20%20%20%20%20%20%20%20%20%20%20%3C%2Fg%3E%20%20%20%20%20%20%20%20%3C%2Fg%3E%20%20%20%20%3C%2Fg%3E%3C%2Fsvg%3E" alt="copy-icon" class="sc-hMqMXs fQIFOK">
                                    Sao chép
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <input type="text" id="js_discount_code_copy" value="" style="opacity: 0;padding: 0; height: 0;">
    </div>
</div>
<div class="clearfix"></div>
<style>
    .product-detail-discount-box {
        clear: both; position: relative;
        padding-bottom: 10px;
    }
    .product-detail-discount__title {
        float: left; width: 100px;
    }
    .product-detail-discount__item {
        float: left; width: calc(100% - 100px);
        display: flex;
        overflow-x: auto;
        -ms-scroll-snap-type: x proximity;
        scroll-snap-type: x proximity;
        gap: 1rem;
        padding-bottom: 5px;
    }
    .product-detail-discount__item::-webkit-scrollbar-track {
        border-radius: 10px;
        background-color: #fff;
        width: 5px; height: 5px;
    }
    .product-detail-discount__item::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background-color: #919aa8;
        width: 5px; height: 5px;
    }
    .product-detail-discount__item::-webkit-scrollbar {
        width: 5px; height: 5px;
        background-color: #fff;
    }
    .coupon__tag {
        cursor: pointer;
        padding: 3px 12px;
        border: 1px solid var(--theme-color);
        border-radius: 4px;
        font-size: 13px;
        font-weight: 500;
        line-height: 20px;
        color: var(--theme-color);
        position: relative;
        margin: 0;
        display: inline-block;
        scroll-snap-stop: normal;
        scroll-snap-align: start;
        flex: 0 0 auto;
    }
    .coupon__tag::before, .coupon__tag::after {
        content: "";
        width: 10px;
        height: 10px;
        background-color: rgb(255, 255, 255);
        border-width: 1px;
        border-style: solid;
        border-color: transparent var(--theme-color) var(--theme-color) transparent;
        border-image: initial;
        position: absolute;
        top: 50%;
        margin-top: -5px;
        border-radius: 50%;
    }
    .coupon__tag::before {
        left: -6px;
        transform: rotate(-45deg);
    }
    .coupon__tag::after {
        right: -6px;
        transform: rotate(135deg);
    }

    .product-detail-discount__popover {
        display: none;
        position: absolute; z-index: 99; width: 450px;
        top: 50px;
        left: 0px;
        background-color: #fff; padding:20px 20px 0 20px;
        border-radius: 10px;
        transform: translateY(-5px);
        box-shadow: 0 4px 60px 0 rgb(0 0 0 / 20%), 0 0 0 transparent;
    }
    .product-detail-discount-box:hover .product-detail-discount__popover { display: block;}
    .product-detail-discount__popover .product-detail-discount__popover_heading {
        font-weight: bold; margin-bottom: 10px;
    }
    .product-detail-discount__popover .product-detail-discount__popover_sub_heading {
        margin-bottom: 10px;
    }
    .coupon__item {
        position: relative;
        opacity: 1;
        width: 100%;
        height: 132px;
        display: flex;
        margin-bottom: 20px;
    }
    .coupon__item .coupon-bg {
        width: 100%;
        height: 132px;
        filter: drop-shadow(rgba(0, 0, 0, 0.15) 0px 1px 3px);
    }
    .coupon__item_box {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        display: flex;
    }
    .coupon__item_img {
        min-width: 132px;
        width: 132px;
        height: 132px;
        padding: 8px;
        display: flex;
        flex-direction: column;
        -webkit-box-align: center;
        align-items: center;
        align-self: center;
        -webkit-box-pack: center;
        justify-content: center;
    }
    .coupon__item_img image {
        object-fit: contain;
        border-radius: 8px;
    }

    .coupon__item_info {
        display: flex;
        flex-direction: column;
        padding: 12px;
        width: calc(100% - 132px);
    }
    .coupon__item_info_detail {
        display: block;
        background: transparent;
        outline: none;
        border: none;
        padding: 8px;
        cursor: pointer;
        line-height: 0px;
    }
    .coupon__item_info_content h4 {
        letter-spacing: 0px;
        margin: 0px;
        padding: 0px;
        font-size: 15px;
        font-weight: 500;
        line-height: 24px;
        color: rgb(36, 36, 36);
    }

    .coupon__item_info_footer {
        margin-top: auto;
        display: flex;
        align-items: flex-end;
    }
    .coupon__item_info_footer p {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
        overflow: hidden;
        text-overflow: ellipsis;
        letter-spacing: 0px;
        margin: 0px;
        padding: 0px;
        font-size: 13px;
        font-weight: 400;
        line-height: 20px;
        max-height: 20px;
        color: rgb(120, 120, 120);
    }
    .coupon__item_info_footer button {
        font-weight: 500;
        letter-spacing: 0px;
        cursor: pointer;
        text-align: center;
        border-radius: 4px;
        outline: none;
        font-size: 13px;
        line-height: 24px;
        padding: 2px 12px;
        color: rgb(255, 255, 255);
        background-color: rgb(1, 127, 255);
        border: none;
    }
</style>

<script>
    $(function () {
        $('.js_coupon_btn__copy').click(function () {
            let code = $(this).data('code');
            $('#js_discount_code_copy').val(code).select();
            document.execCommand("copy");
            show_message('Mã giảm giá đã được sao chép thành công.', 'success');
            return false;
        })
    });
</script>
