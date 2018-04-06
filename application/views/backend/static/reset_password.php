<body id="particles-js">
<style>
    body { overflow:hidden; background-color: cadetblue !important; }
    .login-body{
        position: absolute;
        left: 0;
        right: 0;
        margin-left: auto;
        margin-right: auto;
        margin-top: 200px;
    }
</style>
<div class="login">
    <?php if(isset($success)){?>
        <div class="alert alert-success">
            <?php print_r($success);?>
        </div>
    <?php }?>
    <?php if(isset($errors)){?>
        <div class="alert alert-danger">
            <?php print_r($errors);?>
        </div>
    <?php }?>
    <div class="login-body">
        <a class="login-brand" href="<?= base_url() ?>">
            <img class="img-responsive" src="<?= base_url() ?>assets/<?= $theme ?>/img/logo.svg" alt="Elephant">
        </a>
        <div class="login-form">
            <form data-toggle="validator" method="POST">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" class="form-control" type="password" name="password" minlength="6" data-msg-minlength="Password must be 6 characters or more." data-msg-required="Please enter your password." required>
                </div>
                <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input id="password" class="form-control" type="password" name="c_password" minlength="6" data-msg-minlength="Password must be 6 characters or more." data-msg-required="Please enter your password." required>
                </div>
                <button class="btn btn-primary btn-block" type="submit">Reset</button>
            </form>
        </div>
    </div>
</div>
<script src="<?=  base_url()?>assets/particles.min.js"></script>
<script type="text/javascript" src="<?=  base_url()?>assets/<?php echo $theme ?>/js/vendor.min.js"></script>
<script type="text/javascript" src="<?=  base_url()?>assets/<?php echo $theme ?>/js/elephant.min.js"></script>
<script type="text/javascript">
    particlesJS.load('particles-js', '<?=  base_url()?>assets/particlesjs-config.json', function() {
        console.log('callback - particles.js config loaded');
    });
</script>

</body>
</html>