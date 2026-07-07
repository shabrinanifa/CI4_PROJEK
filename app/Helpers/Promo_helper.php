<?php


function daftar_voucher()
{
    return [
        'PROMO2025'   => 10,
        'PROMO2026'   => 15,
        'AKHIRTAHUN'  => 25,
    ];
}


function hitung_biaya_jasa($total_harga)
{
    $total_harga = (float) $total_harga;

    if ($total_harga <= 10000000) {
        return $total_harga * 0.01;
    }

    return $total_harga * 0.02;
}


function hitung_diskon_voucher($total_harga, $voucher_code)
{
    $total_harga = (float) $total_harga;
    $voucher_code = strtoupper(trim((string) $voucher_code));

    $vouchers = daftar_voucher();

    if ($voucher_code === '' || !isset($vouchers[$voucher_code])) {
        return 0;
    }

    $persen = $vouchers[$voucher_code];

    return $total_harga * ($persen / 100);
}


function persen_diskon_voucher($voucher_code)
{
    $voucher_code = strtoupper(trim((string) $voucher_code));
    $vouchers = daftar_voucher();

    return $vouchers[$voucher_code] ?? 0;
}

/**
 * Menghitung nilai free mouse (hadiah langsung).
 * Diberikan senilai Rp 150.000 jika total belanja > Rp 15.000.000.
 */
function hitung_free_mouse($total_harga)
{
    $total_harga = (float) $total_harga;

    return $total_harga > 15000000 ? 150000 : 0;
}