<div class="row vh-100">
    <div class="col-6 position-relative p-0" id="logo-side">
        <img src="<?=base_url("assets/images/stripes.jpg")?>" alt="LACAD_LOGO.png" class="img-fluid vw-100 vh-100">
        <img src="<?=base_url("assets/images/LACAD_LOGO.png")?>" alt="LACAD_LOGO.png" class="img-fluid position-absolute top-50 start-50 translate-middle">
    </div>

    <div class="col-1 login-side p-0">

    </div>

    <div class="col-4 position-relative login-side pb-5">
        <div class="position-absolute top-50 start-50 translate-middle w-100">
            <p class="my-5">Log In</p>

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

            <form action="<?= base_url("LoginController/login_user"); ?>" method="post">

            <div class="mb-3 icons">
                <i class="bi bi-person-fill icon"></i>
                <input type="text" class="form-control p-3 rounded-4 input-field" id="username" name="username" placeholder="Username" required>
            </div>

            <div class="mb-3 icons">
                <i class="bi bi-lock-fill icon"></i>
                <input type="text" class="form-control p-3 rounded-4 input-field" id="password1" name="password1" placeholder="Password" required>
            </div>

            <a class="position-absolute end-0 link-light link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover" href="">Forgot Password?</a>

            <div class="d-grid my-5">
                <button type="submit" class="border-0 btn btn-primary p-3 rounded-4">Log In</button>
            </div>

            </form>

        </div>
    </div>

    <div class="col-1 login-side p-0">

    </div>
</div>