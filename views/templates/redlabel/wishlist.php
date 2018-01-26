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
<section class="m-wish-list section-padding">
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
        		<div class="row">
	        		<div class="m-top-heading col-md-6">
	                    <h1>Wish List</h1>
	                    <p> <a href="#">My Account <i class="fa fa-angle-right"></i></a><span> Wish List </span></p>
	                    <!--<p class="m-orange">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae nulla vitae ex posuere sollicitudin. Praesent fringilla</p>-->
	            	</div><!--end m-top-heading-->
	            		<div class="col-md-6 m-wishlist-search-container text-right">
	            			<div id="adv-search" class="input-group">
								<input id="search_in_title" class="form-control" value="" placeholder="Search Products in Your Lists" type="text">
								<div class="input-group-btn">
								<div class="btn-group" role="group">
								<button class="btn-go-search mine-color" type="button" onclick="submitForm()">
								<i class="fa fa-search" aria-hidden="true"></i>
								</button>
								</div>
								</div>
								</div>
	            		</div><!--end  m-wishlist-search-container-->
            	</div><!--end row-->
            	
            	
            	    <!--
            		<div class="row m-wishlist-container">
            			<div class="col-md-6 m-nopadding-left">
            				<span id="m-WishlistTitle"> My List </span>
							<span> (0)</span>
            			</div><!--end m-nopadding-left-->
            			<!--<div class="col-md-6 m-nopadding-right">
                            <ul>
            				<li class="m-add-list">
                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">
                                <span class="m-as-links"></span>
                                <i class="icon-plus fa fa-plus" title="New List"></i>

                                </button>
                                     <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="popup-title">New List</div>

        </div>
        <div class="modal-body">
         <div class="popup-content">
            <p>Enter a new list name:</p>
            <input id="folderName" class="form-control col-xs-24" name="folderName" maxlength="20" value="" autocomplete="off" required="" type="text">
            <p class="error hide list-exist-error">List already exists.</p>
            </div>
        </div>

        <div class="modal-footer">
          <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                  <!--<div class="popup-footer">
                   <button type="button" class="btn btn-primary btn-block edit-popup">Create</button> 
                    <!--<input id="btnCreateFolder" class="btn btn-primary" name="btnCreateFolder" value="Create" data-ga-event="click" data-ga-event-category="Wishlist-Action" data-ga-event-action="Wishlist" data-ga-event-label="Click - Create a list" data-ga-event-value="" disabled="">-->
<!--</div>
        </div>
      </div>
    </div>
  </div>

                            </li><!--end m-add-list-->
                                <!--<li class="m-share-link">
                                    <span class="share-text" data-ga-event="click" data-ga-event-category="Share" data-ga-event-action="Share" data-ga-event-label="Click - Share List" data-ga-event-value="">Share</span>
                                    <i class="icon-sharefilled fa fa-share-alt" title="Share Your Wishlist" data-ga-event="click" data-ga-event-category="Share" data-ga-event-action="Share" data-ga-event-label="Click - Share List" data-ga-event-value=""></i>
                                     
                                </li><!--end m-share-link-->
                            <!--<li class="m-my-list">
                                <select id="Folder" class="col-xs-6 form-control float-right list-dropdown" data-ga-event="change" data-ga-event-action="Wishlist" data-ga-event-category="Wishlist-Action" data-ga-event-label="Change - Change List" data-ga-event-value="My List" name="Folder">
                                <option value="">My List</option>
                                </select>
                            </li>
                            </ul>
            			</div><!--end m-nopadding-right-->
            		<!--</div><!--end row m-wishlist-container-->
            		
            		
            		
                        <!--<div class="m-wishlist-sub-header"></div><!-end m-wishlist-sub-header-->
                            <div class="m-actions row">
                                <!--
                                <div class="col-md-2 checkbox-col a-checkbox-edit ">
                                    <input id="manager" name="manager" type="checkbox">
                                    <label for="manager"></label>
                                </div><!--end checkbox-col-->
                                    <div class="col-md-2 m-options-drop">
                                    </div><!--end m-options-drop-->
                                        <div class="col-md-3"></div>
                                    <!--
                                    <div class="col-md-5 m-float-right">
                                        <select id="wishlistFilter" class="form-control filter-dropdown" name="sr" data-ga-event="change" data-ga-event-category="Wishlist-Action" data-ga-event-action="Wishlist" data-ga-event-label="Change - Sort" data-ga-event-value="Sort">
                                        <option selected="selected" value="-1"> -- Sort Items -- </option>
                                        <option value="8">Date Added</option>
                                        <option value="4">Price (Low to High)</option>
                                        <option value="3">Price (High to Low)</option>
                                        <option value="6">Product Name (A-Z)</option>
                                        <option value="7">Product Name (Z-A)</option>
                                        <option value="2">Highest Rated</option>
                                        <option value="11">Heaviest</option>
                                        <option value="12">Lightest</option>
                                        </select>
                                    </div><!--end m-float-right-->
                            </div><!--end m-actions row-->
                        
                <?php
                if ($this->session->flashdata('resultSend')) {
                    ?>
                    <hr>
                    <div class="alert alert-info"><?= $this->session->flashdata('resultSend') ?></div>
                    <hr>
                <?php }
                ?>                        
                            <div class="row m-wishlist-product-container">
                                <div class="col-md-12" style="border:#333;">
                                    
                                    <?php if(!empty($products)) { ?>
                                	<table class="table">
                                		<thead>
                                			<tr>
                                			    <th>Product Image</th>
                                				<th>Product Name</th>
                                				<th>Price ($)</th>
                                				<th>Action</th>
                                			</tr>
                                		</thead>
                                		<tbody>
                                			<?php foreach($products as $row) : ?>
                                		     <tr>
                                			    <td><a href="#"><img src="<?php echo base_url('attachments/shop_images/').$row['image']; ?>" class="img-responsive" style="width : 30%;"></a></td>
                                				<td><?= $row['title']; ?></td>
                                				<td><?= $row['price']; ?> </td>
                                				<td> 
                                					<a href="<?php echo site_url('editCart/set?ip=').$row['product_id'].'&qty='.$row['quantity']; ?>" data-toggle="tooltip" title="Add to cart this product" data-placement="bottom" style="padding-right:10px;"><span class="fa fa-shopping-cart"></span></a>
                                					<a href="<?php echo site_url('wishlist/delete/').$row['wishlist_id'] ?>" data-toggle="tooltip" title="Delete this product" data-placement="bottom" onClick="return confirm(&quot;Are you sure you want to remove this Products from your Wishlist?\n\nPress OK to delete.\nPress Cancel to go back without deleting the Products.\n&quot;)" style=" padding-right:10px;"><span class="fa fa-trash"></span></a>
                                				</td>
                                			 </tr>
                                			 <?php endforeach; ?>
                                		 </tbody>
                                	  </table>
                                    <?php } else { ?>
                                    
                                    <i class=" fa fa-heart-o"></i>
                                        <h4>Your List is Empty</h4>
                                        <p>Shop 35,000+ Top Brand Healthy Products and receive Best Overall Savings for Orders over $40 USD.</p>
                                        <a href="#">Start Browsing</a>
                                    <?php } ?>
                                </div><!--end m-empty-wishlist-->
                            </div><!--end m-wishlist-product-container-->
            </div><!--end m-rigth-side-->
		</div><!--end row-->
	</div><!--end container-->
</section><!--end m-wish-list-->