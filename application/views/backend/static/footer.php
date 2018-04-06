<div class="layout-footer">
        <div class="layout-footer-body">
          <small class="version">Version 1.0</small>
          <small class="copyright">2017 &copy; Technologicx <a href="https://technologicx.com/">Made by Technologicx</a></small>
        </div>
      </div>
    </div>
    <div class="theme">
      <div class="theme-panel theme-panel-collapsed">
        <div class="theme-panel-controls">
          <button class="theme-panel-toggler" title="Expand theme panel ( ] )" type="button">
            <span class="icon icon-cog icon-spin" aria-hidden="true"></span>
          </button>
        </div>
        <div class="theme-panel-body">
          <div class="custom-scrollbar">
            <div class="custom-scrollbar-inner">
              <h5 class="theme-heading">
                <a href="" class="btn btn-primary btn-block">SELECT THEME</a>
              </h5>
              <hr class="theme-divider">
              <ul class="theme-variants">
                <li class="theme-variants-item">
                  <a class="theme-variants-link" href="<?php echo base_url().'Admin/changeTheme/1'?>" title="Theme 1">
                    <img class="img-responsive" src="<?= base_url() ?>assets/<?= $theme ?>/img/f420a3cea0fb04862eb630f5a54b2733.jpg" alt="Theme 1">
                  </a>
                </li>
                <li class="theme-variants-item">
                  <a class="theme-variants-link" href="<?php echo base_url().'Admin/changeTheme/2'?>" title="Theme 2">
                    <img class="img-responsive" src="<?= base_url() ?>assets/<?= $theme ?>/img/4fcb4322807f1fd92aa3140adb37d4d9.jpg" alt="Theme 4">
                  </a>
                </li>
                <li class="theme-variants-item">
                  <a class="theme-variants-link" href=<?php echo base_url().'Admin/changeTheme/3'?>" title="Theme 3">
                    <img class="img-responsive" src="<?= base_url() ?>assets/<?= $theme ?>/img/0100e8b81ad03f81a64a0a5f49c5be41.jpg" alt="Theme 8">
                  </a>
                </li>
                <li class="theme-variants-item">
                  <a class="theme-variants-link" href="<?php echo base_url().'Admin/changeTheme/4'?>" title="Theme 4">
                    <img class="img-responsive" src="<?= base_url() ?>assets/<?= $theme ?>/img/2ef1cfdcf1da5256d7b994983bd8d457.jpg" alt="Theme 10">
                  </a>
                </li>
                  <li class="theme-variants-item">
                      <a class="theme-variants-link" href="<?php echo base_url().'Admin/changeTheme/5'?>" title="Theme 5">
                          <img class="img-responsive" src="<?= base_url() ?>assets/<?= $theme ?>/img/69ece2eb60bdd2126e2acf27af43aa9b.jpg" alt="Theme 9">
                      </a>
                  </li>
                </li>
                <li class="theme-variants-item">
                  <a class="theme-variants-link" href="<?php echo base_url().'Admin/changeTheme/6'?>" title="Theme 6">
                    <img class="img-responsive" src="<?= base_url() ?>assets/<?= $theme ?>/img/7a4ee939781f6165006cff1b5b8096d4.jpg" alt="Theme 12">
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="<?= base_url() ?>backend_assets/<?php echo $theme?>/js/vendor.min.js"></script>
    <script src="<?= base_url() ?>backend_assets/<?php echo $theme?>/js/main.js"></script>
    <script src="<?= base_url() ?>backend_assets/<?php echo $theme?>/js/application.min.js"></script>
    <script src="<?= base_url()?>backend_assets/<?php echo $theme?>/js/demo.min.js"></script>
    <script src="<?= base_url() ?>backend_assets/bootstrap-select.min.js"></script>

    <script>
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove();
                });
            }, 4000);

            $(function(){
                <?php if($this->session->flashdata("msg_type") == "success"): ?>
                toastr.success("<?= $this->session->flashdata("message") ?>");
                <?php elseif($this->session->flashdata("msg_type") == "error"): ?>
                toastr.error("<?= $this->session->flashdata("message") ?>");
                <?php elseif($this->session->flashdata("msg_type") == "info"): ?>
                toastr.info("<?= $this->session->flashdata("message") ?>");
                <?php elseif($this->session->flashdata("msg_type") == "warning"): ?>
                toastr.warning("<?= $this->session->flashdata("message") ?>");
                <?php endif;?>
            });
        </script>

    <!-- DYNAMIC SEARCH IN SIDEBAR -->
    <script>
        (function ($) {
            // custom css expression for a case-insensitive contains()
            jQuery.expr[':'].Contains = function(a,i,m){
                return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
            };

            function FilterMenu(list) {
                var input = $(".filtertxt");

                $(input).change( function () {
                    var filter = $(this).val();
                    //console.log(filter);
                    //If search text box contains some text then apply filter list
                    if(filter){
                        //Add open class to parent li item
                        $(list).parent().addClass('open');
                        //Add class in and expand the ul item which is nested li of main ul
                        $(list).addClass('in').prop('aria-expanded', 'true').slideDown();

                        //Check if child list items contain the query text. Them make them active
                        $(list).find('li:Contains('+filter+')').addClass('active');
                        //Check if any child list items doesn't contain query text. Remove the active class
                        //So that they are not more highlighted
                        $(list).find('li:not(:Contains('+filter+'))').removeClass('active');

                        //Show any ul inside main ul which contains the text.
                        $(list).find('li:Contains('+filter+')').show();
                        //Hide any ul inside main ul which doesn't contains the text.
                        $(list).find('li:not(:Contains('+filter+'))').hide();

                        //Filter top level list items to show and hide them.
                        $('#social-sidebar-menu').find('li:Contains('+filter+')').show();
                        $('#social-sidebar-menu').find('li:not(:Contains('+filter+'))').hide();

                    }else{
                        //On query text = empty reset all classes and styles to default.
                        $(list).parent().removeClass('open');
                        $(list).removeClass('in').prop('aria-expanded', 'false').slideUp();
                        $(list).find('li').removeClass('active');
                        $('#social-sidebar-menu').find('li').show();
                    }
                })
                    .keyup( function () {
                        $(this).change();
                    });
            }

            //ondomready
            $(function () {
                FilterMenu($("#social-sidebar-menu ul"));
            });
        }(jQuery));
    </script>
  </body>
</html>