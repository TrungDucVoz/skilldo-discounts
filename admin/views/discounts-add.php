<form method="post" action="" id="discount_form_add" autocomplete="off">
    <?php echo Admin::loading();?>
    <div class="col-md-6">
        <div class="box" style="overflow: hidden">
            <div class="header"> <h2>MÃ GIẢM GIÁ</h2> </div>
            <!-- .box-content -->
            <div class="box-content">

                <div class="col-md-12 form-group">
                    <label for="discount_code" class="control-label">Mã giảm giá</label>
                    <div class="input-group">
                        <input type="text" name="discount_code" id="discount_code" value="" class="form-control" required>
                        <div class="input-group-addon" id="js_discount_code_auto">Tạo mã tự động</div>
                    </div>
                </div>

                <div class="col-md-12 box_discount " id="box_discount_img">
                    <div class="row">
                    <?php echo _form(['field' => 'discount_image', 'label' => 'Ảnh voucher', 'type' => 'image']);?>
                    </div>
                </div>

                <div class="col-md-12 box_discount " id="box_discount_name">
                    <label for="discount_name" class="control-label">Tên mã giảm giá</label>
                    <div class="group">
                        <input type="text" name="discount_name" id="discount_name" value="" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-12 box_discount " id="box_discount_name">
                    <label for="discount_name" class="control-label">Mô tả mã giảm giá</label>
                    <div class="group">
                        <textarea type="text" name="discount_excerpt" id="discount_excerpt" class="form-control tinymce-shortcut"></textarea>
                    </div>
                </div>

                <div class="col-md-12 form-group">
                    <label for="box_discount_count" class="control-label">Số lần sử dụng mã giảm giá</label>
                    <div class="input-group">
                        <input type="number" name="discount_count" value="1" id="discount_count" class="form-control" required>
                        <div class="input-group-addon">
                            <label>
                                <input type="checkbox" name="discount_count_infinity" id="discount_count_infinity" value="1"> Không giới hạn
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-content -->
        </div>

        <div class="box" style="overflow: hidden">
            <div class="header"> <h2>Loại khuyến mãi </h2> </div>
            <!-- .box-content -->
            <div class="box-content">
                <div class="col-md-6 box_discount " id="box_discount_type">
                    <label for="discount_type" class="control-label">Hình thức khuyến mãi</label>
                    <div class="group">
                        <select name="discount_type" id="discount_type" class="form-control" required="required">
                            <option value="money">VND</option>
                            <option value="percent">%</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 box_discount " id="box_discount_value">
                    <label for="discount_value" class="control-label">Giá trị</label>
                    <div class="group">
                        <input type="number" name="discount_value" value="0" id="discount_value" class="form-control ">
                    </div>
                </div>

                <div class="col-md-12 form-group">
                    <label for="box_discount_maximum" class="control-label">Mức giảm tối đa</label>
                    <div class="input-group">
                        <input type="number" name="discount_value_maximum" value="0" id="discount_value_maximum" class="form-control" required disabled>
                        <div class="input-group-addon">
                            <label> <input type="checkbox" name="discount_type_maximum" id="discount_type_maximum" value="1" checked> Không giới hạn </label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-content -->
        </div>

    </div>
    <div class="col-md-6">
        <div class="box" style="overflow: hidden">
            <div class="header"> <h2>Thời gian áp dụng </h2> </div>
            <!-- .box-content -->
            <div class="box-content">
                <div class="col-md-6 box_discount " id="box_discount_time_start">
                    <label for="discount_time_start" class="control-label">Bắt đầu khuyến mãi</label>
                    <div class="group">
                        <input type="text" name="discount_time_start" id="discount_time_start" value="" class="form-control datetime" required>
                    </div>
                </div>
                <div class="col-md-6 box_discount " id="box_discount_time_end">
                    <label for="discount_time_end" class="control-label">Kết thúc khuyến mãi</label>
                    <div class="group">
                        <input type="text" name="discount_time_end" id="discount_time_end" value="" class="form-control datetime" required>
                    </div>
                </div>
                <div class="col-md-12 box_discount " id="box_discount_time_status">
                    <div class="checkbox">
                        <label> <input type="checkbox" name="discount_time_status" id="discount_time_status" value="1"> Không bao giờ hết hạn </label>
                    </div>
                </div>
            </div>
            <!-- /.box-content -->
        </div>

        <div class="box">
            <div class="header"> <h2>Áp dụng cho </h2> </div>
            <!-- .box-content -->
            <div class="box-content">
                <div class="col-md-12 box_discount" id="box_discount_condition">
                    <div class="group">
                        <select name="discount_condition" id="discount_condition" class="form-control">
                            <option value="order" data-note-minimize="đơn hàng">Tất cả các đơn hàng</option>
                            <option value="products" data-note-minimize="sản phẩm">Sản phẩm cụ thể</option>
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
                            echo _form($input);
                        ?>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="clearfix"></div>
            </div>
            <!-- /.box-content -->
        </div>

        <div class="box" style="overflow: hidden">
            <div class="header"> <h2>Yêu cầu tối thiểu</h2> </div>
            <!-- .box-content -->
            <div class="box-content">
                <div class="col-md-12 box_discount">
                    <div class="radio">
                        <label>
                            <input type="radio" name="discount_type_minimize" id="discount_type_minimize_none" value="none" checked> Không
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="discount_type_minimize" id="discount_type_minimize_money" value="money"> Tiền mua tối thiểu (₫)
                        </label>
                        <div class="box_discount box_discount_value_minimize" id="box_discount_value_minimize_money" style="padding-left: 20px;margin: 10px 0; display: none;">
                            <input type="number" name="discount_value_minimize_money" id="discount_value_minimize_money" value="" class="form-control" style="width:200px;">
                            <p style="color:#637381">Chỉ áp dụng cho các bộ sưu tập được chọn.</p>
                        </div>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="discount_type_minimize" id="discount_type_minimize_quantity" value="quantity"> Số lượng sản phẩm tối thiểu
                        </label>
                        <div class="box_discount box_discount_value_minimize" id="box_discount_value_minimize_quantity" style="padding-left: 20px;margin: 10px 0; display: none;">
                            <input type="number" name="discount_value_minimize_quantity" id="discount_value_minimize_quantity" value="" class="form-control" style="width:200px;">
                            <p style="color:#637381">Chỉ áp dụng cho các bộ sưu tập được chọn.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-content -->
        </div>

        <div class="box">
            <div class="header"> <h2>Áp dụng cho khách hàng</h2> </div>
            <!-- .box-content -->
            <div class="box-content">
                <div class="col-md-12 box_discount " id="box_discount_customer">
                    <div class="group">
                        <select name="discount_customer" id="discount_customer" class="form-control">
                            <option value="customer">Tất cả khách hàng</option>
                            <option value="customer-login">Khách hàng đã đăng nhập</option>
                            <option value="customer-user">Khách hàng cụ thể</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12 " id="box_discount_customer_user" style="display: none">
                    <div class="row">
                        <?php
                            $input =  array(
                                'field' 	=> 'discount_customer_user', 'label' 	=> 'Khách hàng', 'value' 	=> '',
                                'type'  	=> 'popover', 'module' 	=> 'customer', 'key_type'  => 'customer', 'multiple'  => true, 'options'   => []
                            );
                            echo _form($input);
                        ?>
                    </div>

                    <div class="clearfix"></div>

                    <div class="checkbox">
                        <label>
                            <input type="radio" name="discount_customer_count" value="0" id="discount_customer_count" checked> Số lần sử dụng tính cho mỗi khách hàng.
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="radio" name="discount_customer_count" value="1" id="discount_customer_count"> Số lần sử dụng tính cho tổng số lần sử dụng.
                        </label>
                    </div>
                </div>
            </div>
            <!-- /.box-content -->
            <div class="clearfix"></div>
        </div>
    </div>
</form>
<div class="clearfix"></div>
<br>
<br>
<br>
<br>
<br>
<br>

<style type="text/css">
    .box_discount {
        overflow: hidden; margin-bottom: 10px;
    }
    .input-group-addon { cursor: pointer; }

    .item-pr {
        overflow:hidden;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        padding:5px;
    }
    .item-pr .item-pr__img { float:left; }
    .item-pr .item-pr__img img { width:30px; height:30px; }
    .item-pr .item-pr__title, .item-pr .item-pr__price {
        float:left;
        -webkit-box-flex: 1; -webkit-flex: 1 1 0%; -ms-flex: 1 1 0%; flex: 1 1 0%;
        padding: 7px;
        max-width: 100%; min-width: 0;
        color: #31373d;
    }
    .item-pr .item-pr__price {  float:right; }

    .item-us {
        overflow: hidden;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        padding: 5px;
    }
    .item-us .item-us__img {
        float: left;
    }
    .item-us .item-us__img img {
        width: 30px;
        height: 30px;
    }
    .item-us .item-us__title {
        float: left;
        width: calc(100% - 30px);
        padding-left: 5px;
        padding-right: 5px;
        -webkit-box-flex: 1;
        -webkit-flex: 1 1 0%;
        -ms-flex: 1 1 0%;
        flex: 1 1 0%;
        padding: 7px;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        max-width: 100%;
        min-width: 0;
        color: #31373d;
    }
</style>

<script type="text/javascript">
    $(function() {

        let discount_condition      = $('select#discount_condition');
        let discount_type_minimize  = $('input[name="discount_type_minimize"]');
        let discount_type_maximum  = $('input[name="discount_type_maximum"]');
        let minimize_note           = 'đơn hàng';
        let possible  = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        function generateCode(length) {

            let generated = [];

            var text = "";

            for ( var i=0; i < length; i++ ) {
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            }

            if ( generated.indexOf(text) === -1 ) {
                generated.push(text);
            }else {
                generateCode();
            }

            return generated;
        }

        $('#js_discount_code_auto').click(function () {
            $('input#discount_code').val(generateCode(10));
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

        discount_type_maximum.change(function() {
            if(this.checked) {
                $('input#discount_value_maximum').prop( "disabled", true );
            }
            else {
                $('input#discount_value_maximum').prop( "disabled", false );
            }
        });

        discount_condition.change(function() {
            let val = $(this).val();
            minimize_note = $('option:selected', this).attr('data-note-minimize');
            console.log(minimize_note);
            $('.box_discount_condition_value').hide();
            $('#box_discount_condition_value_'+val).show();
            $('.box_discount_value_minimize p').text('Chỉ áp dụng cho các '+minimize_note+' được chọn.');
        });

        discount_type_minimize.change(function() {
            let val = $(this).val();
            $('.box_discount_value_minimize').hide();
            $('.box_discount_value_minimize p').text('Chỉ áp dụng cho các '+minimize_note+' được chọn.');
            $('#box_discount_value_minimize_'+val).show();
        });

        $("select#discount_customer").change(function() {

            let val = $(this).val();

            if(val === 'customer-user') {
                $('#box_discount_customer_user').show();
            }
            else {
                $('#box_discount_customer_user').hide();
            }
        });

        $('#discount_form_add').submit(function() {

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

            data.action     =  'Discount_Admin_Ajax::add';

            $jqxhr   = $.post(base+'/ajax', data, function() {}, 'json');

            $jqxhr.done(function( response ) {

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