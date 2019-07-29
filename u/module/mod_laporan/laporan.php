<?php
// call Class Laporan
include "../model/Laporan.php";
include "../config/library.php";

$m = $_GET['m'];
$aksi = "module/mod_laporan/aksi_laporan.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$laporan = new Laporan();

switch ($act) {
    default: ?>
        <div class="ui stackable grid container">
            <div class="eleven wide column">
                <h2 class="">Laporan </h2>
            </div>
            <div class="four wide column">
                <!--                <a onclick=window.location.href="--><?php //echo "?m=$m&act=tambah"; ?>
                <!--                   class="ui basic button right floated">-->
                <!--                    <i class="icon plus"></i>-->
                <!--                    Tambah Laporan-->
                <!--                </a>-->
            </div>
            <div class="fifteen wide column">
                <div class="ui cards">
                    <div class="card">
                        <div class="content">
                            <div class="header">Jumlah Pasien Hari Ini</div>
                            <div class="meta">Tanggal : <?php echo tgl_indo(date("Y-m-d")); ?></div>
                            <div class="description">
                                <?php
                                $dataLaporan = $laporan->getJumlahPasien();
                                echo "<h1>$dataLaporan[jml] <small>Pasien</small></h1>";

                                ?>

                                Total Seluruh pasien yang telah melakukan pemeriksaan
                                <?php
                                $dataLaporan = $laporan->getJumlahPasienTotal();
                                echo "<h2>$dataLaporan[jml] <small>Pasien</small></h2>";

                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="content">
                            <div class="header"> Pendapatan dari Pembayaran Pengobatan Pasien</div>
                            <div class="meta">Jumlah yg sudah membayar:
                                <?php
                                $dataLaporan = $laporan->getTotalPasienBayar();
                                $nilai = $dataLaporan['transaksi'];
                                echo "<b>$nilai</b>";

                                ?>
                            </div>
                            <div class="description">
                                <?php
                                $dataLaporan = $laporan->getTotalPembayaran();
                                $nilai = number_format($dataLaporan['totalbiaya']);
                                echo "<h1><small>Rp </small>$nilai</h1>";

                                echo terbilang($dataLaporan['totalbiaya']);
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
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
                <h2>Tambah Laporan</h2>
            </div>
        </div>
        <div class="ui stackable grid container">
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formLaporan"
                      onsubmit="return laporanValidation('tambah')"
                      action=<?php echo "$aksi?m=$m&act=tambah" ?>>
                    <div class="field">
                        <label>Nama Lengkap</label>
                        <div class="ui labeled input">
                            <div class="ui label">dr.</div>
                            <input type="text" name="nama_laporan" placeholder="Nama Lengkap" required>
                        </div>
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
                    <button class="ui basic primary button right floated" type="submit" name="btnLaporanAdd">
                        Tambahkan
                    </button>
                </form>
            </div>
        </div>
        <?php
        break;

    case "edit":
        $data = $laporan->getItemLaporan($_GET['id']); ?>

        <div class="ui stackable grid container">
            <div class="four wide column">
                <a onclick="self.history.back()" class="ui labeled icon button">
                    <i class="arrow left icon"></i>
                    Kembali
                </a>
            </div>
            <div class="eight wide column">
                <h2>Edit Laporan</h2>
            </div>
        </div>
        <div class="ui stackable grid container">
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formLaporan"
                      onsubmit="return laporanValidation('update')"
                      action=<?php echo "$aksi?m=$m&act=update" ?>>
                    <input type="hidden" name="id" value="<?php echo $data['id_laporan']; ?>">
                    <div class="field">
                        <label>Nama Lengkap</label>
                        <div class="ui labeled input">
                            <div class="ui label">dr.</div>
                            <input type="text" name="nama_laporan" placeholder="<?php echo $data['nama_laporan']; ?>"
                                   value="<?php echo substr($data['nama_laporan'], 3); ?>" required>
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
                    <button class="ui basic primary button right floated" type="submit" name="btnLaporanAdd">
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
