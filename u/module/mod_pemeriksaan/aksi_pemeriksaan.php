<?php

include "../../../config/functions.php";
include "../../../model/Pemeriksaan.php";

$m = $_GET['m'];
$act = $_GET['act'];
$pemeriksaan = new pemeriksaan();
$conn = dbConnect();
// input pemeriksaan
if ($m == 'pemeriksaan' && $act == 'tambah') {

    $hasil = $pemeriksaan->getLastItempemeriksaan(); //dapatkan data id_pemeriksaan yang terakhir
    if (empty($hasil)) {
        $id_pemeriksaan = 'ip0001';
    } else {
        $ambilAngka = substr($hasil['id_pemeriksaan'], 2);
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
        $id_pemeriksaan = "ip$nol$incrementAngka";
    }

    $nama_pemeriksaan = $conn->real_escape_string(my_inputformat(anti_injection($_POST['nama_pemeriksaan']), 1));
    $hasil_periksa = $conn->real_escape_string(my_inputformat(anti_injection($_POST['hasil_periksa']), 1));
    $id_pasien = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id_pasien']), 0));
    $id_dokter = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id_dokter']), 0));
    $tgl_periksa = date("Y-m-d");

    $insert = $pemeriksaan->insertPemeriksaan($id_pemeriksaan, $id_dokter, $id_pasien, $nama_pemeriksaan, $hasil_periksa, $tgl_periksa);

    if ($insert) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal Memasukkan data $m ";
    }
} elseif ($m == 'pemeriksaan' && $act == 'update') {
    $id_pemeriksaan = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id']), 0));
    $nama_pemeriksaan = $conn->real_escape_string(my_inputformat(anti_injection($_POST['nama_pemeriksaan']), 1));
    $hasil_periksa = $conn->real_escape_string(my_inputformat(anti_injection($_POST['hasil_periksa']), 1));

    $update = $pemeriksaan->updatePemeriksaan($id_pemeriksaan, $nama_pemeriksaan, $hasil_periksa);
    if ($update) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal memperbarui data $m";
    }
} elseif ($m == 'pemeriksaan' && $act == 'hapus') {
    $delete = $pemeriksaan->deletepemeriksaan($_GET['id']);
    if ($delete) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal menghapus data $m ID=$_GET[id]";
    }
} else {
    echo "gagal berak_si";
}
