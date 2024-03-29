<?php
// call Class Dokter
include "../model/Dokter.php";

$m = $_GET['m'];
$aksi = "module/mod_dokter/aksi_dokter.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$dokter = new Dokter();

switch ($act) {
    default: ?>
        <div class="ui stackable grid container">
            <div class="eleven wide column">
                <h2 class="">Tampil Dokter</h2>
            </div>
            <div class="four wide column">
                <a onclick=window.location.href="<?php echo "?m=$m&act=tambah"; ?>";
                   class="ui basic button right floated">
                    <i class="icon plus"></i>
                    Tambah Dokter
                </a>
            </div>
            <div class="fifteen wide column">
                <table class="ui selectable very basic table">
                    <thead>
                    <tr>
                        <th class="one wide">ID</th>
                        <th class="two wide">Nama Dokter</th>
                        <th class="four wide">Spesialisasi</th>
                        <th class="two wide">Jadwal</th>
                        <th class="two wide">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $dataUsers = $dokter->getListDokter();
                    foreach ($dataUsers as $data) {
                        echo "<tr>
                <td>$data[id_dokter]</td>
                <td>$data[nama_dokter]</td>
                <td>$data[spesialisasi]</td>
                <td>$data[jadwal]</td>
                <td>
                    <a href='?m=$m&act=edit&id=$data[id_dokter]'>Edit</a> | 
                    <a href='$aksi?m=$m&act=hapus&id=$data[id_dokter]'
                        onclick='return confirm(`Hapus $data[nama_dokter] ID=$data[id_dokter]?`);'>Hapus
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
                <h2>Tambah Dokter</h2>
            </div>
        </div>
        <div class="ui stackable grid container">
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formDokter"
                      onsubmit="return dokterValidation('tambah')"
                      action=<?php echo "$aksi?m=$m&act=tambah" ?>>
                    <div class="field">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_dokter" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="ui grid">
                        <div class="field eight wide column" id="passwordId">
                            <label>Spesialisasi</label>
                            <input type="text" name="spesialisasi" placeholder="Spesialisasi">
                        </div>
                        <div class="field eight wide column" id="confirmPasswordId">
                            <label>Jadwal</label>
                            <input type="text" name="jadwal" maxlength="13" placeholder="Jadwal">
                        </div>
                    </div>
                    <button class="ui basic primary button right floated" type="submit" name="btnDokterAdd">
                        Tambahkan
                    </button>
                </form>
            </div>
        </div>
        <?php
        break;

    case "edit":
        $data = $dokter->getItemDokter($_GET['id']); ?>

        <div class="ui stackable grid container">
            <div class="four wide column">
                <a onclick="self.history.back()" class="ui labeled icon button">
                    <i class="arrow left icon"></i>
                    Kembali
                </a>
            </div>
            <div class="eight wide column">
                <h2>Edit Dokter</h2>
            </div>
        </div>
        <div class="ui stackable grid container">
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formDokter"
                      onsubmit="return dokterValidation('update')"
                      action=<?php echo "$aksi?m=$m&act=update" ?>>
                    <input type="hidden" name="id" value="<?php echo $data['id_dokter']; ?>">
                    <div class="field">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_dokter" placeholder="<?php echo $data['nama_dokter']; ?>"
                               value="<?php echo $data['nama_dokter']; ?>" required>
                    </div>
                    <div class="ui grid">
                        <div class="field eight wide column" id="passwordId">
                            <label>Spesialisasi</label>
                            <input type="text" name="spesialisasi" placeholder="<?php echo $data['spesialisasi']; ?>"
                                   value="<?php echo $data['spesialisasi']; ?>">
                        </div>
                        <div class="field eight wide column" id="confirmPasswordId">
                            <label>Jadwal</label>
                            <input type="text" name="jadwal" maxlength="13"
                                   placeholder="<?php echo $data['jadwal']; ?>"
                                   value="<?php echo $data['jadwal']; ?>" " >
                        </div>
                    </div>
                    <button class="ui basic primary button right floated" type="submit" name="btnDokterAdd">
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
