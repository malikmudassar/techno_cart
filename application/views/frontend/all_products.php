<div class="row">
    <div class="col-md-12">
        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
            <div class="more-info-tab clearfix ">
                <h3 class="new-product-title pull-left"> Products</h3>
                <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                    <?php foreach($all_products as $key =>  $cat): ?>
                        <li class="<?php if($cat->id == 3){echo "active";}?>">
                            <a data-transition-type="backSlide"
                               href="#<?= str_replace(" ", "-", strtolower($cat->name)) ?>"
                               data-toggle="tab"
                               data-id="<?= $cat->id ?>">
                                <?=$cat->name ?>
                            </a>
                        </li>
                    <?php endforeach;?>
                </ul>
                <!-- /.nav-tabs -->
            </div>


            <div class="tab-content outer-top-xs">
                <?php foreach ($all_products as $key => $cat1): ?>
                <div class="tab-pane in <?php if($cat1->id == 3){echo "active";}?>" id="<?= str_replace(" ", "-", strtolower($cat1->name)) ?>">
                    <div class="product-slider">
                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                    <?php foreach ($cat1->products as $key => $product):
                        //print_r($product);
                        ?>
                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image"> <a href="<?= base_url().'Home/get_product_detail/'.$product->id."/".str_replace(" ", "-", ucwords($product->name)) ?>"><img  src="<?= base_url()?>uploads/harddrive/<?= $product->image?>" alt=""></a> </div>
                                            <!-- /.image -->

                                            <div class="tag new"><span>new</span></div>
                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="detail.html"><?= $product->name ?></a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"></div>
                                            <div class="product-price"> <span class="price"> $<?= $product->sale_price ?></span> <span class="price-before-discount">$ 800</span> </div>
                                            <!-- /.product-price -->

                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <span class=""></span><button type="button" name="add_cart"
                                                                class="btn btn-success fa fa-shopping-cart" data-productname="<?= $product->name ?>"
                                                                data-price="<?= $product->sale_price ?>"
                                                                data-productid="<?= $product->id ?>"
                                                                title="Add to Cart"> Add To Cart
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- /.action -->
                                        </div>
                                        <!-- /.cart -->
                                    </div>
                                    <!-- /.product -->
                                </div>
                                <!-- /.products -->
                            </div>
                        <?php endforeach; ?>
                            <!-- /.item -->
                        </div>
                        <!-- /.home-owl-carousel -->
                    </div>
                    <!-- /.product-slider -->
                </div>
                <!-- /.tab-pane -->
                <?php endforeach; ?>


            </div>
            <!-- /.tab-content -->
        </div>
    </div>
</div>