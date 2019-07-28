<?php

include "../../../config/functions.php";
include "../../../model/Dokter.php";

$m = $_GET['m'];
$act = $_GET['act'];
$dokter = new Dokter();
$conn = dbConnect();
// input Dokter
if ($m == 'dokter' && $act == 'tambah') {

    $hasil = $dokter->getLastItemDokter(); //dapatkan data id_dokter yang terakhir
    if (empty($hasil)) {
        $id_dokter = 'dk0001';
    } else {
        $ambilAngka = substr($hasil['id_dokter'], 2);
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
        $id_dokter = "dk$nol$incrementAngka";
    }

    $nama_dokter = $conn->real_escape_string(my_inputformat(anti_injection($_POST['nama_dokter']), 1));
    $spesialisasi = $conn->real_escape_string(my_inputformat(anti_injection($_POST['spesialisasi']), 1));
    $jadwal = $conn->real_escape_string(my_inputformat(anti_injection($_POST['jadwal']), 0));

    $insert = $dokter->insertDokter($id_dokter, 'dr.' . $nama_dokter, $spesialisasi, $jadwal);
    if ($insert) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal Memasukkan data $m ";
    }
} elseif ($m == 'dokter' && $act == 'update') {
    $id_dokter = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id']), 0));
    $nama_dokter = $conn->real_escape_string(my_inputformat(anti_injection($_POST['nama_dokter']), 1));
    $spesialisasi = $conn->real_escape_string(my_inputformat(anti_injection($_POST['spesialisasi']), 1));
    $jadwal = $conn->real_escape_string(my_inputformat(anti_injection($_POST['jadwal']), 0));

    $update = $dokter->updateDokter($id_dokter, 'dr.' . $nama_dokter, $spesialisasi, $jadwal);
    if ($update) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal memperbarui data $m";
    }
} elseif ($m == 'dokter' && $act == 'hapus') {
    $delete = $dokter->deleteDokter($_GET['id']);
    if ($delete) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal menghapus data $m ID=$_GET[id]";
    }
} else {
    echo "gagal berak_si";
}
