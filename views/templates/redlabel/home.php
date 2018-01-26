<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
    
    .slider {
    width: 100%;
    margin: 0 auto;
}

/*img {*/
/*    width: 200px;*/
/*    height: 200px;*/
/*}*/
</style>
<!--=========================HTML=============================-->
<div id="fn-home-carousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="5000">

             <div class="carousel-inner">

                <div class="item active">

                   <img class="img-responsive" src="<?php echo base_url(); ?>template/imgs/image1.jpg">

                </div>

                <div class="item">

                   <img class="img-responsive" src="<?php echo base_url(); ?>template/imgs/image2.jpg">

                </div>
                <div class="item">

                   <img class="img-responsive" src="<?php echo base_url(); ?>template/imgs/image3.jpg">

                </div>
                <div class="item">

                   <img class="img-responsive" src="<?php echo base_url(); ?>template/imgs/image4.jpg">

                </div>
                <div class="item">

                   <img class="img-responsive" src="<?php echo base_url(); ?>template/imgs/image5.jpg">

                </div>
                
            </div>
    <!-- Left and right controls -->
  <a class="left carousel-control" href="#fn-home-carousel" data-slide="prev">
    <i class="fa fa-angle-left fa-2x" aria-hidden="true"></i>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#fn-home-carousel" data-slide="next">
    <i class="fa fa-angle-right fa-2x" aria-hidden="true"></i>
    <span class="sr-only">Next</span>
  </a>

</div><!--end carousel-->
    <section class="welcome-wrapper">
        <div class="featued-box-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="featued-box">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <i class="fa fa-car fa-3x" aria-hidden="true"></i>
                                </div>
                                <div class="col-md-8">
                                    <h3>Quick Delivery</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetuer.</p>
                                </div>
                            </div>
                        </div><!--end featued-box-->
                    </div><!--end col-md-3-->
                    <div class="col-sm-3">
                        <div class="featued-box">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <i class="fa fa-credit-card fa-3x" aria-hidden="true"></i>
                                </div>
                                <div class="col-md-8">
                                    <h3>Pay with Easy</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetuer.</p>
                                </div>
                            </div>
                        </div><!--end featued-box-->
                    </div><!--end col-md-3-->
                    <div class="col-sm-3">
                        <div class="featued-box">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <i class="fa fa-tag fa-3x" aria-hidden="true"></i>
                                </div>
                                <div class="col-md-8">
                                    <h3>Best Deal</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetuer.</p>
                                </div>
                            </div>
                        </div><!--end featued-box-->
                    </div><!--end col-md-3-->
                    <div class="col-sm-3">
                        <div class="featued-box">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <i class="fa fa-shield fa-3x" aria-hidden="true"></i>
                                </div>
                                <div class="col-md-8">
                                    <h3>Secured Payment</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetuer.</p>
                                </div>
                            </div>
                        </div><!--end featued-box-->
                    </div><!--end col-md-3-->
                </div>
            </div>
        </div><!--end featued-box-wrap-->
        <div class="about-us">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>About Us</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                    </div><!--end col-md-12-->
                </div>
            </div>
        </div><!--end about-us-->
    </section><!--end welcome-wrapper-->
    <section class="trending-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Trending Now</h2>
                </div><!--end col-md-12-->
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="trending-slider" id="trending-slider">
                        <?php if(!empty($trending)){ ?>
                        <?php foreach($trending as $row) : ?>
                            <div class="product-slide text-center">
                                <a href="<?= LANG_URL . '/' . @$row['url'] ?>">
                                    <img src="<?= site_url().'attachments/shop_images/'.$row['image']; ?>" class="img-responsive">
                                    <div class="product-slide-info">
                                        <p class="title"><?= ucwords($row['title']); ?></p>
                                        <p><span class="product_orig_price"><del>$ <?= $row['old_price']?></del></span>&nbsp;&nbsp;<span class="product_dis_price">$ <?= $row['price']?></span></p>
                                    </div>
                                </a>
                            </div><!--end product-slide-->
                        <?php endforeach; ?>
                        <?php } else { ?>
                           <div class="product-slide text-center"><h3>No Products Found!</h3></div>
                        <?php } ?>
                    
                        <!--<div class="product-slide text-center">
                            <a href="#">
                                <img src="<?php echo base_url(); ?>template/imgs/product2.jpg" class="img-responsive">
                                <div class="product-slide-info">
                                    <p class="title">21st Century, Cal Mag Zinc + D3, 90 Tablets</p>
                                    <p><span class="product_orig_price"><del>$ 3.99</del></span>&nbsp;&nbsp;<span class="product_dis_price">$ 2.49</span></p>
                                </div>
                            </a>
                        </div><!--end product-slide-->
                        <!--<div class="product-slide text-center">
                            <a href="#">
                                <img src="<?php echo base_url(); ?>template/imgs/product3.jpg" class="img-responsive">
                                <div class="product-slide-info">
                                    <p class="title">21st Century, Cal Mag Zinc + D3, 90 Tablets</p>
                                    <p><span class="product_orig_price"><del>$ 3.99</del></span>&nbsp;&nbsp;<span class="product_dis_price">$ 2.49</span></p>
                                </div>
                            </a>
                        </div><!--end product-slide-->
                        <!--<div class="product-slide text-center">
                            <a href="#">
                                <img src="<?php echo base_url(); ?>template/imgs/product4.jpg" class="img-responsive">
                                <div class="product-slide-info">
                                    <p class="title">21st Century, Cal Mag Zinc + D3, 90 Tablets</p>
                                    <p><span class="product_orig_price"><del>$ 3.99</del></span>&nbsp;&nbsp;<span class="product_dis_price">$ 2.49</span></p>
                                </div>
                            </a>
                        </div><!--end product-slide-->
                        <!--<div class="product-slide text-center">
                            <a href="#">
                                <img src="<?php echo base_url(); ?>template/imgs/product5.jpg" class="img-responsive">
                                <div class="product-slide-info">
                                    <p class="title">21st Century, Cal Mag Zinc + D3, 90 Tablets</p>
                                    <p><span class="product_orig_price"><del>$ 3.99</del></span>&nbsp;&nbsp;<span class="product_dis_price">$ 2.49</span></p>
                                </div>
                            </a>
                        </div><!--end product-slide-->
                        <!--<div class="product-slide text-center">
                            <a href="#">
                                <img src="<?php echo base_url(); ?>template/imgs/product6.jpg" class="img-responsive">
                                <div class="product-slide-info">
                                    <p class="title">21st Century, Cal Mag Zinc + D3, 90 Tablets</p>
                                    <p><span class="product_orig_price"><del>$ 3.99</del></span>&nbsp;&nbsp;<span class="product_dis_price">$ 2.49</span></p>
                                </div>
                            </a>
                        </div><!--end product-slide-->
                        <!--<div class="product-slide text-center">
                            <a href="#">
                                <img src="<?php echo base_url(); ?>template/imgs/product7.jpg" class="img-responsive">
                                <div class="product-slide-info">
                                    <p class="title">21st Century, Cal Mag Zinc + D3, 90 Tablets</p>
                                    <p><span class="product_orig_price"><del>$ 3.99</del></span>&nbsp;&nbsp;<span class="product_dis_price">$ 2.49</span></p>
                                </div>
                            </a>
                        </div><!--end product-slide-->
                        <!--<div class="product-slide text-center">
                            <a href="#">
                                <img src="<?php echo base_url(); ?>template/imgs/product8.jpg" class="img-responsive">
                                <div class="product-slide-info">
                                    <p class="title">21st Century, Cal Mag Zinc + D3, 90 Tablets</p>
                                    <p><span class="product_orig_price"><del>$ 3.99</del></span>&nbsp;&nbsp;<span class="product_dis_price">$ 2.49</span></p>
                                </div>
                            </a>
                        </div><!--end product-slide-->
                        <!--<div class="product-slide text-center">
                            <a href="#">
                                <img src="<?php echo base_url(); ?>template/imgs/product9.jpg" class="img-responsive">
                                <div class="product-slide-info">
                                    <p class="title">21st Century, Cal Mag Zinc + D3, 90 Tablets</p>
                                    <p><span class="product_orig_price"><del>$ 3.99</del></span>&nbsp;&nbsp;<span class="product_dis_price">$ 2.49</span></p>
                                </div>
                            </a>
                        </div><!--end product-slide-->
                        <!--<div class="product-slide text-center">
                            <a href="#">
                                <img src="<?php echo base_url(); ?>template/imgs/product10.jpg" class="img-responsive">
                                <div class="product-slide-info">
                                    <p class="title">21st Century, Cal Mag Zinc + D3, 90 Tablets</p>
                                    <p><span class="product_orig_price"><del>$ 3.99</del></span>&nbsp;&nbsp;<span class="product_dis_price">$ 2.49</span></p>
                                </div>
                            </a>
                        </div><!--end product-slide-->

                    </div><!--end trending-slider-->
                </div><!--end col-md-12-->
            </div>
        </div>
    </section><!--end trending-wrapper-->
    <section class="best-selling-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Best Selling</h2>
                </div><!--end col-md-12-->
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-icon nav-justified">
                        <?php foreach($categories as $categorie_row): ?>
                      <li <?php if($categorie_row['id'] =='9'){ ?>class="supplement-icon active click_li" data-bind="<?php echo $categorie_row['id'];  ?>" cat_name="<?php echo $categorie_row['category_name'];  ?>"
                      <?php } elseif ($categorie_row['id'] =='11'){ ?>class="herbs-icon click_li" data-bind="<?php echo $categorie_row['id']; ?>" cat_name="<?php echo $categorie_row['category_name'];  ?>"
                      <?php } elseif ($categorie_row['id'] =='12'){ ?>class="bath-icon click_li" data-bind="<?php echo $categorie_row['id']; ?>" cat_name="<?php echo $categorie_row['category_name'];  ?>"
                      <?php } elseif ($categorie_row['id'] =='13'){ ?>class="beauty-icon click_li" data-bind="<?php echo $categorie_row['id']; ?>" cat_name="<?php echo $categorie_row['category_name'];  ?>"
                      <?php } elseif ($categorie_row['id'] =='14'){ ?>class="grocery-icon click_li" data-bind="<?php echo $categorie_row['id']; ?>" cat_name="<?php echo $categorie_row['category_name'];  ?>"
                      <?php } elseif ($categorie_row['id'] =='15'){ ?>class="baby-icon click_li" data-bind="<?php echo $categorie_row['id']; ?>" cat_name="<?php echo $categorie_row['category_name'];  ?>"
                      <?php } elseif ($categorie_row['id'] =='16'){ ?>class="sports-icon click_li" data-bind="<?php echo $categorie_row['id']; ?>" cat_name="<?php echo $categorie_row['category_name'];  ?>"
                      <?php } elseif ($categorie_row['id'] =='17'){ ?>class="home-icon click_li" data-bind="<?php echo $categorie_row['id']; ?>" cat_name="<?php echo $categorie_row['category_name'];  ?>"
                      <?php } elseif ($categorie_row['id'] =='18'){ ?>class="pets-icon click_li" data-bind="<?php echo $categorie_row['id']; ?>" cat_name="<?php echo $categorie_row['category_name'];  ?>"
                      <?php } ?>>
                          <a data-toggle="tab" href="#<?php echo $categorie_row['category_name']; ?>"><?= $categorie_row['category_name']; ?></a>
                         </li>
                      <?php endforeach; ?>
                    </ul><!--end nav nav-tabs-->
                    
                    <div class="tab-content" id="app" >
                      <div id="Supplement" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="trending-slider" id="Supplements-slider">
                                    <?php foreach($categories_supp as $categories_supp_row): ?>
                                    <div class="product-slide text-center">
                                        <a href="<?= LANG_URL . '/' . $categories_supp_row['url'] ?>">
                                            <img src="<?php echo base_url(); ?>attachments/shop_images/<?php echo $categories_supp_row['image']; ?>" class="img-responsive">
                                            <div class="product-slide-info">
                                                <p class="title"><?php echo $categories_supp_row['translations_manufacturer'] ?>, <?php echo $categories_supp_row['translations_title']; ?></p>
                                                <p><span class="product_orig_price"><del>$ <?php echo $categories_supp_row['old_price']; ?></del></span>&nbsp;&nbsp;<span class="product_dis_price">$ <?php echo $categories_supp_row['price']; ?></span></p>
                                            </div>
                                        </a>
                                    </div><!--end product-slide-->
                                    <?php endforeach; ?>
                                </div><!--end supplement-slider-->
                            </div><!--end col-md-12-->
                        </div>
                      </div><!--end supplement-->
                    </div><!--end tab-content-->
                </div><!--end col-md-12-->
            </div>
        </div>
    </section><!--end best-selling-wrapper-->
    <section class="testimonial-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Testimonials</h2>
                </div><!--end col-md-12-->
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="testimonial-slider" id="testimonial-slider">
                        <div class="single-testimonial text-center">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                            <p class="testimonial-author">- Testimonial Author Name goes here</p>
                        </div><!--end single-testimonial-->
                        <div class="single-testimonial text-center">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                            <p class="testimonial-author">- Testimonial Author Name goes here</p>
                        </div><!--end single-testimonial-->
                        <div class="single-testimonial text-center">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                            <p class="testimonial-author">- Testimonial Author Name goes here</p>
                        </div><!--end single-testimonial-->
                    </div><!--end testimonial-slider-->
                </div><!--end col-md-12-->
            </div>
        </div>
    </section><!--end testimonial-wrapper-->
   
    <script>
$(function(){
    
    
  $('li.click_li').click(function (){

      //$('div#app').empty();
      var data = $(this).data('bind');
      var data_name = $(this).attr('cat_name');
      //alert(data);
      var url = '<?= site_url('categories/get_product'); ?>' + '/' + data;
      $.post(url, function (o) {
                if (o.result == 1) { 
                    $('div#app').empty();
                    
                    var output = '<div id="'+ data_name +'" class="tab-pane fade in active"><div class="row"><div class="col-md-12"><div class="trending-slider slider" id="'+ data_name +'-slider">';
                    var i = 0;
                    for (i = 0; i < o.all; i++) {
                    
                         output += '<div class="product-slide text-center"><a href="http://aussievitaminstore.com/'+o.val[i]['url']+'"><img src="http://aussievitaminstore.com/attachments/shop_images/'+o.val[i]['image']+'" class="img-responsive"><div class="product-slide-info"><p class="title">'+ o.val[i]['translations_manufacturer'] +', '+ o.val[i]['translations_title'] +'</p><p><span class="product_orig_price"><del>$'+ o.val[i]['old_price'] +'</del></span>&nbsp;&nbsp;<span class="product_dis_price">$'+ o.val[i]['price'] +'</span></p></div></a></div>';
                        
                    }
                    
                    output += '</div></div></div></div>';
                    $('div#app').html(output);
                        $('.slider').slick({
                            slidesToShow: 5,
                            slidesToScroll: 1,
                            autoplay: true,
                            //dots: true,
                            infinite: true,
                            cssEase: 'linear',
                            responsive: [
			  	{
				  breakpoint: 991,
				  settings: {
					slidesToShow: 4
				  }
				},
				{
				  breakpoint: 768,
				  settings: {
					slidesToShow: 3
				  }
				},
				{
				  breakpoint: 641,
				  settings: {
					slidesToShow: 2
				  }
				},
				{
				  breakpoint: 481,
				  settings: {
					slidesToShow: 1
				  }
				}
			  ]
                        });
                } else {
                    //alert('Hello');
                    $('div#app').empty();
                    var output1 = '<div class="col-md-12 col-sm-12 listing-product"><div class="product-item text-center"><h3>No Product Found!</h3></div></div>';
                    $('div#app').append(output1);
                }
            }, 'json');
  }); 
});
    </script>
    