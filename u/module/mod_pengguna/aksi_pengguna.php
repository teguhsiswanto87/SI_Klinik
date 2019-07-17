<?php

include "../../../config/functions.php";
include "../../../model/Pengguna.php";

$m = $_GET['m'];
$act = $_GET['act'];
$pengguna = new Pengguna();
$conn = dbConnect();
// input Pengguna
if ($m === 'pengguna' && $act == 'tambah') {
    $username = $conn->real_escape_string(my_inputformat(anti_injection($_POST['username']), 0));
    $password = $conn->real_escape_string(my_inputformat(anti_injection($_POST['password']), 0));
    $nama = $conn->real_escape_string(my_inputformat(anti_injection($_POST['nama']), 1));

    $insert = $pengguna->insertPengguna($username, sha1($password), $nama);
    if ($insert) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal Memasukkan data $m ";
    }
} elseif ($m == 'pengguna' && $act == 'update') {
    $id_session = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id_session']), 0));
    $id_pengguna = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id']), 0));
    $username = $conn->real_escape_string(my_inputformat(anti_injection($_POST['username']), 0));
    $nama = $conn->real_escape_string(my_inputformat(anti_injection($_POST['nama']), 1));

    $update = $pengguna->updatePengguna($id_pengguna, $username, $nama, $id_session);
    if ($update) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal memperbarui data $m";
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
