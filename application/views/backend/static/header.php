<body  class="layout layout-header-fixed">
<div class="layout-header">
    <div class="navbar navbar-default">
        <div class="navbar-header">
            <a class="navbar-brand navbar-brand-center" href="<?php echo base_url() ?>">
                <strong><?= $company_info['name']?></strong>
            </a>
            <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#sidenav">
                <span class="sr-only">Toggle navigation</span>
                <span class="bars">
              <span class="bar-line bar-line-1 out"></span>
              <span class="bar-line bar-line-2 out"></span>
              <span class="bar-line bar-line-3 out"></span>
            </span>
                <span class="bars bars-x">
              <span class="bar-line bar-line-4"></span>
              <span class="bar-line bar-line-5"></span>
            </span>
            </button>
            <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="arrow-up"></span>
                <span class="ellipsis ellipsis-vertical">
              <img class="ellipsis-object" width="32" height="32" src="<?= base_url() ?>assets/<?= $theme ?>/img/0180441436.jpg" alt="technologicx">
            </span>
            </button>
        </div>
        <div class="navbar-toggleable">
            <nav id="navbar" class="navbar-collapse collapse">
                <button class="sidenav-toggler hidden-xs" title="Collapse sidenav ( [ )" aria-expanded="true" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="bars">
                <span class="bar-line bar-line-1 out"></span>
                <span class="bar-line bar-line-2 out"></span>
                <span class="bar-line bar-line-3 out"></span>
                <span class="bar-line bar-line-4 in"></span>
                <span class="bar-line bar-line-5 in"></span>
                <span class="bar-line bar-line-6 in"></span>
              </span>
                </button>
                <ul class="nav navbar-nav navbar-right">



                    <li class="dropdown hidden-xs ">
                        <button class="navbar-account-btn" data-toggle="dropdown" aria-haspopup="true">

                            <img class="rounded" width="36" height="36" src="<?php if(!empty($this->session->userdata['image'])) { ?>
                            <?= base_url()?>uploads/<?= $this->session->userdata['image']?>
                            <?php } else { ?>
                            <?= base_url()?>uploads/avatar.png
                            <?php } ?>
                            ">
                            <span class="caret"></span>
                        </button>
                        <?php $controller = $this->uri->segment(1); ?>
                        <div class="dropdown-menu dropdown-menu-right animated fadeInDown">

                            <div class="col-md-12">

                                <img class="rounded"  src="<?php if(!empty($this->session->userdata['image'])) { ?>
                                    <?= base_url()?>uploads/<?= $this->session->userdata['image']?>
                                    <?php } else { ?>
                                    <?= base_url()?>uploads/avatar.png
                                    <?php } ?>" width="120px" height="90px" >
                                <h4>Hi,<?= $this->session->userdata['name'] ?></h4>
                                <p><?= $this->session->userdata['email'] ?></p>
                            </div>
                            <div class="col-md-6 margin">
                                <span><a href="<?php echo base_url().$controller.'/edit_profile'; ?>"><span class="icon icon-user"></span>  Profile</a></span>

                            </div>
                            <div class="col-md-6 margin">
                                <span><a href="<?= base_url().$this->session->userdata['type'].'/change_password'?>"><span class="icon icon-cog"></span>  Settings</a></span>

                            </div>

                            <div class="col-md-12">
                                <a href="<?php echo base_url().$controller.'/logout'; ?>">
                                <button class="btn btn-primary btn-sm btn-block">
                                    <span class="icon icon-unlock"></span>
                                    Logout

                                </button>
                                </a>
                            </div>

                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
