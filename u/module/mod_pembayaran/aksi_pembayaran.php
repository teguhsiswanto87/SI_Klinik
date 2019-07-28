<?php

include "../../../config/functions.php";
include "../../../model/Pembayaran.php";

$m = $_GET['m'];
$act = $_GET['act'];
$pembayaran = new Pembayaran();
$conn = dbConnect();
// input Pembayaran
if ($m == 'pembayaran' && $act == 'tambah') {

    $hasil = $pembayaran->getLastItemPembayaran(); //dapatkan data no_transaksi yang terakhir
    if (empty($hasil)) {
        $no_transaksi = 'pb0001';
    } else {
        $ambilAngka = substr($hasil['no_transaksi'], 3);
        $incrementAngka = (int)$ambilAngka + 1;
        // membuat angka 4 menjadi 0004 / 34 -> 0034 / 234 -> 0234
        if (strlen($incrementAngka) == 1) {
            $nol = '000';
        } elseif (strlen($incrementAngka) == 2) {
            $nol = '00';
        } elseif (strlen($incrementAngka) == 3) {
            $nol = '0';
        } else {
            $nol = '';
        }
        $no_transaksi = "pb$nol$incrementAngka";
    }

    $biaya = $conn->real_escape_string(my_inputformat(anti_injection($_POST['biaya']), 0));
    $id_petugas = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id_petugas']), 0));
    $id_pasien = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id_pasien']), 0));
    $tanggal = date("Y-m-d");

    //  echo"
    // $no_transaksi <br> 
    // $id_pasien <br> 
    // $id_petugas <br> 
    // $tanggal <br> 
    // $biaya <br> 
    // ";
    $insert = $pembayaran->insertPembayaran($no_transaksi, $id_pasien, $id_petugas, $tanggal, $biaya);
    if ($insert) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal Memasukkan data $m ";
    }
} elseif ($m == 'pembayaran' && $act == 'update') {
    $no_transaksi = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id']), 0));
    $biaya = $conn->real_escape_string(my_inputformat(anti_injection($_POST['biaya']), 0));

    $update = $pembayaran->updatePembayaran($no_transaksi, $biaya);
    if ($update) {
        header("location: ../../media.php?m=" . $m);
    } else {


        echo "Gagal memperbarui data $m";
    }
} elseif ($m == 'pembayaran' && $act == 'hapus') {
    $delete = $pembayaran->deletePembayaran($_GET['id']);
    if ($delete) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal menghapus data $m ID=$_GET[id]";
    }
} else {
    echo "gagal berak_si";
}
