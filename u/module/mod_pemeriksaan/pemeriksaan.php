<?php
// call Class Pemeriksaan
include "../model/Pemeriksaan.php";

$m = $_GET['m'];
$aksi = "module/mod_pemeriksaan/aksi_pemeriksaan.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$pemeriksaan = new Pemeriksaan();

switch ($act) {
    default: ?>
        <div class="ui stackable grid container">
            <div class="eleven wide column">
                <h2 class="">Tampil Pemeriksaan</h2>
            </div>
            <div class="four wide column">
                <a onclick=window.location.href="<?php echo "?m=$m&act=tambah"; ?>";
                   class="ui basic button right floated">
                    <i class="icon plus"></i>
                    Tambah Pemeriksaan
                </a>
            </div>
            <div class="fifteen wide column">
                <table class="ui selectable very basic table">
                    <thead>
                    <tr>
                        <th class="one wide">ID</th>
                        <th class="one wide">Dokter</th>
                        <th class="one wide">Pasien</th>
                        <th class="two wide">Tanggal</th>
                        <th class="two wide">Nama pemeriksaan</th>
                        <th class="two wide">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $dataPemeriksaan = $pemeriksaan->getListPemeriksaan();
                    foreach ($dataPemeriksaan as $data) {
                        echo "<tr>
                <td>$data[id_pemeriksaan]</td>
                <td>$data[id_dokter]</td>
                <td>$data[id_pasien]</td>
                <td>$data[tgl_periksa]</td>
                <td>$data[nama_pemeriksaan]</td>
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
                    <div class="field">
                        <label>Nama pasien</label>
                        <?php

                        ?>
                        <select name="id_pasien" class="ui">
                            <option value=""></option>
                        </select>
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
                    <div class="field">
                        <label>Nama pasien</label>
                        <div class="ui labeled input">
                            <div class="ui label">dr.</div>
                            <input type="text" name="nama_pemeriksaan" placeholder="<?php echo $data['nama_pemeriksaan']; ?>"
                                   value="<?php echo substr($data['nama_pemeriksaan'], 3); ?>" required>
                        </div>
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
