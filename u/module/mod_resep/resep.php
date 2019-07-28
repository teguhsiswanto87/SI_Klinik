<?php
// call Class Resep
include_once "../model/Resep.php";

$m = $_GET['m'];
$aksi = "module/mod_resep/aksi_resep.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$resep = new Resep();

switch ($act) {
    default: ?>
        <div class="ui stackable grid container">
            <div class="eleven wide column">
                <h2 class="">Tampil Resep Obat</h2>
            </div>
            <div class="four wide column">
                <a onclick=window.location.href="<?php echo "?m=$m&act=tambah"; ?>";
                   class="ui basic button right floated">
                    <i class="icon plus"></i>
                    Tambah Resep
                </a>
            </div>
            <div class="fifteen wide column">
                <table class="ui selectable very basic table">
                    <thead>
                    <tr>
                        <th class="one wide">ID_Resep</th>
                        <th class="one wide">ID_Dokter</th>
                        <th class="one wide">ID_Pasien</th>
                        <th class="one wide">Nama Resep</th>
                        <th class="one wide">Jenis Obat</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $dataUsers = $resep->getListResep();
                    foreach ($dataUsers as $data) {
                        echo "<tr>
                <td>$data[id_resep]</td>
                <td>$data[id_dokter]</td>
                <td>$data[id_pasien]</td>
                <td style='text-transform: capitalize;'>$data[nama_resep]</td>
                <td>$data[jenis_obat]</td>
                <td class='center aligned'>";
                        if ($data['id_resep'] != "") {
                            echo "<i class='checkmark green icon'></i>";
                        } else {
                            echo "<i class='minus icon'></i>";
                        }
                        echo "
                </td>
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
