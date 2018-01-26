<div id="languages">
    <h1><img src="<?= base_url('assets/imgs/categories.jpg') ?>" class="header-img" style="margin-top:-2px;">Manufacturer</h1> 
    <hr>
    <?php if (validation_errors()) { ?>
        <div class="alert alert-danger"><?= validation_errors() ?></div>
        <hr>
        <?php
    }
    if ($this->session->flashdata('result_add')) {
        ?>
        <div class="alert alert-success"><?= $this->session->flashdata('result_add') ?></div>
        <hr>
        <?php
    }
    if ($this->session->flashdata('result_delete')) {
        ?>
        <div class="alert alert-success"><?= $this->session->flashdata('result_delete') ?></div>
        <hr>
        <?php
    }
    ?>
    <a href="javascript:void(0);" data-toggle="modal" data-target="#add_edit_articles" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;"><b>+</b> Add Manufacturer</a>
    <?php
    if (!empty($manufacturers)) {
        ?>
        <table class="table table-striped custab">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Manufacturer Name</th>
                    <th>Manufacturer Description</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <?php
            $i = 1;
            foreach ($manufacturers as $row) {
                ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $row['manufacturer_name'] ?></td>
                    <td><?= $row['manufacturer_description'] ?></td>
                    <td class="text-center">
                        <a href="<?= base_url('admin/manufacture/?delete=' . $row['manufacturer_id']) ?>" class="btn btn-danger btn-xs confirm-delete"><span class="glyphicon glyphicon-remove"></span> Del</a>
                    </td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </table>
        <?php
    } else {
        ?>
        <div class="clearfix"></div><hr>
        <div class="alert alert-info">No manufacturer found!</div>
    <?php } ?>

    <!-- add edit home categorie -->
    <div class="modal fade" id="add_edit_articles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="frm_manu" action="" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Manufacturer</h4>
                        <div class="text-center text-danger" id="error"></div>
                        <div class="text-center text-success" id="succ"></div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Manufacturer Name</label>
                            <input type="text" name="man_name" id="man_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Manufacturer Description</label>
                            <textarea id="desc" name="desc" class="form-control"></textarea>
                        </div>
                         <div class="form-group">
                            <label>Slug</label>
                           <input type="text" name="slug" id="slug" class="form-control" readonly="readonly">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="categorieEditor">
    <input type="text" name="new_value" class="form-control" value="">
    <button type="button" class="btn btn-default saveEditCategorie">
        <i class="fa fa-floppy-o noSaveEdit" aria-hidden="true"></i>
        <i class="fa fa-spinner fa-spin fa-fw yesSaveEdit"></i>
    </button>
    <button type="button" class="btn btn-default closeEditCategorie"><i class="fa fa-times" aria-hidden="true"></i></button>
</div>
<div id="categorieSubEdit">
    <form method="POST" id="categorieEditSubChanger">
        <input type="hidden" name="editSubId" value="">
        <select class="selectpicker" name="newSubIs">
            <option value=""></option>
            <option value="0">None</option>
            <?php
            foreach ($shop_categories as $key_cat => $shop_categorie) {
                $aa = '';
                foreach ($shop_categorie['info'] as $ff) {
                    $aa .= '[' . $ff['abbr'] . ']' . $ff['name'] . '/';
                }
                ?>
                <option value="<?= $key_cat ?>"><?= $aa ?></option>
            <?php } ?>
        </select>
    </form>
</div>
<div id="positionEditor">
    <input type="hidden" name="positionEditId" value="">
    <input type="text" name="new_position" class="form-control" value="">
    <button type="button" class="btn btn-default savePositionCategorie">
        <i class="fa fa-floppy-o noSavePosition" aria-hidden="true"></i>
        <i class="fa fa-spinner fa-spin fa-fw yesSavePosition"></i>
    </button>
    <button type="button" class="btn btn-default closePositionCategorie"><i class="fa fa-times" aria-hidden="true"></i></button>
</div>

<script type="text/javascript">
$(function(){
//     $('div#error').hide();
//     $('div#succ').hide();
//   $('form#frm_manu').submit(function(e){
//       e.preventDefault();
//         var url = $(this).attr('action');
//         var postData = $(this).serialize();
//         $.post(url, postData, function (o) {
//             if (o.result == 1) {
//                 $('div#error').hide();
//                 $('div#succ').show().text('Manufacturer added successfully.');
//                 setTimeout(function () {
//                   window.location.reload();
//                 }, 1000);
//             } else if (o.result == 0) {
//                 $('div#error').show();
//                 var output = '<ul style="list-style: none" >';
//                 for (var key in o.error) {
//                     var value = o.error[key];
//                     output += '<li>' + value + '</li>';
//                 }
//                 output += '</ul>';
//                 $('div#error').html(output);
//             } else {
//                 $('div#error').show().text('Something went wrong here!');
//             }
//         }, 'json');
//   });
$('#man_name').change(function(){
    var va = $(this).val();
    str = va.replace(/\s+/g, '-').toLowerCase();
    $('#slug').val(str);
});

});
</script>