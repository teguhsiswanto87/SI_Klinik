<?php

include "../../../config/functions.php";
include "../../../model/Direktur.php";

$m = $_GET['m'];
$act = $_GET['act'];
$direktur = new Direktur();
$conn = dbConnect();
// input direktur
if ($m == 'direktur' && $act == 'tambah') {

    $hasil = $direktur->getLastItemDirektur(); //dapatkan data id_petugas yang terakhir
    if (empty($hasil)) {
        $id_direktur = 'dr0001';
    } else {
        $ambilAngka = substr($hasil['id_direktur'], 2);
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
        $id_direktur = "dr$nol$incrementAngka";
    }

    $nama_direktur = $conn->real_escape_string(my_inputformat(anti_injection($_POST['nama_direktur']), 1));


    $insert = $direktur->insertDirektur($id_direktur, $nama_direktur);
    if ($insert) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal Memasukkan data $m ";
    }
} elseif ($m == 'direktur' && $act == 'update') {
    $id_direktur = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id']), 0));
    $nama_direktur = $conn->real_escape_string(my_inputformat(anti_injection($_POST['nama_direktur']), 1));

    $update = $direktur->updateDirektur($id_direktur, $nama_direktur);
    if ($update) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal memperbarui data $m";
    }
} elseif ($m == 'direktur' && $act == 'hapus') {
    $delete = $direktur->deleteDirektur($_GET['id']);
    if ($delete) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal menghapus data $m ID=$_GET[id]";
    }
} else {
    echo "gagal beraksi";
}
