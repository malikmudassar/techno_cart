<?php ?>
<div class="container">

    <div>
        <img src="http://www.huffpartners.com/wp-content/uploads/2015/08/ban2.jpg" />
    </div>
    <div >
        <p>
            <h2>Thank you for registration</h2>
        </p>
    </div>
    <div class="col-lg-12" style="border-radius: 10px; background-color: #f5f5f5; padding: 15px;">

        <p style="color: #000">
            Please copy and paste the below URL in your browser or just  <a href="<?php echo base_url().'Home/activate/'.$id.'/'.$hash?>">Click Here</a>
            to activate your account.
        </p>
        <b>URL:</b><span><?php echo base_url().'Home/activate/'.$id.'/'.$hash?></span>
    </div>
</div>