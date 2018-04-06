<div class="layout-content">
    <div class="layout-content-body">
        <div class="row">
            <div style="left: 50%; transform: translateX(-50%);" class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong><span class="icon icon-plus-circle"></span> EDIT SUB CATEGORY(<?= $sub_cat_detail['name'] ?>)</strong>
                    </div>
                    <div class="card-body">
                        <div id="msg"></div>
                        <form id="update_sub_cat" class="form form-horizontal" style="margin-top: 30px" method="POST">
                            <input type="hidden" name="id" value="<?= $sub_cat_detail['id'] ?>">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%;" for="name">Name</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                          <span class="input-group-addon">
                                                <span class="icon icon-th-large"></span>
                                          </span>
                                        <input class="form-control" type="text" name="name" id="name" placeholder="Name" value="<?= $sub_cat_detail['name'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-3 control-label" style="width: 20%;" for="form-control-17">Category</label>
                                <div class="col-sm-9">
                                    <select id="demo-select2-1" class="form-control" name="cat_id">
                                        <option value="0">Select Category</option>
                                        <?php foreach($categories as $category): ?>
                                            <option value="<?= $category['id'] ?>" <?= $sub_cat_detail['cat_id'] == $category['id'] ? "selected" : "" ?>>
                                                <?= $category['name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-3 control-label" style="width: 20%;" for="form-control-17">Brands</label>
                                <div class="col-sm-9">
                                    <select id="input-brands" name="brands[]" multiple placeholder="Select a brand...">
                                        <option value="">Select a brand...</option>
                                        <?php foreach ($brands as $key => $brand): ?>
                                            <option value="<?= $brand->id ?>" <?= (isset($brand->is_selected) && $brand->is_selected == 1)  ? "selected" : "" ?>>
                                                <?= $brand->name ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>                            
                            <div class="col-xs-12">
                                <div class="col-sm-12">
                                    <button class="btn btn-primary pull-right" type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    jQuery('#input-brands').selectize({
        delimiter: ',',
        plugins: ['remove_button'],
        persist: false
    });

    $(document).ready(function () {

        $("#update_sub_cat").on('submit', (function (e) {
            e.preventDefault();
            $("#msg").html('<div class="loading"></div>');
            var fd = new FormData(this);
            $.ajax({
                url: '<?php echo site_url("Admin/update_sub_cat") ?>',
                data: fd,
                type: "POST",
                contentType: false,
                processData: false,
                cache: false,
                success: function (res) {
                    var res = $.parseJSON(res);
                    if (res.msg_type == 'success') {
                        toastr.success(res.message);
                        // $('#update_sub_cat')[0].reset();
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