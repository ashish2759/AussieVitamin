<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="section-padding">
<div class="container" id="checkout-page">
    <?php
    if (!empty($products)) {
        ?>
        <?= purchase_steps(1, 2) ?>
        <div class="row">
            <div class="col-sm-9 left-side">
                <form method="POST" id="goOrder">
                
                <input title="item_name" name="item_name" type="hidden" value="ahmed fakhr">
                <input title="item_number" name="item_number" type="hidden" value="12345">
                <input title="item_description" name="item_description" type="hidden" value="to buy samsung smart tv">
                <input title="item_tax" name="item_tax" type="hidden" value="1">
                <input title="item_price" name="item_price" type="hidden" value="<?= get_cookie('coupon_total'); ?>">
                <input title="details_tax" name="details_tax" type="hidden" value="7">
                <input title="details_subtotal" name="details_subtotal" type="hidden" value="7">
                
                
                
                
                    <div class="title alone">
                        <span><?= lang('checkout') ?></span>
                    </div>
                    <?php
                    if ($this->session->flashdata('submit_error')) {
                        ?>
                        <hr>
                        <div class="alert alert-danger">
                            <h4><span class="glyphicon glyphicon-alert"></span> <?= lang('finded_errors') ?></h4>
                            <?php
                            foreach ($this->session->flashdata('submit_error') as $error) {
                                echo $error . '<br>';
                            }
                            ?>
                        </div>
                        <hr>
                        <?php
                    }
                    ?>
                    <div class="payment-type-box">
                        <select class="selectpicker payment-type" data-style="btn-blue" name="payment_type">
                            <?php if ($cashondelivery_visibility == 1) { ?>
                                <option value="cashOnDelivery"><?= lang('cash_on_delivery') ?> </option>
                                <option value="PayPal"><?= lang('paypal') ?> </option>
                            <?php } if (filter_var($paypal_email, FILTER_VALIDATE_EMAIL)) { ?>
                                <option value="PayPal"><?= lang('paypal') ?> </option>
                            <?php } if ($bank_account['iban'] != null) { ?>
                                <option value="Bank"><?= lang('bank_payment') ?> </option>
                            <?php } ?>
                        </select>
                        <span class="top-header text-center"><?= lang('choose_payment') ?></span>
                    </div>
					 
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="firstNameInput">First Name*</label>
                            <input id="firstNameInput" class="form-control" name="first_name" value="<?php echo (empty( @$_POST['first_name']))?$this->session->userdata['name']: @$_POST['first_name']; ?>" type="text" placeholder="<?= lang('first_name') ?>">
                        </div> 
                        <div class="form-group col-sm-6">
                            <label for="lastNameInput">Last Name*</label>
                            <input id="lastNameInput" class="form-control" name="last_name" value="<?= @$_POST['last_name'] ?>" type="text" placeholder="<?= lang('last_name') ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="emailAddressInput">Email ID*</label>
                            <input id="emailAddressInput" class="form-control" name="email"  type="text" placeholder="<?= lang('email_address') ?>" value="<?php echo $this->session->userdata('email'); ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="phoneInput">Phone Number*</label>
                            <input id="phoneInput" class="form-control" name="phone" value="<?php echo (empty( @$_POST['phone']))?$this->session->userdata['phone']: @$_POST['phone']; ?>" type="text" placeholder="<?= lang('phone') ?>">
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="addressInput">Address*</label>
                            <textarea id="addressInput" name="address" class="form-control" rows="3"><?= @$_POST['address'] ?></textarea>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="cityInput">City*</label>
                            <input id="cityInput" class="form-control" name="city" value="<?= @$_POST['city'] ?>" type="text" placeholder="<?= lang('city') ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="postInput"><?= lang('post_code') ?></label>
                            <input id="postInput" class="form-control" name="post_code" value="<?= @$_POST['post_code'] ?>" type="text" placeholder="<?= lang('post_code') ?>">
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="notesInput"><?= lang('notes') ?></label>
                            <textarea id="notesInput" class="form-control" name="notes" rows="3"><?= @$_POST['notes'] ?></textarea>
                        </div>
                    </div>
                    <!--<div class="row">-->
                    <!--    <form method="POST" action="<?= site_url('editCart/codeCheck'); ?>">-->
                    <!--    <div class="form-group col-sm-10">-->
                    <!--        <label></label>-->
                    <!--        <input class="form-control" name="coupon" placeholder="" type="text">-->
                    <!--        <div id="coupon_error" style="margin-bottom:10px;color:red" class=""></div>-->
                    <!--        <div id="coupon_error" style="margin-bottom:10px;color:green" class=""></div>-->
                    <!--    </div>-->
                    <!--    <div class="form-group col-sm-2">-->
                    <!--        <button class="btn orange-button" type="submit" style="padding-top:6px;margin-top:19px;"></button>-->
                    <!--    </div>-->
                    <!--    </form>-->
                    <!--</div>-->
                    <div class="table-responsive">
                        <table class="table table-bordered table-products">
                            <thead>
                                <tr>
                                    <th><?= lang('product') ?></th>
                                    <th><?= lang('title') ?></th>
                                    <th><?= lang('quantity') ?></th>
                                    <th><?= lang('price') ?></th>
                                    <th><?= lang('total') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $multiple =0;
                                $total =0;
                                foreach ($products as $item) { ?>
                                     <?php foreach($imageall as $image_row): 
                                        if($image_row['id'] == $item['for_id']){
                                    ?>
                                    <tr>
                                        <td class="relative">
                                            <input type="hidden" name="id[]" value="<?= $item['id'] ?>">
                                            <input type="hidden" name="quantity[]" value="">
                                       
                                            <img class="product-image" src="<?= base_url('/attachments/shop_images/' . $image_row['image']) ?>" alt="">
                                        </td>
                                        <td><a href="<?= LANG_URL . '/' . $image_row['url'] ?>"><?= $item['title'] ?></a></td>
                                        <td>
                                            <?php for($i=0; $i< get_cookie('total'); $i++){ 
                                                if(get_cookie('product_id'.$i) == $item['id']) { 
                                            ?>
                                            <span>
                                                <?= get_cookie('qty'.$i); ?>
                                            </span>
                                            <?php
                                                $multiple = $item['price'] * get_cookie('qty'.$i);
                                                
                                                
                                                 }
                                                } ?>
                                        </td>
                                        <td>$ <?= $item['price']; ?></td>
                                        <td>$ <?= $multiple; ?></td>
                                    </tr>
                                    <?php
                                        }
                                         
                                    endforeach;?>
                                <?php
                                $total += $multiple;
                                } ?>
                                <tr>
                                    <td colspan="4" class="text-right">Total Amount</td>
                                    <td>
                                        <span class="final-amount"><?= $cartItems['finalSum'] ?></span>$ <?php if(get_cookie('coupon_total')){ echo get_cookie('coupon_total');}else{ ?>
                                          <?= $total; ?>
                                          <?php } ?>
                                        <input type="hidden" class="final-amount" name="final_amount" value="<?= $total ?>">
                                        <input type="hidden" name="amount_currency" value="$">
                                        <input type="hidden" name="discountAmount" value="">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
                <div>
                    <a href="<?= LANG_URL ?>" class="btn orange-button go-shop">
                        <span class="glyphicon glyphicon-circle-arrow-left"></span>
                        <?= lang('back_to_shop') ?>
                    </a>
                    <a href="javascript:void(0);" class="btn green-button go-order" onclick="document.getElementById('goOrder').submit();" class="pull-left">
                        <?= lang('custom_order') ?>
                        <span class="glyphicon glyphicon-circle-arrow-right"></span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-sm-3"> 
                <div class="filter-sidebar">
                    <div class="title">
                        <span>Most sellers</span>
                        <i class="fa fa-trophy" aria-hidden="true"></i>
                    </div>
                    <?= $load::getProducts($bestSellers, '', true) ?>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="alert alert-info"><?= lang('no_products_in_cart') ?></div></div>
    <?php
}
if ($this->session->flashdata('deleted')) {
    ?>
    <script>
        $(document).ready(function () {
            ShowNotificator('alert-info', '<?= $this->session->flashdata('deleted') ?>');
        });
    </script>
<?php } if ($codeDiscounts == 1 && isset($_POST['discountCode'])) { ?>
    <script>
        $(document).ready(function () {
            checkDiscountCode();
        });
    </script>
<?php } ?>
</section>