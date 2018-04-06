<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class='active'>Login / Register</li>
            </ul>
        </div>
    </div>
</div>
<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <div class="col-md-12 col-sm-6 create-new-account">
                    <h4 class="checkout-subtitle">Create a new account</h4>
                    <form class="register-form outer-top-xs" method="POST" id="sign_up" enctype="multipart/form-data" accept-charset="utf-8">
                        <div id="msg"></div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input class="form-control required" name="first_name" type="text"
                                           placeholder="First Name" data-toggle="tooltip" title="First Name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input class="form-control required" name="last_name" type="text"
                                           placeholder="Last Name" data-toggle="tooltip" title="Last Name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input class="form-control emails required" name="email" type="email"
                                           placeholder="Email" data-toggle="tooltip" title="Email">
                                </div>
                                <div id='email_note'></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input class="form-control" name="phone" type="text" placeholder="Phone"
                                           data-toggle="tooltip" title="Phone">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input class="form-control pass1 required" type="password" name="password"
                                           placeholder="Password" data-toggle="tooltip" title="Password">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input class="form-control pass2 required" type="password" name="confirm_pass"
                                           placeholder="Confirm Password" data-toggle="tooltip"
                                           title="Confirm Password">
                                </div>
                                <div id='pass_note'></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control required" name="address1" type="text"
                                           placeholder="Address Line 1" data-toggle="tooltip" title="Address Line 1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control required" name="address2" type="text"
                                           placeholder="Address Line 2" data-toggle="tooltip" title="Address Line 2">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control required" type="text" name="city" placeholder="City"
                                           data-toggle="tooltip" title="City">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control required" type="text" name="state" placeholder="State"
                                           data-toggle="tooltip" title="State">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control required" type="text" name="country"
                                           placeholder="Country" data-toggle="tooltip" title="Country">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <input class="form-control required" name="zip" type="text" placeholder="ZIP"
                                           data-toggle="tooltip" title="ZIP">
                                </div>
                            </div>
                        </div>
                        <!--<div class="row">
                            <div class="col-md-12 terms">
                                <input name="terms_check" type="checkbox" value="ok">
                                I Agree With <a href="http://localhost/snapkart/index.php/home/legal/terms_conditions"
                                                target="_blank">
                                    Terms & Conditions </a>
                            </div>
                        </div>-->
                        &nbsp;
                        <div class="col-md-12">
                            <button type="submit" class="btn-upper btn btn-primary btn-lg checkout-page-button pull-left logup_btn" data-ing='Registering..' data-msg="">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        <div class="row">
            <div class="col-md-12">
                <!-- logo slider -->
                <div id="brands-carousel" class="logo-slider wow fadeInUp">
                    <div class="logo-slider-inner">
                        <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                            <div class="item m-t-15"> <a href="#" class="image"> <img data-echo="<?= base_url()?>frontend_assets/images/brands_logo/Dell.jpg" src="<?= base_url()?>frontend_assets/images/brands_logo/Dell.jpg" alt=""> </a> </div>
                            <!--/.item-->

                            <div class="item m-t-10"> <a href="#" class="image"> <img data-echo="<?= base_url()?>frontend_assets/images/brands_logo/HP.jpg" src="<?= base_url()?>frontend_assets/images/brands_logo/HP.jpg" alt=""> </a> </div>
                            <!--/.item-->

                            <div class="item"> <a href="#" class="image"> <img data-echo="<?= base_url()?>frontend_assets/images/brands_logo/WD.jpg" src="<?= base_url()?>frontend_assets/images/brands_logo/WD.jpg" alt=""> </a> </div>
                            <!--/.item-->

                            <div class="item"> <a href="#" class="image"> <img data-echo="<?= base_url()?>frontend_assets/images/brands_logo/Intel.jpg" src="<?= base_url()?>frontend_assets/images/brands_logo/Intel.jpg" alt=""> </a> </div>
                            <!--/.item-->

                            <div class="item"> <a href="#" class="image"> <img data-echo="<?= base_url()?>frontend_assets/images/brands_logo/Hitachi.jpg" src="<?= base_url()?>frontend_assets/images/brands_logo/Hitachi.jpg" alt=""> </a> </div>
                            <!--/.item-->

                            <div class="item"> <a href="#" class="image"> <img data-echo="<?= base_url()?>frontend_assets/images/brands_logo/Seagate.jpg" src="<?= base_url()?>frontend_assets/images/brands_logo/Seagate.jpg" alt=""> </a> </div>
                            <!--/.item-->

                            <div class="item"> <a href="#" class="image"> <img data-echo="<?= base_url()?>frontend_assets/images/brands_logo/Samsung.jpg" src="<?= base_url()?>frontend_assets/images/brands_logo/Samsung.jpg" alt=""> </a> </div>
                            <!--/.item-->

                            <div class="item"> <a href="#" class="image"> <img data-echo="<?= base_url()?>frontend_assets/images/brands/brand4.png" src="<?= base_url()?>frontend_assets/images/blank.gif" alt=""> </a> </div>
                            <!--/.item-->

                            <div class="item"> <a href="#" class="image"> <img data-echo="<?= base_url()?>frontend_assets/images/brands/brand1.png" src="<?= base_url()?>frontend_assets/images/blank.gif" alt=""> </a> </div>
                            <!--/.item-->

                            <div class="item"> <a href="#" class="image"> <img data-echo="<?= base_url()?>frontend_assets/images/brands/brand5.png" src="<?= base_url()?>frontend_assets/images/blank.gif" alt=""> </a> </div>
                            <!--/.item-->
                        </div>
                        <!-- /.owl-carousel #logo-slider -->
                    </div>
                    <!-- /.logo-slider-inner -->

                </div>
                <!-- /.logo-slider -->
            </div>
        </div><!-- /.logo-slider -->
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
</div>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#sign_up").on('submit', (function (e) {
            e.preventDefault();
            //alert(jQuery(e.target).text());
            jQuery("#msg").html('<div class="loading"></div>');
            var fd = new FormData(this);
            jQuery.ajax({
                url: '<?php echo site_url("Home/register_user") ?>',
                data: fd,
                type: "POST",
                contentType: false,
                processData: false,
                cache: false,
                success: function (res) {
                    var res = jQuery.parseJSON(res);
                    if (res.msg_type == 'success') {
                        $.notify("<strong>Success: </strong>"+res.message, {type: "success", allow_dismiss: false });
                        jQuery('#sign_up')[0].reset();
                        jQuery("#name").focus();
                        jQuery(".loading").hide();
                    } else {
                        jQuery("#msg").html(res);
                        $.notify("<strong>Error: </strong>"+res.message, {type: "danger", allow_dismiss: false });
                    }
                },
                error: function (xhr) {
                    jQuery("#msg").html("Error: - " + xhr.status + " " + xhr.statusText);
                }
            });
        }));
    });
</script>