<?php
$hlm = "Home";
if(uri_string()!=""){
  $hlm = ucwords(uri_string());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>- Toko - <?php echo $hlm ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url()?>NiceAdmin/assets/img/favicon.png" rel="icon">
  <link href="<?= base_url()?>NiceAdmin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files (CDN — ganti ke local setelah folder vendor ada) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url()?>NiceAdmin/assets/css/style.css" rel="stylesheet">
</head>

<body>
  <main>
    <?= $this->renderSection('content') ?>
  </main>

  <!-- Bootstrap JS (CDN — ganti ke local setelah folder vendor ada) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url()?>NiceAdmin/assets/js/main.js"></script>

</body>

</html>
