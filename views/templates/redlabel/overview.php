<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?= base_url('assets/css/m-custom.css')?>">
<style>
    #map {
        height: 400px;
        width: 100%;
    }
</style>
<section class="m-overview">
	<div class="container">
		<div class="row">
			<div class="col-md-3 m-left-menu">
                <div class="order-section">
                    <div class="order-category-title"><i class="fa fa-user"></i>
                    <a href="#"><b>MY ACCOUNT</b></a>
                    </div>
                    <div class="order-category-links">
                        <ul>
                            <li><a href="#">Orders</a></li>
                            <li><a href="#">Account Settings</a></li>
                            <li><a href="#">Address Book</a></li>
                            <li><a href="#">Credit Cards</a></li>
                            <li><a href="#">Messages</a></li>
                            <li><a href="#">Reviews</a></li>
                            <li><a href="#">My Page</a></li>
                        </ul>
                    </div>
                </div><!-- end order-section-->
                <div class="shopping-section">
                    <div class="order-category-title"><i class="fa fa-shopping-bag"></i>
                    <a href="#"><b>SHOPPING TOOLS</b></a>
                    </div>
                    <div class="order-category-links">
                        <ul>
                            <li><a href="#">Wish List</a></li>
                            <li><a href="#">Quick Shop</a></li>
                        </ul>
                    </div>
                </div><!-- end shopping-section-->
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
                            <li><a href="#">Overview</a></li>
                            <li><a href="#">Reports</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Terms and Conditions</a></li>
                        </ul>
                    </div>
            </div><!-- end reward-section-->
        </div><!--end m-left-menu-->
        	<div class="col-md-9 m-right-side">
        		<div class="m-top-heading">
                    <h1>Overview</h1>
                    <p> <a href="#">Rewards <i class="fa fa-angle-right"></i></a><span> Overview </span></p>
                    <!--<p class="m-orange">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae nulla vitae ex posuere sollicitudin. Praesent fringilla</p>-->
            	</div><!--end m-top-heading-->

            		<div class="m-rewards-wrap">
            		<ul class="m-rewards-code-bar">
            			<li class="m-logo">
            				<img src="http://wsdev.in/Shopping-Cart/attachments/site_logo/logo_small1.jpg" alt="">
            			</li><!--end m-logo-->
            				<li class="m-code">
            					<p>
									Your Rewards Code:
									<span> Available upon your first order </span>
									<span class="green">
									<strong data-rewards-bar="rc"></strong>
									</span>
								</p>
            				</li><!--end m-code-->
            				<li class="m-rewards">
            					<ul>
            						<li class="m-tooltip-rewards">Available <span class="popup-modal">
									<i class="fa fa-question-circle"></i></span></li>
									<li class="m-tooltip-rewards">Pending<span class="popup-modal">
									<i class="fa fa-question-circle"></i></span></li>
            					</ul>
            				</li><!--end m-rewards-->
            		</ul><!--end m-rewards-code-bar-->
            	</div><!--end m-rewards-wrap-->
            	
        	</div><!--end m-right-side-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end m-overview-->