<?php

include "../../../config/functions.php";

$m = $_GET['m'];
$act = $_GET['act'];
$bookingStatus = new BookingStatusClass();
$conn = dbConnect();
// input Pengguna
if ($m === 'bookingstatus' && $act == 'tambah') {
    $status = $conn->real_escape_string(my_inputformat(anti_injection($_POST['status']), 1));

    $insert = $bookingStatus->insertBookingStatus($status);
    if ($insert) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal Memasukkan data $m ";
    }
} elseif ($m == 'bookingstatus' && $act == 'update') {
    $booking_status_id = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id']), 0));
    $status = $conn->real_escape_string(my_inputformat(anti_injection($_POST['status']), 1));

    $update = $bookingStatus->updateBookingStatus($booking_status_id, $status);
    if ($update) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal memperbarui data $m";
    }
} elseif ($m == 'bookingstatus' && $act == 'hapus') {
    $delete = $bookingStatus->deleteBookingStatus($_GET['id']);
    if ($delete) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal menghapus data $m ID=$_GET[id]";
    }
} else {
    echo "gagal mengeksekusi CRUD";
}
