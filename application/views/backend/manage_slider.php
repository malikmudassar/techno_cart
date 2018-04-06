<div class="layout-content">
    <div class="layout-content-body">
        <div class="row gutter-xs">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Manage Slider Images</strong>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?= base_url() . 'Admin/add_slide' ?>">
                            <button class="btn-xs btn-info" type="submit">Add Slide</button>
                        </form>
                        <table id="demo-datatables-fixedheader-2"
                               class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>ID#</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Enable/Disable</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for ($i = 0; $i < count($slider); $i++) { ?>
                                <tr>
                                    <td><?php echo $slider[$i]['id'] ?></td>
                                    <td>
                                        <a class="file-link" href="<?= base_url() ?>uploads/<?= $slider[$i]['image'] ?>"
                                           title="0310728269.jpg">
                                            <div class="file-thumbnail"
                                                 style="background-image: url(<?= base_url() ?>uploads/<?= $slider[$i]['image'] ?>)"></div>
                                        </a>
                                    </td>
                                    <!--<td><?php /*echo $slider[$i]['date_time'] */?></td>-->
                                    <td align="center">
                                        <?php if($slider[$i]['status'] == "Enable") { ?>
                                        <span class="badge badge-success"><?= $slider[$i]['status'] ?></span>
                                        <?php }
                                        else {
                                        ?>
                                        <span class="badge badge-warning"><?= $slider[$i]['status'] ?></span>
                                        <?php } ?>
                                    </td>
                                    <td align="center">
                                        <button class="btn btn-info" title="Enable" onclick="validate1(this)"
                                                value="<?php echo $slider[$i]['id'] ?>"><i class="icon icon-toggle-on"></i>
                                        </button>
                                        <button class="btn btn-success" title="Disable" onclick="validate2(this)"
                                                value="<?php echo $slider[$i]['id'] ?>"><i class="icon icon-toggle-off"></i>
                                        </button>
                                    </td>
                                    <td align="center">
                                        <a href="<?php echo base_url() . 'Admin/edit_slide/' . $slider[$i]['id']; ?>"
                                           class="btn btn-success"><i class="icon icon-pencil"></i></a>
                                        <button class="btn btn-danger" onclick="validate(this)"
                                                value="<?php echo $slider[$i]['id'] ?>"><i class="icon icon-times"></i>
                                        </button>
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
                    url: '<?php echo base_url()?>Admin/del_sliderImage/',
                    data: {'id': id}
                }).then(function(res){
                    $(a).closest('tr').remove();
                    swal('Deleted!', 'Slide Image has been Deleted.', 'success');
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
                    url: '<?php echo base_url()?>Admin/enable_slider_image/',
                    data: {'id': id}
                }).then(function(res){
                    //$(a).closest('tr').remove();
                    swal('Enabled!', 'Slide Image has been Enable.', 'success');
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
                    url: '<?php echo base_url()?>Admin/disable_slider_image/',
                    data: {'id': id}
                }).then(function(res){
                    //$(a).closest('tr').remove();
                    swal('Disabled!', 'Slide Image has been Disable.', 'success');
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