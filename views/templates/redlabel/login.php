<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
    #map {
        height: 400px;
        width: 100%;
    }
</style>
<link rel="stylesheet" type='text/css' href="<?= base_url('assets/css/facebook.css') ?>">
<div id="contacts">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="row">
                 <div class="col-md-12">
                    <div class="custom-breadcrumb">
                        <ul class="list-inline">
                        </ul>
                        <ul class="list-inline">
                        </ul>
                    </div><!--end custom-breadcrumb-->
        </div><!--end col-md-12-->
    </div>
                <?php
                if ($this->session->flashdata('resultSend')) {
                    ?>
                    <hr>
                    <div class="alert alert-info"><?= $this->session->flashdata('resultSend') ?></div>
                    <hr>
                <?php }
                ?>
                
                <div class="well well-sm">
                    <form id="frmLogin" class="form-horizontal m-t-20" action="<?php echo base_url('login/validation'); ?>" method="post" >
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="form-group">
                                    <label for="username">
                                        Username
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
                                        </span>
                                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" required="required" />
                                        <input type="hidden" name="checkout" value="<?= $this->input->get('process'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">
                                        Password
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span>
                                        </span>
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required="required" />
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="col-md-9">
                                &nbsp;&nbsp;New Customer? <a href="<?= LANG_URL . '/registration' ?>"><?= lang('registration') ?><i class="fa fa-sign-out" aria-hidden="true"></i> <span class="hidden-sm hidden-xs">Sign Up</span></a>
								
                                <br />
&nbsp;&nbsp;Forget Credentials? <a href="<?= LANG_URL . '/login/recover_credentials' ?>"><?= lang('registration') ?><i class="fa fa-sign-out" aria-hidden="true"></i> <span class="hidden-sm hidden-xs">Recover</span></a>
                            <br />

                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary pull-right" id="btnLogin">
                                    Login</button>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-md-12" >
							<br />

                                <a href="<?php echo base_url();?>login/fblogin"><img size="80" src='<?php echo base_url();?>template/imgs/facebook.png' id='facebook'  style='cursor:pointer;float:left;margin-right:10%;'  alt="Sign in with Facebook"/></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </div>

</div>