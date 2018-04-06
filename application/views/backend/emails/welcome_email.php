<div class="container">
    <div >
        <p>
        <h2>Welcome <b><?php echo $user['name']?>!</b> Encon Engineering System</h2>
        </p>

    </div>
    <div class="col-lg-12" style="border-radius: 10px; background-color: #f5f5f5; padding: 15px;">

        <p style="color: #000">
        <h3>Alert</h3>

        Kindly change your default password after your first login from settings menu.

        <hr>
        Your account has been created. <a href="<?php echo base_url()?>">Click here</a> to Login
        </p>
        <br />
        <h2>Your Login Details</h2>
        <p><b>Email    : </b><?php echo $user['email']; ?></p>
        <p><b>Password : </b>nocne123*</p>
        <br />
        <h4>Regards</h4>
        <p><strong>Webmaster</strong><br>Technologicx</p>
    </div>
</div>