<?php include "static/dashboard_header.php"; ?>
<section class="page-section">
    <div class="wrap container">
        <div id="profile-content">
            <div class="row profile">
                <div class="col-md-12" >
                    <div class="information-title">
                        <?php echo 'profile_information'; ?>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="thumbnail no-border no-padding thumbnail-banner size-1x3">
                                <div class="media">
                                    <div class="media-link imran">
                                        <div class="caption">
                                            <div class="caption-wrapper div-table">
                                                <div class="caption-inner div-cell">
                                                    <h2 class="caption-title"><span><?php echo 'total_purchase'; ?>
                                                            : <?php /*echo currency($this->crud_model->user_total(0)); */?></span></h2>
                                                    <h3 class="caption-sub-title"><span><?php echo 'last_7_days'; ?>
                                                            : <?php /*echo currency($this->crud_model->user_total(7)); */?></span></h3>
                                                    <h3 class="caption-sub-title"><span><?php echo 'last_30_days'; ?>
                                                            : <?php /*echo currency($this->crud_model->user_total(30)); */?></span></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="thumbnail no-border no-padding thumbnail-banner size-1x3" style="height:auto;">
                                <div class="media">
                                    <div class="media-link">
                                        <div class="caption text-right">
                                            <div class="caption-wrapper div-table">
                                                <div class="caption-inner div-cell">
                                                    <h2 class="caption-title"><span><?php echo 'wished_products'; ?>
                                                            : <?php /*echo $this->crud_model->user_wished(); */?></span></h2>
                                                    <h3 class="caption-sub-title"><span><?php echo 'user_since'; ?>
                                                            : (<?= $this->session->userdata['date_time'] ?>)</span></h3>
                                                    <h3 class="caption-sub-title"><span><?php echo 'last_login'; ?>
                                                            : <?php /*echo date('d M, Y', $row['last_login']); */?></span></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="details-wrap" style="margin-top:30px;">
                        <div class="details-box orders">
                            <table class="table table-bordered details_user">
                                <tbody>
                                <tr>
                                    <td class="description">
                                        <strong><?php echo 'Name'; ?></strong> :
                                    </td>
                                    <td class="diliver-date"> <?= $this->session->userdata['first_name']." ".$this->session->userdata['last_name'] ?> </td>
                                </tr>
                                <tr>
                                    <td class="description">
                                        <strong><?php echo 'Email'; ?></strong> :
                                    </td>
                                    <td class="diliver-date"> <?= $this->session->userdata['email'] ?> </td>
                                </tr>
                                <tr>
                                    <td class="description">
                                        <strong><?php echo 'Address 1'; ?></strong> :
                                    </td>
                                    <td class="diliver-date"> <?= $this->session->userdata['address_1'] ?> </td>
                                </tr>
                                <tr>
                                    <td class="description">
                                        <strong><?php echo 'Address 2 (Optional)'; ?></strong> :
                                    </td>
                                    <td class="diliver-date"> <?= $this->session->userdata['address_2'] ?> </td>
                                </tr>
                                <tr>
                                    <td class="description">
                                        <strong><?php echo 'Contact_no'; ?></strong> :
                                    </td>
                                    <td class="diliver-date"> <?= $this->session->userdata['contact_no'] ?> </td>
                                </tr>
                                <tr>
                                    <td class="description">
                                        <strong><?php echo 'Country'; ?></strong> :
                                    </td>
                                    <td class="diliver-date"> <?= $this->session->userdata['country'] ?> </td>
                                </tr>
                                <tr>
                                    <td class="description">
                                        <strong><?php echo 'City'; ?></strong> :
                                    </td>
                                    <td class="diliver-date"> <?= $this->session->userdata['city'] ?> </td>
                                </tr>
                                <tr>
                                    <td class="description">
                                        <strong><?php echo 'State'; ?></strong> :
                                    </td>
                                    <td class="diliver-date"> <?= $this->session->userdata['state'] ?> </td>
                                </tr>
                                <tr>
                                    <td class="description">
                                        <strong><?php echo 'Zip Code'; ?></strong> :
                                    </td>
                                    <td class="diliver-date"> <?= $this->session->userdata['zip_code'] ?> </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var top = Number(200);
    var loading_set = '<div style="text-align:center;width:100%;height:'+(top*2)+'px; position:relative;top:'+top+'px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>';

    $('#info').on('click',function(){
        $("#profile-content").html(loading_set);
        $("#profile-content").load("<?php echo base_url()?>index.php/home/profile/info");
        $("li").removeClass("active");
        $(this).closest("li").addClass("active");
    });
    $('#wishlist').on('click',function(){
        $("#profile-content").html(loading_set);
        $("#profile-content").load("<?php echo base_url()?>index.php/home/profile/wishlist");
        $("li").removeClass("active");
        $(this).closest("li").addClass("active");
    });
    $('#order_history').on('click',function(){
        $("#profile-content").html(loading_set);
        $("#profile-content").load("<?php echo base_url()?>index.php/home/profile/order_history");
        $("li").removeClass("active");
        $(this).closest("li").addClass("active");
    });
    $('#downloads').on('click',function(){
        $("#profile-content").html(loading_set);
        $("#profile-content").load("<?php echo base_url()?>index.php/home/profile/downloads");
        $("li").removeClass("active");
        $(this).closest("li").addClass("active");
    });
    $('#update_profile').on('click',function(){
        $("#profile-content").html(loading_set);
        $("#profile-content").load("<?php echo base_url()?>index.php/home/profile/update_profile");
        $("li").removeClass("active");
        $(this).closest("li").addClass("active");
    });
    $('#ticket').on('click',function(){
        $("#profile-content").html(loading_set);
        $("#profile-content").load("<?php echo base_url()?>index.php/home/profile/ticket");
        $("li").removeClass("active");
        $(this).closest("li").addClass("active");
    });
    $('#message_view').on('click',function(){
        $("#profile-content").html(loading_set);
        $("#profile-content").load("<?php echo base_url()?>index.php/home/profile/message_view");
    });
    $(document).ready(function(){
        $("#<?php echo $part; ?>").click();
    });
</script>
<style type="text/css">
    .pagination_box a{
        cursor: pointer;
    }
</style>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
