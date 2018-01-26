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
<section class="m-right-top">
<div id="m-my-page">
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
                            <li><a href="<?php echo site_url('dashboard/wishlist'); ?>">Wish List</a></li>
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
                    <h1>My Page</h1>
                    <p> <a href="#">My Account <i class="fa fa-angle-right"></i></a><span>My Page</span> </p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae nulla vitae ex posuere sollicitudin. Praesent fringilla</p> <hr>
            </div><!--end m-top-heading-->

            <!--MY PAGE SECTION-->
                <div class="m-contant-heading">
                  <h3>Lorem ipsum dolor sit amet consectetur<i class="fa fa-info-circle"></i></h3>
                  <p>www.loremipsum/dolor/2054658421</p>
                       <form>
                        <div class="row">
                         <div class="m-form-group col-md-6">
                              <input type="text" class="form-control m-form-control" placeholder="Enter Web Address Name" id="">
                         </div>
                        <div class="col-md-3">
                            <button type="#" class="btn update-btn">Update Web URL</button>
                        </div>
                        <div class="col-md-3">
                            <a class="m-view" href="#">View Web Page</a>
                        </div>
                        </div><!--end row-->
                    </form>
                        <p><span class="m-black-bold">Note:</span> Your web address must be between 6 and 25 characters.</p>

                    <form>
                        <div class="row">
                         <div class="m-form-group col-md-6">
                              <input type="text" class="form-control m-form-control" placeholder="Enter User Name" id="">
                         </div>
                        <div class="col-md-3">
                            <button type="#" class="btn update-btn">Update Web URL</button>
                        </div>
                        <div class="col-md-3">
                            <a href="#"></a>
                        </div>
                        </div><!--end row-->
                    </form>            
                        <p><span class="m-black-bold">Note:</span> This name will be displayed on your iHerb Page and in product reviews. User Names may not contain three characters followed by three or more numbers.</p>
                        <h3><span class="m-black-bold">Note:</span> <span class="m-green"> Lorem ipsum dolor</span></h3>
                        <div class="m-checkbox"><input type="checkbox" name="m-check" value="tick"> Do not show</div><hr>
                </div><!--end m-contant-heading-->
            <!--END MY PAGE SECTION-->
            
            <!--PAGE HEADER SECTION-->    
                    <div class="m-page-header">
                        <h1>Page Header</h1>
                        <div class="form-group m-form-group">
                            <h2><label>Title</label></h2>
                            <input type="text" class="form-control m-form-control" placeholder="Add Page Title" id="PageTitle">
                        <p><span class="m-black-bold">Note:</span> Page title should not exceed 50 characters. Please do not include a rewards or promo code.</p>
                        <h3 class="m-rank"><span class="m-black-bold">My Rank : </span> <span class="m-green">---</span></h3>
                        <div class="m-checkbox"><input type="checkbox" name="m-check" value="tick"> Do not show</div><hr>
                      </div><!--end m-form-group-->
                    </div><!--end m-page-header-->
            <!--END PAGE HEADER SECTION--> 

            <!--PAGE CUSTOMIZATION SECTION-->
            <div class="m-page-customization">
                <div class="m-page-header">
                    <h1>Page Customization</h1>
                </div><!--end m-page-header-->
                <div class="row">
                    <div class="m-profile-text col-md-4">
                        <h3>Profile Photo</h3>
                        <span>You may upload photos in jpg, gif or png format</span>
                    </div><!--end m-profile-photo-text-->
                        <div class="m-profile-photo col-md-4">
                            <div class="m-photo-holder">
                                <img class="pro-img" src="https://secure.iherb.com/statimgs/5700740908806431125_0.png" alt="">
                                    <div id="choosefile" class="photo-button"> 
                                        <i class="fa fa-camera"></i>
                                    </div><!--end photo-button-->
                            </div><!--end m-photo-holder-->   
                        </div><!--end m-profile-photo-->
                            <div class="m-pro-text-right col-md-4"> 
                                <a class="m-removePhoto">Remove Photo</a>
                                <p>Profile photo changes may take up to a few minutes to see changes.</p>
                            </div><!--end m-pro-text-right-->
                </div><!--end row-->
                <div class="m-light-gray">
                    <div class="row"> 
                        <div class="col-md-12 m-page-description">
                           <h2>Page Description</h2>
                           <textarea id="PageDescription" class="form-control" cols="20" maxlength="1000" name="PageDescription" placeholder="Add Page Description" rows="8"></textarea>
                           <p><span class="m-black-bold">Note:</span>  Use this field to tell us about yourself! Please limit your remarks to yourself, natural products, and healthy living. (Please no phone numbers or URLs.) Do not exceed 1000 characters.</p> <hr>
                        </div><!--end m-page-description-->
                    </div><!--end row-->
                <div class="row">
                    <div class=" col-md-6 m-social-text">
                        <h2>Social Media Accounts</h2>
                        <span>Include Links to Your Social Media Accounts</span>
                    </div><!--end m-social-text--> 
                        <div class="m-social-icon col-md-6">
                            <ul>
                                <li><i class="icon-facebook fa fa-facebook "></i></li>
                                <li><i class="icon-twitter fa fa-twitter "></i></li>
                                <li><i class="icon-googleplus fa fa-google-plus  "></i></li>
                                <li><i class="icon-pinterest fa fa-pinterest-p "></i></li>
                                <li><i class="icon-youtube fa fa-youtube "></i></li>
                                <!--<li><i class="icon-linkedin "></i></li>
                                <li><i class="icon-wordpress "></i></li>
                                <li><i class="icon-blogger "></i></li>
                                <li><i class="icon-livejournal "></i></li>
                                <li><i class="icon-instagram "></i></li>
                                <li><i class="icon-youku "></i></li>-->
                            </ul>
                      </div><!--end m-social-icon--> 
                </div><!--end row-->
                    <div class="row">
                       <div class="col-md-12">
                           <button type="#" class="btn btn-primary m-yellow">Show Social Media Link Options</button>
                       </div> 
                    </div><!--end row-->
                </div><!--end m-light-gray-->
            </div><!--end m-page-customization-->
                <div class="m-submit-sec">
                    <div class="row m-all-bottom">
                       <!--<div class="col-md-3"></div>-->
                       <div class="col-md-6 m-gray-btn">
                       <button type="#" class="btn update-btn" id="m-gray-bottom-btn">View Page</button>
                       </div>
                       <div class="col-md-6 m-yellow-btn">
                       <button type="#" class="btn btn-primary m-yellow" id="m-bottom-btn">Save Page Customizations</button>
                       </div>
                    </div><!--end row-->
                </div><!--end m-submit-sec-->

                    <div class="m-favorite-products">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>My Favorite Products</h4>
                                <p>Add your favorite products to display on your My iHerb Page profile by entering Product Code or URL. Drag each product to categorize your favorite by numeral ranking.</p>
                            </div>
                        </div>
                    </div><!--end m-favorite-products-->
                        <div class="m-add-product-sec">
                            <div class="row">
                               <div class="col-md-3">
                                    <article class="m-product-box">
                                        <div class="m-add">
                                            <i class="fa fa-plus-circle m-add-icon"></i>Add a New Product
                                        </div><!--end m-add-->
                                    </article><!--end m-product-box--> 
                               </div> 
                               <div class="col-md-3">
                                  <article class="m-product-box">
                                        <div class="m-add">
                                            <i class="fa fa-plus-circle m-add-icon"></i>Add a New Product
                                        </div><!--end m-add-->
                                    </article><!--end m-product-box-->  
                               </div>
                               <div class="col-md-3">
                                  <article class="m-product-box">
                                        <div class="m-add">
                                            <i class="fa fa-plus-circle m-add-icon"></i>Add a New Product
                                        </div><!--end m-add-->
                                    </article><!--end m-product-box-->  
                               </div>
                               <div class="col-md-3">
                                  <article class="m-product-box">
                                        <div class="m-add">
                                            <i class="fa fa-plus-circle m-add-icon"></i>Add a New Product
                                        </div><!--end m-add-->
                                    </article><!--end m-product-box-->  
                               </div>
                            </div><!--end row-->
                             <div class="row m-bottom-row">
                               <div class="col-md-3">
                                    <article class="m-product-box">
                                        <div class="m-add">
                                            <i class="fa fa-plus-circle m-add-icon"></i>Add a New Product
                                        </div><!--end m-add-->
                                    </article><!--end m-product-box--> 
                               </div> 
                               <div class="col-md-3">
                                  <article class="m-product-box">
                                        <div class="m-add">
                                            <i class="fa fa-plus-circle m-add-icon"></i>Add a New Product
                                        </div><!--end m-add-->
                                    </article><!--end m-product-box-->  
                               </div>
                               <div class="col-md-3">
                                  <article class="m-product-box">
                                        <div class="m-add">
                                            <i class="fa fa-plus-circle m-add-icon"></i>Add a New Product
                                        </div><!--end m-add-->
                                    </article><!--end m-product-box-->  
                               </div>
                               <div class="col-md-3">
                                  <article class="m-product-box">
                                        <div class="m-add">
                                            <i class="fa fa-plus-circle m-add-icon"></i>Add a New Product
                                        </div><!--end m-add-->
                                    </article><!--end m-product-box-->  
                               </div>
                            </div><!--end row-->
                        </div><!--end m-add-product-sec-->
            </div><!--end m-rigth-side-->
       </div><!--end row-->
    </div><!--end container-->
</div><!--end m-my-page-->
</section><!-- end m-right-top-->
