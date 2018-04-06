<?php
echo form_open(base_url() . 'index.php/home/cart_finish/go', array(
        'method' => 'post',
        'enctype' => 'multipart/form-data',
        'id' => 'cart_form'
    )
);
?>
<script src="https://checkout.stripe.com/checkout.js"></script>
<!-- PAGE -->
<div class="checkout-box ">
    <div class="row">
        <div class="col-md-12">
            <div class="panel-group checkout-steps" id="accordion">
                <!-- checkout-step-01  -->
                <div class="panel panel-default checkout-step-01">

                    <!-- panel-heading -->
                    <div class="panel-heading">
                        <h4 class="unicase-checkout-title">
                            <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
                                <span><?php echo translate('1'); ?>.
                                    </span><?php echo translate('orders'); ?>
                            </a>
                        </h4>
                    </div>
                    <!-- panel-heading -->

                    <div id="collapseOne" class="panel-collapse collapse in">

                        <!-- panel-body  -->
                        <div class="panel-body">
                            <div class="row orders">

                            </div>
                        </div>
                        <!-- panel-body  -->

                    </div><!-- row -->
                </div>
                <!-- checkout-step-01  -->
                <!-- checkout-step-02  -->
                <div class="panel panel-default checkout-step-02">

                    <!-- panel-heading -->
                    <div class="panel-heading">
                        <h4 class="unicase-checkout-title">
                            <a href="#" class="">
                                <span><?php echo translate('2'); ?>.</span>
                                <?php echo translate('delivery_address'); ?>
                                </a>
                            </h4>
                        </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div action="#" class="form-delivery delivery_address">
                                        </div>
                                    </div>
                                </div>
                    </div>
                <!-- checkout-step-02  -->

                <!-- checkout-step-03  -->
                <div class="panel panel-default checkout-step-03">
                    <div class="panel-heading">
                        <h4 class="unicase-checkout-title">
                            <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseThree">

                                <span><?php echo translate('3'); ?></span>
                                <?php echo translate('payments_options'); ?>

                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="panel-group payments-options" id="accordion" role="tablist"
                                 aria-multiselectable="true">
                            </div>
                            <div class="overflowed">
                                <a class="btn btn-theme-dark btn-warning" href="<?php echo base_url(); ?>index.php/home/cancel_order">
                                    <?php echo translate('cancel_order');?>
                                </a>
            <span class="btn btn-primary pull-right disabled" id="order_place_btn" onclick="cart_submission();">
                <?php echo translate('place_order');?>
            </span>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- checkout-step-03  -->

            </div><!-- /.checkout-steps -->
        </div>
    </div><!-- /.row -->
</div><!-- /.checkout-box -->

<!-- /PAGE -->
</form>
<script>
    $(document).ready(function () {
        var top = Number(200);
        $('.orders').html('<div style="text-align:center;width:100%;height:' + (top * 2) + 'px; position:relative;top:' + top + 'px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        var state = check_login_stat('state');
        state.success(function (data) {
            if (data == 'hypass') {
                load_orders();
            } else {
                signin();
            }
        });
    });

    function load_orders() {
        var top = Number(200);
        $('.orders').html('<div style="text-align:center;width:100%;height:' + (top * 2) + 'px; position:relative;top:' + top + 'px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $('.orders').load('<?php echo base_url(); ?>index.php/home/cart_checkout/orders');
    }

    function load_address_form() {

        var top = Number(200);
        $('.delivery_address').html('<div style="text-align:center;width:100%;height:' + (top * 2) + 'px; position:relative;top:' + top + 'px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');

        $('.delivery_address').load('<?php echo base_url(); ?>index.php/home/cart_checkout/delivery_address',
            function () {
                var top_off = $('.header').height();
                $('.selectpicker').selectpicker();
                $('html, body').animate({
                    scrollTop: $(".delivery_address").offset().top - (2 * top_off)
                }, 1000);
            }
        );
    }

    function load_payments() {
        $('#order_place_btn').removeClass('disabled')
        var okay = 'yes';
        var sel = 'no';
        $('.delivery_address').find('.required').each(function () {
            if ($(this).is('select') || $(this).is('input')) {
                //alert($(this).val());
                if ($(this).val() == '') {
                    okay = 'no';
                    if ($(this).is('select')) {
                        $(this).closest('.form-group').find('.selectpicker').focus();
                    } else {
                        if (sel == 'no') {
                            $(this).focus();
                        }
                    }

                    //alert(okay);
                    //$(this).css('background','red');
                }
            }
        });
        if (okay == 'yes') {
            var top = Number(200);
            $('.payments-options').html('<div style="text-align:center;width:100%;height:' + (top * 2) + 'px; position:relative;top:' + top + 'px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
            $('.payments-options').load('<?php echo base_url(); ?>index.php/home/cart_checkout/payments_options',
                function () {
                    var top_off = $('.header').height();
                    $('html, body').animate({
                        scrollTop: $(".payments-options").offset().top - (2 * top_off)
                    }, 1000);
                }
            );
        } else {
            var top_off = $('.header').height();
            $('html, body').animate({
                scrollTop: $(".delivery_address").offset().top - (2 * top_off)
            }, 1000);
        }
    }

    function radio_check(id) {
        $("#visa").prop("checked", false);
        $("#mastercardd").prop("checked", false);
        $("#mastercard").prop("checked", false);
        $("#" + id).prop("checked", true);
    }

</script>



