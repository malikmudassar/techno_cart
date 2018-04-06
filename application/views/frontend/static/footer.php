<footer id="footer" class="footer color-bg">
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading">
                        <h4 class="module-title">Contact Us</h4>
                    </div>
                    <!-- /.module-heading -->

                    <div class="module-body">
                        <ul class="toggle-footer" style="">
                            <li class="media">
                                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i> </span> </div>
                                <div class="media-body">
                                    <p><?= $company_info['address']?></p>
                                </div>
                            </li>
                            <li class="media">
                                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-mobile fa-stack-1x fa-inverse"></i> </span> </div>
                                <div class="media-body">
                                    <p>
                                        <?= $company_info['contact']?>
                                    </p>
                                </div>
                            </li>
                            <li class="media">
                                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span> </div>
                                <div class="media-body"> <span><a href="#"><?= $company_info['email']?></a></span> </div>
                            </li>
                        </ul>
                    </div>
                    <!-- /.module-body -->
                </div>
                <!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading">
                        <h4 class="module-title">Quick Links</h4>
                    </div>
                    <!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                            <li class="first"><a href="<?= base_url().'Home/customer_sign_in'?>" title="Login">Login</a></li>
                            <li><a href="<?= base_url().'Home/Customer_sign_up'?>" title="Register">Register</a></li>
                            <li><a href="#" title="Terms & Conditions">Terms & Conditions</a></li>
                            <li><a href="#" title="Privacy & Policy">Privacy & Policy</a></li>
                            <li class="last"><a href="#" title="Contact us">Contact Us</a></li>
                        </ul>
                    </div>
                    <!-- /.module-body -->
                </div>
                <!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading">
                        <h4 class="module-title">Categories</h4>
                    </div>
                    <!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                            <?php for($i=0; $i<count($category); $i++) { ?>
                            <li class="first"><a title="Your Account" href="#"><?= $category[$i]['name']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- /.module-body -->
                </div>
                <!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading">
                        <h4 class="module-title">Valueable Brands</h4>
                    </div>
                    <!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                            <?php for($i=0; $i<count($brands); $i++) { ?>
                            <li class="first"><a href="" title="<?= $brands[$i]['name']?>"><?= $brands[$i]['name']?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- /.module-body -->
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-bar">
        <div class="container">
            <div class="col-xs-12 col-sm-6 no-padding social">
                <ul class="link">
                    <li class="fb pull-left"><a href="<?php echo $social_links['facebook']?>" title="Facebook"></a></li>
                    <li class="tw pull-left"><a target="_blank" rel="nofollow" href="#" title="Twitter"></a></li>
                    <li class="googleplus pull-left"><a target="_blank" rel="nofollow" href="#" title="GooglePlus"></a></li>
                    <li class="linkedin pull-left"><a target="_blank" rel="nofollow" href="#" title="Linkedin"></a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-6 no-padding">
                <div class="clearfix payment-methods">
                    <ul>
                        <li><img src="<?= base_url()?>frontend_assets/images/payments/1.png" alt=""></li>
                        <li><img src="<?= base_url()?>frontend_assets/images/payments/2.png" alt=""></li>
                        <li><img src="<?= base_url()?>frontend_assets/images/payments/3.png" alt=""></li>
                        <li><img src="<?= base_url()?>frontend_assets/images/payments/4.png" alt=""></li>
                        <li><img src="<?= base_url()?>frontend_assets/images/payments/5.png" alt=""></li>
                    </ul>
                </div>
                <!-- /.payment-methods -->
            </div>
        </div>
    </div>
</footer>

<!-- JavaScripts placed at the end of the document so the pages load faster -->
<script src="<?= base_url()?>frontend_assets/js/bootstrap.min.js"></script>
<script src="<?= base_url()?>frontend_assets/js/bootstrap-hover-dropdown.min.js"></script>
<script src="<?= base_url()?>frontend_assets/js/owl.carousel.min.js"></script>
<script src="<?= base_url()?>frontend_assets/js/echo.min.js"></script>
<script src="<?= base_url()?>frontend_assets/js/jquery.easing-1.3.min.js"></script>
<script src="<?= base_url()?>frontend_assets/js/bootstrap-slider.min.js"></script>
<script src="<?= base_url()?>frontend_assets/js/jquery.rateit.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>frontend_assets/js/lightbox.min.js"></script>
<script src="<?= base_url()?>frontend_assets/js/bootstrap-select.min.js"></script>
<script src="<?= base_url()?>frontend_assets/js/wow.min.js"></script>
<script src="<?= base_url()?>frontend_assets/js/scripts.js"></script>
<script src="<?= base_url()?>frontend_assets/js/bootstrap-notify.min.js"></script>
<script>
    $(function(){
        <?php if($this->session->flashdata("msg_typ") == "success"): ?>
        $.notify("<strong>Success: </strong> <?= $this->session->flashdata("message") ?>", {type: "success", allow_dismiss: false });
        <?php elseif($this->session->flashdata("msg_typ") == "error"): ?>
        $.notify("<strong>Error: </strong> <?= $this->session->flashdata("message") ?>", {type: "danger", allow_dismiss: false });
        <?php elseif($this->session->flashdata("msg_typ") == "info"): ?>
        $.notify("<strong>Info: </strong> <?= $this->session->flashdata("message") ?>", {type: "info", allow_dismiss: false });
        <?php elseif($this->session->flashdata("msg_typ") == "warning"): ?>
        $.notify("<strong>Warning: </strong> <?= $this->session->flashdata("message") ?>", {type: "warning", allow_dismiss: false });
        <?php endif;?>//now fuck it
    });
</script>
<script>
    $(document).ready(function () {
        $(".add_cart").click(function () {
            var product_id = $(this).data('productid');
            var product_name = $(this).data('productname');
            var product_price = $(this).data('price');
            var quantity = 1;//$('#'+ product_id).val();
            //var button = $(this);
            if (quantity != '' && quantity > 0) {
                //button.html("cart_adding");
                $.ajax({
                    url: '<?php echo base_url()?>Home/add_to_cart',
                    method: "POST",
                    data: {
                        product_id: product_id, product_name: product_name,
                        product_price: product_price, quantity: quantity
                    },
                    success: function (data) {
                        toastr.success("Product added in to cart");
                        $("#cart_details").html(data);
                    }
                });
            } else {
                alert("please enter quantity");
            }
        });
        $("#cart_details").load("<?php echo base_url()?>Home/load");

        $(document).on('click', '.remove_inventory', function () {
            var row_id = $(this).attr("id");
            if (confirm("Are yoiu sure you want to remove this?")) {
                $.ajax({
                    url: "<?=base_url()?>Home/remove",
                    method: "POST",
                    data: {row_id: row_id},
                    success: function (data) {
                        toastr.warning("Product removed from cart");
                        $("#cart_details").html(data);
                    }
                })
            }
        });

        $(document).on('click', '#clear_cart', function () {
            if (confirm("Are you sure you want to clear cart?")) {
                $.ajax({
                    url: "<?=base_url()?>Home/clear",
                    method: "POST",
                    success: function (data) {
                        toastr.info("Your cart has been cleared");
                        $("#cart_details").html(data);
                    }
                })
            }
        });

    });
</script>
</body>

</html>