<?php
// call Class Petugas
include "../model/Petugas.php";

$m = $_GET['m'];
$aksi = "module/mod_petugas/aksi_petugas.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$petugas = new Petugas();

switch ($act) {
    default: ?>
        <div class="ui stackable grid container">
            <div class="eleven wide column">
                <h2 class="">Tampil Petugas Administrasi</h2>
            </div>
            <div class="four wide column">
                <a onclick=window.location.href="<?php echo "?m=$m&act=tambah"; ?>";
                   class="ui basic button right floated">
                    <i class="icon plus"></i>
                    Tambah Petugas
                </a>
            </div>
            <div class="fifteen wide column">
                <table class="ui selectable very basic table">
                    <thead>
                    <tr>
                        <th class="one wide">ID</th>
                        <th class="two wide">Nama Pegawai</th>
                        <th class="four wide">Alamat</th>
                        <th class="two wide">Kontak</th>
                        <th class="one wide">Akses Pengguna</th>
                        <th class="two wide">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $dataUsers = $petugas->getListPetugas();
                    foreach ($dataUsers as $data) {
                        echo "<tr>
                <td>$data[id_petugas]</td>
                <td style='text-transform: capitalize;'>$data[nama_pegawai]</td>
                <td>$data[alamat]</td>
                <td>$data[kontak]</td>
                <td class='center aligned'>";
                        if ($data['id_pengguna'] != "") {
                            echo "<i class='checkmark green icon'></i>";
                        } else {
                            echo "<i class='minus icon'></i>";
                        }
                        echo "
                </td>
                <td>
                    <a href='?m=$m&act=edit&id=$data[id_petugas]'>Edit</a> | 
                    <a href='$aksi?m=$m&act=hapus&id=$data[id_petugas]'
                        onclick='return confirm(`Hapus $data[nama_pegawai] ID=$data[id_petugas]?`);'>Hapus
                    </a>
                </td>
                </tr>";
                        $no++;
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
        break;

    case "tambah": ?>
        <div class="ui stackable grid">
            <div class="four wide column">
                <a onclick="self.history.back()" class="ui labeled icon button">
                    <i class="arrow left icon"></i>
                    Kembali
                </a>
            </div>
            <div class="eight wide column">
                <h2>Tambah Petugas Administrasi</h2>
            </div>
        </div>
        <div class="ui stackable grid container">
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formPetugas"
                      onsubmit="return petugasValidation('tambah')"
                      action=<?php echo "$aksi?m=$m&act=tambah" ?>>
                    <div class="field">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_pegawai" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="ui grid">
                        <div class="field eight wide column" id="passwordId">
                            <label>Alamat</label>
                            <input type="text" name="alamat" placeholder="Alamat">
                        </div>
                        <div class="field eight wide column" id="confirmPasswordId">
                            <label>Kontak</label>
                            <input type="text" pattern="\d*" name="kontak" maxlength="13" placeholder="Kontak">
                        </div>
                    </div>
                    <button class="ui basic primary button right floated" type="submit" name="btnPetugasAdd">
                        Tambahkan
                    </button>
                </form>
            </div>
        </div>
        <?php
        break;

    case "edit":
        $data = $petugas->getItemPetugas($_GET['id']); ?>

        <div class="ui stackable grid container">
            <div class="four wide column">
                <a onclick="self.history.back()" class="ui labeled icon button">
                    <i class="arrow left icon"></i>
                    Kembali
                </a>
            </div>
            <div class="eight wide column">
                <h2>Edit Petugas Administrasi</h2>
            </div>
        </div>
        <div class="ui stackable grid container">
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formPetugas"
                      onsubmit="return petugasValidation('update')"
                      action=<?php echo "$aksi?m=$m&act=update" ?>>
                    <input type="hidden" name="id" value="<?php echo $data['id_petugas']; ?>">
                    <div class="field">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_pegawai" placeholder="<?php echo $data['nama_pegawai']; ?>"
                               value="<?php echo $data['nama_pegawai']; ?>" required>
                    </div>
                    <div class="ui grid">
                        <div class="field eight wide column" id="passwordId">
                            <label>Alamat</label>
                            <input type="text" name="alamat" placeholder="<?php echo $data['alamat']; ?>"
                                   value="<?php echo $data['alamat']; ?>">
                        </div>
                        <div class="field eight wide column" id="confirmPasswordId">
                            <label>Kontak</label>
                            <input type="text" pattern="\d*" name="kontak" maxlength="13"
                                   placeholder="<?php echo $data['kontak']; ?>"
                                   value="<?php echo $data['kontak']; ?>" " >
                        </div>
                    </div>
                    <button class="ui basic primary button right floated" type="submit" name="btnPetugasAdd">
                        Perbarui
                    </button>
                </form>
            </div>
        </div>
        <?php
        break;

    case "gantipassword":

        break;
} ?>
