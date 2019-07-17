<?php

include "../../../config/functions.php";

$m = $_GET['m'];
$act = $_GET['act'];
$users = new Users();
$conn = dbConnect();
// input Pengguna
if ($m === 'pengguna' && $act == 'tambah') {
    $username = $conn->real_escape_string(my_inputformat(anti_injection($_POST['username']), 0));
    $password = $conn->real_escape_string(my_inputformat(anti_injection($_POST['password']), 0));
    $full_name = $conn->real_escape_string(my_inputformat(anti_injection($_POST['full_name']), 1));
    $email = $conn->real_escape_string(my_inputformat(anti_injection($_POST['email']), 0));
    $phone = $conn->real_escape_string(my_inputformat(anti_injection($_POST['phone']), 0));
    $position = $conn->real_escape_string(my_inputformat(anti_injection($_POST['position']), 0));

    $insert = $users->insertUsers($username, sha1($password), $full_name, $email, $phone, $position, 'N');
    if ($insert) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal Memasukkan data $m ";
    }
} elseif ($m == 'pengguna' && $act == 'update') {
    $session = $conn->real_escape_string(my_inputformat(anti_injection($_POST['session']), 0));
    $username = $conn->real_escape_string(my_inputformat(anti_injection($_POST['username']), 0));
    $full_name = $conn->real_escape_string(my_inputformat(anti_injection($_POST['full_name']), 1));
    $email = $conn->real_escape_string(my_inputformat(anti_injection($_POST['email']), 0));
    $phone = $conn->real_escape_string(my_inputformat(anti_injection($_POST['phone']), 0));
//    $block = $conn->real_escape_string(my_inputformat(anti_injection(isset($_POST['active']) ? $_POST['active'] : 'N'), 0));

    $update = $users->updateUsers($full_name, $email, $phone, $username, $session);
    if ($update) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal memperbarui data $m";
    }
} elseif ($m == 'pengguna' && $act == 'hapus') {
    $delete = $users->deleteUsers($_GET['id']);
    if ($delete) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal menghapus data $m ID=$_GET[id]";
    }
} else {
    echo "gagal berak_si";
}
