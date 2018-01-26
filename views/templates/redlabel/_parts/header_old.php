<!DOCTYPE html>
<html lang="<?= MY_LANGUAGE_ABBR ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?></title>
        <meta name="description" content="<?= $description ?>">
        <meta name="keywords" content="<?= $keywords ?>">
        <meta property="og:image" content="<?= base_url('assets/img/site-overview.png') ?>" />
        <link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
        <link href="<?= base_url('assets/css/bootstrap-datepicker.min.css') ?>" rel="stylesheet">
        <link href="<?= base_url('templatecss/custom.css') ?>" rel="stylesheet">
        <link href="<?= base_url('cssloader/theme.css') ?>" rel="stylesheet">
        <!-- DURA MENU V1.0 -->
        <link href="<?= base_url('templatecss/dura-main.css') ?>" rel="stylesheet">
        <link href="<?= base_url('templatecss/dura-responsive.css') ?>" rel="stylesheet">
        <!--DURA MENU END-->
        <!--Slick CSS -->
        <link rel="stylesheet" href="<?= base_url('templatecss/slick.css') ?>"/>
        <!--Slick End-->
        <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
        <!-- slick js -->
        <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="<?= base_url('templatejs/slick.min.js') ?>"></script>
        <!--Main JS-->
        <script type="text/javascript" src="<?= base_url('templatejs/main.js') ?>"></script>
        <!--end Slick JS-->
        
        <?php if ($cookieLaw != false) { ?>
            <script type="text/javascript">
                window.cookieconsent_options = {"message": "<?= $cookieLaw['message'] ?>", "dismiss": "<?= $cookieLaw['button_text'] ?>", "learnMore": "<?= $cookieLaw['learn_more'] ?>", "link": "<?= $cookieLaw['link'] ?>", "theme": "<?= $cookieLaw['theme'] ?>"};
            </script>
            <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.10/cookieconsent.min.js"></script>
        <?php } ?>
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="wrapper">
            
            <div id="content">
                <div id="languages-bar">
                    <div class="container">
                        <div class="row">
                        <div class="col-sm-12 text-right">
                            <nav class="top-header-menu">
                                <ul class="list-inline">
                                    <?php if ($this->session->userdata('user_type')) { ?>
                                        <li><a href="<?= site_url('editCart'); ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="sumOfItems"><?php if(get_cookie('total')){ echo get_cookie('total'); }else{ echo 'Bal'; } ?></span> <!--<span class="caret"></span>--></a>
                                        <!--<ul class="dropdown-menu dropdown-menu-right dropdown-cart" role="menu">
                                            <?= $load::getCartItems($cartItems) ?>
                                        </ul>-->
                                    </li>
                                    <li class="list-have-dropdown">
                                        <a href="#"><i class="fa fa-user-circle-o" aria-hidden="true"></i> <span class="hidden-sm hidden-xs">My Account <i class="fa fa-caret-down" aria-hidden="true"></i></span></a>
                                        <div class="top-dropdown-menu-wrap">
                                            <ul class="top-dropdown-menu text-left">
                                              <li><a href="#">My Account</a></li>
                                              <li><a href="#">Orders</a></li>
                                              <li><a href="#">Wish list</a></li>
                                              <li><a href="#">Reviews</a></li>
                                              <li><a href="#">My Page</a></li>
                                              <li><a href="#">Wish list</a></li>
                                              <li class="divider"></li>
                                              <li><a href="#">Create New Account</a></li>
                                            </ul>
                                        </div><!--end top-dropdown-menu-wrap-->
                                    </li>
                                    <li><a href="<?= LANG_URL . '/login/logout' ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> <span class="hidden-sm hidden-xs">Sign Out</span></a></li>
                                    <?php } else { ?>
                                    <li><a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="true"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="sumOfItems"><?php if(get_cookie('total')){ echo get_cookie('total'); }else{ echo '0'; } ?></span></a>
                                        <ul class="dropdown-menu dropdown-menu-right dropdown-cart" role="menu">
                                            <?= $load::getCartItems($cartItems) ?>
                                        </ul>
                                    </li>
                                    <li><a href="<?= LANG_URL . '/login' ?>"><i class="fa fa-sign-in" aria-hidden="true"></i> <span class="hidden-sm hidden-xs">Sign In</span></a></li>
                                    <li><a href="<?= LANG_URL . '/registration' ?>"><?= lang('registration') ?><i class="fa fa-sign-out" aria-hidden="true"></i> <span class="hidden-sm hidden-xs">Sign Up</span></a></li>
                                    <?php } ?>
                                 </ul>
                            </nav><!--end top-header-menu-->
                        </div>
                        </div><!--end row-->
                    </div>
                </div>
                
                <?php if (!$this->session->userdata('user_type')) { ?>
                <div id="top-part">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-5 col-md-3 col-lg-3 left">
                                <a href="<?= base_url() ?>">
                                    <img src="<?= base_url('attachments/site_logo/' . $sitelogo) ?>" class="site-logo" alt="<?= $_SERVER['HTTP_HOST'] ?>">
                                </a>
                            </div>
                            <div class="col-sm-6 col-md-5 col-lg-5 col-lg-offset-4 col-md-offset-4 col-sm-offset-1">
                                <div class="input-group" id="adv-search">
                                    <input type="text" value="<?= isset($_GET['search_in_title']) ? $_GET['search_in_title'] : '' ?>" id="search_in_title" class="form-control" placeholder="<?= lang('search_by_keyword_title') ?>" />
                                    <div class="input-group-btn">
                                        <div class="btn-group" role="group">
                                              <button type="button" onclick="submitForm()" class="btn-go-search mine-color">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
     
                <?php } else { ?>
                
                <div id="top-part">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-5 col-md-3 col-lg-3 left">
                                <a href="<?= base_url() ?>">
                                    <img src="<?= base_url('attachments/site_logo/' . $sitelogo) ?>" class="site-logo" alt="<?= $_SERVER['HTTP_HOST'] ?>">
                                </a>
                            </div>
                            <div class="col-sm-6 col-md-5 col-lg-5 col-lg-offset-4 col-md-offset-4 col-sm-offset-1">
                                <div class="input-group" id="adv-search">
                                    <input type="text" value="<?= isset($_GET['search_in_title']) ? $_GET['search_in_title'] : '' ?>" id="search_in_title" class="form-control" placeholder="<?= lang('search_by_keyword_title') ?>" />
                                    <div class="input-group-btn">
                                        <div class="btn-group" role="group">
                                              <button type="button" onclick="submitForm()" class="btn-go-search mine-color">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
              
                
           
                <?php } ?>
                 <div class="menu-wrap">
                    <div class="container nav-container">
                      <div class="row header-bottom-row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                 
                          <nav class="navbar navbar-inverse navbar-static-top">
                            <div class="container">
                              <!-- Brand and toggle get grouped for better mobile display -->
                              <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                  <span class="sr-only">Toggle navigation</span>
                                  <span class="icon-bar"></span>
                                  <span class="icon-bar"></span>
                                  <span class="icon-bar"></span>
                                </button>
                                <!--a class="navbar-brand" href="#">Brand</a-->
                              </div>

                              <!-- Collect the nav links, forms, and other content for toggling -->
                              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                  <li class="dropdown active-shopping"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars" aria-hidden="true"></i>Categories <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                      
                                      
                                      <?php if (!empty($footerCategories)) { ?>
                                      <?php foreach ($footerCategories as $key => $categorie) { ?>
                                      
                                      <li>
                                          <a href="#"><?= $categorie ?></a>
                                          <div class="container-fluid dropdown-menu-shopping">
                                          <div class="row">
                                            <div class="col-lg-12 banner-menswear">
                                              <h2 class="light"><?= $categorie ?></h2>
                                              <div class="gradient-left"></div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                              <ul>
                                                <li><a href="#"> Amino Acids </a></li>
                                                <li><a href="#">Antioxidants</a></li>
                                                <li><a href="#">T-Shirts</a></li>
                                                <li><a href="#">Astaxanthin</a></li>
                                                <li><a href="#">BCAA</a></li>
                                                <li><a href="#">Bone Formulas</a></li>
                                              </ul>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                              <ul>
                                                <li><a href="#"> Amino Acids </a></li>
                                                <li><a href="#">Antioxidants</a></li>
                                                <li><a href="#">T-Shirts</a></li>
                                                <li><a href="#">Astaxanthin</a></li>
                                                <li><a href="#">BCAA</a></li>
                                                <li><a href="#">Bone Formulas</a></li>
                                              </ul>                             
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                              <ul>
                                                <li><a href="#"> Amino Acids </a></li>
                                                <li><a href="#">Antioxidants</a></li>
                                                <li><a href="#">T-Shirts</a></li>
                                                <li><a href="#">Astaxanthin</a></li>
                                                <li><a href="#">BCAA</a></li>
                                                <li><a href="#">Bone Formulas</a></li>
                                              </ul>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                              <ul>
                                                <li><a href="#"> Amino Acids </a></li>
                                                <li><a href="#">Antioxidants</a></li>
                                                <li><a href="#">T-Shirts</a></li>
                                                <li><a href="#">Astaxanthin</a></li>
                                                <li><a href="#">BCAA</a></li>
                                                <li><a href="#">Bone Formulas</a></li>
                                              </ul>
                                            </div>
                                          </div>
                                        </div>
                                      </li>
                                      
                                      <?php } ?>
                                      
                                      <?php } ?>
                                     
                                     
                                      
                                
                                      
                                      <!--<li><a href="#"><i class="fa fa-fire" aria-hidden="true"></i>Supplements</a>-->
                                      <!--  <div class="container-fluid dropdown-menu-shopping">-->
                                      <!--    <div class="row">-->
                                      <!--      <div class="col-lg-12 banner-menswear">-->
                                      <!--        <h2 class="light">Supplements</h2>-->
                                      <!--        <div class="gradient-left"></div>-->
                                      <!--      </div>-->
                                      <!--    </div>-->
                                      <!--    <div class="row">-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>-->
                                      <!--      </div>-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>                             -->
                                      <!--      </div><!--end col-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>-->
                                      <!--      </div><!--end col-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>-->
                                      <!--      </div><!--end col-->
                                      <!--    </div>-->
                                      <!--  </div>-->
                                      <!--</li>-->
                                      <!--<li><a href="#"><i class="fa fa-futbol-o" aria-hidden="true"></i>Sports</a>-->
                                      <!--  <div class="container-fluid dropdown-menu-shopping">-->
                                      <!--    <div class="row">-->
                                      <!--      <div class="col-lg-12 banner-menswear">-->
                                      <!--        <h2 class="light">Supplements</h2>-->
                                      <!--        <div class="gradient-left"></div>-->
                                      <!--      </div>-->
                                      <!--    </div>-->
                                      <!--    <div class="row">-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>-->
                                      <!--      </div>-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>                             -->
                                      <!--      </div><!--end col-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>-->
                                      <!--      </div><!--end col-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>-->
                                      <!--      </div><!--end col-->
                                      <!--    </div>-->
                                      <!--  </div>-->
                                      <!--</li>-->
                                      <!--<li><a href="#"><i class="fa fa-leaf" aria-hidden="true"></i>Herbs</a>-->
                                      <!--  <div class="container-fluid dropdown-menu-shopping">-->
                                      <!--    <div class="row">-->
                                      <!--      <div class="col-lg-12 banner-menswear">-->
                                      <!--        <h2 class="light">Herbs</h2>-->
                                      <!--        <div class="gradient-left"></div>-->
                                      <!--      </div>-->
                                      <!--    </div>-->
                                      <!--    <div class="row">-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>-->
                                      <!--      </div>-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>                             -->
                                      <!--      </div><!--end col-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>-->
                                      <!--      </div><!--end col-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>-->
                                      <!--      </div><!--end col-->
                                      <!--    </div>-->
                                      <!--  </div>-->
                                      <!--</li>-->
                                      <!--<li><a href="#"><i class="fa fa-female" aria-hidden="true"></i>Beauty</a>-->
                                      <!--  <div class="container-fluid dropdown-menu-shopping">-->
                                      <!--    <div class="row">-->
                                      <!--      <div class="col-lg-12 banner-menswear">-->
                                      <!--        <h2 class="light">Beauty</h2>-->
                                      <!--        <div class="gradient-left"></div>-->
                                      <!--      </div>-->
                                      <!--    </div>-->
                                      <!--    <div class="row">-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>-->
                                      <!--      </div>-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>                             -->
                                      <!--      </div><!--end col-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>-->
                                      <!--      </div><!--end col-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>-->
                                      <!--      </div><!--end col-->
                                      <!--    </div>-->
                                      <!--  </div>-->
                                      <!--</li>-->
                                      <!--<li><a href="#"><i class="fa-shopping-bag" aria-hidden="true"></i>Grocery</a>-->
                                      <!--  <div class="container-fluid dropdown-menu-shopping">-->
                                      <!--    <div class="row">-->
                                      <!--      <div class="col-lg-12 banner-menswear">-->
                                      <!--        <h2 class="light">Grocery</h2>-->
                                      <!--        <div class="gradient-left"></div>-->
                                      <!--      </div>-->
                                      <!--    </div>-->
                                      <!--    <div class="row">-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>-->
                                      <!--      </div>-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>                             -->
                                      <!--      </div><!--end col-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>-->
                                      <!--      </div><!--end col-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>-->
                                      <!--      </div><!--end col-->
                                      <!--    </div>-->
                                      <!--  </div>-->
                                      <!--</li>-->
                                      <!--<li><a href="#"><i class="fa fa-child" aria-hidden="true"></i>Baby</a>-->
                                      <!--  <div class="container-fluid dropdown-menu-shopping">-->
                                      <!--    <div class="row">-->
                                      <!--      <div class="col-lg-12 banner-menswear">-->
                                      <!--        <h2 class="light">Baby</h2>-->
                                      <!--        <div class="gradient-left"></div>-->
                                      <!--      </div>-->
                                      <!--    </div>-->
                                      <!--    <div class="row">-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>-->
                                      <!--      </div>-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>                             -->
                                      <!--      </div><!--end col-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>-->
                                      <!--      </div><!--end col-->
                                      <!--      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                      <!--        <ul>-->
                                      <!--          <li><a href="#"> Amino Acids </a></li>-->
                                      <!--          <li><a href="#">Antioxidants</a></li>-->
                                      <!--          <li><a href="#">T-Shirts</a></li>-->
                                      <!--          <li><a href="#">Astaxanthin</a></li>-->
                                      <!--          <li><a href="#">BCAA</a></li>-->
                                      <!--          <li><a href="#">Bone Formulas</a></li>-->
                                      <!--        </ul>-->
                                      <!--      </div><!--end col-->
                                      <!--    </div>-->
                                      <!--  </div>-->
                                      <!--</li>-->
                                    </ul>
                                  </li>

                                  <!-- MEGA MENU CLASSIC -->
                                  <li class="dropdown dropdown-mega"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Brands <span class="caret"></span></a>
                                    <div class="dropdown-menu dropdown-mega-content">
                                      <div class="row" style="padding: 20px; padding-bottom: 0">
                                        <div class="col-sm-12">
                                            <h3>Brands <span><a href="#">View All</a></span></h3>
                                        </div><!--end col-->
                                        <div class="col-sm-12">
                                            <ul class="list-inline nav-justified">
                                              <li><a href="#">#</a></li>
                                              <li><a href="#">A</a></li>
                                              <li><a href="#">B</a></li>
                                              <li><a href="#">C</a></li>
                                              <li><a href="#">D</a></li>
                                              <li><a href="#">E</a></li>
                                              <li><a href="#">F</a></li>
                                              <li><a href="#">G</a></li>
                                              <li><a href="#">H</a></li>
                                              <li><a href="#">I</a></li>
                                              <li><a href="#">J</a></li>
                                              <li><a href="#">K</a></li>
                                              <li><a href="#">L</a></li>
                                              <li><a href="#">M</a></li>
                                              <li><a href="#">N</a></li>
                                              <li><a href="#">O</a></li>
                                              <li><a href="#">P</a></li>
                                              <li><a href="#">Q</a></li>
                                              <li><a href="#">R</a></li>
                                              <li><a href="#">S</a></li>
                                              <li><a href="#">T</a></li>
                                              <li><a href="#">U</a></li>
                                              <li><a href="#">V</a></li>
                                              <li><a href="#">W</a></li>
                                              <li><a href="#">X</a></li>
                                              <li><a href="#">Y</a></li>
                                              <li><a href="#">Z</a></li>
                                            </ul>
                                        </div><!--end col-->
                                        
                                        <?php 
                                      $i = 0;
                                      foreach ($brand as $key => $brandshow): ?>
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                        <ul>
                                         
                                                <li><a href="<?php echo site_url('brands/index').'/'.$brandshow['manufacturer_id'] ; ?>"><?= $brandshow['manufacturer_name'] ?></a></li>
                      
                                      <?php if($i==5) break; ?>
                                      </ul> 
                                      </div>
                                      <?php 
                                      endforeach ?>
                                        
                                        <!--<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                        <!--      <ul>-->
                                        <!--        <li><a href="#"> Amino Acids </a></li>-->
                                        <!--        <li><a href="#">Antioxidants</a></li>-->
                                        <!--        <li><a href="#">T-Shirts</a></li>-->
                                        <!--        <li><a href="#">Astaxanthin</a></li>-->
                                        <!--        <li><a href="#">BCAA</a></li>-->
                                        <!--        <li><a href="#">Bone Formulas</a></li>-->
                                        <!--      </ul>                             -->
                                        <!--</div>-->
                                        <!--<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                        <!--      <ul>-->
                                        <!--        <li><a href="#"> Amino Acids </a></li>-->
                                        <!--        <li><a href="#">Antioxidants</a></li>-->
                                        <!--        <li><a href="#">T-Shirts</a></li>-->
                                        <!--        <li><a href="#">Astaxanthin</a></li>-->
                                        <!--        <li><a href="#">BCAA</a></li>-->
                                        <!--        <li><a href="#">Bone Formulas</a></li>-->
                                        <!--      </ul>                             -->
                                        <!--</div>-->
                                        <!--<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">-->
                                        <!--      <ul>-->
                                        <!--        <li><a href="#"> Amino Acids </a></li>-->
                                        <!--        <li><a href="#">Antioxidants</a></li>-->
                                        <!--        <li><a href="#">T-Shirts</a></li>-->
                                        <!--        <li><a href="#">Astaxanthin</a></li>-->
                                        <!--        <li><a href="#">BCAA</a></li>-->
                                        <!--        <li><a href="#">Bone Formulas</a></li>-->
                                        <!--      </ul>                             -->
                                        <!--</div>-->
                                      </div>
                                    </div>
                                  </li>
                                  <!-- /MEGA MENU CLASSIC -->

                                  <!-- MEGA MENU CLASSIC -->
                                  <li class="dropdown dropdown-mega"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Conditions <span class="caret"></span></a>
                                    <div class="dropdown-menu dropdown-mega-content">
                                      <div class="row" style="padding: 20px; padding-bottom: 0">
                                        <div class="col-sm-12">
                                            <h3>Conditions <span><a href="#">View All</a></span></h3>
                                        </div><!--end col-->
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                              <ul>
                                                <li><a href="#"> Amino Acids </a></li>
                                                <li><a href="#">Antioxidants</a></li>
                                                <li><a href="#">T-Shirts</a></li>
                                                <li><a href="#">Astaxanthin</a></li>
                                                <li><a href="#">BCAA</a></li>
                                                <li><a href="#">Bone Formulas</a></li>
                                              </ul>                             
                                        </div><!--end col-->
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                              <ul>
                                                <li><a href="#"> Amino Acids </a></li>
                                                <li><a href="#">Antioxidants</a></li>
                                                <li><a href="#">T-Shirts</a></li>
                                                <li><a href="#">Astaxanthin</a></li>
                                                <li><a href="#">BCAA</a></li>
                                                <li><a href="#">Bone Formulas</a></li>
                                              </ul>                             
                                        </div><!--end col-->
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                              <ul>
                                                <li><a href="#"> Amino Acids </a></li>
                                                <li><a href="#">Antioxidants</a></li>
                                                <li><a href="#">T-Shirts</a></li>
                                                <li><a href="#">Astaxanthin</a></li>
                                                <li><a href="#">BCAA</a></li>
                                                <li><a href="#">Bone Formulas</a></li>
                                              </ul>                             
                                        </div><!--end col-->
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                              <ul>
                                                <li><a href="#"> Amino Acids </a></li>
                                                <li><a href="#">Antioxidants</a></li>
                                                <li><a href="#">T-Shirts</a></li>
                                                <li><a href="#">Astaxanthin</a></li>
                                                <li><a href="#">BCAA</a></li>
                                                <li><a href="#">Bone Formulas</a></li>
                                              </ul>                             
                                        </div><!--end col-->
                                      </div>
                                    </div>
                                  </li>
                                  <!-- /MEGA MENU CLASSIC -->
                                  
                                  <!-- BOOTSTRAP Simple Link -->
                                  <li>
                                    <a href="#">New</a>
                                  </li>
                                  <!-- /BOOTSTRAP Simple Link -->
                                  <!-- BOOTSTRAP Simple Link -->
                                  <li>
                                    <a href="#">Best Seller</a>
                                  </li>
                                  <!-- /BOOTSTRAP Simple Link -->
                                  <!-- BOOTSTRAP Simple Link -->
                                  <li>
                                    <a href="#">Specials</a>
                                  </li>
                                  <!-- /BOOTSTRAP Simple Link -->
                                  <!-- BOOTSTRAP Simple Link -->
                                  <li>
                                    <a href="#">Try And Save</a>
                                  </li>
                                  <!-- /BOOTSTRAP Simple Link -->
                                </ul>
                              </div><!-- /.navbar-collapse -->
                            </div><!-- /.container-fluid -->
                          </nav>
                        </div>
                      </div>          
                    </div>
                </div>