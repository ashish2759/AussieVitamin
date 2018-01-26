<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?= base_url('assets/css/a-custom.css')?>">
<style>
    #map {
        height: 400px;
        width: 100%;
    }
</style>
<div id="my-account-order" class="section-padding">
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

            <div class="col-md-9">
                <div class="row">
                    <div class="a-breadcrumb col-md-6">
                        <h1>Messages</h1>
                        <p> <a href="#">My Account <i class="fa fa-angle-right"></i></a><span>Messages</span> </p>
                    </div><!--end a-breadcrumb-->
                    <div class="a-message-filter col-md-3 col-md-offset-3">
                        <div class="form-group">
                            <select class="form-control" id="sel1">
                               <option value="0" data-ga-event-label="Change - Filter All Messages">All Messages</option>
								<option value="1" data-ga-event-label="Change - Filter Unread">Unread</option>
								<option value="2" data-ga-event-label="Change - Filter Last 30 Days">Last 30 Days</option>
								<option value="3" data-ga-event-label="Change - Filter Last 6 Months">Last 6 Months</option>
								<option value="4" data-ga-event-label="Change - Filter This Year">This Year</option>
								<option value="5" data-ga-event-label="Change - Filter Last Year">Last Year</option>
								<option value="6" data-ga-event-label="Change - Filter Older">Older</option>
                            </select>
                        </div>
                    </div><!--end a-message-filter-->
                </div>
                <div class="row">
                	<div class="col-md-12 a-MessageCenterContainer">
	                	<ul class="nav nav-tabs">
						  <li class="active">
						  	<a data-toggle="tab" href="#a-important"> Important <span class="count Important">(0)</span></a></li>
						  <li>
						  	<a data-toggle="tab" href="#a-order">Your Orders <span class="count Order">(0)</span></a></li>
						  <li>
						  	<a data-toggle="tab" href="#a-account">Your Account <span class="count Account">(0)</span></a></li>
						</ul>

						<div class="tab-content">
						  <div id="a-important" class="tab-pane a-tab-pane fade in active">
						   	<div class="a-empty-state"><i class="fa fa-envelope"></i><p><b>No Messages to Display</b></p></div>
						  </div>
						  <div id="a-order" class="tab-pane a-tab-pane fade">
						    <div class="a-empty-state"><i class="fa fa-envelope"></i><p><b>No Messages to Display</b></p></div>
						  </div>
						  <div id="a-account" class="tab-pane a-tab-pane fade">
						    <div class="a-empty-state"><i class="fa fa-envelope"></i><p><b>No Messages to Display</b></p></div>
						  </div>
						</div>
					</div>
                </div>
            </div><!--end col-md-9-->

        </div>
    </div>
</div>
