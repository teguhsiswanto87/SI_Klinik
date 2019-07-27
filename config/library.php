<?php
//memang masih kosong

$tgl_sekarang = date("Ymd");
// format penanggalan di database MySQL
$tanggal = date("Y-m-d");

function format_rupiah($angka)
{
    $rupiah = number_format($angka, 0, ',', '.');
    return $rupiah;
}

function tgl_indo($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulanAngka = substr($tgl, 5, 2); // konversi menjadi nama bulan bahasa indonesia
    $bulan = ambilbulan(substr($tgl, 5, 2)); // konversi menjadi nama bulan bahasa indonesia
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

// fungsi untuk mengubah angka bulan menjadi nama bulan
function ambilbulan($bln)
{
    if ($bln == "01") return "Januari";
    elseif ($bln == "02") return "Februari";
    elseif ($bln == "03") return "Maret";
    elseif ($bln == "04") return "April";
    elseif ($bln == "05") return "Mei";
    elseif ($bln == "06") return "Juni";
    elseif ($bln == "07") return "Juli";
    elseif ($bln == "08") return "Agustus";
    elseif ($bln == "09") return "September";
    elseif ($bln == "10") return "Oktober";
    elseif ($bln == "11") return "November";
    elseif ($bln == "12") return "Desember";
}


?>

