<div class="layout-content">
    <div class="layout-content-body">
        <div class="row">
            <div style="left: 50%; transform: translateX(-50%);" class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong><span class="icon icon-edit"></span> EDIT MENU ITEM</strong>
                    </div>
                    <div class="card-body">
                        <div id="msg"></div>
                        <form id="edit_menu" class="form form-horizontal" style="margin-top: 30px" method="POST">
                            <div class="form-group">
                                <label for="username" class="col-sm-3 control-label" style="width: 20%;" for="form-control-17">Parent</label>
                                <div class="col-sm-9">
                                    <select id="demo-select2-1" class="form-control" name="parent">
                                        <option value="0">Main</option>
                                        <?php
                                        if (count($parents) > 0) {
                                            for ($i = 0; $i < count($parents); $i++) {
                                                ?>
                                                <option value="<?php echo $parents[$i]['id'] ?>" <?php if ($menu_item['parent'] == $parents[$i]['id']) {
                                                    echo 'selected';
                                                } ?> ><?php echo $parents[$i]['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%;" for="name">Name</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                          <span class="input-group-addon">
                                                <span class="icon icon-th-large"></span>
                                          </span>
                                        <input class="form-control" type="text" name="name" id="name" placeholder="Name" value="<?php echo $menu_item['name'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%;" for="class">Class</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                           <span class="input-group-addon">
                                               <span class="icon icon-code"></span>
                                           </span>
                                        <input class="form-control" type="text" name="class" id="class" placeholder="Class" value="<?php echo $menu_item['class'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%" for="url">Url</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                           <span class="input-group-addon">
                                               <span class="icon icon-globe"></span>
                                           </span>
                                        <input class="form-control" type="text" name="url" id="url" placeholder="URL" value="<?php echo $menu_item['url'] ?>">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id2" value="<?= $menu_item['id']?>">
                            <div class="col-xs-6 col-md-3">
                                <button class="btn btn-primary" style="margin-left: 250px;padding: 6px 25px;!important;"
                                        type="submit">Update menu
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
        $("#edit_menu").on('submit', (function (e) {
            e.preventDefault();
            $("#msg").html('<div class="loading"></div>');
            var fd = new FormData(this);
            $.ajax({
                url: '<?php echo site_url("Admin/save_admin_edit_menu") ?>',
                data: fd,
                type: "POST",
                contentType: false,
                processData: false,
                cache: false,
                success: function (res) {
                    var res = $.parseJSON(res);
                    if (res.msg_type == 'success') {
                        toastr.success(res.message);
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