<div class="layout-content">
    <div class="layout-content-body">
        <div class="row gutter-xs">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Manage Brands</strong>
                    </div>
                    <div class="card-body">
                            <table id="demo-datatables-fixedheader-2" class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID#</th>
                                <th>Logo</th>
                                <th>Name</th>
                                <th>Added At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for($i=0;$i<count($brands);$i++){?>
                                <tr>
                                    <td><?= $brands[$i]['id']; ?></td>
                                    <td>
                                            <a class="file-link" href="<?=base_url()?>uploads/brands_logo/<?= $brands[$i]['image'] ?>">
                                                <div class="file-thumbnail" style="background-image: url(<?=base_url()?>uploads/brands_logo/<?= $brands[$i]['image'] ?>)"></div>
                                            </a>
                                    </td>
                                    <td><?= $brands[$i]['name'] ?></td>
                                    <td><?php echo $brands[$i]['date_time'] ?></td>
                                    <td align="center">
                                        <a href="<?php echo base_url().'Admin/edit_brand/'.$brands[$i]['id'];?>" class="btn btn-info"><i class="icon icon-edit"></i></a>
                                        <button class="btn btn-danger" onclick="validate(this)" value="<?php echo $brands[$i]['id']?>"><i class="icon icon-times"></i></button>
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
                    url: '<?php echo base_url()?>Admin/delete_brand/',
                    data: {'id': id}
                }).then(function(res){
                    $(a).closest('tr').remove();
                    swal('Deleted!', 'Brand has been Deleted.', 'success');
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
