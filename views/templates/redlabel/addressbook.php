<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?= base_url('assets/css/m-custom.css')?>">
<link rel="stylesheet" href="<?= base_url('assets/css/a-custom.css')?>">
<style>
    #map {
        height: 400px;
        width: 100%;
    }
</style>
<section class="m-address-book section-padding">
	<div class="container">
		<div class="row">
			 <div class="col-md-3">
                <div class="order-section">
                    <div class="order-category-title"><i class="fa fa-user"></i>
                    <a href="#"><b>MY ACCOUNT</b></a>
                    </div>
                    <div class="order-category-links">
                        <ul>
                            <li><a href="<?php echo site_url('dashboard'); ?>">Orders</a></li>
                            <li><a href="<?php echo site_url('dashboard/accountsettings'); ?>">Account Settings</a></li>
                            <li><a href="<?php echo site_url('dashboard/addressbook'); ?>">Address Book</a></li>
                           <!-- <li><a href="#">Credit Cards</a></li>-->
                            <li><a href="<?php echo site_url('dashboard/messages'); ?>">Messages</a></li>
                            <li><a href="<?php echo site_url('dashboard/reviews'); ?>">Reviews</a></li>
                            <!--<li><a href="<?php echo site_url('dashboard/mypage'); ?>">My Page</a></li>-->
                        </ul>
                    </div>
                </div><!-- end order-section-->
              <div class="shopping-section">
                    <div class="order-category-title"><i class="fa fa-shopping-bag"></i>
                    <a href="#"><b>SHOPPING TOOLS</b></a>
                    </div>
                    <div class="order-category-links">
                        <ul>
                            <li><a href="<?php echo site_url('wishlist'); ?>">Wish List</a></li>
                            <!--  <li><a href="#">Quick Shop</a></li>-->
                        </ul>
                    </div>
                </div><!-- end shopping-section
                <div class="setting-section">
                    <div class="order-category-title"><i class="fa fa-cogs"></i>
                    <a href="#"><b>SETTINGS</b></a>
                    </div>
                    <div class="order-category-links">
                        <ul>
                            <li><a href="#">Email Preferences</a></li>
                            <li><a href="#">Notification List</a></li>
                        </ul>
                    </div>
                </div><!-- end setting-section-->
                 <div class="reward-section">
                    <div class="order-category-title"><i class="fa fa-gift"></i>
                    <a href="#"><b>REWARDS</b></a>
                    </div>
                    <div class="order-category-links">
                        <ul>
                            <!--<li><a href="#">Overview</a></li>
                            <li><a href="#">Reports</a></li>-->
                            <li><a href="<?php echo site_url('dashboard/faq'); ?>">FAQ</a></li>
                            <li><a href="<?php echo site_url('dashboard/termsandcondition'); ?>">Terms and Conditions</a></li>
                        </ul>
                    </div>
                </div><!-- end reward-section-->
            </div><!-- end -md- 3-->
            
        	<div class="col-md-9 m-rigth-side">
        		<div class="m-top-heading">
                    <h1>Address Book</h1>
                    <p> <a href="#">My Account <i class="fa fa-angle-right"></i></a><span> Address Book </span></p>
                    <!--<p class="m-orange">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae nulla vitae ex posuere sollicitudin. Praesent fringilla</p>-->
            	</div><!--end m-top-heading-->
                    <div class="a-address-book">
                    <!-- Centered Pills -->
                    <ul class="nav nav-pills row">
                      <li class="active col-md-3"><a href="#a-shipping-address" data-toggle="tab">Shipping Address</a></li>
                      <li class="col-md-3"><a href="#a-billing-address" data-toggle="tab">Billing Address</a></li>
                      <li class="col-md-3"><a href="#a-rewards-address" data-toggle="tab">Rewards Address</a></li>
                    </ul>
                    <hr>
                <!--end Centered Pills -->
                <div class="tab-content">
                <?php
                if ($this->session->flashdata('resultSend')) {
                    ?>
                    <hr>
                    <div class="alert alert-info"><?= $this->session->flashdata('resultSend') ?></div>
                    <hr>
                <?php }
                ?>                    
                <!-- Shipping Address -->
                  <div id="a-shipping-address" class="tab-pane fade in active">
                    <div class="a-personal-info"><h1>New Shipping Address </h1></div>
                    <hr>
                    <form class="form-horizontal" action="<?php echo base_url('dashboard/update_shipping_address'); ?>" method="post">
                        <div class="col-md-12 row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo $shipping[0]['shipping_name']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Address Line 1</label>
                                    <input type="text" name="address1" class="form-control" value="<?php echo $shipping[0]['shipping_address1']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control" value="<?php echo $shipping[0]['shipping_city']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Country</label>
                                    <input type="text" name="country" class="form-control" value="<?php echo $shipping[0]['shipping_country']; ?>" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone" class="form-control" value="<?php echo $shipping[0]['shipping_phone']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Address Line 2</label>
                                    <input type="text" name="address2" class="form-control" value="<?php echo $shipping[0]['shipping_address2']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>State</label>
                                    <input type="text" name="state" class="form-control" value="<?php echo $shipping[0]['shipping_state']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Zip</label>
                                    <input type="text" name="zip" class="form-control" value="<?php echo $shipping[0]['shipping_zip']; ?>" />
                                </div>
                                 <div class="form-group text-right">
                                     <button type="submit" class="btn btn-primary" id="btnUpdate">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                  </div>
                  
                  
                  <!-- Biling Address -->
                  <div id="a-billing-address" class="tab-pane fade">
                    <div class="a-personal-info"><h1>New Billing Address</h1></div>
                    <hr>
                    <form class="form-horizontal" action="<?php echo base_url('dashboard/update_billing_address'); ?>" method="post">
                        <div class="col-md-12 row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo $billing[0]['billing_name']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Address Line 1</label>
                                    <input type="text" name="address1" class="form-control" value="<?php echo $billing[0]['billing_address1']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control" value="<?php echo $billing[0]['billing_city']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Country</label>
                                    <input type="text" name="country" class="form-control" value="<?php echo $billing[0]['billing_country']; ?>" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone" class="form-control" value="<?php echo $billing[0]['billing_phone']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Address Line 2</label>
                                    <input type="text" name="address2" class="form-control" value="<?php echo $billing[0]['billing_address2']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>State</label>
                                    <input type="text" name="state" class="form-control" value="<?php echo $billing[0]['billing_state']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Zip</label>
                                    <input type="text" name="zip" class="form-control" value="<?php echo $billing[0]['billing_zip']; ?>" />
                                </div>
                                 <div class="form-group text-right">
                                     <button type="submit" class="btn btn-primary" id="btnUpdate">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                  </div>
                  
                  
                  <!-- Rewards Address -->
                  <div id="a-rewards-address" class="tab-pane fade">
                    <div>
                        <strong>In order to redeem your Rewards Credit for cash, follow these steps:</strong>

<p style="padding-top:15px;">1. Quisque erat ligula, pulvinar ac pharetra id, tincidunt sit amet urna. Nam augue velit, elementum sed enim a, consectetur pharetra dolor. Curabitur eget mauris tempus, bibendum nunc sit amet, consequat neque. Donec vitae risus neque. Quisque in facilisis tellus, ut porta lacus. Mauris quis velit id ipsum mollis elementum sit amet vestibulum erat.</p>

<p>2. Quisque erat ligula, pulvinar ac pharetra id, tincidunt sit amet urna. Nam augue velit, elementum sed enim a, consectetur pharetra dolor. Curabitur eget mauris tempus, bibendum nunc sit amet, consequat neque. Mauris quis velit id ipsum mollis elementum sit amet vestibulum erat.</p>
                    </div>
                    <div class="a-personal-info"><h1>New Rewards Address</h1></div>
                    <hr>
                    <form class="form-horizontal" action="<?php echo base_url('dashboard/update_rewards_address'); ?>" method="post">
                        <div class="col-md-12 row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo $rewards[0]['rewards_name']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Address Line 1</label>
                                    <input type="text" name="address1" class="form-control" value="<?php echo $rewards[0]['rewards_address1']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control" value="<?php echo $rewards[0]['rewards_city']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Country</label>
                                    <input type="text" name="country" class="form-control" value="<?php echo $rewards[0]['rewards_country']; ?>" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone" class="form-control" value="<?php echo $rewards[0]['rewards_phone']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Address Line 2</label>
                                    <input type="text" name="address2" class="form-control" value="<?php echo $rewards[0]['rewards_address2']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>State</label>
                                    <input type="text" name="state" class="form-control" value="<?php echo $rewards[0]['rewards_state']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Zip</label>
                                    <input type="text" name="zip" class="form-control" value="<?php echo $rewards[0]['rewards_zip']; ?>" />
                                </div>
                                 <div class="form-group text-right">
                                     <button type="submit" class="btn btn-primary" id="btnUpdate">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
                <!--end tab-content -->
                </div>
        	</div><!--end m-rigth-side-->
		</div><!--end row-->
	</div><!--end container-->
</section><!--end m-address-book-->
<script type="text/javascript">
    $(document).ready(function(){
        $("#shipping-sen").click(function(){
    $(this).remove();
});

})
</script>