<?php

include "../../../config/functions.php";
include "../../../model/Module.php";

$m = $_GET['m'];
$act = $_GET['act'];
$module = new Module();
$conn = dbConnect();
// input modul
if ($m === 'module' && $act == 'tambah') {
    $module_name = $conn->real_escape_string(my_inputformat(anti_injection($_POST['module_name']), 1));
    $link = $conn->real_escape_string(my_inputformat(anti_injection($_POST['link']), 0));
    $icon = $conn->real_escape_string(my_inputformat(anti_injection($_POST['icon']), 1));
    $active = $conn->real_escape_string(my_inputformat(anti_injection(isset($_POST['active']) ? $_POST['active'] : 'N'), 0));
    $access_director = $conn->real_escape_string(my_inputformat(anti_injection(isset($_POST['access_director']) ? $_POST['access_director'] : 'N'), 0));
    $access_admin = $conn->real_escape_string(my_inputformat(anti_injection(isset($_POST['access_admin']) ? $_POST['access_admin'] : 'N'), 0));
    $access_doctor = $conn->real_escape_string(my_inputformat(anti_injection(isset($_POST['access_doctor']) ? $_POST['access_doctor'] : 'N'), 0));

    $insert = $module->insertModule($module_name, '?m=' . $link, $icon, $active, $access_director, $access_admin, $access_doctor);
    if ($insert) {
        header("location: ../../media.php?m=" . $m . "&info=1");
    } else {
        echo "Gagal Memasukkan data $m ";
    }
} elseif ($m == 'module' && $act == 'update') {
    $module_id = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id']), 0));
    $module_name = $conn->real_escape_string(my_inputformat(anti_injection($_POST['module_name']), 1));
    $link = $conn->real_escape_string(my_inputformat(anti_injection($_POST['link']), 0));
    $icon = $conn->real_escape_string(my_inputformat(anti_injection($_POST['icon']), 1));
    $active = $conn->real_escape_string(my_inputformat(anti_injection(isset($_POST['active']) ? $_POST['active'] : 'Y'), 0));
    $access_director = $conn->real_escape_string(my_inputformat(anti_injection(isset($_POST['access_director']) ? $_POST['access_director'] : 'N'), 0));
    $access_admin = $conn->real_escape_string(my_inputformat(anti_injection(isset($_POST['access_admin']) ? $_POST['access_admin'] : 'N'), 0));
    $access_doctor = $conn->real_escape_string(my_inputformat(anti_injection(isset($_POST['access_doctor']) ? $_POST['access_doctor'] : 'N'), 0));

    $update = $module->updateModule($module_id, $module_name, '?m=' . $link, $icon, $active, $access_director, $access_admin, $access_doctor);
    if ($update) {
        header("location: ../../media.php?m=" . $m . "&info=2");
    } else {
        echo "Gagal memperbarui data $m";
    }
} elseif ($m == 'module' && $act == 'hapus') {
    $delete = $module->deleteModule($_GET['id']);
    if ($delete) {
        header("location: ../../media.php?m=" . $m . "&info=3");
    } else {
        echo "Gagal menghapus data $m ID=$_GET[id]";
    }
} else {
    echo "gagal berak_si";
}
