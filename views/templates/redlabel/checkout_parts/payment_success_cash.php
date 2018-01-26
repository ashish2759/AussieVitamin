<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
                    <div class="custom-breadcrumb">
                        
                        
                    </div><!--end custom-breadcrumb-->
                </div><!--end col-md-12-->
    </div>
    <?= purchase_steps(1, 2, 3) ?>
    <div class="alert alert-success"><?= lang('c_o_d_order_completed') ?></div>
</div>