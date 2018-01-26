</div>
</div>
</div>
</div>
<?php if ($this->session->userdata('logged_in')) { ?>
    <footer><a href="#"></a></footer>
<?php } ?>
</div>
<!-- Modal Calculator -->
<div class="modal fade" id="modalCalculator" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Calculator</h4>
            </div>
            <div class="modal-body" id="calculator">
                <div class="hero-unit" id="calculator-wrapper">
                    <div class="row">
                        <div class="col-sm-8">
                            <div id="calculator-screen" class="form-control"></div>
                        </div>
                        <div class="col-sm-1">
                            <div class="visible-xs">
                                =
                            </div>
                            <div class="hidden-xs">
                                =
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div id="calculator-result"  class="form-control">0</div>
                        </div>
                    </div>
                </div>
                <div class="well">
                    <div id="calc-board">
                        <div class="row">
                            <a href="javascript:void(0);" class="btn btn-default" data-constant="SIN" data-key="115">sin</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-constant="COS" data-key="99">cos</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-constant="MOD" data-key="109">md</a>
                            <a href="javascript:void(0);" class="btn btn-danger" data-method="reset" data-key="8">C</a>
                        </div>
                        <div class="row">
                            <a href="javascript:void(0);" class="btn btn-default" data-key="55">7</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-key="56">8</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-key="57">9</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-constant="BRO" data-key="40">(</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-constant="BRC" data-key="41">)</a>
                        </div>
                        <div class="row">
                            <a href="javascript:void(0);" class="btn btn-default" data-key="52">4</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-key="53">5</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-key="54">6</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-constant="MIN" data-key="45">-</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-constant="SUM" data-key="43">+</a>
                        </div>
                        <div class="row">
                            <a href="javascript:void(0);" class="btn btn-default" data-key="49">1</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-key="50">2</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-key="51">3</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-constant="DIV" data-key="47">/</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-constant="MULT" data-key="42">*</a>
                        </div>
                        <div class="row">
                            <a href="javascript:void(0);" class="btn btn-default" data-key="46">.</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-key="48">0</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-constant="PROC" data-key="37">%</a>
                            <a href="javascript:void(0);" class="btn btn-primary" data-method="calculate" data-key="61">=</a>
                        </div>
                    </div>
                </div>
                <div class="well">
                    <legend>History</legend>
                    <div id="calc-panel">
                        <div id="calc-history">
                            <ol id="calc-history-list"></ol>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootbox.min.js') ?>"></script>
<script src="<?= base_url('assets/js/zxcvbn.js') ?>"></script>
<script src="<?= base_url('assets/js/zxcvbn_bootstrap3.js') ?>"></script>
<script src="<?= base_url('assets/js/pGenerator.jquery.js') ?>"></script>
<script>
    var urls = {
        changePass: '<?= base_url('admin/changePass') ?>',
        editShopCategorie: '<?= base_url('admin/editshopcategorie') ?>',
        changeTextualPageStatus: '<?= base_url('admin/changePageStatus') ?>',
        removeSecondaryImage: '<?= base_url('admin/removeSecondaryImage') ?>',
        convertCurrency: '<?= base_url('admin/convertCurrency') ?>',
        productstatusChange: '<?= base_url('admin/productstatusChange') ?>',
        productsOrderBy: '<?= base_url('admin/products?orderby=') ?>',
        productStatusChange: '<?= base_url('admin/productStatusChange') ?>',
        changeOrdersOrderStatus: '<?= base_url('admin/changeOrdersOrderStatus') ?>',
        ordersOrderBy: '<?= base_url('admin/orders?order_by=') ?>',
        uploadOthersImages: '<?= base_url('admin/uploadOthersImages') ?>',
        loadOthersImages: '<?= base_url('admin/loadOthersImages') ?>',
        editPositionCategorie: '<?= base_url('admin/changePosition') ?>'
    };
</script>
<script src="<?= base_url('assets/js/mine_admin.js') ?>"></script>

<script type="text/javascript">
    $(function () {
    	$('div#name_error').hide();
        $('div#username_error').hide();
        $('div#password_error').hide();
        $('div#con_password_error').hide();
        $('div#email_error').hide();
        $('div#phone_error').hide();
        $('div#login_error').hide();
        $('div#login_success').hide();
        $('form#staff_form').submit(function (e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var postData = $(this).serialize();
            $.post(url, postData, function (o) {
                if (o.result == 1) {
                    $('form#staff_form').find('input:text').val('');
                    $('form#staff_form').find('input:password').val('');
                    $('form#staff_form').find('input:radio').val('');
                    $('form#staff_form').find('textarea').val('');
                    $('form#staff_form').find('select').val('');
                    $('div#name_error').hide();
               	    $('div#username_error').hide();
                    $('div#password_error').hide();
                    $('div#con_password_error').hide();
                    $('div#email_error').hide();
                    $('div#phone_error').hide();
                    $('div#login_error').hide();
                    $('div#login_success').show().text('Staff Added Successfully');
                    window.setTimeout(function () {
                        window.location.reload();
                    }, 1000);
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
                        
                        if (o.error['username']) {
                            $('div#username_error').show().text(o.error['username']);
                        } else {
                            $('div#username_error').hide();
                        }

                        if (o.error['email']) {
                            $('div#email_error').show().text(o.error['email']);
                        } else {
                            $('div#email_error').hide();
                        }

                        if (o.error['phone']) {
                            $('div#phone_error').show().text(o.error['phone']);
                        } else {
                            $('div#phone_error').hide();
                        }
                        
                        if (o.error['password']) {
                            $('div#password_error').show().text(o.error['password']);
                        } else {
                            $('div#password_error').hide();
                        }
                        
                        if (o.error['con_password']) {
                            $('div#con_password_error').show().text(o.error['con_password']);
                        } else {
                            $('div#con_password_error').hide();
                        }
                                              
                    }
                } else {
                    	$('div#name_error').hide();
		        $('div#username_error').hide();
		        $('div#password_error').hide();
		        $('div#con_password_error').hide();
		        $('div#email_error').hide();
		        $('div#phone_error').hide();
                
                    $('div#login_success').hide();
                    $('div#login_error').show().text('Invalid Credential Details');
                }
            }, 'json');
        });
    });
</script>
<script type="text/javascript">
var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>
</body>
</html>