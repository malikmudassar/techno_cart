<section class="page-section profile_top">
    <div  class="wrap container">
        <div class="row">
            <div class="col-md-12">
                <div class="top_nav">
                    <ul>
                        <li class="active">
                            <span id="dashboard">
                                <a href="<?= base_url().'Home/Customer_dashboard'?>"><?php echo 'Dashboard';?></a>
                            </span>
                        </li>
                        <li>
                            <span id="edit_profile">
                                <a href="<?= base_url().'Home/Edit_profile/'.$this->session->userdata['id']?>"><?php echo 'Edit Profile';?></a>
                            </span>
                        </li>
                        <li>
                        	<span id="order_history">
                        		<a href="<?= base_url().'Home/Order_history/'.$this->session->userdata['id']?>"><?php echo 'Order history';?></a>
                        	</span>
                        </li>
                        <li>
                        	<span id="update_password">
                        		<a href="<?= base_url().'Home/change_password/'?>"><?php echo 'Change Password';?></a>
                        	</span>
                        </li>
                        <li>
                        	<span id="Logout">
                        		<a href="<?= base_url(). 'Home/logout'; ?>">Logout</a>
                        	</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<hr class="hr_sp">