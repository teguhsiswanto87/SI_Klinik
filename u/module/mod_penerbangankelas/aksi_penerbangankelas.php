<?php

include "../../../config/functions.php";

$m = $_GET['m'];
$act = $_GET['act'];
$flightClass = new FlightClass();
$conn = dbConnect();
// input Pengguna
if ($m === 'penerbangankelas' && $act == 'tambah') {
    $class = $conn->real_escape_string(my_inputformat(anti_injection($_POST['class']), 1));

    $insert = $flightClass->insertFlightClass($class);
    if ($insert) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal Memasukkan data $m ";
    }
} elseif ($m == 'penerbangankelas' && $act == 'update') {
    $flight_class_id = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id']), 0));
    $class = $conn->real_escape_string(my_inputformat(anti_injection($_POST['class']), 1));

    $update = $flightClass->updateFlightClass($flight_class_id, $class);
    if ($update) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal memperbarui data $m";
    }
} elseif ($m == 'penerbangankelas' && $act == 'hapus') {
    $delete = $flightClass->deleteFlightClass($_GET['id']);
    if ($delete) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal menghapus data $m ID=$_GET[id]";
    }
} else {
    echo "gagal mengeksekusi CRUD";
}
