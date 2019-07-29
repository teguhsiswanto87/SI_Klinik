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


function terbilang($i)
{
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");

    if ($i < 12) return " " . $huruf[$i];
    elseif ($i < 20) return terbilang($i - 10) . " belas";
    elseif ($i < 100) return terbilang($i / 10) . " puluh" . terbilang($i % 10);
    elseif ($i < 200) return " seratus" . terbilang($i - 100);
    elseif ($i < 1000) return terbilang($i / 100) . " ratus" . terbilang($i % 100);
    elseif ($i < 2000) return " seribu" . terbilang($i - 1000);
    elseif ($i < 1000000) return terbilang($i / 1000) . " ribu" . terbilang($i % 1000);
    elseif ($i < 1000000000) return terbilang($i / 1000000) . " juta" . terbilang($i % 1000000);
}


?>

