<div class="layout-content">
    <div class="layout-content-body">
        <div class="row">
            <div style="left: 50%; transform: translateX(-50%);" class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong><span class="icon icon-plus-circle"></span> ADD SUB CATEGORY</strong>
                    </div>
                    <div class="card-body">
                        <div id="msg"></div>
                        <form id="add_sub_cat" class="form form-horizontal" style="margin-top: 30px" method="POST">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%;" for="name">Name</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                          <span class="input-group-addon">
                                                <span class="icon icon-th-large"></span>
                                          </span>
                                        <input class="form-control" type="text" name="name" id="name" placeholder="Name">
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
                                                <option value="<?php echo $category[$i]['id'] ?>"><?php echo $category[$i]['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <button class="btn btn-primary" style="margin-left: 250px;padding: 6px 25px;!important;"
                                        type="submit">Add Sub-Category
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
        $("#add_sub_cat").on('submit', (function (e) {
            e.preventDefault();
            $("#msg").html('<div class="loading"></div>');
            var fd = new FormData(this);
            $.ajax({
                url: '<?php echo site_url("Admin/save_sub_category") ?>',
                data: fd,
                type: "POST",
                contentType: false,
                processData: false,
                cache: false,
                success: function (res) {
                    var res = $.parseJSON(res);
                    if (res.msg_type == 'success') {
                        toastr.success(res.message);
                        $('#add_sub_cat')[0].reset();
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