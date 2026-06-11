<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<section class="section profile">
    <div class="card">
        <div class="card-body pt-3">
            <h5 class="card-title">Profile Information</h5>
            
            <div class="row mb-3">
                <div class="col-lg-3 col-md-4 label">Username</div>
                <div class="col-lg-9 col-md-8">
                    <?= $username; ?> 
                    <span class="badge bg-danger"><?= $role; ?></span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-3 col-md-4 label">Email</div>
                <div class="col-lg-9 col-md-8 text-primary"><?= $email; ?></div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-3 col-md-4 label">Login Time</div>
                <div class="col-lg-9 col-md-8"><?= $login_time; ?></div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-3 col-md-4 label">Status</div>
                <div class="col-lg-9 col-md-8">
                    <span class="badge bg-success"><?= $status; ?></span>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>