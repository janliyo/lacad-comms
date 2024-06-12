<div class="content-area">
    <div class="subheader-container">
        <h2 class="subheader">Edit User</h2>
    </div>
    <div class="field" role="alert">
        <?= validation_errors('<div class="alert alert-danger rounded-2 m-1">', '</div>'); ?>
    </div>


    <?php if ($this->session->flashdata("success")) : ?>
        <div class="alert alert-success rounded-2 m-1">
            <?= $this->session->flashdata("success"); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata("error")) : ?>
        <div class="alert alert-danger rounded-2 m-1">
            <?= $this->session->flashdata("error"); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata("warning")) : ?>
        <div class="alert alert-warning rounded-2 m-1">
            <?= $this->session->flashdata("warning"); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <form action="<?= base_url('UserManagementController/editUser/').$user[0]["id"]; ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="image">Employee Image</label>
                <input type="file" class="form-control" id="image" name="image">
                <p>Current Image:<?php if ($user[0]["image"] != NULL) : ?>
                    <img src="<?= base_url("uploads/employees/") . $user[0]["image"]; ?>" alt="product.png">
                <?php else : ?>
                    <img src="<?= base_url("assets/images/default-profile.png"); ?>" alt="product.png" >
                <?php endif; ?>
                </p>
            </div>

            <div class="form-group">
                <label for="role">User Type</label>
                <select class="form-select" aria-label="Default select example" name="role">
                    <option selected disabled>Select Role:</option>
                    <option value="SystemAdmin" <?= $user[0]['role'] === 'SystemAdmin' ? 'selected' : ''; ?>>System Admin</option>
                    <option value="Admin" <?= $user[0]['role'] === 'Admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="Staff" <?= $user[0]['role'] === 'Staff' ? 'selected' : ''; ?>>Staff</option>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Employee Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Ex. Juan Dela Cruz" value="<?= $user[0]["name"]; ?>">
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" value="<?= $user[0]["username"]; ?>">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="exampleEmail@gmail.com" value="<?= $user[0]["email"]; ?>">
            </div>

            <div class="form-group">
                <label for="password1">Password</label>
                <input type="password" class="form-control" id="password1" name="password1" value="<?= $user[0]["password1"]; ?>">
            </div>

            <div class="form-group">
                <label for="password2">Confirm Password</label>
                <input type="password" class="form-control" id="password2" name="password2" value="<?= $user[0]["password2"]; ?>">
            </div>

            <!-- Buttons -->
            <div class="button-container">
                <a href="<?= base_url("UserManagementController/index"); ?>" class="btn btn-secondary" role="button" aria-disabled="true">Cancel</a>
                <button type="submit" class="add-user-button">Edit User</button>
            </div>
        </form>
    </div>
</div>