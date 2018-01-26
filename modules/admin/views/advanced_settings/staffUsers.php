<div id="users">
    <h1><img src="<?= base_url('assets/imgs/admin-user.png') ?>" class="header-img" style="margin-top:-3px;"> Staff Users</h1> 
    <hr>
    <?php if (validation_errors()) { ?>
        <hr>
        <div class="alert alert-danger"><?= validation_errors() ?></div>
        <hr>
        <?php
    }
    if ($this->session->flashdata('result_add')) {
        ?>
        <hr>
        <div class="alert alert-success"><?= $this->session->flashdata('result_add') ?></div>
        <hr>
        <?php
    }
    if ($this->session->flashdata('result_delete')) {
        ?>
        <hr>
        <div class="alert alert-success"><?= $this->session->flashdata('result_delete') ?></div>
        <hr>
        <?php
    }
    ?>
    <a href="javascript:void(0);" data-toggle="modal" data-target="#add_edit_users1" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;"><b>+</b> Add new Staff user</a>
    <?php
    if ($staff_users) {
        ?>
        <table class="table table-striped custab">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Last login</th>
                    <!---<th class="text-center">Action</th>--->
                </tr>
            </thead>
            <?php foreach ($staff_users as $user) { ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><b>hidden ;)</b></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['phone'] ?></td>
                    <td><?= date('d.m.Y - H:m:s', $user['last_login']) ?></td>
                    <!---<td class="text-center">
                        <div>
                            <a href="?delete=<?= $user['id'] ?>" class="confirm-delete">Delete</a>
                            <a href="?edit=<?= $user['id'] ?>">Edit</a>
                        </div>
                    </td>--->
                </tr>
            <?php } ?>
            
        </table>
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