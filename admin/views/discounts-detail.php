<form method="post" action="" id="discount_form_edit" autocomplete="off">
    <?php echo Admin::loading();?>
    <input type="hidden" name="id" value="<?php echo $discount->id;?>">
    <div class="col-md-6">
        <div class="box" style="overflow: hidden">
            <div class="header"> <h2>MÃ GIẢM GIÁ</h2> </div>
            <!-- .box-content -->
            <div class="box-content">

                <div class="col-md-12 form-group">
                    <span class="discount-code"><?php echo $discount->code;?></span>
                    <div class="discount-value">
                        <div class="value">
                            <span class="text">Khuyến mãi</span>
                            <p class="price">
                                <?php echo number_format($discount->discount_value).Discount::unit($discount->discount_type);?>
                            </p>
                        </div>
                        <span class="icon-cut"><i class="fad fa-cut fa-rotate-270"></i></span>
                    </div>
                </div>

                <div class="col-md-12 box_discount " id="box_discount_img">
                    <div class="row">
                        <?php echo _form(['field' => 'discount_image', 'label' => 'Ảnh voucher', 'type' => 'image'], $discount->image);?>
                    </div>
                </div>

                <div class="col-md-12 box_discount" id="box_discount_name">
                    <label for="discount_name" class="control-label">Tên mã giảm giá</label>
                    <div class="group">
                        <input type="text" name="discount_name" id="discount_name" value="<?php echo $discount->name;?>" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-12 box_discount" id="box_discount_name">
                    <label for="discount_name" class="control-label">Mô tả mã giảm giá</label>
                    <div class="group">
                        <textarea type="text" name="discount_excerpt" id="discount_excerpt" class="form-control tinymce"><?php echo $discount->excerpt;?></textarea>
                    </div>
                </div>

            </div>
            <!-- /.box-content -->
        </div>
    </div>
    <div class="col-md-6">
        <div class="box" style="overflow: hidden">
            <div class="header"> <h2>Loại khuyến mãi </h2> </div>
            <div class="box-content">
                <!-- .Số lần giảm giá -->
                <div class="col-md-6 form-group">
                    <label for="box_discount_count" class="control-label">Số lần sử dụng mã giảm giá</label>
                    <?php if($discount->discount_customer == 'customer-user' && $discount->discount_customer_count == 0) {?>
                        <div class="input-group">
                            <input value="<?php echo $discount->discount_count;?>" class="form-control" disabled>
                            <div class="input-group-addon">
                                <label>
                                    <?php echo ($discount->discount_count_infinity == 1) ? 'Không giới hạn' : '';?>
                                </label>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="input-group">
                            <input type="number" name="discount_count" value="<?php echo $discount->discount_count;?>" id="discount_count" class="form-control" required <?php echo ($discount->discount_count_infinity == 1) ? 'disabled' : '';?>>
                            <div class="input-group-addon">
                                <label>
                                    <input type="checkbox" name="discount_count_infinity" id="discount_count_infinity" value="1" <?php echo ($discount->discount_count_infinity == 1) ? 'checked' : '';?>> Không giới hạn
                                </label>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- .Mức giảm tối đa -->
                <div class="col-md-6 form-group">
                    <label for="box_discount_count" class="control-label">Mức giảm tối đa</label>
                    <div class="input-group">
                        <input type="number" name="discount_value_maximum" value="<?php echo $discount->discount_value_maximum;?>" id="discount_value_maximum" class="form-control" required <?php echo ($discount->discount_type_maximum == 1) ? 'disabled' : '';?>>
                        <div class="input-group-addon">
                            <label> <input type="checkbox" name="discount_type_maximum" id="discount_type_maximum" value="1" <?php echo ($discount->discount_type_maximum == 1) ? 'checked' : '';?>> Không giới hạn </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box" style="overflow: hidden">
            <div class="header"> <h2>Thời gian áp dụng </h2> </div>
            <!-- .box-content -->
            <div class="box-content">
                <div class="col-md-6 box_discount " id="box_discount_time_start">
                    <label for="discount_time_start" class="control-label">Bắt đầu khuyến mãi</label>
                    <div class="group">
                        <input type="text" value="<?php echo date('Y/m/d', $discount->time_start);?>" class="form-control datetime" required disabled>
                    </div>
                </div>

                <div class="col-md-6 box_discount " id="box_discount_time_end">
                    <label for="discount_time_end" class="control-label">Kết thúc khuyến mãi</label>
                    <div class="group">
                        <input type="text" name="discount_time_end" id="discount_time_end" value="<?php echo date('Y/m/d', $discount->time_end);?>" class="form-control datetime" required <?php echo ($discount->time_status == 1) ? 'disabled' : '';?>>
                    </div>
                </div>
                <div class="col-md-12 box_discount " id="box_discount_time_status">
                    <div class="checkbox">
                        <label> <input type="checkbox" name="discount_time_status" id="discount_time_status" value="1" <?php echo ($discount->time_status == 1) ? 'checked' : '';?>> Không bao giờ hết hạn </label>
                    </div>
                </div>
            </div>
            <!-- /.box-content -->
        </div>

        <!-- YÊU CẦU TỐI THIỂU -->
        <div class="box" style="overflow: hidden">
            <div class="header"> <h2>Yêu cầu tối thiểu</h2> </div>
            <!-- .box-content -->
            <div class="box-content">
                <div class="col-md-12 box_discount">
                    <div class="radio">
                        <label>
                            <input type="radio" name="discount_type_minimize" id="discount_type_minimize_none" value="none" <?php echo ($discount->discount_type_minimize == 'none') ? 'checked' : '';?>> Không
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="discount_type_minimize" id="discount_type_minimize_money" value="money" <?php echo ($discount->discount_type_minimize == 'money') ? 'checked' : '';?>> Tiền mua tối thiểu (₫)
                        </label>
                        <div class="box_discount box_discount_value_minimize" id="box_discount_value_minimize_money" style="padding-left: 20px;margin: 10px 0; display: <?php echo ($discount->discount_type_minimize == 'money') ? 'block' : 'none';?>;">
                            <input type="number" name="discount_value_minimize_money" id="discount_value_minimize_money" value="<?php echo ($discount->discount_type_minimize == 'money') ? $discount->discount_value_minimize : '';?>" class="form-control" style="width:200px;">
                            <p style="color:#637381">Chỉ áp dụng cho các bộ sưu tập được chọn.</p>
                        </div>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="discount_type_minimize" id="discount_type_minimize_quantity" value="quantity" <?php echo ($discount->discount_type_minimize == 'quantity') ? 'checked' : '';?>> Số lượng sản phẩm tối thiểu
                        </label>
                        <div class="box_discount box_discount_value_minimize" id="box_discount_value_minimize_quantity" style="padding-left: 20px;margin: 10px 0; display: <?php echo ($discount->discount_type_minimize == 'quantity') ? 'block' : 'none';?>;">
                            <input type="number" name="discount_value_minimize_quantity" id="discount_value_minimize_quantity" value="<?php echo ($discount->discount_type_minimize == 'quantity') ? $discount->discount_value_minimize : '';?>" class="form-control" style="width:200px;">
                            <p style="color:#637381">Chỉ áp dụng cho các bộ sưu tập được chọn.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-content -->
        </div>

        <div class="box" style="overflow: inherit">
            <div class="header"><h2>Áp dụng cho loại</h2> </div>
            <!-- .box-content -->
            <div class="box-content" style="overflow: inherit">
                <div class="col-md-12 box_discount" id="box_discount_condition">
                    <div class="group">
                        <select name="discount_condition" id="discount_condition" class="form-control">
                            <option value="order" data-note-minimize="đơn hàng" <?php echo ($discount->discount_condition == 'order') ? 'selected' : '';?>>Tất cả các đơn hàng</option>
                            <option value="products" data-note-minimize="sản phẩm" <?php echo ($discount->discount_condition == 'products') ? 'selected' : '';?>>Sản phẩm cụ thể</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 box_discount_condition_value" id="box_discount_condition_value_products" style="display: none">
                    <div class="row">
                        <?php
                        $input =  array(
                            'field' 	=> 'discount_condition_value_products',
                            'label'     => 'Sản phẩm',
                            'type'  	=> 'popover-advance',
                            'search' 	=> 'products-variable',
                        );
                        echo FormBuilder::render($input, $discount->discount_condition_value);
                        ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- /.box-content -->
        </div>

        <div class="box">
            <div class="header"> <h2>Áp dụng cho khách hàng</h2> </div>
            <!-- .box-content -->
            <div class="box-content">
                <div class="col-md-12 box_discount " id="box_discount_customer">
                    <label class="control-label">
                        <?php if($discount->discount_customer == 'customer') echo 'Tất cả khách hàng';?>
                        <?php if($discount->discount_customer == 'customer-login') echo 'Khách hàng đã đăng nhấp';?>
                        <?php if($discount->discount_customer == 'customer-user') echo 'Khách hàng cụ thể';?>
                    </label>
                </div>
                <div class="col-md-12" id="box_discount_customer_user">

                    <?php if($discount->discount_customer == 'customer-user') {
                        $customer_count = $discount->discount_customer_use;
                        $list_user = User::gets(['where_in' => array('field' => 'id', 'data' => $discount->discount_customer_value), 'params' => array('select' => 'id, username, firstname, lastname, email')]);
                        ?>
                        <div class="discount_customer_list_user">
                            <?php foreach ($list_user as $item) { ?>
                                <div class="item-user" style="overflow: hidden; background-color: #e7e7e7;padding:10px; margin-bottom: 10px;">
                                    <div class="item-user-info pull-left">
                                        <p><strong><?php echo $item->firstname.' '.$item->lastname;?></strong> - <?php echo $item->email;?></p>
                                    </div>
                                    <div class="item-user-count pull-right">
                                        <?php
                                        $use = 0; $count = 0;
                                        if(isset($customer_count[$item->id])) {
                                            $use    = $customer_count[$item->id]['use'];
                                            $count  = ($discount->discount_count_infinity == 1) ? '∞' : $customer_count[$item->id]['count'];
                                        }
                                        ?>
                                        <p><?php echo $use;?>/<b><?php echo $count;?></b></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- /.box-content -->
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
</form>
<div class="clearfix"></div>
<br/><br/><br/><br/><br/><br/>
<style type="text/css">
    .box_discount {
        overflow: hidden; margin-bottom: 10px;
    }
    .input-group-addon { cursor: pointer; }

    .discount-code {
        margin:10px;
        padding:10px;
        display: block;
        background-color: #eaeaea;
        border: 2px dashed #c11e2f;
        text-align: center;
        font-size: 25px;
        font-weight: bold;
    }
    .discount-value {
        background-color: #c11e2f;
        color:#fff;
        padding:10px;
        position: relative;
        margin: 0 10px;
    }
    .discount-value .value {
        text-align: center;
    }
    .discount-value .value .text {
        font-size: 13px;
        font-weight: bold; display: block;
        color:#fff;
        padding:5px 10px;
    }
    .discount-value .value .text-2 {
        font-size: 20px;
        font-weight: bold; display: block;
        color:#fff;
    }
    .discount-value .value .price {
        font-size: 35px; font-weight: bold; display: block;
    }
    .discount-value .icon-cut {
        font-size: 18px;
        position: absolute; right: -8px;
        bottom:0;
        color: #231f20;
        z-index: 10;
    }
</style>

<script type="text/javascript">
    $(function() {
        let discount_condition      = $('select#discount_condition');
        let minimize_note           = 'đơn hàng';
        let discount_type_maximum  = $('input[name="discount_type_maximum"]');
        let discount_type_minimize  = $('input[name="discount_type_minimize"]');

        let val = discount_condition.val();
        minimize_note = $('option:selected', discount_condition).attr('data-note-minimize');
        $('.box_discount_condition_value').hide();
        $('#box_discount_condition_value_'+val).show();
        $('.box_discount_value_minimize p').text('Chỉ áp dụng cho các '+minimize_note+' được chọn.');

        discount_type_maximum.change(function() {
            if(this.checked) {
                $('input#discount_value_maximum').prop( "disabled", true );
            }
            else {
                $('input#discount_value_maximum').prop( "disabled", false );
            }
        });

        discount_type_minimize.change(function() {
            let val = $(this).val();
            $('.box_discount_value_minimize').hide();
            $('.box_discount_value_minimize p').text('Chỉ áp dụng cho các đơn hàng được chọn.');
            $('#box_discount_value_minimize_'+val).show();
        });

        discount_condition.change(function() {
            let val = $(this).val();
            minimize_note = $('option:selected', this).attr('data-note-minimize');
            $('.box_discount_condition_value').hide();
            $('#box_discount_condition_value_'+val).show();
            $('.box_discount_value_minimize p').text('Chỉ áp dụng cho các '+minimize_note+' được chọn.');
        });

        $("input#discount_count_infinity").change(function() {
            if(this.checked) {
                $('input#discount_count').prop( "disabled", true );
            }
            else {
                $('input#discount_count').prop( "disabled", false );
            }
        });

        $("input#discount_time_status").change(function() {
            if(this.checked) {
                $('input#discount_time_end').prop( "disabled", true );
            }
            else {
                $('input#discount_time_end').prop( "disabled", false );
            }
        });

        $('#discount_form_edit').submit(function() {

            $('.loading').show();

            let data        = $(this).serializeJSON();

            $(this).find('textarea').each(function(index, el) {
                let textareaid 	= $(this).attr('id');
                let value 		= $(this).val();
                if($(this).hasClass('tinymce') === true || $(this).hasClass('tinymce-shortcut') === true){
                    value 	= document.getElementById(textareaid+'_ifr').contentWindow.document.body.innerHTML;
                }
                data[$(this).attr('name')] = value;
            });

            data.action     =  'Discount_Admin_Ajax::save';

            $jqxhr   = $.post(ajax, data, function() {}, 'json');

            $jqxhr.done(function(response) {

                $('.loading').hide();

                show_message(response.message, response.status);

                if( response.status === 'success') {
                    window.location = response.location;
                }
            });

            return false;

        });
    })
</script>