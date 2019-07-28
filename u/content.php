<?php
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    header("location:index.php?error=8");
} else {
    include_once "../model/Module.php";

    //format tampil peringatan jika halaman yang bukan hak-nya diakses oleh orang tersebut --versi Edy Rahmayadi
    function warningText($halaman)
    {
        echo "Apa urusan Anda membuka halaman <b>$halaman</b> ? <br><br> 
                <i>- Edy Rahmayadi <small>mantan ketua PSSI</small></i>";
    }

    // adaptasi variabel dengan nama kolom di database
    if ($_SESSION['status'] == 'dirut') {
        $accessName = 'access_director';
    } else if ($_SESSION['status'] == 'dokter') {
        $accessName = 'access_doctor';
    } else {
        $accessName = 'access_admin';
    }

    //fungsi mengecek apakah user dengan jabatan tertentu boleh mengakses halamannya sesuai dengan database
    function moduleAccess($value, $accessName)
    {
        $module = new Module();
        if ($data = $module->getItemModuleBy("?m=$value", 'link')) {
            $yourAccess = $data[$accessName];
            if ($yourAccess == 'Y') {
                return true;
            } else {
                return warningText($value);
            }
        } else return false;
    }

    if ($_GET['m'] == 'pengguna') {
        if (moduleAccess($_GET['m'], $accessName))
            include "module/mod_pengguna/pengguna.php";
    } elseif ($_GET['m'] == 'module') {
        if (moduleAccess($_GET['m'], $accessName))
            include "module/mod_module/module.php";
    } elseif ($_GET['m'] == 'pasien') {
        if (moduleAccess($_GET['m'], $accessName))
            include "module/mod_pasien/pasien.php";
    } elseif ($_GET['m'] == 'petugas') {
        if (moduleAccess($_GET['m'], $accessName))
            include "module/mod_petugas/petugas.php";
    } elseif ($_GET['m'] == 'dokter') {
        if (moduleAccess($_GET['m'], $accessName))
            include "module/mod_dokter/dokter.php";
    } elseif ($_GET['m'] == 'direktur') {
        if (moduleAccess($_GET['m'], $accessName))
            include "module/mod_direktur/direktur.php";
    } elseif ($_GET['m'] == 'pemeriksaan') {
        if (moduleAccess($_GET['m'], $accessName))
            include "module/mod_pemeriksaan/pemeriksaan.php";
    } else {
        echo "Modul <b>$_GET[m]</b> sedang dibuat";
    }


//    if ($_GET['m'] == 'pengguna') {
////        if ($_SESSION['status'] == 'dirut') {
//        include "module/mod_pengguna/pengguna.php";
////        }
//    } elseif ($_GET['m'] == 'module') {
////        if ($_SESSION['status'] == 'dirut' || $_SESSION['status'] == 'admin') {
//        include "module/mod_module/module.php";
////        }
//    } elseif ($_GET['m'] == 'pasien') {
////        if ($_SESSION['status'] == 'dirut' || $_SESSION['status'] == 'petugas') {
//        include "module/mod_pasien/pasien.php";
////        }
//    } elseif ($_GET['m'] == 'petugas') {
////        if ($_SESSION['status'] == 'dirut' || $_SESSION['status'] == 'admin') {
//        include "module/mod_petugas/petugas.php";
////        }
//    } elseif ($_GET['m'] == 'dokter') {
////        if ($_SESSION['status'] == 'dirut' || $_SESSION['status'] == 'admin') {
//        include "module/mod_dokter/dokter.php";
////        }
//    } elseif ($_GET['m'] == 'direktur') {
////        if ($_SESSION['status'] == 'dirut' || $_SESSION['status'] == 'admin') {
//        include "module/mod_direktur/direktur.php";
////        }
//    } else {
//        echo "Modul <b>$_GET[m]</b> sedang dibuat";
//    }
}



