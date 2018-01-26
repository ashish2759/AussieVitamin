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
                    <div class="a-breadcrumb col-md-12">
                        <h1>Account Settings</h1>
                        <p> <a href="#">My Account <i class="fa fa-angle-right"></i></a><span>Account Settings</span> </p>
                    </div><!--end a-breadcrumb-->
                </div>
                <div class="row">
                    <div class="col-md-12">
                <?php
                //if ($this->session->flashdata('resultSend')) {
                    ?>
                    <hr>
                    <div class="alert alert-info"><?= $this->session->flashdata('resultSend') ?></div>
                    <hr>
                <?php //}
                ?>
                    <div class="a-personal-info"><h1>Personal Information</h1></div>
                    <hr>
                    <form id="frmAdd" class="form-horizontal" action="<?php echo base_url('dashboard/update'); ?>" method="post">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group" style="margin-right:0;">
                                    <label for="name">
                                        <?= lang('name') ?></label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="<?php //echo $user[0]['name']; ?>" required="required" />
                                </div>
                                <div class="form-group" style="margin-right:0;">
                                    <label for="email">
                                        <?= lang('email_address') ?>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                        </span>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="<?php //echo $user[0]['email']; ?>" required="required" />
                                    </div>
                                </div>
                                <div class="form-group" style="margin-right:0;">
                                    <label for="phone">
                                        Phone Number
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span>
                                        </span>
                                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter phone" value="<?php //echo $user[0]['phone']; ?>" required="required" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" style="margin-left:0;">
                                    <label for="password">
                                        New Password
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span>
                                        </span>
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" />
                                    </div>
                                </div>

                                <div class="form-group" style="margin-left:0;">
                                    <label for="confirm_password">
                                        Confirm Password
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span>
                                        </span>
                                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Enter password" />
                                    </div>
                                </div>

                                 <div class="form-group col-md-12" style="margin-left: 0; margin-top: 25px; padding-left: 0;">
                                     <button type="submit" class="btn btn-primary" id="btnUpdate">
                                    Update</button>
                                </div>

                            </div>

                        </div>
                    </form>
                </div>
                </div>
            </div><!--end col-md-9-->

        </div>
    </div>
</div>
