<?php
// call Class Petugas
include "../model/Pasien.php";

$m = $_GET['m'];
$aksi = "module/mod_pasien/aksi_pasien.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$pasien = new Pasien();

switch ($act) {
    default: ?>
        <div class="ui stackable grid container">
            <div class="eleven wide column">
                <h2 class="">Tampil Pasien Utama</h2>
            </div>
            <div class="four wide column">
                <a onclick=window.location.href="<?php echo "?m=$m&act=tambah"; ?>";
                   class="ui basic button right floated">
                    <i class="icon plus"></i>
                    Tambah Pasien Utama
                </a>
            </div>
            <div class="fifteen wide column">
                <table class="ui selectable very basic table">
                    <thead>
                    <tr>
                        <th class="one wide">ID_Pasien</th>
                        <th class="four wide">Nama_Pasien</th>
                        <th class="three wide">Tempat_Lahir</th>
                        <th class="three wide">Tanggal_Lahir</th>
                        <th class="three wide">Jenis_kelamin</th>
                        <th class="four wide">Alamat</th>
                        <th class="four wide">Kontak</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $dataUsers = $pasien->getListPasien();
                    foreach ($dataUsers as $data) {
                        echo "<tr>
                <td>$data[id_pasien]</td>
                <td>$data[nama_pasien]</td>
                <td>$data[tempat_lahir]</td>
                <td>$data[tgl_lahir]</td>
                <td>$data[jenis_kelamin]</td>
                <td>$data[alamat]</td>
                <td>$data[kontak]</td>
                <td>
                    <a href='?m=$m&act=edit&id=$data[id_pasien]'>Edit</a> | 
                    <a href='$aksi?m=$m&act=hapus&id=$data[id_pasien]'
                        onclick='return confirm(`Hapus $data[nama_pasien] ID=$data[id_pasien]?`);'>Hapus
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
                <h2>Tambah Pasien Utama</h2>
            </div>
        </div>
        <div class="ui stackable grid container">
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formPasien"
                      onsubmit="return pasienValidation('tambah')"
                      action=<?php echo "$aksi?m=$m&act=tambah" ?>>
                    <div class="field">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_pasien" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="field">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" required>
                    </div>
                    <div class="field">
                        <label>Tanggal_Lahir</label>
                        <input type="text" name="tgl_lahir" placeholder="Tanggal Lahir" required>
                    </div>
                    <div class="ui form">
  
  <div class="grouped fields">
    <label for="fruit">Jenis Kelamin</label>
    <div class="field">
      <div class="ui radio checkbox">
        <input type="radio" name="fruit" checked="" tabindex="0" class="hidden">
        <label>Laki-Laki</label>
      </div>
    </div>
    <div class="field">
      <div class="ui radio checkbox">
        <input type="radio" name="fruit" tabindex="0" class="hidden">
        <label>Perempuan</label>
      </div>
    </div>
  </div>
</div>
                    <div class="field">
                        <label>Alamat</label>
                        <input type="text" name="alamat" placeholder="Alamat" required>
                    </div>
                    <div class="field">
                        <label>Kontak</label>
                        <input type="text" name="kontak" placeholder="Kontak" required>
                    </div>
                    
                    <button class="ui basic primary button right floated" type="submit" name="btnPasienAdd">
                        Tambahkan
                    </button>
                </form>
            </div>
        </div>
        <?php
        break;

    case "edit":
        $data = $pasien->getItemPasien($_GET['id']); ?>

        <div class="ui stackable grid container">
            <div class="four wide column">
                <a onclick="self.history.back()" class="ui labeled icon button">
                    <i class="arrow left icon"></i>
                    Kembali
                </a>
            </div>
            <div class="eight wide column">
                <h2>Edit Pasien Utama</h2>
            </div>
        </div>
        <div class="ui stackable grid container">
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formPasien"
                      onsubmit="return petugasValidation('update')"
                      action=<?php echo "$aksi?m=$m&act=update" ?>>
                    <input type="hidden" name="id" value="<?php echo $data['id_pasien']; ?>">
                    <div class="field">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_pasien" placeholder="<?php echo $data['nama_pasien']; ?>"
                               value="<?php echo $data['nama_pasien']; ?>" required>
                    </div>
                    
                    <button class="ui basic primary button right floated" type="submit" name="btnPasienAdd">
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
