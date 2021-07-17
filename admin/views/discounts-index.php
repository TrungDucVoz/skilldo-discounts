<?php if(have_posts($discounts) || InputBuilder::get('status') == 'stop') {?>
<div class="col-md-12">
    <div class="ui-title-bar__group">
        <h1 class="ui-title-bar__title">Mã giảm giá</h1>
        <div class="ui-title-bar__action">
            <a href="<?php echo Url::admin('plugins?page=discounts');?>" class="btn btn-default <?php echo ($page_status != 'stop') ? 'active' : '';?>"><i class="fad fa-gift"></i> Mã sắp & đang chạy</a>
            <a href="<?php echo Url::admin('plugins?page=discounts&status=stop');?>" class="btn btn-default <?php echo ($page_status == 'stop') ? 'active' : '';?>"><i class="fad fa-compass-slash"></i> Mã hết hạn</a>
        </div>
    </div>
</div>
<div class="col-md-12">
    <!-- .box-content -->
    <div class="" style="background-color: #E6E8EA; overflow: hidden; margin-bottom:50px;">

        <?php foreach ($discounts as $discount): ?>
            <?php include 'discounts-item.php';?>
        <?php endforeach ?>

        <style type="text/css">
            .discount-item {
                margin: 10px 0 20px 10px;
                border: 0px solid #c11e2f;
                border-left: 3px dashed #c11e2f;
                border-right: 5px solid #c11e2f;
                position: relative;
                opacity: 0.5;
                background-color: #fff;
            }
            .discount-item-run {
                opacity: 1;
            }

            /* common */
            .ribbon {
                width: 70px; height: 70px; overflow: hidden; position: absolute; z-index: 10;
            }
            .ribbon::before, .ribbon::after {
                position: absolute; z-index: -1; content: ""; display: block; border: 5px solid #2980b9;
            }
            .ribbon span {
                position: absolute; display: block;
                width: 100px; padding: 6px 0;
                background-color: #3498db;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1); color: #fff;
                font: 700 9px/1 "Lato", sans-serif; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); text-transform: uppercase; text-align: center;
            }
            .ribbon-top-left { top: -10px; left: -10px; }
            .ribbon-top-left::before, .ribbon-top-left::after { border-top-color: transparent; border-left-color: transparent; }
            .ribbon-top-left::before { top: 0px; right: 0; }
            .ribbon-top-left::after { bottom: 0; left: -2px; }
            .ribbon-top-left span { right: -8px; top: 20px; transform: rotate(-45deg); }
            .ribbon-out-of-use span { background-color: yellow; color:#000; }
            .ribbon-out-of-use::before, .ribbon-out-of-use::after {
                border-color:#bebe03;
            }

            .ribbon-wait span { background-color: #FBE3C7; color:#000; }
            .ribbon-wait::before, .ribbon-wait::after { border-color:#bebe03; }

            .ribbon-stop span { background-color: #102122; color:#fff; }
            .ribbon-stop::before, .ribbon-stop::after { border-color:#102122; }

            .ribbon-run span { background-color: #5aba6a; color:#fff; }
            .ribbon-run::before, .ribbon-run::after { border-color:#102122; }

            .discount-item .discount-value {
                float: left; width: 200px; height: 130px;
                background-color: #c11e2f;
                color:#fff;
                padding:10px;
                position: relative;
                border-right: 1px dashed #fff;
            }
            .discount-item .discount-value .image {
                width:100%; height: 100%; text-align: center;
            }
            .discount-item .discount-value img {
                max-width:100%; max-height: 100%;
            }
            .discount-item .discount-value:before, .discount-item .discount-value:after {
                content: '';
                position: absolute; right: -17px; width: 30px; height: 30px; border-radius: 50%; display: inline-block;
                z-index: 9; background-color: #E6E8EA;
            }
            .discount-item .discount-value:before {
                top: -22px;
            }
            .discount-item .discount-value:after {
                bottom: -22px;
            }
            .discount-item .discount-value .value {
                text-align: center; position: absolute; top:0; left:0; width:100%; height: 100%;
            }
            .discount-item .discount-value .value .text {
                font-size: 13px;
                font-weight: bold; display: block;
                color:#fff;
                padding:5px 10px;
            }
            .discount-item .discount-value .value .text-2 {
                font-size: 20px;
                font-weight: bold; display: block;
                color:#fff;
            }
            .discount-item .discount-value .value .price {
                font-size: 35px; font-weight: bold; display: block;
            }
            .discount-item .discount-value .icon-cut {
                font-size: 18px;
                position: absolute; right: -8px;
                bottom:0;
                color: #231f20;
                z-index: 10;
            }
            .discount-item .discount-content {
                float: left; width: 35%; padding:10px;
            }
            .discount-item .discount-content h3 { margin-top: 0; font-size: 15px; line-height: 20px; font-weight: bold; }
            .discount-item .discount-content p { font-size: 14px; color:#6d6c6c; margin-bottom: 1px; }
            /** time */
            .discount-item .discount-time {
                float: left; padding:10px 25px; text-align: left;
                width:150px; color:#6d6c6c; font-size: 13px;
            }
            .discount-item .discount-time span{
                color:#000; font-size: 15px; spen
            }
            .discount-item .discount-time .time-start {
            }
            .discount-item .discount-time .time-end {
            }
            /** info */
            .discount-item .discount-info {
                float: left; width: 20%; padding:0 10px;
            }
            .discount-item .discount-info .discount-code {
                margin:10px;
                padding:10px;
                display: block;
                background-color: #eaeaea;
                border: 2px dashed #c11e2f;
                text-align: center;
                font-size: 25px;
                font-weight: bold;
            }
            .discount-item-stop .discount-info .discount-code {
                text-decoration: line-through;
            }
            .discount-action {
                padding:20px 10px;
            }


            .discount-status-wait {
                color:#CB9F00;;
            }
            .discount-status-run {
                color:green;
            }
            .discount-status-stop {
                color:red;
            }

        </style>

        <script type="text/javascript">
            $(function(){

                $('.js_discount-code-copy').click(function () {
                    let copyText = document.getElementById("myInput");
                });
                $('.delete-discount').bootstrap_confirm_delete({
                    heading:'Xác nhận xóa',
                    message:'Bạn muốn xóa trường dữ liệu này ?',
                    callback:function ( event ) {

                        var button = event.data.originalObject;

                        id = button.attr('data-id');

                        if(id == null || id.length == 0) {
                            show_message('Không có dữ liệu nào được xóa ?', 'error');
                        }
                        else {
                            let data ={
                                'action' : 'Discount_Admin_Ajax::delete',
                                'id'     : id,
                            };

                            $jqxhr   = $.post(ajax, data, function() {}, 'json');

                            $jqxhr.done(function( reponse ) {

                                show_message(reponse.message, reponse.status);

                                if(reponse.status === 'success') {

                                    button.closest( '.discount-item' ).remove();
                                }
                            });
                        }
                    },
                });
            })
        </script>
    </div>
    <!-- /.box-content -->
</div>
<?php } else { ?>
<div class="col-md-5 box-empty">
    <h2>Tạo một mã giảm giá</h2>
    <h4>Để có thể gia tăng doanh thu và lượng tiêu thụ sản phẩm,doanh nghiệp đã sử dụng rất nhiều phương pháp khác nhau như khuyến mãi,trả góp,…và không thể không kể đến cả việc phát hành phiếu giảm giá</h4>
    <a href="<?php echo Url::admin('plugins?page=discounts&view=add');?>" class="btn-icon btn-green"><?php echo Admin::icon('add');?> Thêm Mới</a>
</div>

<div class="col-md-7"><img src="https://cdn.shopify.com/shopifycloud/web/assets/v1/dd646441fcb32ed84d99e20aa8b13ac8.svg" alt="Emptystate pages"></div>

<style type="text/css">
    .box-empty { margin-top: 50px; }
    .box-empty h2 {
        font-size: 30px;
        font-weight: bold;
    }
    .box-empty h4 {
        font-size: 18px;
        line-height: 2.8rem;
        font-weight: 400;
        color: #637381;
    }
</style>
<?php } ?>