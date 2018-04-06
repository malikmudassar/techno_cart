<div class="row">
    <div class="col-md-12">
        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
            <div class="more-info-tab clearfix ">
                <h3 class="new-product-title pull-left">New Products</h3>
                <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                    <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a></li>
                    <?php foreach($all_products as $key =>  $cat): ?>
                        <li>
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
                <?php foreach ($all_products as $key => $cat): ?>
                    <div class="tab-pane in active" id="<?= str_replace(" ", "-", strtolower($cat->name)) ?>">
                        <div class="product-slider">
                            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                                <div class="item item-carousel">
                                    <div class="products">
                                        <?php foreach ($cat->products as $key => $product): ?>
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image"> <a href="detail.html"><img  src="<?= base_url("uploads/$product->image") ?>" alt=""></a> </div>
                                                    <!-- /.image -->

                                                    <div class="tag new"><span>new</span></div>
                                                </div>
                                                <!-- /.product-image -->

                                                <div class="product-info text-left">
                                                    <h3 class="name"><a href="detail.html"><?= $product->name ?></a></h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>
                                                    <div class="product-price"> <span class="price"> $<?= $product->sale_price ?> </span> <span class="price-before-discount">$ 800</span> </div>
                                                    <!-- /.product-price -->

                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                            <li class="add-cart-button btn-group">
                                                                <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title="Add Cart"> <i class="fa fa-shopping-cart"></i> </button>
                                                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                            </li>
                                                            <li class="lnk wishlist"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                                            <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.action -->
                                                </div>
                                                <!-- /.cart -->
                                            </div>
                                            <!-- /.product -->
                                        <?php endforeach; ?>
                                    </div>
                                    <!-- /.products -->
                                </div>
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