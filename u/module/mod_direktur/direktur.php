<?php
// call Class Petugas
include_once "../model/Direktur.php";

$m = $_GET['m'];
$aksi = "module/mod_direktur/aksi_direktur.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$direktur = new Direktur();

switch ($act) {
    default: ?>
        <div class="ui stackable grid container">
            <div class="eleven wide column">
                <h2 class="">Tampil Direktur Utama</h2>
            </div>
            <div class="four wide column">
                <a onclick=window.location.href="<?php echo "?m=$m&act=tambah"; ?>";
                   class="ui basic button right floated">
                    <i class="icon plus"></i>
                    Tambah Direktur Utama
                </a>
            </div>
            <div class="fifteen wide column">
                <table class="ui selectable very basic table">
                    <thead>
                    <tr>
                        <th class="one wide">ID Direktur</th>
                        <th class="four wide">Nama_Direktur</th>
                        <th class="two wide center aligned">Akses Pengguna</th>
<!--                        <th class="four wide">Aksi</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $dataUsers = $direktur->getListDirektur();
                    foreach ($dataUsers as $data) {
                        echo "<tr>
                <td>$data[id_direktur]</td>
                <td style='text-transform: capitalize;'>$data[nama_direktur]</td>
                <td class='center aligned'>";
                        echo ($data['id_pengguna'] == '') ? "<i class='minus icon'></i>" : "<i class='checkmark green icon'></i>";
                        echo "
                </td>
                <td style='display: none;'>
                    <a href='?m=$m&act=edit&id=$data[id_direktur]'>Edit</a> | 
                    <a href='$aksi?m=$m&act=hapus&id=$data[id_direktur]'
                        onclick='return confirm(`Hapus $data[nama_direktur] ID=$data[id_direktur]?`);'>Hapus
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
                <h2>Tambah Direktur Utama</h2>
            </div>
        </div>
        <div class="ui stackable grid container">
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formDirektur"
                      onsubmit="return direkturValidation('tambah')"
                      action=<?php echo "$aksi?m=$m&act=tambah" ?>>
                    <div class="field">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_direktur" placeholder="Nama Lengkap" required>
                    </div>

                    <button class="ui basic primary button right floated" type="submit" name="btnDirekturAdd">
                        Tambahkan
                    </button>
                </form>
            </div>
        </div>
        <?php
        break;

    case "edit":
        $data = $direktur->getItemDirektur($_GET['id']); ?>

        <div class="ui stackable grid container">
            <div class="four wide column">
                <a onclick="self.history.back()" class="ui labeled icon button">
                    <i class="arrow left icon"></i>
                    Kembali
                </a>
            </div>
            <div class="eight wide column">
                <h2>Edit Direktur Utama</h2>
            </div>
        </div>
        <div class="ui stackable grid container">
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formDirektur"
                      onsubmit="return petugasValidation('update')"
                      action=<?php echo "$aksi?m=$m&act=update" ?>>
                    <input type="hidden" name="id" value="<?php echo $data['id_direktur']; ?>">
                    <div class="field">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_direktur" placeholder="<?php echo $data['nama_direktur']; ?>"
                               value="<?php echo $data['nama_direktur']; ?>" required>
                    </div>

                    <button class="ui basic primary button right floated" type="submit" name="btnDirekturAdd">
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
