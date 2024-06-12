<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" style="background-color: #15171B!important;">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarNav" aria-controls="sidebarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="<?= base_url("DashboardController") ?>">
            <img src="<?= base_url("assets/images/logo-header-gray.png") ?>" alt="LACAD.png" id="logo3">
        </a>
        <div class="col text-center">
            <p><?= $page ?></p>
        </div>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="<?= base_url('user/profile') ?>" class="text-decoration-none text-light">
                    <div class="profile-group">
                        <?php if ($this->session->userdata("image")) : ?>
                            <img src="<?= base_url("uploads/employees/{$this->session->userdata('image')}") ?>" alt="profile.png" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
                        <?php else : ?>
                            <img src="<?= base_url("assets/images/default-profile.png") ?>" alt="profile.png" class="rounded-circle" style="width: 40px; height: 40px; left: 0; top: 0; margin-right: 10px;">
                        <?php endif; ?>
                        <div class="profile-info">
                            <p class="text-light"><?= $this->session->userdata("name") ?></p>
                            <p class="text-light"><?= $this->session->userdata("role") ?></p>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</nav>

<div class="sidebar bg-dark sticky-top">
    <div class="sidebar-nav collapse navbar-collapse show" id="sidebarNav">
        <ul class="nav flex-column">
            <?php if ($this->session->userdata("id")) : ?>
                <?php if ($this->session->userdata("role") != "Staff") : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url("DashboardController") ?>">
                            <i class="bi bi-bounding-box"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url("ReportsController") ?>">
                            <i class="bi bi-bar-chart-line"></i>
                            Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url("CctvController") ?>">
                            <i class="bi bi-bar-chart-line"></i>
                            CCTV
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ($this->session->userdata("role") != "Staff" || ($this->session->userdata("role") == "Staff")) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url("PosController") ?>">
                            <i class="bi bi-receipt-cutoff"></i>
                            POS
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url("InventoryController") ?>">
                            <i class="bi bi-person"></i>
                            Inventory
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url("ScheduleController") ?>">
                            <i class="bi bi-person"></i>
                            Schedule
                        </a>
                    </li>
                    <?php if ($this->session->userdata("role") == "SystemAdmin") : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url("UserManagementController") ?>">
                                <i class="bi bi-person"></i>
                                Users
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="signout nav-item">
                    <a href="<?= base_url("LoginController/signout") ?>" id="signout-link">
                        <i class="bi bi-box-arrow-right"></i>
                        Sign Out
                    </a>
                <?php endif; ?>
                <div>
        </ul>
    </div>
</div>