<body id="particles-js">
<style>
    body { overflow:hidden; background-color: cadetblue !important; }
    .login-body{
      position: absolute;
      left: 0;
      right: 0;
      margin-left: auto;
      margin-right: auto;
      margin-top: 100px;
  }
</style>
<div class="login">
    <?php if(isset($success)){?>
    <div class="alert alert-danger">
        <?php print_r($success);?>
    </div>
    <?php }?>
    <?php if(isset($errors)){?>
    <div class="alert alert-danger">
        <?php print_r($errors);?>
    </div>
    <?php }?>
    <div class="login-body">
        <img data-wow-duration="0.5s" data-wow-delay="0.5s" src="<?= base_url().'uploads/avatar1.png'?>" class="wow fadeIn center-block animated" style="width: 78px; height: 60px; margin-bottom: 20px; visibility: visible; animation-duration: 0.5s; animation-delay: 0.5s; animation-name: fadeIn;" alt="">
        <div class="login-form">
            <form data-toggle="validator" method="POST" id="login-form">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" class="form-control" type="email" name="email" spellcheck="false" autocomplete="off" data-msg-required="Please enter your email address." required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" class="form-control" type="password" name="password" minlength="6" data-msg-minlength="Password must be 6 characters or more." data-msg-required="Please enter your password." required>
                </div>
                <div class="form-group">
                    <label class="custom-control custom-control-primary custom-checkbox">
                        <input class="custom-control-input" type="checkbox" checked="checked">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-label">Keep me signed in</span>
                    </label>
                    <span aria-hidden="true"> · </span>
                    <a href="<?= base_url().'login/forgot_password'?>">Forgot password?</a>
                </div>
                <button class="btn btn-primary btn-block" type="submit">Login</button>
            </form>
        </div>
    </div>
</div>
<script src="<?=  base_url()?>backend_assets/particles.min.js"></script>
<script type="text/javascript" src="<?=  base_url()?>backend_assets/<?php echo $theme ?>/js/vendor.min.js"></script>
<script type="text/javascript" src="<?=  base_url()?>backend_assets/<?php echo $theme ?>/js/main.js"></script>
<script type="text/javascript">
    particlesJS.load('particles-js', '<?=  base_url()?>assets/particlesjs-config.json', function() {
        console.log('callback - particles.js config loaded');
    });

    $(function(){
        $("#login-form").on("submit", function(e){
            e.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "",
                data: form_data,
            }).then(function(res){
                res = $.parseJSON(res);
                if(res.type == "success"){
                    toastr.success(res.response);
                    setTimeout(function(){
                        window.location = res.redirect_link;
                    }, 2000);
                } else {
                    toastr.error(res.response);
                }
            }, function(){

            })
        });
    });

</script>
</body>
</html>