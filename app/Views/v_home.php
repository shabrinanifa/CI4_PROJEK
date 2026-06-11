<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php
if (session()->getFlashData('success')) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>

<div class="row">
    <?php foreach ($products as $key => $item) : ?>         
            <div class="col-lg-6">
              <?= form_open('keranjang') ?>
              <?= form_hidden([
                  'id'    => $item['id'],
                  'nama'  => $item['nama'],
                  'harga' => $item['harga'],
                  'foto'  => $item['foto']]) ?>

                <div class="card">
                    <div class="card-body">
                        <img src="<?= base_url() . "img/" . $item['foto'] ?>" alt="..." width="50%">
                        <h5 class="card-title"><?= $item['nama'] ?><br><?= number_to_currency($item['harga'], 'IDR') ?></h5>
                        <button type="submit" class="btn btn-info rounded-pill">Beli</button>
                    </div>
                </div>

              <?= form_close() ?>
            </div> 
    <?php endforeach ?> 
</div>

  <!-- <table class="table datatable">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Position</th>
        <th scope="col">Age</th>
        <th scope="col">Start Date</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Brandon Jacob</td>
        <td>Designer</td>
        <td>28</td>
        <td>2016-05-25</td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Bridie Kessler</td>
        <td>Developer</td>
        <td>35</td>
        <td>2014-12-05</td>
      </tr>
      </tbody>
  </table> -->
  <?= $this->endSection() ?>