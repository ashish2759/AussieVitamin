<footer>
    <div class="footer section-padding" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-2  col-md-4 col-sm-4 col-xs-12 f-col">
                    <h3><?= lang('about_us') ?></h3>
                    <p><?= $footerAboutUs ?></p>
                </div>
                <div class="col-lg-2  col-md-3 col-sm-3 col-xs-12 f-col">
                    <h3><?= lang('pages') ?></h3>
                    <ul class="links">
                        <li><a href="<?= base_url() ?>"> <?= lang('home') ?> </a></li>
                        <li><a href="<?= LANG_URL . '/checkout' ?>"> <?= lang('checkout') ?> </a></li>
                        <li><a href="<?= LANG_URL . '/contacts' ?>"> <?= lang('contacts') ?> </a></li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-4 col-sm-4 col-xs-12 f-col">
                    <h3><?= lang('categories') ?></h3>
                    <?php if (!empty($footerCategories)) { ?>
                        <ul class="links">
                            <?php foreach ($footerCategories as $key => $categorie) { 
							
							?>
                                <li><a href="<?php echo site_url('categories/view').'/'.strtolower($categorie) ; ?>" data-categorie-id="<?= $key ?>" class="go-category"><?= $categorie ?></a></li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        <p><?= lang('no_categories') ?></p>
                    <?php } ?>
                </div>
                <div class="col-lg-3  col-md-6 col-sm-4 col-xs-12 f-col">
                    <h3><?= lang('contacts') ?></h3>
                    <?php if ($footerContactEmail != '') { ?>
                    <div class="email"> <i class="fa fa-envelope"></i>
                        <p><a href="mailto:<?= $footerContactEmail ?>"><?= $footerContactEmail ?></a></p>
                    </div>
                    <?php } ?>
                    <?php if ($footerContactPhone != '') { ?>
                    <div class="phone"> <i class="fa fa-phone"></i>
                        <p><?= $footerContactPhone ?></p>
                    </div>
                    <?php } ?>
                    <?php if ($footerContactAddr != '') { ?>
                    <div class="address"> <i class="fa fa-map-marker"></i>
                        <p> <?= $footerContactAddr ?></p>
                    </div>
                    <?php } ?>  
                    <!--<ul class="footer-icon">

                        <?php if ($footerContactAddr != '') { ?>
                            <li>
                                <span class="pull-left"><i class="fa fa-map-marker"></i></span> 
                                <span class="pull-left f-cont-info"> <?= $footerContactAddr ?></span> 
                            </li>
                        <?php }if ($footerContactPhone != '') { ?>
                            <li>
                                <span class="pull-left"><i class="fa fa-phone"></i></span> 
                                <span class="pull-left f-cont-info"> <?= $footerContactPhone ?></span> 
                            </li>
                        <?php } if ($footerContactEmail != '') { ?>
                            <li>
                                <span class="pull-left"><i class="fa fa-envelope"></i></span> 
                                <span class="pull-left f-cont-info"><a href="mailto:<?= $footerContactEmail ?>"><?= $footerContactEmail ?></a></span>
                            </li>
                        <?php } ?>
                    </ul>-->
                    
                </div>
                <div class="col-lg-3  col-md-4 col-sm-6 col-xs-12 f-col">
                    <h3><?= lang('newsletter') ?></h3>
                    <ul>
                        <li>
                            <div class="input-append newsletter-box text-center">
                                <form method="POST" id="subscribeForm">
                                    <input type="text" class="form-control" name="subscribeEmail" placeholder="<?= lang('email_address') ?>">
                                    <button class="btn bg-gray" onclick="checkEmailField()" type="button"> <?= lang('subscribe') ?> <i class="fa fa-long-arrow-right"></i></button>
                                </form>
                            </div>
                        </li>
                    </ul>
                    <div class="social">
                        <ul class="inline-mode">
                            <?php if ($footerSocialFacebook != '') { ?>
                                <li class="social-network fb"> <a href="<?= $footerSocialFacebook ?>"><i class=" fa fa-facebook"></i></a></li>
                            <?php } if ($footerSocialTwitter != '') { ?>
                                <li class="social-network tw"> <a href="<?= $footerSocialTwitter ?>"><i class="fa fa-twitter"></i></a></li>
                            <?php } if ($footerSocialGooglePlus != '') { ?>
                                <li class="social-network googleplus"> <a href="<?= $footerSocialGooglePlus ?>"><i class="fa fa-google-plus"></i></a></li>
                            <?php } if ($footerSocialPinterest != '') { ?>
                                <li class="social-network pinterest"> <a href="<?= $footerSocialPinterest ?>"><i class="fa fa-pinterest"></i></a></li>
                            <?php } if ($footerSocialYoutube != '') { ?>
                                <li class="social-network youtube"> <a href="<?= $footerSocialYoutube ?>"><i class="fa fa-youtube"></i></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <p class="text-center"><?= $footerCopyright ?></p>
            <!--<div class="pull-right">
                <ul class="nav nav-pills payments">
                    <li><i class="fa fa-cc-visa"></i></li>
                    <li><i class="fa fa-cc-mastercard"></i></li>
                    <li><i class="fa fa-cc-amex"></i></li>
                    <li><i class="fa fa-cc-paypal"></i></li>
                </ul> 
            </div>-->
        </div>
    </div>
</footer>
</div>
</div>
<div id="notificator" class="alert"></div>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap-confirmation.min.js') ?>"></script>
<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>
<script src="<?= base_url('assets/js/placeholders.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap-datepicker.min.js') ?>"></script>
<script>
var variable = {
    clearShoppingCartUrl: "<?= base_url('clearShoppingCart') ?>",
    manageShoppingCartUrl: "<?= base_url('manageShoppingCart') ?>",
    discountCodeChecker: "<?= base_url('discountCodeChecker') ?>"
};
</script>
<script src="<?= base_url('assets/js/system.js') ?>"></script>
<script src="<?= base_url('templatejs/dura-main.js') ?>"></script>
<script type="text/javascript">
    $(function () {
    	$('div#subject_error').hide();
        $('div#message_error').hide();
        $('div#login_error').hide();
        $('div#name_error').hide();
        $('div#email_error').hide();
        $('div#phone_number_error').hide();
        $('div#login_success').hide();
        $('form#enquire').submit(function (e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var postData = $(this).serialize();
            $.post(url, postData, function (o) {
                if (o.result == 1) {
                    $('form#enquire').find('input:text').val('');
                    $('form#enquire').find('input:password').val('');
                    $('form#enquire').find('input:radio').val('');
                    $('form#enquire').find('textarea').val('');
                    $('form#enquire').find('select').val('');
                    $('div#subject_error').hide();
               	    $('div#message_error').hide();
                    $('div#login_error').hide();
                    $('div#name_error').hide();
                    $('div#email_error').hide();
                    $('div#phone_number_error').hide();
                    $('div#login_success').show().text('Email sent successfully');
//                    window.setTimeout(function () {
//                        window.location.href = '<?php echo site_url('home'); ?>';
//                    }, 1000);
                } else if (o.result == 0) {
                    $('div#login_error').hide();
                    console.log(o.error);
                    $('div#login_success').hide();
                    for (var key in o.error)
                    {
                        if (o.error['name']) {
                            $('div#name_error').show().text(o.error['name']);
                        } else {
                            $('div#name_error').hide();
                        }

                        if (o.error['email']) {
                            $('div#email_error').show().text(o.error['email']);
                        } else {
                            $('div#email_error').hide();
                        }

                        if (o.error['phone_number']) {
                            $('div#phone_number_error').show().text(o.error['phone_number']);
                        } else {
                            $('div#phone_number_error').hide();
                        }
                        if (o.error['name']) {
                            $('div#subject_error').show().text(o.error['subject']);
                        } else {
                            $('div#subject_error').hide();
                        }
                        if (o.error['name']) {
                            $('div#message_error').show().text(o.error['message']);
                        } else {
                            $('div#message_error').hide();
                        }
                    }
                } else {
                
                $('div#subject_error').hide();
                $('div#message_error').hide();
                
                    $('div#name_error').hide();
                    $('div#email_error').hide();
                    $('div#phone_number_error').hide();
                    $('div#login_success').hide();
                    $('div#login_error').show().text('Invalid Credential Details');
                }
            }, 'json');
        });
    });
</script>
 

</body>
</html>
