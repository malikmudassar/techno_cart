<div class="layout-content">
    <div class="layout-content-body">
        <div class="row">
            <div style="left: 50%; transform: translateX(-50%);" class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong><span class="icon icon-edit"></span> EDIT PRODUCT</strong>
                    </div>
                    <div class="card-body">
                        <div id="msg"></div>
                        <form id="edit_product" class="form form-horizontal" style="margin-top: 30px" method="POST">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%;" for="name">Name</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                          <span class="input-group-addon">
                                                <span class="icon icon-cube"></span>
                                          </span>
                                        <input class="form-control" type="text" name="name" id="name" value="<?= $product_detail['name']?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%;" for="model">Model/Part No.</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                           <span class="input-group-addon">
                                               <span class="icon icon-cube"></span>
                                           </span>
                                        <input class="form-control" type="text" name="part_no" id="part_no" value="<?= $product_detail['part_no']?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-3 control-label" style="width: 20%;" for="form-control-17">Category</label>
                                <div class="col-sm-9">
                                    <select id="demo-select2-1" class="form-control" name="cat_id">
                                        <option value="0">Select Category</option>
                                        <?php
                                        if (count($category) > 0) {
                                            for ($i = 0; $i < count($category); $i++) {
                                                ?>
                                                <option value="<?php echo $category[$i]['id'] ?>" <?php if($product_detail['cat_id'] == $category[$i]['id']) { echo 'selected'; }?>><?php echo $category[$i]['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-3 control-label" style="width: 20%;" for="form-control-17">Sub Category</label>
                                <div class="col-sm-9">
                                    <select id="demo-select2-2" class="form-control" name="sub_cat_id">
                                        <option value="0">Select Sub Category</option>
                                        <?php
                                        if (count($sub_category) > 0) {
                                            for ($i = 0; $i < count($sub_category); $i++) {
                                                ?>
                                                <option value="<?php echo $sub_category[$i]['id'] ?>" <?php if($product_detail['sub_cat_id'] == $sub_category[$i]['id']) { echo 'selected'; } ?>><?php echo $sub_category[$i]['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-3 control-label" style="width: 20%;" for="form-control-17">Brands</label>
                                <div class="col-sm-9">
                                    <select id="demo-select2-3" class="form-control" name="brand_id">
                                        <option value="0">Select Brand</option>
                                        <?php
                                        if (count($brand) > 0) {
                                            for ($i = 0; $i < count($brand); $i++) {
                                                ?>
                                                <option value="<?php echo $brand[$i]['id'] ?>" <?php if($product_detail['brand_id'] == $brand[$i]['id']) { echo 'selected'; } ?>><?php echo $brand[$i]['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%" for="purchase_price">Purchase Price</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                           <span class="input-group-addon">
                                               <span class="icon icon-dollar"></span>
                                           </span>
                                        <input class="form-control" type="text" name="purchase_price" id="purchase_price" value="$<?= $product_detail['purchase_price']?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%" for="selling_price">Selling Price</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                           <span class="input-group-addon">
                                               <span class="icon icon-dollar"></span>
                                           </span>
                                        <input class="form-control" type="text" name="sale_price" id="sale_price" value="$<?= $product_detail['sale_price']?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%" for="qty">Quantity</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                           <span class="input-group-addon">
                                               <span class="icon icon-dollar"></span>
                                           </span>
                                        <input class="form-control" type="text" name="qty" id="qty" value="$<?= $product_detail['qty']?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%" for="discount">Discount</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                           <span class="input-group-addon">
                                               <span class="icon icon-dollar"></span>
                                           </span>
                                        <input class="form-control" type="text" name="discount" id="discount" value="$<?= $product_detail['discount']?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%" for="tags">Tags</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                           <span class="input-group-addon">
                                               <span class="icon icon-cubes"></span>
                                           </span>
                                        <input class="form-control" type="text" name="tags" id="tags" value="<?= $product_detail['tags']?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%;" for="details">Detail</label>
                                &nbsp;&nbsp;&nbsp;<textarea name="details" style="width: 71%" rows="2" required><?= $product_detail['details']?></textarea>
                            </div>
                            <input type="hidden" name="id" value="<?= $product_detail['id']; ?>">
                            <div class="col-xs-6 col-md-3">
                                <button class="btn btn-primary" style="margin-left: 250px;padding: 6px 25px;!important;"
                                        type="submit">Update Product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#edit_product").on('submit', (function (e) {
            e.preventDefault();
            $("#msg").html('<div class="loading"></div>');
            var fd = new FormData(this);
            $.ajax({
                url: '<?php echo site_url("Admin/save_edit_product") ?>',
                data: fd,
                type: "POST",
                contentType: false,
                processData: false,
                cache: false,
                success: function (res) {
                    var res = $.parseJSON(res);
                    if (res.msg_type == 'success') {
                        toastr.success(res.message);
                        $('#edit_product')[0].reset();
                        $("#name").focus();
                        $(".loading").hide();
                    } else {
                        $("#msg").html(res);
                        toastr.error(res.message);
                    }
                },
                error: function (xhr) {
                    $("#msg").html("Error: - " + xhr.status + " " + xhr.statusText);
                }
            });
        }));
    });
</script>