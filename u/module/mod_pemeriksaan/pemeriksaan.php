<?php
// call Class Pemeriksaan
include "../model/Pemeriksaan.php";
include "../model/Pasien.php";
include "../config/library.php";

$m = $_GET['m'];
$aksi = "module/mod_pemeriksaan/aksi_pemeriksaan.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$pemeriksaan = new Pemeriksaan();
$pasien = new Pasien();
$dokter = new Dokter();

switch ($act) {
    default: ?>
        <div class="ui stackable grid container">
            <div class="twelve wide column">
                <h2 class="">Tampil Pemeriksaan</h2>
            </div>
            <div class="four wide column">
                <a onclick=window.location.href="<?php echo "?m=$m&act=tambah"; ?>";
                   class="ui basic button right floated">
                    <i class="icon plus"></i>
                    Tambah Pemeriksaan
                </a>
            </div>
            <div class="sixteen wide column">
                <table class="ui selectable very basic table fixed">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Dokter</th>
                        <th>Pasien</th>
                        <th>Tanggal</th>
                        <th>Nama pemeriksaan</th>
                        <th>Hasil Periksa</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $dataPemeriksaan = $pemeriksaan->getListPemeriksaan();
                    foreach ($dataPemeriksaan as $data) {
                        echo "<tr>
                <td>$data[id_pemeriksaan]</td>
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
                <td>";
                        $tanggal = tgl_indo($data['tgl_periksa']);
                        echo "$tanggal
                </td>
                <td>$data[nama_pemeriksaan]</td>
                <td>$data[hasil_periksa]</td>
                <td>
                    <a href='?m=$m&act=edit&id=$data[id_pemeriksaan]'>Edit</a> | 
                    <a href='$aksi?m=$m&act=hapus&id=$data[id_pemeriksaan]'
                        onclick='return confirm(`Hapus $data[nama_pemeriksaan] ID=$data[id_pemeriksaan]?`);'>Hapus
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
                <h2>Tambah Pemeriksaan</h2>
            </div>
        </div>
        <div class="ui stackable grid container">
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formPemeriksaan"
                      onsubmit="return pemeriksaanValidation('tambah')"
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
                            $dataPasien = $pasien->getListPasien();
                            foreach ($dataPasien as $data) {
                                echo "<option value='$data[id_pasien]'>$data[nama_pasien]</option> ";
                            }
                            ?>

                        </select>
                    </div>

                    <div class="ui grid">
                        <div class="field sixteen wide column" id="passwordId">
                            <label>Nama Pemeriksaan</label>
                            <input type="text" name="nama_pemeriksaan" placeholder="Nama Pemeriksaan">
                        </div>
                    </div>
                    <div class="ui grid">
                        <div class="field sixteen wide column" id="confirmPasswordId">
                            <label>Hasil Periksa</label>
                            <textarea type="text" name="hasil_periksa"
                                      placeholder="Hasil Pemeriksaan oleh dokter"></textarea>
                        </div>
                    </div>
                    <br>
                    <button class="ui basic primary button right floated" type="submit" name="btnPemeriksaanAdd">
                        Tambahkan
                    </button>
                </form>
            </div>
        </div>
        <?php
        break;

    case "edit":
        $data = $pemeriksaan->getItemPemeriksaan($_GET['id']); ?>

        <div class="ui stackable grid container">
            <div class="four wide column">
                <a onclick="self.history.back()" class="ui labeled icon button">
                    <i class="arrow left icon"></i>
                    Kembali
                </a>
            </div>
            <div class="eight wide column">
                <h2>Edit Pemeriksaan</h2>
            </div>
        </div>
        <div class="ui stackable grid container">
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formPemeriksaan"
                      onsubmit="return pemeriksaanValidation('update')"
                      action=<?php echo "$aksi?m=$m&act=update" ?>>
                    <input type="hidden" name="id" value="<?php echo $data['id_pemeriksaan']; ?>">
                    <div class="ui grid">
                        <div class="field sixteen wide column" id="passwordId">
                            <label>Nama Pemeriksaan</label>
                            <input type="text" name="nama_pemeriksaan"
                                   placeholder="<?php echo $data['nama_pemeriksaan']; ?>"
                                   value="<?php echo $data['nama_pemeriksaan']; ?>" autofocus>
                        </div>
                    </div>
                    <div class="ui grid">
                        <div class="field sixteen wide column" id="confirmPasswordId">
                            <label>Hasil Periksa</label>
                            <textarea type="text" name="hasil_periksa"
                                      placeholder="<?php echo $data['hasil_periksa']; ?>"><?php echo $data['hasil_periksa']; ?></textarea>
                        </div>
                    </div>
                    <br>
                    <button class="ui basic primary button right floated" type="submit" name="btnPemeriksaanAdd">
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
