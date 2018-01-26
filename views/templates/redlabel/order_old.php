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
                        <h1>Orders</h1>
                        <p> <a href="#">My Account <i class="fa fa-angle-right"></i></a><span>Orders</span> </p>
                    </div><!--end a-breadcrumb-->
                    <div class="a-survey-feedback-holder col-md-6">
                        <div class="a-survey-link">
                            <a href="#">Give us some feedback!</a>
                            <i class="fa fa-comments-o"></i>
                        </div>
                    </div><!--end a-survey-feedback-holder-->
                </div>
                <div class="row">
                    <article class="col-xs-12 col-md-6 a-loyalty-section">
                        <div class="a-credit-section">
                            <div class="a-credit-section-container">
                            <div class="a-savings-info">
                                <h2>Loyalty Credit</h2>
                                <div class="a-primary">
                                    <h1 class="savings">AU$0.00</h1><h3>Available</h3>
                                </div>
                                </div>
                                <div class="a-secondary">
                                    <span class="pending">AU$0.00</span>
                                    <span> Pending</span>
                                </div>
                                <p class="a-additional">Why zero? Simply place an order to earn Loyalty Credit.</p>
                                </div>
                            </div><!--end credit-section-->
                        <div class="a-info-section">
                            <div class="a-credit-info">
                                <div class="a-credit-info-container">
                               <p> With every purchase you gain a credit of <span class="a-rewards-savings">5% of your order amount!</span></p>
                               <p><a href="#">Read More</a> about our Loyalty Program</p>
                           </div>
                            </div>
                        </div><!--end info-section-->
                    </article>
                      <article class="col-xs-12 col-md-6 a-loyalty-section">
                        <div class="a-credit-section">
                            <div class="a-credit-section-container">
                            <div class="a-savings-info">
                                <h2>Rewards Credit</h2>
                                <div class="a-primary">
                                    <h1 class="savings">AU$0.00</h1><h3>Available</h3>
                                </div>
                                </div>
                                <div class="a-secondary">
                                    <span class="pending">AU$0.00</span>
                                    <span> Pending</span>
                                </div>
                                <p class="a-additional">Learn how to <a href="#">earn Rewards Credit</a> and accept the Terms of Use.</p>
                                </div>
                            </div><!--end credit-section-->
                        <div class="a-info-section">
                            <div class="a-credit-info">
                                <div class="a-credit-info-container">
                               <p> Share your ordered items with others to earn </p>
                               <p>Rewards by clicking <span class="a-share">Share <i class="fa fa-share-alt"></i></span>in your Order History</p>
                                </div>
                            </div>
                        </div><!--end info-section-->
                    </article>
                </div>
                <div class="row">
<!--                    <section class="a-SpeedyReordering col-md-12">-->
<!--                        <div class="">-->
<!--                        <h1>Speedy Reordering <span class="a-light-title">in 3 Simple Ways:</span></h1>-->
<!--                        <ul>-->
<!--                            <li>-->
<!--                                <div class="row">-->
<!--                                    <div class="col-md-9">-->
<!--                                        <p><strong>Combine Carts:</strong>-->
<!--                                            Add all items from your last 1-5 orders into your shopping cart all at once. Remove the items you do not wish to reorder.-->
<!--</p>                                 </div>-->
<!--                                    <div class="col-md-3">-->
<!--                                        <form>-->
<!--                                            <div class="form-group">-->
<!--                                                 <select class="form-control a-form-control" id="sel1">-->
<!--                                                    <option>1</option>-->
<!--                                                    <option>2</option>-->
<!--                                                    <option>3</option>-->
<!--                                                    <option>4</option>-->
<!--                                                  </select>-->
<!--                                                <button type="submit" class="btn btn-default update-btn">Add</button>-->
<!--                                            </div>-->
<!--                                        </form>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <div class="row">-->
<!--                                    <div class="col-md-9">-->
<!--                                        <p><strong>Frequently Purchased Items:</strong>-->
<!--                                            Add your top 1-5 products to the cart. Remove the items you do not wish to reorder.-->
<!--</p>                                 </div>-->
<!--                                    <div class="col-md-3">-->
<!--                                        <form>-->
<!--                                            <div class="form-group">-->
<!--                                                 <select class="form-control a-form-control" id="sel1">-->
<!--                                                    <option>1</option>-->
<!--                                                    <option>2</option>-->
<!--                                                    <option>3</option>-->
<!--                                                    <option>4</option>-->
<!--                                                  </select>-->
<!--                                                <button type="submit" class="btn btn-default update-btn">Add</button>-->
<!--                                            </div>-->
<!--                                        </form>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <div class="row">-->
<!--                                    <div class="col-md-9">-->
<!--                                        <p><strong>Product Codes:</strong>-->
<!--                                            If you know the product code, add them to the cart using our <a href="#">Quickshop</a> feature.-->
<!--</p>                                 </div>-->
<!--                                    <div class="col-md-3">-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                    </section>-->
                    <!---<section class="a-SpeedyReordering col-md-12">
                        <!--<div class="">-->
                        <!--    <div class="col-md-3"> <h1>Order History</h1></div>-->
                        <!--    <div class="col-md-9 a-search-orders">-->
                        <!--      <form id="a-orderHistorySearch" class="order-history-search-bar form-horizontal form-inline" action="/myaccount/orderhistory">-->
                        <!--        <div class="form-group a2-form-group">-->
                        <!--        <label for="">Search Orders</label>-->
                        <!--        <input id="a-orderHistorySearchInput" class="form-control" name="kw" placeholder="Order Number or Product Name ..." type="text">-->
                        <!--        <button class="btn btn-primary" type="submit" data-ga-event="click" data-ga-event-category="Order History" data-ga-event-action="Order History" data-ga-event-label="Click - Search" data-ga-event-value=""> Search </button>-->
                        <!--        </div>-->
                        <!--    </form>  -->
                        <!--    </div>-->
                        <!--</div>-->
                            <!--<div class="a-filter-bar col-md-12">-->
                            <!--    <div class="row">-->
                            <!--    <div class="col-md-8">-->
                            <!--        <form id="orderHistoryFilter" class="order-filter form-inline" action="">-->
                            <!--            <div class="form-group a3-form-group">-->
                            <!--            <label for="filter-by-date">Find Orders: </label>-->
                            <!--            <div class="a-custom-dropdown">-->
                            <!--              <select class="form-control" id="sel32">-->
                            <!--                    <option>Last 30 Days</option>-->
                            <!--                    <option>Last 6 Months</option>-->
                            <!--                    <option>2017</option>-->
                            <!--                    <option>2016</option>-->
                            <!--                    <option>2015</option>-->
                            <!--                    <option>2014 - Older</option>-->
                            <!--                </select>-->
                            <!--            </div>-->
                            <!--            </div>-->
                            <!--            <div class="checkbox">-->
                            <!--                <label>-->
                            <!--                <input id="showCanceledOrders" class="canceled-orders filter onoBffswitch-checkbox" name="canceled" value="false" type="checkbox">-->
                            <!--                <span>Show Canceled Orders</span>-->
                            <!--                </label>-->
                            <!--            </div>-->
                            <!--        </form>-->
                            <!--    </div>-->
                            <!--    <div class="col-md-4 btu-right">-->
                            <!--        <form><button class="btn btn-primary" type="submit" data-ga-event="click" data-ga-event-category="Order History" data-ga-event-action="Order History" data-ga-event-label="Click - Download Orders" data-ga-event-value=""> Download Orders </button></form>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--</div>-->
                            
                            <!--<?php if(!empty($order_data)) { ?>-->
                    <!--        <table class="shopping-cart-product table">-->
                    <!--<thead>-->
                    <!--    <tr>-->
                    <!--        <th>Sl No.</th>-->
                            
                    <!--        <th >Product Name</th>-->
                    <!--        <th style="text-align: center;">Quantity</th>-->
                    <!--        <th style="text-align: center;">Price ($)</th>-->
                               
                    <!--    </tr>-->
                    <!--</thead>-->
                    <!--<tbody>-->
                        <!---<?php  $j=0; foreach($order_data as $row) : ?>
                        
                       <tr class="removeme<?= $j; ?>">
                           <td><?php echo $j+1; ?></td>
                           <td>
                                <div class="row">
                                    <div class="col-md-8"> <?= $row['manufacturer']; ?>, <?= $row['title']; ?></div>
                                    <?php foreach($imageall as $image_row): 
                                        if($image_row['id'] == $row['for_id']){
                                    ?>
                                      <div class="col-md-4"><a href="#"><img src="<?= site_url('attachments/shop_images').'/'.$image_row['image']; ?>" class="img-responsive" style="width: 50%;"></a></div>
                                    <?php
                                        }
                                    endforeach;?>
                                    
                                </div>
                            </td>--->
                            <!--<td style="text-align: center;"><?= $row['order_quantity']; ?>-->
                            <!--    </td>-->
                            <!--<td style="text-align: center;"><?= $row['price']; ?></td>-->
                            
                                
                         </tr>
                         <!---<?php 
                         $j++;
                         endforeach; ?>--->
                  <!--   </tbody>-->
                  <!--</table>-->
                
                  <!--<div class="row">-->
                  <!--   <div class="col-md-6">-->
                  <!--    <div class="cart-functions2">-->
                  <!--        <div class="btn-group pull-right">-->
                          <!--<input name="total" type="hidden" value="2.39">-->
                          <!--<a href="<?= site_url('/'); ?>" class="btn-success conti-shopping conti-shopping-button" name="continue">Continue Shopping</a>-->
                          <!--<button type="submit" class="btn-success conti-shopping conti-shopping-button" name="update">Update Shopping Cart</button>-->
                          <!--<button type="submit" class="btn-success conti-shopping conti-shopping-button" name="checkout">Checkout Item(s)</button>-->
                  <!--        </div>-->
                  <!--     </div> -->
                  <!--  </div>-->
                  <!--   </form>-->
                  <!--   <form method="POST" action="<?= site_url('editCart/codeCheck'); ?>">  -->
                  <!--      <div class="col-md-3 cart-total-wrapper">-->
                  <!--        <h5 style=""></h5></td>-->
                            <!--<input type="text" id="coupon" class="cart-total-input col-md-7 col-sm-9 col-xs-7" placeholder="Enter Code" name="coupon"> -->
                            <!--<button type="submit" name="coupon_check" class="btn-success col-md-5 col-sm-3 col-xs-5 cart-total-button" style="font-size: 14px; border-radius: 0 4px 4px 0; ">Add Discount</button>-->
                  <!--          <div id="coupon_error" style="margin-bottom:10px;color:red" class=""><?= $this->session->flashdata('coderror'); ?></div>-->
                  <!--          <div id="coupon_error" style="margin-bottom:10px;color:green" class=""><?= $this->session->flashdata('codesucc'); ?></div>-->
                  <!--      </div>-->
                  <!--  </form>-->
                  <!--  <div class="col-md-4 pull-right">-->
                  <!--    <div class="cart-order-summary">-->
                        
                  <!--      <p>-->
                  <!--        <span style="font-size: 14px; font-weight: bold; float: left;"><strong>Grand Total:</strong></span>                                   -->
                  <!--        <span class="" style="text-align: right;"><span id="Grandtotal"><?php if(get_cookie('coupon_total')){ echo '$ '.get_cookie('coupon_total'); ?><?php }else{ ?>$ <?= $total; ?><?php } ?></span></span>-->
                  <!--      </p>-->
                  <!--    </div>-->
                  <!--  </div>-->
                  <!--</div>-->
                  
                  <!---<?php }else{  ?>
                            
                            <div class="col-md-12 text-center">
                                <div class="a-empty-state">
                                    <i class="fa fa-paper-plane-o"></i>
                                    <h4><b>No results were found within the period specified</b></h4>
                                    <p>Try updating your date range to find a specific order.</p>
                                </div>
                            </div>
                            <?php } ?>
                    </section>--->
                    
                </div>
            </div><!--end col-md-9-->

        </div>
    </div>
</div>