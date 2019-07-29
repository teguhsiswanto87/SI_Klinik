<?php
// call Class Pembayaran
include_once "../model/Pembayaran.php";
include_once "../model/Pasien.php";
include_once "../model/Dokter.php";
include_once "../config/library.php";

$m = $_GET['m'];
$aksi = "module/mod_pembayaran/aksi_pembayaran.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$pembayaran = new Pembayaran();
$pasien = new Pasien();
$petugas = new Petugas();

switch ($act) {
    default: ?>
        <div class="ui stackable grid container">
            <div class="eleven wide column">
                <h2 class="">Tampil Pembayaran </h2>
            </div>
            <div class="four wide column">
                <a onclick=window.location.href="<?php echo "?m=$m&act=tambah"; ?>";
                   class="ui basic button right floated">
                    <i class="icon plus"></i>
                    Tambah Pembayaran
                </a>
            </div>
            <div class="fifteen wide column">
                <table class="ui selectable very basic table">
                    <thead>
                    <tr>
                        <th class="one wide">NO_Transaksi</th>
                        <th class="one wide">ID_Pembayaran</th>
                        <th class="one wide">ID_Petugas</th>
                        <th class="one wide">Tanggal</th>
                        <th class="one wide">Biaya</th>
                        <th class="one wide">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $dataPembayaran = $pembayaran->getListPembayaran();
                    foreach ($dataPembayaran as $data) {
                        echo "<tr>
                <td>$data[no_transaksi]</td>
                <td>$data[id_pasien]</td>
                <td>$data[id_petugas]</td>
                <td>";
                    $tgl = tgl_indo($data['tgl']);
                    echo " $tgl
                </td>
                <td>Rp $data[biaya]</td>   
                <td>
                    <a href='?m=$m&act=edit&id=$data[no_transaksi]'>Edit</a> | 
                    <a href='$aksi?m=$m&act=hapus&id=$data[no_transaksi]'
                        onclick='return confirm(`Hapus $data[no_transaksi] ID=$data[no_transaksi]?`);'>Hapus
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
                <h2>Tambah Pembayaran</h2>
            </div>
        </div>
        <div class="ui stackable grid container">
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formPembayaran"
                      onsubmit="return pembayaranValidation('tambah')"
                      action=<?php echo "$aksi?m=$m&act=tambah" ?>>
                            <?php
                    $dataPetugas = $petugas->getItemPetugasBy($_SESSION['id_pengguna'], 'id_pengguna');
                        echo "<input type='hidden' value='$dataPetugas[id_petugas]' name='id_petugas'>";
                    ?>
                      <div class="field">
                        <label>Nama pasien</label>
                        <select name="id_pasien">
                            <option>--Pilih Pasien--</option>
                            <?php
                            $dataPasien = $pasien->getListPasienForPembayaran();
                            foreach ($dataPasien as $data) {
                                echo "<option value='$data[id_pasien]'>$data[nama_pasien]</option> ";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="ui grid">
                        <div class="field eight wide column" id="passwordId">
                            <label>Biaya</label>
                            <input type="number" name="biaya" placeholder="Biaya">
                        </div>
                    </div>
                    <button class="ui basic primary button right floated" type="submit" name="btnPembayaranAdd">
                        Tambahkan
                    </button>
                </form>
            </div>
        </div>
        <?php
        break;

    case "edit":
        $data = $pembayaran->getItemPembayaran($_GET['id']); ?>

        <div class="ui stackable grid container">
            <div class="four wide column">
                <a onclick="self.history.back()" class="ui labeled icon button">
                    <i class="arrow left icon"></i>
                    Kembali
                </a>
            </div>
            <div class="eight wide column">
                <h2>Edit Pembayaran</h2>
            </div>
        </div>
        <div class="ui stackable grid container">
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formPembayaran"
                      onsubmit="return pembayaranValidation('update')"
                      action=<?php echo "$aksi?m=$m&act=update" ?>>
                    <input type="hidden" name="id" value="<?php echo $data['no_transaksi']; ?>">
                    <div class="ui grid">
                        <div class="field eight wide column" id="passwordId">
                            <label>Biaya</label>
                            <input type="text" name="biaya" placeholder="<?php echo $data['biaya']; ?>"
                                   value="<?php echo $data['biaya']; ?>">
                        </div>
                    </div>
                    <button class="ui basic primary button right floated" type="submit" name="btnPembayaranAdd">
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
