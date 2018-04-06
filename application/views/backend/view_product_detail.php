<!--<div class="layout-content">
    <div class="layout-content-body">
        <div class="row">
            <div style="left: 50%; transform: translateX(-50%);" class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong><span class="icon icon-edit"></span> VIEW PRODUCT DETAILS</strong>
                    </div>
                    <div class="card-body">
                        <div id="msg"></div>
                        <form id="product_detail" class="form form-horizontal" style="margin-top: 30px" method="POST">

                            <br />
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%;" for="name">Name</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="name" id="name" value="<?/*= $product_detail['name']*/?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%;" for="model">Model/Part No.</label>
                                <div class="col-sm-9">
                                        <input class="form-control" type="text" name="part_no" id="part_no" value="<?/*= $product_detail['part_no']*/?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%;" for="Category">Category</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="cat" id="cat" value="<?/*= $product_detail['cat_id']*/?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%;" for="sub_category">Sub Category</label>
                                <div class="col-sm-9">
                                        <input class="form-control" type="text" name="sub_cat" id="sub_cat" value="<?/*= $product_detail['sub_cat_id']*/?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%;" for="Brand">Brand</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="brand" id="brand" value="<?/*= $product_detail['brand_id']*/?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%" for="purchase_price">Purchase Price</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="purchase_price" id="purchase_price" value="$<?/*= $product_detail['purchase_price']*/?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%" for="selling_price">Selling Price</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="sale_price" id="sale_price"  value="$<?/*= $product_detail['purchase_price']*/?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%" for="discount">Discount</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="discount" id="discount"  value="$<?/*= $product_detail['discount']*/?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%" for="tags">Tags</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="tags" id="tags" value="<?/*= $product_detail['tags']*/?>" readonly>
                                </div>
                            </div>
                            <div class="row" align="center">
                                <div class="col-md-7">
                                    <?/*= $product_detail['details']*/?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
-->
<div class="layout-content">
    <div class="layout-content-body">
        <div class="row">
            <div style="left: 50%; transform: translateX(-50%);" class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong><span class="icon icon-eye"></span> PRODUCT DETAIL</strong>
                    </div>
                    <div class="card-body">
                        <div id="msg"></div>
                        <form id="product_detail" class="form form-horizontal" style="margin-top: 30px" method="POST">
                            <div class="profile-avetar">
                                <img class="" style="background-color: #fff;
                                border: 2px solid #2f4050;  margin-left: 240px; " width="200" height="150" src="<?= base_url().'/uploads/products/'.$product_detail['image']?>" alt="<?= $product_detail['name']?>">
                            </div>
                            <br />

                            <table border="2px" width="500px" align="center">
                                <tr>
                                    <th style="height: 30px;">Product Name</th>
                                    <th>&nbsp;<?= $product_detail['name']?></th>
                                </tr>
                                <tr>
                                    <th style="height: 30px;">Category</th>
                                    <th>&nbsp;
                                            <?php for ($i = 0; $i < count($cat_name); $i++) { ?>
                                                <?php if ($cat_name[$i]['id'] == $product_detail['cat_id']) { ?>
                                                    <?= $cat_name[$i]['name'] ?>
                                                <?php }
                                            }
                                         ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="height: 30px;">Model/Part No.</th>
                                    <th>&nbsp;<?= $product_detail['part_no']?></th>
                                </tr>
                                <tr>
                                    <th style="height: 30px;">Purchase Price</th>
                                    <th>&nbsp;$<?= $product_detail['purchase_price']?></th>
                                </tr>
                                <tr>
                                    <th style="height: 30px;">Selling Price</th>
                                    <th>&nbsp;$<?= $product_detail['sale_price']?></th>
                                </tr>
                                <tr>
                                    <th style="height: 30px;">Quantity</th>
                                    <th>&nbsp;<?= $product_detail['qty']?></th>
                                </tr>
                                <tr>
                                    <th style="height: 30px;">Amount after Discount</th>
                                    <th>&nbsp;$<?= $product_detail['discount']?></th>
                                </tr>
                            </table>
                            <br/>
                            <div class="row" align="center" style="padding-left: 200px;">
                                <div class="col-md-7">
                                    <?= $product_detail['details']?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
