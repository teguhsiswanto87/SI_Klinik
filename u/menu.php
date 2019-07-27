<?php
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    header("location:index.php?error=8");
} else {
    $dataModule = getListModule($_SESSION['status']);
    foreach ($dataModule as $data) {
        $module_name = str_replace(' ', '', strtolower($data['module_name']));
        ($_GET['m'] == $module_name) ? $active = "active" : $active = "";
        echo "<a href='$data[link]' class='item $active waves-effect' style='text-transform:capitalize;'>
           <i class='$data[icon] icon'></i>";
        if ($data['module_name'] == 'pasien') {
            echo "Pendaftaran Pasien";
        } elseif ($data['module_name'] == 'pembayaran') {
            echo "Pembayaran Pasien";
        } elseif ($data['module_name'] == 'resep') {
            echo "Pengelolaan Resep Obat";
        } elseif ($data['module_name'] == 'pemeriksaan') {
            echo "Pemeriksaan Pasien";
        } elseif ($data['module_name'] == 'laporan') {
            echo "Pembuatan Laporan & Cetak";
        } elseif ($data['module_name'] == 'petugas') {
            echo "Pengelolaan Data Petugas Administrasi";
        } elseif ($data['module_name'] == 'direktur') {
            echo "Pengelolaan Data Direktur Utama";
        } elseif ($data['module_name'] == 'dokter') {
            echo "Pengelolaan Data Dokter";
        } else {
            echo "$data[module_name]";
        }

        echo "
        </a>";
    }
}