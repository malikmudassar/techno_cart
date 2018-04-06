<div class="layout-content">
    <div class="layout-content-body">
        <div class="row">
            <div style="left: 50%; transform: translateX(-50%);" class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong><span class="icon icon-plus-circle"></span> ADD PRODUCT</strong>
                    </div>
                    <div class="card-body">
                        <div id="msg"></div>
                        <form id="add_product" class="form form-horizontal" style="margin-top: 30px" method="POST">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%;" for="name">Name</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                          <span class="input-group-addon">
                                                <span class="icon icon-cube"></span>
                                          </span>
                                        <input class="form-control" type="text" name="name" id="name" placeholder="Name">
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
                                        <input class="form-control" type="text" name="part_no" id="part_no" placeholder="Model/Part No.">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="main_cat_section">
                                <label for="username" class="col-sm-3 control-label" style="width: 20%;" for="form-control-17">Category</label>
                                <div class="col-sm-9">
                                    <select id="demo-select2-1" class="form-control" name="cat_id">
                                        <option value="0">Select Category</option>
                                        <pre><?php print_r($categories); ?></pre>
                                        <?php foreach($categories as $category): ?>
                                                <option value="<?= $category['id'] ?>">
                                                    <?= $category['name'] ?>
                                                </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-3 control-label" style="width: 20%;" for="form-control-17">Sub Category</label>
                                <div class="col-sm-9">
                                    <select id="demo-select2-2" class="form-control" disabled name="sub_cat_id">
                                        <option value="0">Select Sub Category</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-3 control-label" style="width: 20%;" for="form-control-17">Brands</label>
                                <div class="col-sm-9">
                                    <select id="demo-select2-3" disabled class="form-control" name="brand_id">
                                        <option value="0">Select Brand</option>
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
                                        <input class="form-control" type="text" name="purchase_price" id="purchase_price" placeholder="$0.00">
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
                                        <input class="form-control" type="text" name="sale_price" id="sale_price" placeholder="$0.00">
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
                                        <input class="form-control" type="number" name="qty" id="qty" placeholder="$0.00">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%" for="discount">Discount</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                           <span class="input-group-addon">
                                               <span class="icon icon-cubes"></span>
                                           </span>
                                        <input class="form-control" type="text" name="discount" id="discount" placeholder="Discount %">
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
                                        <input class="form-control" type="text" name="tags" id="tags" placeholder="Tags">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%;" for="details">Detail</label>
                                &nbsp;&nbsp;&nbsp;<textarea name="detail" style="width: 71%" rows="2" required></textarea>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%;">Select Image</label>
                                <div class="col-sm-9">
                                    <input id="form-control-9"  style="padding-top: 9px" type="file" name="image" id="image" accept="image/*" multiple="multiple">
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <button class="btn btn-primary" style="margin-left: 250px;padding: 6px 25px;!important;"
                                        type="submit">Add Product
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

        $("#demo-select2-1").change(function(e){
            var id = $(this).val();
            $("#demo-select2-3").prop("disabled", true).empty();
            $.ajax({
                type: 'post',
                url: "<?= site_url("Admin/get_sub_cats") ?>",
                data: {'cat_id': id}
            }).then(function(res){
                $("#demo-select2-2").prop("disabled", false).empty().append(res);
            }, function(){

            });
        });

        $("#demo-select2-2").change(function(e){
            var id = $(this).val();
            $.ajax({
                type: 'post',
                url: "<?= site_url("Admin/get_brands") ?>",
                data: {'sub_cat_id': id}
            }).then(function(res){
                $("#demo-select2-3").prop("disabled", false).empty().append(res);
            }, function(){

            });
        });


        $("#add_product").on('submit', (function (e) {
            e.preventDefault();
            $("#msg").html('<div class="loading"></div>');
            var fd = new FormData(this);
            $.ajax({
                url: '<?php echo site_url("Admin/save_product") ?>',
                data: fd,
                type: "POST",
                contentType: false,
                processData: false,
                cache: false,
                success: function (res) {
                    var res = $.parseJSON(res);
                    if (res.msg_type == 'success') {
                        toastr.success(res.message);
                        $('#add_product')[0].reset();
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