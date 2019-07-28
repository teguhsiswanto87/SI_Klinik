<?php

include "../../../config/functions.php";
include "../../../model/Petugas.php";

$m = $_GET['m'];
$act = $_GET['act'];
$petugas = new Petugas();
$conn = dbConnect();
// input Petugas
if ($m == 'petugas' && $act == 'tambah') {

    $hasil = $petugas->getLastItemPetugas(); //dapatkan data id_petugas yang terakhir
    if (empty($hasil)) {
        $id_petugas = 'pa0001';
    } else {
        $ambilAngka = substr($hasil['id_petugas'], 2);
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
        $id_petugas = "pa$nol$incrementAngka";
    }

    $nama_pegawai = $conn->real_escape_string(my_inputformat(anti_injection($_POST['nama_pegawai']), 1));
    $alamat = $conn->real_escape_string(my_inputformat(anti_injection($_POST['alamat']), 1));
    $kontak = $conn->real_escape_string(my_inputformat(anti_injection($_POST['kontak']), 0));

    $insert = $petugas->insertPetugas($id_petugas, $nama_pegawai, $alamat, $kontak);
    if ($insert) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal Memasukkan data $m ";
    }
} elseif ($m == 'petugas' && $act == 'update') {
    $id_petugas = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id']), 0));
    $nama_pegawai = $conn->real_escape_string(my_inputformat(anti_injection($_POST['nama_pegawai']), 1));
    $alamat = $conn->real_escape_string(my_inputformat(anti_injection($_POST['alamat']), 1));
    $kontak = $conn->real_escape_string(my_inputformat(anti_injection($_POST['kontak']), 0));

    $update = $petugas->updatePetugas($id_petugas, $nama_pegawai, $alamat, $kontak);
    if ($update) {
        header("location: ../../media.php?m=" . $m);
    } else {


        echo "Gagal memperbarui data $m";
    }
} elseif ($m == 'petugas' && $act == 'hapus') {
    $delete = $petugas->deletePetugas($_GET['id']);
    if ($delete) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal menghapus data $m ID=$_GET[id]";
    }
} else {
    echo "gagal berak_si";
}
