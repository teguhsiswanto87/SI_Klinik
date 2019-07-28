<?php

include "../../../config/functions.php";
include "../../../model/Pasien.php";

$m = $_GET['m'];
$act = $_GET['act'];
$pasien = new Pasien();
$conn = dbConnect();
// input pasien
if ($m == 'pasien' && $act == 'tambah') {

    $hasil = $pasien->getLastItemPasien(); //dapatkan data id_petugas yang terakhir
    if (empty($hasil)) {
        $id_pasien = 'ps0001';
    } else {
        $ambilAngka = substr($hasil['id_pasien'], 2);
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
        $id_pasien = "ps$nol$incrementAngka";
    }

    $nama_pasien = $conn->real_escape_string(my_inputformat(anti_injection($_POST['nama_pasien']), 1));
    $tempat_lahir = $conn->real_escape_string(my_inputformat(anti_injection($_POST['tempat_lahir']), 1));
    $tgl_lahir = $conn->real_escape_string(my_inputformat(anti_injection($_POST['tgl_lahir']), 0));
    $jenis_kelamin = $conn->real_escape_string(my_inputformat(anti_injection($_POST['jenis_kelamin']), 0));
    $alamat = $conn->real_escape_string(my_inputformat(anti_injection($_POST['alamat']), 1));
    $kontak = $conn->real_escape_string(my_inputformat(anti_injection($_POST['kontak']), 0));

    $insert = $pasien->insertPasien($id_pasien, $nama_pasien, $tempat_lahir, $tgl_lahir, $jenis_kelamin, $alamat, $kontak);
    if ($insert) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal Memasukkan data $m ";
    }
} elseif ($m == 'pasien' && $act == 'update') {
    $id_pasien = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id']), 0));
    $nama_pasien = $conn->real_escape_string(my_inputformat(anti_injection($_POST['nama_pasien']), 1));
    $tempat_lahir = $conn->real_escape_string(my_inputformat(anti_injection($_POST['tempat_lahir']), 1));
    $tgl_lahir = $conn->real_escape_string(my_inputformat(anti_injection($_POST['tgl_lahir']), 0));
    $jenis_kelamin = $conn->real_escape_string(my_inputformat(anti_injection($_POST['jenis_kelamin']), 0));
    $alamat = $conn->real_escape_string(my_inputformat(anti_injection($_POST['alamat']), 1));
    $kontak = $conn->real_escape_string(my_inputformat(anti_injection($_POST['kontak']), 0));

//    echo "
//    id_pasien : $id_pasien<br>
//    nama pasien: $nama_pasien<br>
//    tempat Lahir: $tempat_lahir<br>
//    Tanggal Lahir: $tgl_lahir<br>
//    jenis kelamin: $jenis_kelamin<br>
//    alamat: $alamat<br>
//    kontak: $kontak<br>
//    ";
//
    $update = $pasien->updatePasien($id_pasien, $nama_pasien, $tempat_lahir, $tgl_lahir,$jenis_kelamin,$alamat,$kontak);

    if ($update) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal memperbarui data $m";
    }
} elseif ($m == 'pasien' && $act == 'hapus') {
    $delete = $pasien->deletePasien($_GET['id']);
    if ($delete) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal menghapus data $m ID=$_GET[id]";
    }
} else {
    echo "gagal beraksi";
}
