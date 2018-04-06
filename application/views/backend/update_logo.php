<div class="layout-content">
    <div class="layout-content-body">
        <div class="row">
            <div style="left: 50%; transform: translateX(-50%);" class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong><span class="icon icon-plus-circle"></span> Change Logo</strong>
                    </div>
                    <div class="card-body">
                        <div id="msg"></div>
                        <form id="update_logo" class="form form-horizontal" style="margin-top: 30px" method="POST">
                            <div class="profile-avetar">
                                <img class="" style="background-color: #fff;
                                border: 2px solid #2f4050;  margin-left: 240px; " width="200" height="150" src="<?= base_url().'/uploads/'.$company_info['logo']?>" alt="<?= $company_info['name']?>">
                            </div>
                            <br />
                            <div class="form-group" style="margin-left: 106px;">
                                <label class="col-sm-3 control-label" style="width: 20%;">Select Image</label>
                                <div class="col-sm-9">
                                    <input id="form-control-9"  style="padding-top: 9px" type="file" name="image" id="image" accept="image/*" multiple="multiple">
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <button class="btn btn-primary" style="margin-left: 278px;padding: 6px 25px;!important;"
                                        type="submit">Update
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
        $("#update_logo").on('submit', (function (e) {
            e.preventDefault();
            $("#msg").html('<div class="loading"></div>');
            var fd = new FormData(this);
            $.ajax({
                url: '<?php echo site_url("Admin/update_logo") ?>',
                data: fd,
                type: "POST",
                contentType: false,
                processData: false,
                cache: false,
                success: function (res) {
                    var res = $.parseJSON(res);
                    if (res.msg_type == 'success') {
                        toastr.success(res.message);
                        $('#update_logo')[0].reset();
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