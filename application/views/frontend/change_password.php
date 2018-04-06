<?php include "static/dashboard_header.php"; ?>
<section class="page-section">
    <div class="wrap container">
        <div id="profile-content">
            <div class="row profile">
                <div class="col-md-12" >
                    <div class="information-title">
                        <?php echo 'UPDATE PASSWORD'; ?>
                    </div>
                    <div class="details-wrap" style="margin-top:30px;">
                        <div class="details-box orders">
                            <div class="col-md-6 col-sm-6 sign-in">
                                <form class="register-form outer-top-xs" method="POST"  id="change_password">
                                    <div id="msg"></div>
                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                                        <input type="email" class="form-control unicase-form-control text-input" name="email" value="<?= $this->session->userdata['email']?>" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputPassword1">Old Password <span>*</span></label>
                                        <input type="password" class="form-control unicase-form-control text-input" name="old_pass" >
                                    </div>
                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputPassword1">New Password <span>*</span></label>
                                        <input type="password" class="form-control unicase-form-control text-input" name="new_pass" >
                                    </div>
                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputPassword1">Confirm Password <span>*</span></label>
                                        <input type="password" class="form-control unicase-form-control text-input" name="confirm_pass" >
                                    </div>
                                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">UPDATE</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        $("#change_password").on('submit', (function (e) {
            e.preventDefault();
            $("#msg").html('<div class="loading"></div>');
            var fd = new FormData(this);
            $.ajax({
                url: '<?php echo base_url("Home/change_password_ajax_action") ?>',
                data: fd,
                type: "POST",
                contentType: false,
                processData: false,
                cache: false,
                success: function (res) {
                    var res = $.parseJSON(res);
                    if (res.msg_type == 'success') {
                        $.notify("<strong>Success: </strong>"+res.message, {type: "success", allow_dismiss: false });
                        $('#change_password')[0].reset();
                        $("#name").focus();
                        $(".loading").hide();
                    } else {
                        $("#msg").html(res);
                        $.notify("<strong>Error: </strong>"+res.message, {type: "danger", allow_dismiss: false });
                    }
                },
                error: function (xhr) {
                    $("#msg").html("Error: - " + xhr.status + " " + xhr.statusText);
                }
            });
        }));
    });
</script>
