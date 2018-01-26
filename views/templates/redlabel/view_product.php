<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/jquery.rateyo.min.css">

<!--- simple lens --->
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/jquery.simpleLens.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/jquery.simpleGallery.css">
<!--- simple lens --->


<?php
$avg_stars = round($av_star[0]['stars'], 1);
?>
<div class="container" id="view-product">
    <div class="row">
        <div class="col-md-12">
                    <div class="custom-breadcrumb">
                        <ul class="list-inline">
                            <li></li>
                            <li></li>
                        </ul>
                        <ul class="list-inline">
                            <li><a href="#"><?= $trans[0]['manufacturer'] ?></a></li>
                            <li><?= $product['title'] ?></li>
                        </ul>
                    </div><!--end custom-breadcrumb-->
                </div><!--end col-md-12-->
    </div><!--end row-->
    <div class="row">
        <div class="col-md-4">
            <div <?= $product['folder'] != null ? 'style="margin-bottom:20px;"' : '' ?> class="simpleLens-container" id="demo-1">
                <div class="simpleLens-container">
                    <div class="simpleLens-big-image-container">
                        <a class="simpleLens-lens-image" id="loaded_lens"  data-lens-image="<?php echo  base_url('/attachments/shop_images/' . $product['image']) ?>">
                            <img src="<?= base_url('/attachments/shop_images/' . $product['image']) ?>" id="loaded_image" style="width:auto; height:auto;" data-num="0" class="other-img-preview img-responsive img-sl the-image simpleLens-big-image" alt="<?= str_replace('"', "'", $product['title']) ?>">
                        </a>
                    </div>
                </div>
            </div>
            
            
            <a href="#" class="simpleLens-thumbnail-wrapper" data-lens-image="{{ url('public/uploads/product/21st-century-cal-mag-zinc-d3-90-tablets/product1.jpg') }}" data-big-image="{{ url('public/uploads/product/21st-century-cal-mag-zinc-d3-90-tablets/small/product1.jpg') }}">
              <img src="{{ url('public/uploads/product/21st-century-cal-mag-zinc-d3-90-tablets/thumb/product1.jpg') }}">
            </a>
            
            
            <?php
            if ($product['folder'] != null) {
                $dir = "attachments/shop_images/" . $product['folder'] . '/';
                ?>
                <div class="row">
                    <?php
                    if (is_dir($dir)) {
                        if ($dh = opendir($dir)) {
                            $i = 1;
                            while (($file = readdir($dh)) !== false) {
                                if (is_file($dir . $file)) {
                                    ?>
                                    <div class="col-xs-4 col-sm-6 col-md-4 text-center clicktoload"  data-bind="<?= base_url($dir . $file) ?>">
                                        <img src="<?= base_url($dir . $file) ?>" data-num="<?= $i ?>" class="other-img-preview img-sl img-thumbnail the-image" alt="<?= str_replace('"', "'", $product['title']) ?>">
                                    </div>
                                    <?php
                                    $i++;
                                }
                            }
                            closedir($dh);
                        }
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <!--<div class="col-sm-8">
            <h1><?= $product['title'] ?></h1>
            <div class="row row-info">
                <div class="col-sm-6"><b><?= lang('price') ?>:</b></div>
                <div class="col-sm-6"><?= $product['price'] . CURRENCY ?></div>
                <div class="col-sm-12 border-bottom"></div>
            </div>
            <?php if ($product['old_price'] != '') { ?>
                <div class="row row-info">
                    <div class="col-sm-6"><b><?= lang('old_price') ?>:</b></div>
                    <div class="col-sm-6"><?= $product['old_price'] . CURRENCY ?></div>
                    <div class="col-sm-12 border-bottom"></div>
                </div>
            <?php } if ($publicQuantity == 1) { ?>
                <div class="row row-info">
                    <div class="col-sm-6">
                        <b><?= lang('in_stock') ?>:</b>
                    </div>
                    <div class="col-sm-6"><?= $product['quantity'] ?></div>
                    <div class="col-sm-12 border-bottom"></div>
                </div>
            <?php } ?>
            <div class="row row-info">
                <div class="col-sm-6"><b><?= lang('num_added_to_cart') ?>:</b></div>
                <div class="col-sm-6"><?php
                    @$result = array_count_values($_SESSION['shopping_cart']);
                    if (isset($result[$product['id']]))
                        echo $result[$product['id']];
                    else
                        echo 0;
                    ?></div>
                <div class="col-sm-12 border-bottom"></div>
            </div>
            <?php if ($publicDateAdded == 1) { ?>
                <div class="row row-info">
                    <div class="col-sm-6"><b><?= lang('added_on') ?>:</b></div>
                    <div class="col-sm-6"><?= date('m.d.Y', $product['time']) ?></div>
                    <div class="col-sm-12 border-bottom"></div>
                </div>
            <?php } ?>
            <div class="row row-info">
                <div class="col-sm-6"><b><?= lang('in_category') ?>:</b></div>
                <div class="col-sm-6">
                    <a href="javascript:void(0);" class="go-category btn-blue-round" data-categorie-id="<?= $product['shop_categorie'] ?>">
                        <?= $product['categorie_name'] ?>
                    </a>
                </div>
                <div class="col-sm-12 border-bottom">

                </div>
            </div>
            <div class="row row-info">
                <div class="col-sm-6"></div>
                <div class="col-sm-6 manage-buttons">
                    <?php if ($product['quantity'] > 0) { ?>
                        <a href="javascript:void(0);" data-id="<?= $product['id'] ?>" data-goto="<?= LANG_URL . '/checkout' ?>" class="add-to-cart btn-add">
                            <span class="text-to-bg"><?= lang('buy_now') ?></span>
                        </a>
                        <a href="javascript:void(0);" data-id="<?= $product['id'] ?>" data-goto="<?= LANG_URL . '/shopping-cart' ?>" class="add-to-cart btn-add">
                            <span class="text-to-bg"><?= lang('add_to_cart') ?></span>
                        </a>
                    <?php } else { ?>
                        <div class="alert alert-info"><?= lang('out_of_stock_product') ?></div>
                    <?php } ?>
                </div>
                <div class="col-sm-12 border-bottom"></div>
            </div>
            <div class="row row-info">
                <div class="col-xs-12"><b><?= lang('description') ?>:</b></div>
            </div>
            <div id="description">
                <?= $product['description'] ?>
            </div>
        </div>
    </div>-->
    <!--HTML-->
        <div class="col-md-8 product-details">
            <div class="row">
                <div class="col-sm-7">
                    <h3 class="product-title"><?= $product['title'] ?></h3>
                    <small class="product-made-by"> By <a href="#"><?= $trans[0]['manufacturer'] ?></a></small>
                    <div class="product-rating">
                        <div class="rateyo-readonly-widg2"></div>
                    </div>
                    <div class="stock-value">
                        <?php if(!$product['quantity'] > 0){ ?>
                              Out of Stock
                        <?php }else{ ?>
                              In Stock 
                        <?php } ?>
                    </div>
                    <ul class="product-specs-list">
                        <li>Expiration Date: <?= date('M Y', strtotime($trans[0]['expiration_date'])); ?></li>
                        <li>Shipping Weight: <?= $trans[0]['weight']; ?></li>
                        <li>Product Code: <span> <?= $trans[0]['product_code']; ?></span></li>
                        <li>UPC Code: <span> <?= $trans[0]['upc_code']; ?></span></li>
                        <li>Package Quantity: <?= $trans[0]['package_qty']; ?></li>
                        <li>Dimensions: <?= $trans[0]['dimension']; ?></li>
                    </ul>
                </div><!--end col-sm-7-->
                <div class="col-sm-5">
                    <div class="cstm-product-info">
                        <h3 class="text-center text-uppercase">Price Details</h3>
                            <div class="cstm-product-info-inner">
                            <div class="row">
                                <div class="col-xs-4">
                                    <p>MSRP:</p>
                                </div><!--end col-xs-4-->
                                <div class="col-xs-8">
                                    <p class="product_orig_price"><del>$ <?= $product['old_price']; ?></del></p>
                                </div><!--end col-xs-4-->
                            </div><!--end row-->
                            <div class="row">
                                <div class="col-xs-4">
                                    <p>Our Price:</p>
                                </div><!--end col-xs-4-->
                                <div class="col-xs-8">
                                    <p class="product_dis_price">$ <?= $product['price']; ?></p>
                                </div><!--end col-xs-4-->
                            </div><!--end row-->
                            <form method="GET" action="<?= site_url('editCart/set'); ?>">
                            <div class="row">
                                <div class="col-xs-4">
                                    <p>Quantity:</p>
                                </div><!--end col-xs-4-->
                                <div class="col-xs-8">
                                    <input type="hidden" name="ip" value="<?= $trans[0]['id']; ?>">
                                    <p>
                                        <select id="qty" class="" name="qty">
                                            <?php if($product['quantity'] > 0){ ?>
                                            <?php for($i=1; $i<= $product['quantity']; $i++){ ?>
                                              <option value="<?= $i; ?>"><?= $i; ?></option>
                                            <?php } ?>
                                            <?php }else{ ?>
                                              <option value="">Out of stock</option>
                                            <?php }?>
                                      </select>
                                    </p>
                                </div><!--end col-xs-4-->
                            </div><!--end row-->
                            <?php if(in_array($trans[0]['id'], $prod_ids)) { ?>
                                <a href="<?= site_url('editCart'); ?>"><button class="orange-button full-width text-uppercase" type="button">Go to Cart</button></a>
                                <a href="<?= site_url('wishlist?ip='.base64_encode($trans[0]['id'])); ?>"><button class="green-button full-width text-uppercase" type="button">Add to Wish List</button></a>
                            <?php } else { ?>
                                <button class="orange-button full-width text-uppercase" type="submit">Add to Cart</button>
                                <a href="<?= site_url('wishlist?ip='.base64_encode($trans[0]['id'])); ?>"><button class="green-button full-width text-uppercase" type="button">Add to Wish List</button></a>
                            <?php } ?>
                            </form>
                        </div>
                    </div><!--end cstm-product-info-->
                </div><!--end col-sm-5-->
            </div><!--end row-->
        </div><!--end col-md-8-->
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h3 class="title-head-border">Product Overview</h3>
        </div><!---end col-sm-12-->
    </div><!--end row-->
    <div class="row">
        <div class="col-sm-6">
            <?= $trans[0]['description']; ?>
        </div>
        <div class="col-sm-6">
            <?php if($trans[0]['description_r'] !=""){ ?>
              <?= $trans[0]['description_r']; ?>
            <?php } ?>
        </div><!---end col-sm-6-->
    </div><!--end row-->
    <!--Customar Reviews-->
    
    <div class="row">
        <div class="col-sm-12">
            <h3 class="title-head-border">Customar Reviews</h3>
        </div><!---end col-sm-12-->
    </div><!--end row-->
    <div class="row">
        <div class="col-sm-12">
            <div class="single-review">
                <div class="row">
                    <?php if(!empty($avg_star)){ ?>
                    <div class="col-sm-8">
                        <div class="review-rating">
                          <div class="rateyo-readonly-widg1"></div>
                        </div><!--end review-rating-->
                        <h4 class="review-title"><?php echo $avg_star[0]['review_title']; ?></h4>
                        <p class="reviewers-info">Posted by <a href="#"><?php echo $avg_star[0]['username']; ?></a> on <?php echo date('M d, Y', strtotime($avg_star[0]['rv_time'])); ?> <span class="verified-purchase"> | <i class="icon-addedtocartcheck"></i>Verified Purchase</span></p>
                        <div class="review-comment"><?php echo ucfirst($avg_star[0]['review']); ?></div>
                        
                    
                    </div><!--end col-->
                    <div class="col-sm-4">
                        <p>Was this review helpful to you?</p>
                        <button class="btn btn-default btn-xs"> Yes (0) </button>
                        <button class="btn btn-default btn-xs"> No (0) </button>
                        <p class="abuse"><a href="#">Report Abuse</a></p>
                    </div><!--end col-->
                    <?php }else{ ?>
                    <div class="col-sm-8">
                     <h4 class="review-title">Reviews not found!</h4>
                    </div>
                    <?php } ?>
                 <?php if($this->session->userdata('user_id')){ ?>
                    <div class="col-sm-4">
                         <button class="btn btn-primary waves-effect waves-light pull-right" data-toggle="modal" data-target="#myModal">Add Review</button>
                    </div>
                <?php }else{ ?>
                <div class="col-sm-4">
     		     <span>Note: Please login to add review.</span>
                </div>
                <?php } ?>
                    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="mySmallModalLabel">Post Review</h4>
                                </div>
                               
                                <form name="review_form" id="review_form" role="form" method="post" action="<?= site_url('home/review'); ?>" >
                                    <div class="modal-body">
                                        <div id="div_error" class="text-center text-danger"></div>
                                        <div id="div_succ" class="text-center text-success"><h3 id="div_successfull"></h3></div>
                                        <center><div class="rateyo-readonly-widg a-rateyo-readonly-widg"></div></center>
                                        <input type="hidden" name="rating" id="rating">
                                        <input type="hidden" name="product_id" id="product_id" value="<?= $product['id'] ?>">
                                        <hr>
                                        <div class="form-group mb-2">
                                            <label>Review Title</label>
                                            <input type="text" class="form-control" name="title" id="title" placeholder="Enter review title">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label>Remarks</label>
                                            <textarea class="form-control" name="review" id="review" style="resize: none" placeholder="Enter remarks"></textarea>  
                                        </div>
                                        <div class="form-group text-right">
                                            <button class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Close</button>
                                            <button type="submit" id="sub" class="btn btn-success waves-effect waves-light">Post</button>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                </div><!--end row-->
            </div><!--end single-review-->
        </div><!---end col-sm-12-->
    </div><!--end row-->
    
<?php if(!empty($sameCagegoryProducts)){ ?>
    <!--Related Product-->
    <div class="row">
        <div class="col-sm-12">
            <h3 class="title-head-border">Related Product</h3>
        </div><!---end col-sm-12-->
    </div><!--end row-->
    <div class="row">
         <?php $i=0; foreach($sameCagegoryProducts as $row) : 
            if($i <= 3){
         ?>
        <div class="col-md-3 col-sm-6 related-product">
            <div class="product-item text-center">
                <a href="<?= LANG_URL . '/' . $row['url'] ?>">
                    <img src="<?= site_url('attachments/shop_images').'/'.$row['image']; ?>" class="img-responsive">
                    <div class="product-item-info">
                        <p class="title"><?= ucwords($row['title']); ?></p>
                        <p><span class="product_orig_price"><del>$ <?= $row['old_price']?></del></span>&nbsp;&nbsp;<span class="product_dis_price">$ <?= $row['price']?></span></p>
                    </div>
                </a>
            </div><!--end product-item-->
        </div>
        <?php } $i++; endforeach; ?>
    </div> 
<?php } ?>
    <!--END HTML-->
    <div class="row orders-from-category" id="products-side">
        <div class="filter-sidebar">
        </div>
    </div>
</div>
<!---<div id="modalImagePreview" class="modal">
    <div class="image-preview-container">
        <div class="modal-content">
            <div class="inner-prev-container">
                <img id="img01" alt="">
                <span class="close">&times;</span>
                <span class="img-series"></span>
            </div>
        </div>
        <a href="javascript:void(0);" class="inner-next"></a>
        <a href="javascript:void(0);" class="inner-prev"></a>
    </div>
    <div id="caption"></div>
</div>--->
<script src="<?= base_url('assets/js/image-preveiw.js') ?>"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.rateyo.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.simpleGallery.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.simpleLens.js"></script>
<script>
    $(function () {
	
        $('div.item-row').removeClass('row');
        //alert(1);


        $('div.clicktoload').click(function () {
            var src = $(this).data('bind');
            //alert(src);
            $('img#loaded_image').attr('src', src);
            $('a#loaded_lens').attr('data-lens-image', src);
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('#demo-1 .simpleLens-thumbnails-container img').simpleGallery({
            loading_image: '<?= base_url('/attachments/shop_images/' . $product['image']) ?>'
        });

        $('#demo-1 .simpleLens-big-image').simpleLens({
            loading_image: '<?= base_url('/attachments/shop_images/' . $product['image']) ?>'
        });
    });
</script>

<script type="text/javascript">
    $(function () {
        $('div#div_error').hide();
        $('div#div_succ').hide();
        $('form#review_form').submit(function (e) {
            $('#sub').text('Loading..');
            e.preventDefault();
            var url = $(this).attr('action');
            var postData = $(this).serialize();
            $.post(url, postData, function (o) {
                if (o.result == 1) {
                    $('div#div_succ').show();
                     $('#div_successfull').text('Review Post Successfully');
                    $('div#div_error').hide();
                    window.setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else if (o.result == 0) {
                    
                    $('#sub').text('Post');
                    $('div#div_error').show();
                    $('div#div_succ').hide();
                    var output = '<ul style="list-style: none" >';
                    for (var key in o.error)
                    {
                        var value = o.error[key];
                        output += '<li>' + value + '</li>';
                    }
                    output += '</ul>';
                    $('div#div_error').html(output);
                } else {
                    $('#sub').text('Post');
                    $('div#div_error').show().text('Something went wrong here');
                    $('div#div_succ').hide();
                }
            }, 'json');
        });

    });
</script>
<script type="text/javascript">

    $(function () {

        var rating = 0;

        $(".counter").text(rating);

        $("#rateYo1").on("rateyo.init", function () {
            console.log("rateyo.init");
        });

        $("#rateYo1").rateYo({
            rating: rating,
            numStars: 5,
            precision: 2,
            starWidth: "64px",
            spacing: "5px",
            rtl: true,
            multiColor: {
                startColor: "#000000",
                endColor: "#ffffff"
            },
            onInit: function () {

                console.log("On Init");
            },
            onSet: function () {

                console.log("On Set");
            }
        }).on("rateyo.set", function () {
            console.log("rateyo.set");
        })
                .on("rateyo.change", function () {
                    console.log("rateyo.change");
                });

        $(".rateyo").rateYo();

        $(".rateyo-readonly-widg").rateYo({
            rating: rating,
            numStars: 5,
            precision: 1,
            minValue: 1,
            maxValue: 5
        }).on("rateyo.set", function (e, data) {

            //console.log(data.rating);
            //alert(data.rating);
            $('#rating').val(data.rating);

        });
    });
</script>
<script>

    $(function () {

        var rating = <?php echo $avg_stars; ?>;

        $(".rateyo-readonly-widg2").rateYo({
            rating: rating,
            numStars: 5,
            precision: 1,
            minValue: 1,
            maxValue: 5,
            readOnly: true
        });
        
        var ratingg = <?php echo $avg_star[0]['stars']; ?>;
         $(".rateyo-readonly-widg1").rateYo({
            rating: ratingg,
            numStars: 5,
            precision: 1,
            minValue: 1,
            maxValue: 5,
            readOnly: true
        });
    });
</script>