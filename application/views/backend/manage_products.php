<div class="layout-content">
    <div class="layout-content-body">
        <div class="row gutter-xs">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Manage Products</strong>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?= base_url().'Admin/export_product' ?>">
                           <button name="export" type="submit" class="btn-xs btn-primary">EXPORT</button>
                        </form>
                            <table id="demo-datatables-fixedheader-2" class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID#</th>
                                <th>Part No.</th>
                                <th>Purchase Price</th>
                                <th>Selling Price</th>
                                <th>Feature</th>
                                <th>Feature YES/NO</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for($i=0;$i<count($products);$i++){?>
                                <tr>
                                    <td><?php echo $products[$i]['id']?></td>
                                    <td><?php echo $products[$i]['part_no']?></td>
                                    <td><?php echo $products[$i]['purchase_price']?></td>
                                    <td><?php echo $products[$i]['sale_price']?></td>
                                    <td align="center">
                                        <?php if($products[$i]['p_feature'] == 'NO') { ?>
                                            <span class="badge badge-danger"><?= $products[$i]['p_feature'] ?></span>
                                        <?php } else { ?>
                                            <span class="badge badge-primary"><?= $products[$i]['p_feature'] ?></span>
                                        <?php } ?>
                                    </td>
                                    <td align="center">
                                        <button class="btn btn-info" onclick="validate1(this)" value="<?php echo $products[$i]['id']?>" title="Enable"><i class="icon icon-toggle-on"></i></button>
                                        <button class="btn btn-primary" onclick="validate2(this)" value="<?php echo $products[$i]['id']?>" title="Disable"><i class="icon icon-toggle-off"></i></button>
                                    </td>
                                    <td align="center">
                                        <a href="<?php echo base_url().'Admin/view_product_detail/'.$products[$i]['id'];?>" class="btn btn-info"><i class="icon icon-eye"></i></a>
                                        <a href="<?php echo base_url().'Admin/edit_product/'.$products[$i]['id'];?>" class="btn btn-success"><i class="icon icon-pencil"></i></a>
                                        <button class="btn btn-danger" onclick="validate(this)" value="<?php echo $products[$i]['id']?>" title="Delete"><i class="icon icon-times"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= base_url() ?>backend_assets/<?= $theme ?>/sweetalert/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>backend_assets/<?= $theme ?>/sweetalert/core.js"></script>
<script>
    function validate(a)
    {
        var id= a.value;
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            animation: false,
            customClass: 'animated pulse',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: true,
            reverseButtons: true
        }).then( function(result) {
            if (result.value) {

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url()?>Admin/delete_product/',
                    data: {'id': id}
                }).then(function(res){
                    $(a).closest('tr').remove();
                    swal('Deleted!', 'Product has been Deleted.', 'success');
                }, function(err){
                    swal('Error', err.statusText, 'error');
                });



            } else if (result.dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })
    }
</script>
<script>
    function validate1(a)
    {
        var id= a.value;
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            animation: false,
            customClass: 'animated pulse',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Enable it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: true,
            reverseButtons: true
        }).then( function(result) {
            if (result.value) {

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url()?>Admin/enable_feature_product/',
                    data: {'id': id}
                }).then(function(res){
                    //$(a).closest('tr').remove();
                    swal('Enabled!', 'Feature Product has been Enable.', 'success');
                }, function(err){
                    swal('Error', err.statusText, 'error');
                });



            } else if (result.dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })
    }
</script>
<script>
    function validate2(a)
    {
        var id= a.value;
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            animation: false,
            customClass: 'animated pulse',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Disable it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: true,
            reverseButtons: true
        }).then( function(result) {
            if (result.value) {

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url()?>Admin/disable_feature_product/',
                    data: {'id': id}
                }).then(function(res){
                    //$(a).closest('tr').remove();
                    swal('Disabled!', 'Feature Product has been Disable.', 'success');
                }, function(err){
                    swal('Error', err.statusText, 'error');
                });



            } else if (result.dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })
    }
</script>
