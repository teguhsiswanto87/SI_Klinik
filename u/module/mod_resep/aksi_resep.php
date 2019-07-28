<?php

include "../../../config/functions.php";
include "../../../model/Resep.php";

$m = $_GET['m'];
$act = $_GET['act'];
$resep = new Resep();
$conn = dbConnect();
// input Resep
if ($m == 'resep' && $act == 'tambah') {

    $hasil = $resep->getLastItemResep(); //dapatkan data id_resep yang terakhir
    if (empty($hasil)) {
        $id_resep = 'rd0001';
    } else {
        $ambilAngka = substr($hasil['id_resep'], 3);
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
        $id_resep = "rd$nol$incrementAngka";
    }

    $nama_resep = $conn->real_escape_string(my_inputformat(anti_injection($_POST['nama_resep']), 1));
    $jenis_obat = $conn->real_escape_string(my_inputformat(anti_injection($_POST['jenis_obat']), 1));
    $id_dokter = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id_dokter']), 0));
    $id_pasien = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id_pasien']), 0));

    $insert = $resep->insertresep($id_resep, $id_dokter, $id_pasien, $nama_resep, $jenis_obat);
    if ($insert) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal Memasukkan data $m ";
    }
} elseif ($m == 'resep' && $act == 'update') {
    $id_resep = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id']), 0));
    $nama_resep = $conn->real_escape_string(my_inputformat(anti_injection($_POST['nama_resep']), 1));
    $jenis_obat = $conn->real_escape_string(my_inputformat(anti_injection($_POST['jenis_obat']), 1));

    $update = $resep->updateResep($id_resep, $nama_resep, $jenis_obat);
    if ($update) {
        header("location: ../../media.php?m=" . $m);
    } else {


        echo "Gagal memperbarui data $m";
    }
} elseif ($m == 'resep' && $act == 'hapus') {
    $delete = $resep->deleteResep($_GET['id']);
    if ($delete) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal menghapus data $m ID=$_GET[id]";
    }
} else {
    echo "gagal berak_si";
}
