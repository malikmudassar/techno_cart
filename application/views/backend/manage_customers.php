<div class="layout-content">
    <div class="layout-content-body">
        <div class="row gutter-xs">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Manage Customers</strong>
                    </div>
                    <div class="card-body">
                            <table id="demo-datatables-fixedheader-2" class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Country</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <form method="POST">
                            <?php for($i=0;$i<count($customers);$i++){?>
                                <tr>
                                    <td><?php echo $customers[$i]['first_name']?>&nbsp;<?php echo $customers[$i]['last_name']?></td>
                                    <td><?php echo $customers[$i]['email']?></td>
                                    <td><?php echo $customers[$i]['contact_no']?></td>
                                    <td><?php echo $customers[$i]['country']?></td>
                                    <td align="center">
                                        <?php  if($customers[$i]['status']=='Approved') {?>
                                        <span class="badge badge-primary"><?= $customers[$i]['status']?></span>
                                        <?php } else { ?>
                                        <span class="badge badge-danger"><?= $customers[$i]['status']?></span>
                                        <?php } ?>

                                    </td>
                                    <td align="center">
                                        <a href="<?php echo base_url().$this->session->userdata['type'].'/view_customer_detail/'.$customers[$i]['id'];?>" class="btn btn-primary" title="Customer Detail"><i class="icon icon-eye"></i></a>
                                        <button class="btn btn-danger" onclick="validate(this)" value="<?php echo $customers[$i]['id']?>" title="Delete"><i class="icon icon-trash"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                            </form>
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
                    url: '<?php echo base_url()?>Admin/delete_customer/',
                    data: {'id': id}
                }).then(function(res){
                    $(a).closest('tr').remove();
                    swal('Deleted!', 'Customer has been Deleted.', 'success');
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
