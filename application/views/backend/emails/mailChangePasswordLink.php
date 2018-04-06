<?php ?>



<!--Mail Change Password-->
<div class="container">
    <div >
        <p>
        <h2>Hi, We Notice that you request for reset your current Password</h2>
        </p>
    </div>
    <div class="col-lg-12" style="border-radius: 10px; background-color: #f5f5f5; padding: 15px;">

        <p style="color: #000">
            Please copy and paste the below URL in your browser or just  <a href="<?php echo base_url().'login/change_password/'.$id.'/'.$hash?>">Click Here</a>
            to reset your <strong>Password</strong>.
        </p>
        <b>URL:</b><span><?php echo base_url().'login/change_password/'.$id.'/'.$hash?></span>
        <h4>Regards</h4>
        <p><strong>Webmaster</strong><br>Technologicx</p>
    </div>
</div>