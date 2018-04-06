<?php include "static/dashboard_header.php"; ?>
<section class="page-section">
    <div class="wrap container">
        <div id="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="information-title">
                        <?php echo 'Your Order History';?>
                    </div>
                    <div class="details-wrap">
                        <div class="details-box orders">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo 'Date';?></th>
                                    <th><?php echo 'Amount';?></th>
                                    <th><?php echo 'Payment Status'; ?></th>
                                    <th><?php echo 'Order Status';?></th>
                                    <th><?php echo 'invoice';?></th>
                                </tr>
                                </thead>
                                <tbody id="result2">
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <input type="hidden" id="page_num2" value="0" />

                    <div class="pagination_box">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
