<?php include "static/dashboard_header.php"; ?>
<section class="page-section">
    <div class="wrap container">
        <div id="profile-content">
            <div class="row profile">
                <div class="col-md-12" >
                    <div class="information-title">
                        <?php echo 'UPDATE PROFILE'; ?>
                    </div>
                    <div class="details-wrap" style="margin-top:30px;">
                        <div class="details-box orders">
                            <table class="table table-bordered details_user">
                                <form method="POST" id="profile_update">
                                    <div id="msg"></div>
                                    <tbody>
                                    <tr>
                                        <td class="description">
                                            <strong><?php echo 'First Name'; ?></strong> :
                                        </td>
                                        <td class="diliver-date">
                                            <input class="form-control required" type="text" name="first_name" data-toggle="tooltip" title="First Name" value="<?= $detail['first_name']?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="description">
                                            <strong><?php echo 'Last Name'; ?></strong> :
                                        </td>
                                        <td class="diliver-date">
                                            <input class="form-control required" type="text" name="last_name" data-toggle="tooltip" title="Last Name" value="<?= $detail['last_name']?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="description">
                                            <strong><?php echo 'Email'; ?></strong> :
                                        </td>
                                        <td class="diliver-date"> <input class="form-control required" type="email" name="email" data-toggle="tooltip" title="Email" value="<?= $detail['email']?>"> </td>
                                    </tr>
                                    <tr>
                                        <td class="description">
                                            <strong><?php echo 'Address 1'; ?></strong> :
                                        </td>
                                        <td class="diliver-date"> <input class="form-control required" type="text" name="address_1" data-toggle="tooltip" title="Address 1" value="<?= $detail['address_1']?>"> </td>
                                    </tr>
                                    <tr>
                                        <td class="description">
                                            <strong><?php echo 'Address 2 (Optional)'; ?></strong> :
                                        </td>
                                        <td class="diliver-date"> <input class="form-control required" type="text" name="address_2" data-toggle="tooltip" title="Address 2" value="<?= $detail['address_2']?>"> </td>
                                    </tr>
                                    <tr>
                                        <td class="description">
                                            <strong><?php echo 'Contact_no'; ?></strong> :
                                        </td>
                                        <td class="diliver-date"> <input class="form-control required" type="text" name="contact_no" data-toggle="tooltip" title="Contact No" value="<?= $detail['contact_no']?>"> </td>
                                    </tr>
                                    <tr>
                                        <td class="description">
                                            <strong><?php echo 'Country'; ?></strong> :
                                        </td>
                                        <td class="diliver-date"> <input class="form-control required" type="text" name="country" data-toggle="tooltip" title="Country" value="<?= $detail['country']?>"> </td>
                                    </tr>
                                    <tr>
                                        <td class="description">
                                            <strong><?php echo 'City'; ?></strong> :
                                        </td>
                                        <td class="diliver-date"> <input class="form-control required" type="text" name="city" data-toggle="tooltip" title="City" value="<?= $detail['city']?>"> </td>
                                    </tr>
                                    <tr>
                                        <td class="description">
                                            <strong><?php echo 'State'; ?></strong> :
                                        </td>
                                        <td class="diliver-date"> <input class="form-control required" type="text" name="state" data-toggle="tooltip" title="State" value="<?= $detail['state']?>"> </td>
                                    </tr>
                                    <tr>
                                        <td class="description">
                                            <strong><?php echo 'Zip Code'; ?></strong> :
                                        </td>
                                        <td class="diliver-date"> <input class="form-control required" type="text" name="zip_code" data-toggle="tooltip" title="Zip Code" value="<?= $detail['zip_code']?>"> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" align="center">
                                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">UPDATE PROFILE</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <input type="hidden" name="id" value="<?= $detail['id'] ?>">
                                </form>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#profile_update").on('submit', (function (e) {
            e.preventDefault();
            jQuery("#msg").html('<div class="loading"></div>');
            var fd = new FormData(this);
            jQuery.ajax({
                url: '<?php echo site_url("Home/update_profile") ?>',
                data: fd,
                type: "POST",
                contentType: false,
                processData: false,
                cache: false,
                success: function (res) {
                    var res = jQuery.parseJSON(res);
                    if (res.msg_type == 'success') {
                        $.notify("<strong>Success: </strong>"+res.message, {type: "success", allow_dismiss: false });
                        jQuery('#profile_update')[0].reset();
                        jQuery("#name").focus();
                        jQuery(".loading").hide();
                    } else {
                        jQuery("#msg").html(res);
                        $.notify("<strong>Error: </strong>"+res.message, {type: "danger", allow_dismiss: false });
                    }
                },
                error: function (xhr) {
                    jQuery("#msg").html("Error: - " + xhr.status + " " + xhr.statusText);
                }
            });
        }));
    });
</script>
