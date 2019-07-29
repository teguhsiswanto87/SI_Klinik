<?php
// call Class Resep
include_once "../model/Resep.php";
include "../model/Pasien.php";

$m = $_GET['m'];
$aksi = "module/mod_resep/aksi_resep.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$resep = new Resep();
$pasien = new Pasien();

switch ($act) {
    default: ?>
        <div class="ui stackable grid container">
            <div class="twelve wide column">
                <h2 class="">Tampil Resep Obat</h2>
            </div>
            <div class="four wide column">
                <a onclick=window.location.href="<?php echo "?m=$m&act=tambah"; ?>";
                   class="ui basic button right floated">
                    <i class="icon plus"></i>
                    Tambah Resep
                </a>
            </div>
            <div class="sixteen wide column">
                <table class="ui selectable very basic fixed table">
                    <thead>
                    <tr>
                        <th>ID_Resep</th>
                        <th>Dokter</th>
                        <th>Pasien</th>
                        <th>Nama Resep</th>
                        <th>Jenis Obat</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $dataUsers = $resep->getListResep();
                    foreach ($dataUsers as $data) {
                        echo "<tr>
                <td>$data[id_resep]</td>
                <td>";
                        $dataDokter = $dokter->getItemDokter($data['id_dokter']);
                        $shortDoctorName = explode(' ', trim($dataDokter['nama_dokter']));
                        echo "dr.$shortDoctorName[1]";
                        echo "
                </td>
                <td>";
                        $dataPasien = $pasien->getItemPasien($data['id_pasien']);
                        $shortPasienName = explode(' ', trim($dataPasien['nama_pasien']));
                        echo "$shortPasienName[0]
                </td>
                <td style='text-transform: capitalize;'>$data[nama_resep]</td>
                <td>$data[jenis_obat]</td>
                <td>
                    <a href='?m=$m&act=edit&id=$data[id_resep]'>Edit</a> | 
                    <a href='$aksi?m=$m&act=hapus&id=$data[id_resep]'
                        onclick='return confirm(`Hapus $data[nama_resep] ID=$data[id_resep]?`);'>Hapus
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
                <h2>Tambah Resep Obat</h2>
            </div>
        </div>
        <div class="ui stackable grid container">
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formResep"
                      onsubmit="return resepValidation('tambah')"
                      action=<?php echo "$aksi?m=$m&act=tambah" ?>>
                    <?php
                    $dataDokter = $dokter->getItemDokterBy($_SESSION['id_pengguna'], 'id_pengguna');
                    echo "<input type='hidden' value='$dataDokter[id_dokter]' name='id_dokter'>";
                    ?>
                    <div class="field">
                        <label>Nama pasien</label>
                        <select name="id_pasien">
                            <option>--Pilih Pasien--</option>
                            <?php
                            $dataPasien = $pasien->getListPasienForRecipe();
                            foreach ($dataPasien as $data) {
                                echo "<option value='$data[id_pasien]'>$data[nama_pasien]</option> ";
                            }
                            ?>

                        </select>
                    </div>

                    <div class="field">
                        <label>Nama Resep</label>
                        <input type="text" name="nama_resep" placeholder="Nama Resep" required>
                    </div>
                    <div class="ui grid">
                        <div class="field eight wide column" id="passwordId">
                            <label>Jenis Obat</label>
                            <input type="text" name="jenis_obat" placeholder="Jenis Obat">
                        </div>
                    </div>
                    <button class="ui basic primary button right floated" type="submit" name="btnResepAdd">
                        Tambahkan
                    </button>
                </form>
            </div>
        </div>
        <?php
        break;

    case "edit":
        $data = $resep->getItemResep($_GET['id']); ?>

        <div class="ui stackable grid container">
            <div class="four wide column">
                <a onclick="self.history.back()" class="ui labeled icon button">
                    <i class="arrow left icon"></i>
                    Kembali
                </a>
            </div>
            <div class="eight wide column">
                <h2>Edit Resep Obat</h2>
            </div>
        </div>
        <div class="ui stackable grid container">
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formResep"
                      onsubmit="return resepValidation('update')"
                      action=<?php echo "$aksi?m=$m&act=update" ?>>
                    <input type="hidden" name="id" value="<?php echo $data['id_resep']; ?>">
                    <div class="field">
                        <label>Nama Resep</label>
                        <input type="text" name="nama_resep" placeholder="<?php echo $data['nama_resep']; ?>"
                               value="<?php echo $data['nama_resep']; ?>" required>
                    </div>
                    <div class="ui grid">
                        <div class="field eight wide column" id="passwordId">
                            <label>Jenis Obat</label>
                            <input type="text" name="jenis_obat" placeholder="<?php echo $data['jenis_obat']; ?>"
                                   value="<?php echo $data['jenis_obat']; ?>">
                        </div>
                    </div>
                    <button class="ui basic primary button right floated" type="submit" name="btnResepAdd">
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
