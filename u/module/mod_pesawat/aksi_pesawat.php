<?php

include "../../../config/functions.php";

$m = $_GET['m'];
$act = $_GET['act'];
$airplane = new Airplane();
$conn = dbConnect();
// input Pengguna
if ($m === 'pesawat' && $act == 'tambah') {
    $producer = $conn->real_escape_string(my_inputformat(anti_injection($_POST['producer']), 1));
    $type = $conn->real_escape_string(my_inputformat(anti_injection($_POST['type']), 1));

    $insert = $airplane->insertAirplane($producer,$type);
    if ($insert) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal Memasukkan data $m ";
    }
} elseif ($m == 'pesawat' && $act == 'update') {
    $airplane_id = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id']), 0));
    $producer = $conn->real_escape_string(my_inputformat(anti_injection($_POST['producer']), 1));
    $type = $conn->real_escape_string(my_inputformat(anti_injection($_POST['type']), 1));

    $update = $airplane->updateAirplane($airplane_id,$producer,$type);
    if ($update) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal memperbarui data $m";
    }
} elseif ($m == 'pesawat' && $act == 'hapus') {
    $delete = $airplane->deleteAirplane($_GET['id']);
    if ($delete) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal menghapus data $m ID=$_GET[id]";
    }
} else {
    echo "gagal mengeksekusi CRUD";
}
