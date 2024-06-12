<div class="content-area">
    <div class="subheader-container">
        <h2 class="subheader">Add User</h2>
</div>
<div class="field" role="alert">   
        <?= validation_errors('<div class="alert alert-danger rounded-2 m-1">', '</div>'); ?>
    </div>

    
<?php if($this->session->flashdata("success")): ?>
    <div class="alert alert-success rounded-2 m-1">   
        <?= $this->session->flashdata("success"); ?>
    </div>
<?php endif; ?>

<?php if($this->session->flashdata("error")): ?>
    <div class="alert alert-danger rounded-2 m-1">   
        <?= $this->session->flashdata("error"); ?>
    </div>
<?php endif; ?>

<?php if($this->session->flashdata("warning")): ?>
    <div class="alert alert-warning rounded-2 m-1">   
        <?= $this->session->flashdata("warning"); ?>
    </div>
<?php endif; ?>

    <div class="row">
        <form action="<?= base_url('UserManagementController/addUser'); ?>" method="post" enctype="multipart/form-data">

            <!-- Profile Picture Upload would go here -->
            <div class="form-group">
                <label for="role">User Type</label>
                <select class="form-select" aria-label="Default select example" name="role">
                    <option selected disabled>Select Role:</option>
                    <option value="SystemAdmin">System Admin</option>
                    <option value="Admin">Admin</option>
                    <option value="Staff">Staff</option>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Employee Name</label>
                <input type="text" class="form-control" id="emp_name" name="emp_name" placeholder="Ex. Juan Dela Cruz">
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="emp_username" name="emp_username" placeholder="Enter Username">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="exampleEmail@gmail.com">
            </div>

            <!-- Buttons -->
            <div class="button-container">
                <a href="<?= base_url("UserManagementController/index"); ?>" class="btn btn-secondary" role="button" aria-disabled="true">Cancel</a>
                <button type="submit" class="add-user-button">Add User</button>
            </div>
        </form>
    </div>
</div>
