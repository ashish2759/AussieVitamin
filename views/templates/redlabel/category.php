<section class="product-listing-page">
	<div class="container">
		<div class="row">
        		<div class="col-md-12">
                    <div class="custom-breadcrumb">
                        <ul class="list-inline">
                        <li><a href="#">Categories</a></li>
                        <?php if(@$mother_categpry_name[0]['category_name']) { ?>
                        <li><a href="#"><?php echo @$mother_categpry_name[0]['category_name']; ?></a></li>
                        <?php } ?>
                        <?php if(@$categpry_name[0]['category_name']) { ?>
                        <li><a href="#"><?php echo @$categpry_name[0]['category_name']; ?></a></li>
                        <?php } ?>
                        <!--</ul>-->
                    </div><!--end custom-breadcrumb-->
                </div><!--end col-md-12-->
    	</div><!--end row-->
    	<div class="row">
    		<div class="col-md-12">
    			<h3 class="product-title"><?php echo @$category_details[0]['category_name']; ?></h3>

                        <span> <?php echo count($category_details); ?> Results ( showing <?php if (count($category_details) == 0) { ?> 0 <?php } elseif (count($category_details) > 0) { ?> 1 - <?php echo count($category_details); ?> <?php } ?> )</span>

    		</div><!--end col-md-12-->
    	</div><!--end row-->
    </div><!--end container-fluid-->
    <div class="container section-padding">
    	<div class="row">
    		<div class="col-sm-4 col-lg-3 col-md-4 sidebar">
    			<div class="sidebar-col">
	    			<div data-toggle="collapse" data-target="#sidebar1" class="drop-icon"><h3 class="sidebar-title">Categories</h3></div>
					  <div id="sidebar1" class="collapse in"> 
					    <ul class="category-links">
					        <?php foreach($categories as $categorie_row): ?>
                                <li><a href="<?php echo site_url('categories/view') . '/' . strtolower($categorie_row['category_name']); ?>"><?= $categorie_row['category_name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
					</div>
				</div><!--end sidebar-col-->
    		</div><!--end col-sm-4-->
    		<div class="col-sm-8 col-lg-9 col-md-8 listing-content">
    			<div class="row">
    				<?php
    				if(count($category_details) == '0'){?>
    				   <div class="col-md-6 col-sm-6 listing-product">
    				    <div class="product-item text-center">
    				        No Product Found
    				    </div>   
    				   </div> 
    			<?php 
    				}else{ 
    			    $i = 0;
    			    foreach ($category_details as $key => $row):
    			?>
    				  <div class="col-md-3 col-sm-6 listing-product">
			            <div class="product-item text-center">
			                <a href="<?= LANG_URL . '/' . $row['url'] ?>">
			                    <img src="<?php echo base_url(); ?>attachments/shop_images/<?php echo $row['image']; ?>" class="img-responsive">
			                    <div class="product-item-info">
			                        <p class="title"><?php  if($row['translations_manufacturer']){ echo $row['translations_manufacturer'].','; } ?>  <?php $pieces = explode(" ", $row['translations_title']); echo implode(" ", array_splice($pieces , 0, 6)).'...'; ?></p>
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
    				<?php if($i==3) break; ?>   
    				    
    			<?php 
    			endforeach;
    			} ?>
                     
    				
                    
			        <!--<div class="col-md-3 col-sm-6 listing-product">-->
			        <!--    <div class="product-item text-center">-->
			        <!--        <a href="#">-->
			        <!--            <img src="http://wsdev.in/Shopping-Cart/template/imgs/product1.jpg" class="img-responsive">-->
			        <!--            <div class="product-item-info">-->
			        <!--                <p class="title">21st Century, Cal Mag Zinc + D3, 90 Tablets</p>-->
			        <!--                <div class="product-rating">-->
				       <!--                 <ul class="list-inline">-->
				       <!--                     <li><i class="fa fa-star" aria-hidden="true"></i></li>-->
				       <!--                     <li><i class="fa fa-star" aria-hidden="true"></i></li>-->
				       <!--                     <li><i class="fa fa-star" aria-hidden="true"></i></li>-->
				       <!--                     <li><i class="fa fa-star" aria-hidden="true"></i></li>-->
				       <!--                     <li><i class="fa fa-star inactive" aria-hidden="true"></i></li>-->
				       <!--                 </ul>-->
				       <!--             </div><!--end product-rating-->
			        <!--                <p><span class="product_orig_price"><del>$ 3.99</del></span>&nbsp;&nbsp;<span class="product_dis_price">$ 2.49</span></p>-->
			        <!--            </div>-->
			        <!--        </a>-->
			        <!--        <button class="orange-button" type="submit">Add to Cart</button>-->
			        <!--    </div><!--end product-item-->
			        <!--</div>-->
			        <!--<div class="col-md-3 col-sm-6 listing-product">-->
			        <!--    <div class="product-item text-center">-->
			        <!--        <a href="#">-->
			        <!--            <img src="http://wsdev.in/Shopping-Cart/template/imgs/product1.jpg" class="img-responsive">-->
			        <!--            <div class="product-item-info">-->
			        <!--                <p class="title">21st Century, Cal Mag Zinc + D3, 90 Tablets</p>-->
			        <!--                <div class="product-rating">-->
				       <!--                 <ul class="list-inline">-->
				       <!--                     <li><i class="fa fa-star" aria-hidden="true"></i></li>-->
				       <!--                     <li><i class="fa fa-star" aria-hidden="true"></i></li>-->
				       <!--                     <li><i class="fa fa-star" aria-hidden="true"></i></li>-->
				       <!--                     <li><i class="fa fa-star" aria-hidden="true"></i></li>-->
				       <!--                     <li><i class="fa fa-star inactive" aria-hidden="true"></i></li>-->
				       <!--                 </ul>-->
				       <!--             </div><!--end product-rating-->
			        <!--                <p><span class="product_orig_price"><del>$ 3.99</del></span>&nbsp;&nbsp;<span class="product_dis_price">$ 2.49</span></p>-->
			        <!--            </div>-->
			        <!--        </a>-->
			        <!--        <button class="orange-button" type="submit">Add to Cart</button>-->
			        <!--    </div><!--end product-item-->
			        <!--</div>-->
			        <!--<div class="col-md-3 col-sm-6 listing-product">-->
			        <!--    <div class="product-item text-center">-->
			        <!--        <a href="#">-->
			        <!--            <img src="http://wsdev.in/Shopping-Cart/template/imgs/product1.jpg" class="img-responsive">-->
			        <!--            <div class="product-item-info">-->
			        <!--                <p class="title">21st Century, Cal Mag Zinc + D3, 90 Tablets</p>-->
			        <!--                <div class="product-rating">-->
				       <!--                 <ul class="list-inline">-->
				       <!--                     <li><i class="fa fa-star" aria-hidden="true"></i></li>-->
				       <!--                     <li><i class="fa fa-star" aria-hidden="true"></i></li>-->
				       <!--                     <li><i class="fa fa-star" aria-hidden="true"></i></li>-->
				       <!--                     <li><i class="fa fa-star" aria-hidden="true"></i></li>-->
				       <!--                     <li><i class="fa fa-star inactive" aria-hidden="true"></i></li>-->
				       <!--                 </ul>-->
				       <!--             </div><!--end product-rating-->
			        <!--                <p><span class="product_orig_price"><del>$ 3.99</del></span>&nbsp;&nbsp;<span class="product_dis_price">$ 2.49</span></p>-->
			        <!--            </div>-->
			        <!--        </a>-->
			        <!--        <button class="orange-button" type="submit">Add to Cart</button>-->
			        <!--    </div><!--end product-item-->
			        <!--</div>-->
    			</div><!--end row--><!--end row-->
    		</div><!--end col-sm-8-->
    	</div><!--end row-->
    </div><!--end container-fluid-->
</section><!--end product-listing-page-->