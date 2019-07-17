<?php
//session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    header("location:index.php?error=8");
} else {
//    include "../config/functions.php";


//    $dataModule = getListModule();
//    PAKAI CARA 2
//        $counter = 1;
//    foreach ($dataModule as $item) {
//        ($counter > 1)? $else="else":$else="";
//        $link_length = strlen($item['link']);
//        $equal_sign = strpos($item['link'], "=");
//        $ques_sign = strpos($item['link'], "?");
//        $ques_name = substr($item['link'], $ques_sign+1, ($equal_sign-$ques_sign)-1);
//        $equal_name = substr($item['link'], $equal_sign + 1, $link_length - strlen($ques_name)-2);
//
//        echo $_GET[$ques_name] . " === " . $equal_name . " $equal_sign $ques_sign -- $ques_name<br>";
//
//
//        $else;elseif ($_GET[$ques_name] == $equal_name) {
//            if ($_SESSION['position'] == 'admin') {
//                if (is_dir("module/mod_$equal_name")) {
//                    include "module/mod_$equal_name/$equal_name.php";
//                } else {
//                    echo "Folder belum dibuat<br>";
//                }
//            }
//        } else {
////            echo "<li>Modul <b>$_GET[$ques_name]</b> sedang dibuat<br>";
//        }
//        echo $counter++;
//    }


//    PAKAI CARA 1
    if ($_GET['m'] == 'pesawat') {
        if ($_SESSION['position'] == 'admin') {
            include "module/mod_pesawat/pesawat.php";
        }
    } elseif ($_GET['m'] == 'module') {
        if ($_SESSION['position'] == 'admin') {
            include "module/mod_module/module.php";
        }
    } elseif ($_GET['m'] == 'pengguna') {
        if ($_SESSION['position'] == 'admin') {
            include "module/mod_pengguna/pengguna.php";
        }
    } elseif ($_GET['m'] == 'penumpang') {
        if ($_SESSION['position'] == 'admin') {
            include "module/mod_penumpang/penumpang.php";
        }
    } elseif ($_GET['m'] == 'penerbangankelas') {
        if ($_SESSION['position'] == 'admin') {
            include "module/mod_penerbangankelas/penerbangankelas.php";
        }
    } elseif ($_GET['m'] == 'bookingstatus') {
        if ($_SESSION['position'] == 'admin') {
            include "module/mod_bookingstatus/bookingstatus.php";
        }
    } else {
        echo "Modul <b>$_GET[m]</b> sedang dibuat";
    }
}
