<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
        <div class="row">
            <!-- ============================================== SIDEBAR ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-3 sidebar">

                <!-- ================================== TOP NAVIGATION ================================== -->
                <div class="side-menu animate-dropdown outer-bottom-xs">
                    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
                    <nav class="yamm megamenu-horizontal">
                        <ul class="nav">
                            <?php foreach($cats as $key =>  $cat): ?>
                            <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="<?= $cat->icon ?>" aria-hidden="true"></i><?= $cat->name; ?></a>
                                    <ul class="dropdown-menu mega-menu">
                                        <li class="yamm-content">
                                            <div class="row">
                                                <?php foreach($cat->sub_cats as $scat): ?>
                                                    <div class="col-sm-12 col-md-3">
                                                        <h4 class=""><?= $scat->name ?></h4>
                                                        <ul class="links list-unstyled">
                                                        <?php foreach($scat->brands as $brand): ?>
                                                        <li><a href="#"><?= $brand->name; ?></a></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
                                            <!-- /.row -->
                                        </li>
                                        <!-- /.yamm-content -->
                                    </ul>

                                <!-- /.dropdown-menu --> </li>
                            <?php endforeach; ?>
                        </ul>
                        <!-- /.nav -->
                    </nav>
                    <!-- /.megamenu-horizontal -->
                </div>
            </div>
            <!-- /.sidemenu-holder -->
            <!-- ============================================== SIDEBAR : END ============================================== -->

            <!-- ============================================== CONTENT ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                <div id="hero">
                    <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                        <?php for ($i = 0; $i < count($slides); $i++) {
                            if ($slides[$i]['status'] == "Enable") {
                                ?>
                                <div class="item"
                                     style="background-image: url(<?= base_url() ?>uploads/<?= $slides[$i]['image'] ?>);">
                                    <div class="container-fluid">
                                        <div class="caption bg-color vertical-center text-left">
                                            <div class="slider-header fadeInDown-1">Top Brands</div>
                                            <div class="big-text fadeInDown-1"> <?= $slides[$i]['title'] ?> </div>
                                            <div class="excerpt fadeInDown-2 hidden-xs">
                                                <span><?= $slides[$i]['quote'] ?>.</span></div>
                                            <div class="button-holder fadeInDown-3">
                                                <a href="<?= $slides[$i]['link'] ?>" class="btn-lg btn btn-uppercase btn-primary shop-now-button"> Shop Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } ?>
                    </div>
                </div>
            </div>

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
            </div>

            <!-- All products -->
            <?php include "all_products.php"; ?>
            <!-- All products -->

            <!-- New Arrival -->
            <?php include "latest_products.php"; ?>
            <!-- New Arrival -->

            <!-- featured Product-->
            <?php include "featured_products.php"; ?>
            <!-- featured Product-->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>
<!-- /#top-banner-and-menu -->
