<style type="text/css">

    a.export,
    a.export:visited {
        display: inline-block;
        text-decoration: none;
        color: #000;
        background-color: #ddd;
        border: 1px solid #ccc;
        padding: 8px;
    }
</style>
<div id="users">
    <h1><img src="<?= base_url('assets/imgs/admin-user.png') ?>" class="header-img" style="margin-top:-3px;"> Customers</h1> 
    <hr>
    <input type="hidden" id="curr_time_stamp" value="<?php echo time(); ?>">
    <?php
    if ($customers) {
        ?>
        
        <table id="testTable" class="table table-striped custab"> 
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <?php foreach ($customers as $user) { ?>
                <tr>
                    <td><?= $user['user_id'] ?></td>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['phone'] ?></td>
                </tr>
            <?php } ?>
            
        </table>
        <input type="button" onclick="tableToExcel('testTable', 'W3C Example Table')" value="Export to Excel">
    <?php } else { ?>
        <div class="clearfix"></div><hr>
        <div class="alert alert-info">No users found!</div>
    <?php } ?>

    <!-- add edit users -->
    <div class="modal fade" id="add_edit_users1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div id="login_error" class="text-center" style="color: red;"></div> 
        	<div id="login_success" class="alert alert-success text-center"></div>
                <form action="<?= base_url('admin/staffusers/add_staff_members') ?>" method="POST" name="staff_form" id="staff_form" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Staff Members</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="added_by" id="added_by" value="<?php echo $this->session->userdata('admin_id'); ?>">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name"  class="form-control" id="name">
                            <div id="name_error" style="color: red;"></div>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username"  class="form-control" id="username">
                            <div id="username_error" style="color: red;"></div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                            <div id="password_error" style="color: red;"></div>
                        </div>
                        <div class="form-group">
                            <label for="con_password">Confirm Password</label>
                            <input type="password" name="con_password" class="form-control" id="con_password">
                            <div id="con_password_error" style="color: red;"></div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" id="email">
                            <div id="email_error" style="color: red;"></div>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" class="form-control" id="phone">
                            <div id="phone_error" style="color: red;"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    
                    	<button type="submit" class="btn btn-primary" id="submit_form">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
<?php if (isset($_GET['edit'])) { ?>
        $(document).ready(function () {
            $("#add_edit_users1").modal('show');
        });
<?php } ?>
</script>