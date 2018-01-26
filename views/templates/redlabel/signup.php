<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
    #map {
        height: 400px;
        width: 100%;
    }
</style>
<div id="contacts">
    <div class="container">
        <div class="row">
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
            <div class="col-md-8 col-md-offset-2">
                <?php
                if ($this->session->flashdata('resultSend')) {
                    ?>
                    <hr>
                    <div class="alert alert-info"><?= $this->session->flashdata('resultSend') ?></div>
                    <hr>
                <?php }
                ?>
                <div class="well row">
                    <form id="frmAdd" class="form-horizontal" action="<?php echo base_url('registration/insert'); ?>" method="post">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group" style="margin-right:0;">
                                    <label for="name">
                                        <?= lang('name') ?></label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" required="required" />
                                </div>
                                <div class="form-group" style="margin-right:0;">
                                    <label for="email">
                                        <?= lang('email_address') ?>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                        </span>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required="required" />
                                    </div>
                                </div>
                                <div class="form-group" style="margin-right:0;">
                                    <label for="phone">
                                        Phone Number
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span>
                                        </span>
                                        <input type="number" name="phone" class="form-control" id="phone" placeholder="Enter phone" required="required" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" style="margin-left:0;">
                                    <label for="username">
                                        Username
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
                                        </span>
                                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" required="required" />
                                    </div>
                                </div>
                                <div class="form-group" style="margin-left:0;">
                                    <label for="password">
                                        Password
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span>
                                        </span>
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required="required" />
                                    </div>
                                </div>

                                 <div class="form-group col-md-12" style="margin-left: 0; margin-top: 25px; padding-left: 0;">
                                     <button type="submit" class="btn btn-primary" id="btnContactUs">
                                    Register</button>
                                </div>
                                
                            </div>
                           
                        </div>
                    </form>
                </div>
            </div>
            <!--<div class="col-md-4">

            </div>-->
        </div>
    </div>

</div>