<?php
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    header("location:index.php?error=8");
} else {
    $session = session_id();

    // set icon sesuai dengan status pengguna
    $dir_icon = "../assets/icons/";
    if ($_SESSION['status'] == 'dirut') {
        $icon = "ic_director.png";
    } else if ($_SESSION['status'] == 'dokter') {
        $icon = "ic_doctor.png";
    } else {
        $icon = "ic_admin.png";
    }

    ?>
    <div class="ui secondary pointing menu">
        <a class="active item ui label" style="text-transform: capitalize" title="Edit Akun"
           href=<?php echo "media.php?m=pengguna&act=edit&id=$_SESSION[id_pengguna]"; ?>>
            <img class="ui right spaced avatar image"
                 src=<?php echo "$dir_icon$icon"; ?>>
            <?php
            if ($_SESSION['status'] == 'dirut') {
                include_once "../model/Direktur.php";
                $direktur = new Direktur();
                $dataDirektur = $direktur->getItemDirekturBy($_SESSION['id_pengguna'], 'id_pengguna');
                echo $dataDirektur['nama_direktur'];
            } elseif ($_SESSION['status'] == 'dokter') {
                include_once "../model/Dokter.php";
                $dokter = new Dokter();
                $dataDokter = $dokter->getItemDokterBy($_SESSION['id_pengguna'], 'id_pengguna');
                echo $dataDokter['nama_dokter'];
            } else {
                include_once "../model/Petugas.php";
                $petugas = new Petugas();
                $dataPetugas = $petugas->getItemPetugasBy($_SESSION['id_pengguna'], 'id_pengguna');
                echo $dataPetugas['nama_pegawai'];
            }
            ?>
        </a>
        <a class="item" style="cursor: default; text-transform: capitalize;">
            <?php
            if ($_SESSION['status'] == 'dirut') {
                echo "Direktur Utama";
            } elseif ($_SESSION['status'] == 'dokter') {
                echo $_SESSION['status'];
            } else {
                echo "Petugas Administrasi";
            }

            ?>
        </a>
        <div class="right menu">
            <a class="ui item" id="btn-logout" type="submit">Logout</a>
        </div>
    </div>

<?php } ?>
