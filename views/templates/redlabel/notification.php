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
<div id="my-account-order">
    <div class="container">
        <div class="row">

            <div class="col-md-3">
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
            </div><!-- end -md- 3-->

            <div class="col-md-9">
                <div class="row">
                    <div class="a-breadcrumb col-md-6">
                        <h1>Notification List</h1>
                        <p> <a href="#">My Account <i class="fa fa-angle-right"></i></a><span>Notification List</span> </p>
                    </div><!--end a-breadcrumb-->
                </div>
                <div class="row">
                	<div class="a-empty-state a-notification-para"><i class="fa fa-bell-o"></i><p>There is nothing in your notification list just yet. If you click the Notify Me button on the product page for any out-of-stock product, that product will appear here.</p></div>
                </div>
            </div><!--end col-md-9-->

        </div>
    </div>
</div>

