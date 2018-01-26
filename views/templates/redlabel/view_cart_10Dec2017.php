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
<div id="view_cart_wrapper" class="section-padding">
    <div class="container">
        <div class="row">
			<div class="col-md-12">
				<div class="shop-cart-container">
              <!-- tabstart-->
              <ul class="nav nav-pills nav-tabs">
                <li class="active"><a data-toggle="pill" href="#cart">Cart (<?php if(get_cookie('countertotal')) { echo get_cookie('countertotal'); ?><?php }else{ ?>
                    <?php if(get_cookie('total')){echo get_cookie('total');}else{echo '0';} ?><?php } ?>)
                    </a>
                </li>
                <li><a data-toggle="pill" href="#wishlist">Wish List (0)</a></li>
              </ul>

              <div class="tab-content">
                <div id="cart" class="tab-pane fade in active">
                   
              <form method="POST" action="<?= site_url('editCart/updateCart'); ?>" accept-charset="UTF-8" id="pageform">
              <div class="shop-cart-item">
            <?php if(get_cookie('countertotal')) { ?>
                <h2><?= get_cookie('countertotal'); ?> items in your cart </h2>
               <?php }else{ ?>
                <?php if(get_cookie('total')) { ?>
                    <h2><?= get_cookie('total'); ?> items in your cart </h2>
                <?php }else{ ?>
                    <h2>0 items in your cart </h2>
                <?php } ?>
            <?php } ?>
                <?php if(!empty($products)) { ?>
                <table class="shopping-cart-product table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th style="text-align: center;">Delete / Wishlist</th>
                            <th style="text-align: center;">Price ($)</th>
                            <th style="text-align: center;">Quantity</th>   
                            <th style="text-align: right;">Item Total ($)</th>   
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total =0.00; $j=0; foreach($products as $row) : ?>
                       <tr class="removeme<?= $j; ?>">
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
                            </td>
                            <td class="shopping-cart-icon" style=" text-align: center;">
                                 <?php for($i=0; $i< get_cookie('total'); $i++){ 
                            if(get_cookie('product_id'.$i) == $row['id']) { 
                            ?> 
                               	<a href="<?= site_url('editCart/remove_cookie'.'/'.get_cookie('i'.$i)); ?>" title="Delete this product" class="del_cookie" alt="removeme<?= $j; ?>" data-bind="<?= get_cookie('i'.$i); ?>" style=" padding-right:10px;"><i class="fa fa-trash"></i></a>
                            <?php } } ?>  	
                                <a href="<?= site_url('wishlist?ip='.$row['id']); ?>" data-toggle="tooltip" title="Move to your wishlist" data-placement="bottom"><i class="fa fa-heart"></i></a>
                            </td>
                            <td style="text-align: center;"><?= $row['price']; ?></td>
                            <?php for($i=0; $i< get_cookie('total'); $i++){ 
                            if(get_cookie('product_id'.$i) == $row['id']) { 
                            ?>
                                <td style="text-align: center;">
                                    <input id="quantity" name="qty<?= get_cookie('i'.$i); ?>" type="text" value="<?= get_cookie('qty'.$i); ?>"> 
                                </td>
                            <?php
                            $multiple = $row['price'] * get_cookie('qty'.$i);
                             }
                            } ?>
                            <td style="text-align: right;"><?= $multiple; ?></td>
                         </tr>
                         <?php 
                         
                         $total += $multiple;
                         $j++;
                         endforeach; ?>
                     </tbody>
                  </table>
                
                  <div class="row">
                    <div class="col-md-6">
                      <div class="cart-functions2">
                          <div class="btn-group pull-right">
                          <input name="total" type="hidden" value="2.39">
                          <a href="<?= site_url('/'); ?>" class="btn-success conti-shopping conti-shopping-button" name="continue">Continue Shopping</a>
                          <button type="submit" class="btn-success conti-shopping conti-shopping-button" name="update">Update Shopping Cart</button>
                          <!--<button type="submit" class="btn-success conti-shopping conti-shopping-button" name="checkout">Checkout Item(s)</button>-->
                          </div>
                       </div> 
                    </div>
                     </form>
                     <div class="col-md-3 cart-total-wrapper">
                     <form method="POST" action="<?= site_url('editCart/codeCheck'); ?>">  
                        
                          <h5 style="">Apply Discount Code</h5></td>
                            <input type="text" id="coupon" class="cart-total-input col-md-7 col-sm-9 col-xs-7" placeholder="Enter Code" name="coupon"> 
                            <button type="submit" name="coupon_check" class="btn-success col-md-5 col-sm-3 col-xs-5 cart-total-button" style="font-size: 14px; border-radius: 0 4px 4px 0; ">Add Discount</button>
                            <div id="coupon_error" style="margin-bottom:10px;color:red" class=""><?= $this->session->flashdata('coderror'); ?></div>
                            <div id="coupon_error" style="margin-bottom:10px;color:green" class=""><?= $this->session->flashdata('codesucc'); ?></div>
                        </div>
                    </form>
                    <div class="col-md-3">
                      <div class="cart-order-summary">
                        <p>
                          <span style="font-size: 14px; font-weight: bold; float: left;">Sub Total:</span>
                          <span class="" style="text-align: right;">$ <?= $total; ?></span>
                        </p>
                        <p>
                          <span style="font-size: 14px; font-weight: bold; float: left; width: 70%">Coupon Amount:</span>
                          <span class="" style=" width: 30%; text-align: right;"><span id="coupon_amount" style="width:100%;"><?php if(get_cookie('coupon')){ echo '$ '.get_cookie('coupon'); ?><?php }else{ ?>$ <?= '0.00'; ?><?php } ?></span></span></p>
                        <p>
                          <span style="font-size: 14px; font-weight: bold; float: left;"><strong>Grand Total:</strong></span>                                   
                          <span class="" style="text-align: right;"><span id="Grandtotal"><?php if(get_cookie('coupon_total')){ echo '$ '.get_cookie('coupon_total'); ?><?php }else{ ?>$ <?= $total; ?><?php } ?></span></span>
                        </p>
                        <p>
                        <?php if(!$this->session->userdata('user_id')){ ?>
                          <a href="<?= site_url('login?process=checkout'); ?>" class="conti-shopping-chekout" name="continue" style="width:100%;">Proceed to Checkout</a> 
                        <?php }else{ ?>
                          <a href="<?= site_url('checkout'); ?>" class="conti-shopping-chekout" name="continue" style="width:100%;">Proceed to Checkout</a>
                        <?php } ?>
                        </p>
                      </div>
                    </div>
                  </div>
                  <?php }else{ ?>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Your Shopping Cart is empty</h3>
                        </div>    
                    </div>
                <?php } ?>
              </div>
                </div>
                <div id="wishlist" class="tab-pane fade" style="min-height:330px;">
                  <h3 style="font-size: 20px;">You Must Be Signed In To Use Wish Lists</h3>
                  <a href="#">Sign In or Create an Account</a>
                </div>
              </div>
              <!-- end tab -->
			</div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

$(function(){
//   $('.del_cookie').click(function (){
//       var data = $(this).data('bind');
//       var alter = $(this).attr('alt');
//       //alert(data);
//       var url = '' + '/' + data;
//       $.post(url, function(o){
//           $('.'+alter).remove();
//           if(o.result == 1){
//               window.loaction.reload();
//               $('.'+alter).remove();
//           }else{
//              $('.'+alter).remove();
//              window.loaction.reload();  
//           } 
//       }, 'json');
//   }); 
});
</script>
