<section class="product-listing-page">
	<div class="container-fluid">
		<div class="row">
        		<div class="col-md-12">
                    <div class="custom-breadcrumb">
                        <!---<ul class="list-inline">
                            <li></li>
                            <li></li>
                        </ul>
                        <ul class="list-inline">
                            <li><a href="#">Categories</a></li>
                            <li><a href="#">Supplements</a></li>
                            <li><a href="#">Aloe Vera</a></li>
                            <li><a class="last" href="#">Aloe Vera, Liquid</a></li>
                        </ul>--->
                    </div><!--end custom-breadcrumb-->
                </div><!--end col-md-12-->
    	</div><!--end row-->
    	<div class="row">
    		<div class="col-md-12">
    			<h3 class="product-title"></h3>
    			<span> <?php echo count($product_details); ?> Results (showing <?php if (count($product_details) >= 25) { ?> 1 - 24 <?php } elseif (count($product_details) == 0) { ?> 0 <?php } elseif ((count($product_details) > 0) && (count($product_details) < 25)) { ?> 1 - <?php echo count($product_details); ?> <?php } ?> )</span>
    		</div><!--end col-md-12-->
    	</div><!--end row-->
    </div><!--end container-fluid-->
    <div class="container-fluid section-padding">
    	<div class="row">
    		<div class="col-sm-4 col-lg-3 col-md-4 sidebar">
    			<div class="sidebar-col">
	    			<div data-toggle="collapse" data-target="#sidebar1" class="drop-icon"><h3 class="sidebar-title">Categories</h3></div>
					  <div id="sidebar1" class="collapse in">
					    <ul class="category-links">
                            <li><a href="#">Supplements</a></li>
                            <li><a href="#">Herbs</a></li>
                            <li><a href="#">Bath</a></li>
                            <li><a href="#">Beauty</a></li>
                            <li><a href="#">Grocery</a></li>
                            <li><a href="#">Baby</a></li>
                            <li><a href="#">Sports</a></li>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Pets</a></li>
                        </ul>
					</div>
				</div><!--end sidebar-col-->
    		</div><!--end col-sm-4-->
    		<div class="col-sm-8 col-lg-9 col-md-8 listing-content">
    			<div class="row">
    				<?php
    				if(count($product_details) == '0'){?>
    				   <div class="col-md-6 col-sm-6 listing-product">
    				    <div class="product-item text-center">
    				        No Product Found
    				    </div>   
    				   </div> 
    			<?php 
    				}else{ 
    			    $i = 0;
    			    foreach ($product_details as $key => $row):
    			?>
    				  <div class="col-md-3 col-sm-6 listing-product">
			            <div class="product-item text-center">
			                <a href="<?= LANG_URL . '/' . $row['url'] ?>">
			                    <img src="<?php echo base_url(); ?>attachments/shop_images/<?php echo $row['image']; ?>" class="img-responsive">
			                    <div class="product-item-info">
			                        <p class="title"><?php echo $row['translations_manufacturer'] ?>,  <?php echo $row['translations_title']; ?></p>
			                        <div class="product-rating">
				                        <ul class="list-inline">
				                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
				                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
				                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
				                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
				                            <li><i class="fa fa-star inactive" aria-hidden="true"></i></li>
				                        </ul>
				                    </div><!--end product-rating-->
			                        <p><span class="product_orig_price"><del>$ <?php echo $row['old_price']; ?></del></span>&nbsp;&nbsp;<span class="product_dis_price">$ <?php echo $row['price']; ?></span></p>
			                    </div>
			                </a>
			                <?php if(!in_array($row['tr_id'], $prod_ids)){ ?>
			                  <a href="<?= site_url('editCart/set?ip=').$row['tr_id'].'&qty='.$row['quantity']; ?>" class="orange-button" type="submit">Add to Cart</a>
			                <?php }else{ ?>
			                  <a href="<?= site_url('editCart'); ?>" class="orange-button" type="submit">Go to Cart</a>
			                <?php } ?>
			            </div><!--end product-item-->
			        </div>  
    				<?php if($i==3) { ?><div class="clearfix"></div><?php } ?>   
    				    
    			<?php 
    			endforeach;
    			} ?>
                     
    				
                    
    			</div><!--end row--><!--end row-->
    		</div><!--end col-sm-8-->
    	</div><!--end row-->
    </div><!--end container-fluid-->
</section><!--end product-listing-page-->