<?php

include "../../../config/functions.php";
include "../../../model/Pengguna.php";
include "../../../model/Dokter.php";
include "../../../model/Petugas.php";
include "../../../model/Direktur.php";

$m = $_GET['m'];
$act = $_GET['act'];
$pengguna = new Pengguna();
$dokter = new Dokter();
$petugas = new Petugas();
$direktur = new Direktur();
$conn = dbConnect();
// input Pengguna
if ($m === 'pengguna' && $act == 'tambah') {
    $cb_status_pengguna = $conn->real_escape_string(my_inputformat(anti_injection($_POST['cb_status_pengguna']), 0));
    $cb_akses_kepada = $conn->real_escape_string(my_inputformat(anti_injection($_POST['cb_akses_kepada']), 0));
    $username = $conn->real_escape_string(my_inputformat(anti_injection($_POST['username']), 0));
    $password = $conn->real_escape_string(my_inputformat(anti_injection($_POST['password']), 0));

//    echo "
//    Jabatan : $cb_status_pengguna <br>
//    Kepada : $cb_akses_kepada<br>
//    Username : $username<br>
//    pass: $password<br>
//    ".substr($username, 2);

    $hasil = $pengguna->getLastItemPengguna(); //dapatkan data id_petugas yang terakhir
    if (empty($hasil)) {
        $id_pengguna = 'pg0001';
    } else {
        $ambilAngka = substr($hasil['id_pengguna'], 2);
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
        $id_pengguna = "pg$nol$incrementAngka";
    }

    $insert = $pengguna->insertPengguna($id_pengguna, $username, sha1($password), $cb_status_pengguna, null);
    if ($insert) {
        if ($cb_status_pengguna == 'dirut') {
            $direktur->updateDirekturAksesPegguna($cb_akses_kepada, $id_pengguna);
//        echo "1 $cb_akses_kepada & $id_pengguna";
        } elseif ($cb_status_pengguna == 'dokter') {
            $dokter->updateDokterAksesPegguna($cb_akses_kepada, $id_pengguna);
//        echo "2 $cb_akses_kepada & $id_pengguna";
        } else {
            $petugas->updatePetugasAksesPegguna($cb_akses_kepada, $id_pengguna);
//        echo "3 $cb_akses_kepada & $id_pengguna";
        }

        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal Memasukkan data $m ";
    }
} elseif ($m == 'pengguna' && $act == 'update') {
    $id_session = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id_session']), 0));
    $id_pengguna = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id']), 0));
    $username = $conn->real_escape_string(my_inputformat(anti_injection($_POST['username']), 0));

    $update = $pengguna->updatePengguna($id_pengguna, $username, '', $id_session);
    if ($update) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal memperbarui data $m";
    }
} elseif ($m == 'pengguna' && $act == 'hapusakses') {

    $id_pengguna = $_GET['id'];
    $status = $_GET['status'];

    if ($status == 'dokter') {
        //ambil data dan simpan dulu
        $instanceDokter = $dokter->getItemDokterBy($id_pengguna, 'id_pengguna');
        //hapus
        $dokter->deleteDokterBy($id_pengguna, 'id_pengguna');
    } else {
        //ambil data dan simpan dulu
        $instancePetugas = $petugas->getItemPetugasBy($id_pengguna, 'id_pengguna');
        //hapus
        $petugas->deletePetugasBy($id_pengguna, 'id_pengguna');
    }


    $delete = $pengguna->deletePenggunaAksesPengguna($_GET['id']);
    if ($delete) {
        if ($status == 'dokter') {
            $dokter->insertDokter($instanceDokter['id_dokter'], $instanceDokter['nama_dokter'], $instanceDokter['spesialisasi'], $instanceDokter['jadwal']);
        } else {
            $petugas->insertPetugas($instancePetugas['id_petugas'], $instancePetugas['nama_pegawai'], $instancePetugas['alamat'], $instancePetugas['kontak']);
        }

        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal menghapus data $m ID=$_GET[id]";
    }
} elseif ($m == 'pengguna' && $act == 'hapus') {
    $delete = $pengguna->deletePengguna($_GET['id']);
    if ($delete) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal menghapus data $m ID=$_GET[id]";
    }
} else {
    echo "gagal berak_si";
}
