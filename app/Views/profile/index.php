<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="pagetitle">
  <h1>Profile</h1>
</div>

<section class="section">
  <div class="card">
    <div class="card-body">

      <h5 class="card-title">Profile Information</h5>

      <table class="table">
        <tr>
          <td><b>Username</b></td>
          <td>
            <?= $username ?>
            <span class="badge bg-danger"><?= $role ?></span>
          </td>
        </tr>

        <tr>
          <td><b>Email</b></td>
          <td><?= $email ?></td>
        </tr>

        <tr>
          <td><b>Login Time</b></td>
          <td><?= $login_time ?></td>
        </tr>

        <tr>
          <td><b>Status</b></td>
          <td>
            <?php if ($status): ?>
              <span class="badge bg-success">Sudah Login</span>
            <?php else: ?>
              <span class="badge bg-secondary">Belum Login</span>
            <?php endif; ?>
          </td>
        </tr>
      </table>

    </div>
  </div>
</section>

<?= $this->endSection() ?>