<div class="layout-content">
    <div class="layout-content-body">
        <div class="row">
            <div style="left: 50%; transform: translateX(-50%);" class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong><span class="icon icon-eye"></span> CUSTOMER DETAIL</strong>
                    </div>
                    <div class="card-body">
                        <div id="msg"></div>
                        <form id="customer_detail" class="form form-horizontal" style="margin-top: 30px" method="POST">
                            <table border="2px" width="500px" align="center">
                                <tr>
                                    <th style="height: 30px;">Customer Full Name</th>
                                    <th>&nbsp;<?= $customer_detail['first_name']?>&nbsp;<?=$customer_detail['last_name']?></th>
                                </tr>
                                <tr>
                                    <th style="height: 30px;">Email</th>
                                    <th>&nbsp;<?= $customer_detail['email']?></th>
                                </tr>
                                <tr>
                                    <th style="height: 30px;">Contact</th>
                                    <th>&nbsp;<?= $customer_detail['contact_no']?></th>
                                </tr>
                                <tr>
                                    <th style="height: 30px;">Country</th>
                                    <th>&nbsp;<?= $customer_detail['country']?></th>
                                </tr>
                                <tr>
                                    <th style="height: 30px;">City</th>
                                    <th>&nbsp;<?= $customer_detail['city']?></th>
                                </tr>
                                <tr>
                                    <th style="height: 30px;">Address 1</th>
                                    <th>&nbsp;<?= $customer_detail['address_1']?></th>
                                </tr>
                                <tr>
                                    <th style="height: 30px;">Address 2</th>
                                    <th>&nbsp;<?= $customer_detail['address_2']?></th>
                                </tr>
                                <tr>
                                    <th style="height: 30px;">State</th>
                                    <th>&nbsp;<?= $customer_detail['state']?></th>
                                </tr>
                                <tr>
                                    <th style="height: 30px;">Zip Code</th>
                                    <th>&nbsp;<?= $customer_detail['zip_code']?></th>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
