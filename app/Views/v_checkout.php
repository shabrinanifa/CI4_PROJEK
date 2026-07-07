<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-6">
        <h5>Detail Pesanan</h5>
        <?= form_open('buy', 'class="row g-3"') ?>

<?= form_hidden('username', session()->get('username')) ?>
<?= form_input([
    'type' => 'hidden',
    'name' => 'total_harga',
    'id' => 'total_harga'
]) ?>

<div class="col-12">
    <?= form_label('Nama', 'nama', ['class' => 'form-label']) ?>
    <?= form_input([
        'name'     => 'nama',
        'id'       => 'nama',
        'class'    => 'form-control',
        'value'    => session()->get('username'),
        'readonly' => true]) ?>
</div>
<div class="col-12">
    <?= form_label('Alamat', 'alamat', ['class' => 'form-label']) ?>
    <?= form_input([
        'name'  => 'alamat',
        'id'    => 'alamat',
        'class' => 'form-control']) ?>
</div> 
<div class="col-12"> 
    <?= form_label('Kelurahan', 'kelurahan', ['class' => 'form-label']) ?>
    <?= form_dropdown('kelurahan', [], '', ['id' => 'kelurahan', 'class' => 'form-control']) ?>
</div>
<div class="col-12"> 
    <?= form_label('Layanan', 'layanan', ['class' => 'form-label']) ?> 
    <?= form_dropdown('layanan', [], '', ['id' => 'layanan', 'class' => 'form-control']) ?>
</div>
<div class="col-12">
    <?= form_label('Ongkir', 'ongkir', ['class' => 'form-label']) ?>
    <?= form_input([
        'name'     => 'ongkir',
        'id'       => 'ongkir',
        'class'    => 'form-control',
        'readonly' => true]) ?>
</div>
<div class="col-12">
    <?= form_label('Kode Voucher', 'voucher_code', ['class' => 'form-label']) ?>
    <?= form_input([
        'name'        => 'voucher_code',
        'id'          => 'voucher_code',
        'class'       => 'form-control',
        'placeholder' => 'Masukkan kode voucher (opsional)']) ?>
    <div class="form-text">
        Tersedia: PROMO2025 (10%), PROMO2026 (15%), AKHIRTAHUN (25%)
    </div>
    <div id="voucher-feedback" class="form-text"></div>
</div>
<div class="col-12">
    <?= form_submit(
        'submit',
        'Buat Pesanan',
        ['class' => 'btn btn-primary']) ?>
</div>

<?= form_close() ?> 

</div>
<div class="col-lg-6">
    <h5>Ringkasan Pesanan</h5>
        <table class="table">
  <thead>
      <tr>
          <th scope="col">Nama</th>
          <th scope="col">Harga</th>
          <th scope="col">Jumlah</th>
          <th scope="col">Sub Total</th>
      </tr>
  </thead>
  <tbody>
      <?php 
      if (!empty($items)) :
          foreach ($items as $index => $item) :
      ?>
              <tr>
                  <td><?= $item['name'] ?></td>
                  <td><?= number_to_currency($item['price'], 'IDR') ?></td>
                  <td><?= $item['qty'] ?></td>
                  <td><?= number_to_currency($item['price'] * $item['qty'], 'IDR') ?></td>
              </tr>
      <?php
          endforeach;
      endif;
      ?>
<tr>
    <td colspan="2"></td>
    <td>Subtotal</td>
    <td><span id="subtotal"><?= number_to_currency($total, 'IDR') ?></span></td>
</tr>
<tr>
    <td colspan="2"></td>
    <td style="color:red;">Diskon Voucher</td>
    <td style="color:red;">
        <span id="diskon-text">-IDR 0</span>
        <span id="diskon-persen" style="font-size:0.85em;"></span>
    </td>
</tr>
<tr>
    <td colspan="2"></td>
    <td>Biaya Jasa</td>
    <td><span id="biaya-jasa-text"><?= number_to_currency(0, 'IDR') ?></span></td>
</tr>
<tr>
    <td colspan="2"></td>
    <td style="color:green;">Free Mouse</td>
    <td style="color:green;"><span id="free-mouse-text">-IDR 0</span></td>
</tr>
<tr>
    <td colspan="2"></td>
    <td><strong>Subtotal (+Jasa-Voucher-Free Mouse)</strong></td>
    <td><strong><span id="subtotal-promo"><?= number_to_currency($total, 'IDR') ?></span></strong></td>
</tr>
<tr>
    <td colspan="2"></td>
    <td><strong>Grand Total (incl. Ongkir)</strong></td>
    <td><strong><span id="total"><?= number_to_currency($total, 'IDR') ?></span></strong></td>
</tr>
  </tbody>
</table>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
$(document).ready(function() {
    let ongkir = 0;
    let subtotal = <?= $total ?>; //

    // Daftar voucher promo (harus sinkron dengan app/Helpers/PromoHelper.php)
    const daftarVoucher = {
        'PROMO2025': 10,
        'PROMO2026': 15,
        'AKHIRTAHUN': 25
    };

    hitungTotal();

    function hitungBiayaJasa(subtotal) {
        return subtotal <= 10000000 ? subtotal * 0.01 : subtotal * 0.02;
    }

    function hitungDiskonVoucher(subtotal, kode) {
        kode = (kode || '').trim().toUpperCase();
        const persen = daftarVoucher[kode] || 0;
        return {
            persen: persen,
            nilai: Math.floor(subtotal * persen / 100)
        };
    }

    function hitungFreeMouse(subtotal) {
        return subtotal > 15000000 ? 150000 : 0;
    }

    function formatIDR(angka) {
        return `IDR ${Math.round(angka).toLocaleString('id-ID')}`;
    }

    function hitungTotal() {
        const kodeVoucher = $('#voucher_code').val();
        const biayaJasa = hitungBiayaJasa(subtotal);
        const { persen, nilai: nilaiDiskon } = hitungDiskonVoucher(subtotal, kodeVoucher);
        const freeMouse = hitungFreeMouse(subtotal);

        const subtotalPromo = subtotal + biayaJasa - nilaiDiskon - freeMouse;
        const grandTotal = subtotalPromo + ongkir;

        $('#ongkir').val(ongkir);
        $('#subtotal').text(formatIDR(subtotal));
        $('#biaya-jasa-text').text(formatIDR(biayaJasa));
        $('#subtotal-promo').text(formatIDR(subtotalPromo));
        $('#total').text(formatIDR(grandTotal));
        $('#total_harga').val(Math.round(grandTotal));

        if (persen > 0) {
            $('#diskon-text').text(`-${formatIDR(nilaiDiskon)}`);
            $('#diskon-persen').text(`(${persen}%)`);
            $('#voucher-feedback').html('<span class="text-success">Voucher valid, diskon ' + persen + '% diterapkan.</span>');
        } else {
            $('#diskon-text').text('-IDR 0');
            $('#diskon-persen').text('');
            if ((kodeVoucher || '').trim() !== '') {
                $('#voucher-feedback').html('<span class="text-danger">Kode voucher tidak valid.</span>');
            } else {
                $('#voucher-feedback').html('');
            }
        }

        if (freeMouse > 0) {
            $('#free-mouse-text').text(`-${formatIDR(freeMouse)} (Free Mouse)`);
        } else {
            $('#free-mouse-text').text('-IDR 0');
        }
    }

    $('#voucher_code').on('input', function () {
        hitungTotal();
    });

    // Inisialisasi Select2 Kelurahan
    $('#kelurahan').select2({
        placeholder: 'Cari daerah tujuan',
        minimumInputLength: 3, 
        ajax: {
            url: '<?= site_url('ajax/destinations') ?>', //
            dataType: 'json',
            delay: 300,
            data: function(params) {
                return {
                    q: params.term
                };
            },
            processResults: function(data) {
                // Di controller Anda membungkus datanya dengan array 'results'
                // Maka di sini harus diarahkan ke data.results
                return {
                    results: data.results
                };
            },
            cache: true
        }
    });

    // Jalankan pencarian biaya ongkir HANYA saat kelurahan diubah/dipilih
    $("#kelurahan").on('change', function () {
        let id_kelurahan = $(this).val(); //

        $("#layanan").empty();
        ongkir = 0;
        hitungTotal(); 

        if (id_kelurahan) {
            $.ajax({
                url: "<?= site_url('ajax/costs') ?>", //
                dataType: "json",
                data: {
                    destination: id_kelurahan
                },
                success: function (data) { 
                    $("#layanan").append($('<option>', { value: '', text: '- Pilih Layanan -' }));
                    data.forEach(function (item) {
                        $("#layanan").append(
                            $('<option>', {
                                value: item.cost,
                                text: `${item.description} (${item.service}) : estimasi ${item.etd}`
                            })
                        );
                    });
                }
            });
        }
    });

    $("#layanan").on('change', function() {
        ongkir = parseInt($(this).val()) || 0;
        hitungTotal();
    }); 
});
</script>
<?= $this->endSection() ?>