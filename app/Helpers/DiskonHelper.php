<?php

function hitung_diskon($total_harga)
{
    if ($total_harga >= 50000000) {
        return 20;
    } elseif ($total_harga >= 25000000) {
        return 12;
    } elseif ($total_harga >= 15000000) {
        return 7;
    } elseif ($total_harga >= 5000000) {
        return 3;
    } else {
        return 0;
    }
}