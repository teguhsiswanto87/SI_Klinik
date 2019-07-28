<?php
// call Class Module
//include_once "../model/Module.php";

$m = $_GET['m'];
$aksi = "module/mod_module/aksi_module.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$module = new Module();

switch ($act) {
    default: ?>
        <div class="ui stackable grid container">
            <div class="twelve wide column">
                <h2 class="">Tampil Module</h2>
            </div>
            <div class="four wide column">
                <a onclick=window.location.href="<?php echo "?m=$m&act=tambah"; ?>"
                   class="ui basic button right floated">
                    <i class="icon plus"></i>
                    Tambah Module
                </a>
            </div>
            <div class="sixteen wide column">
                <?php
                // show notification
                $info = new InfoCheck();
                $info->checkInfo("info");
                ?>
                <table class="ui selectable very basic structured table">
                    <thead>
                    <tr>
                        <th class="one wide" rowspan="2">ID</th>
                        <th class="three wide" rowspan="2">Nama Modul</th>
                        <th class="three wide" rowspan="2">Link</th>
                        <th class="one wide" rowspan="2">Ikon</th>
                        <th class="one wide" rowspan="2">Aktif</th>
                        <th class="four wide center aligned" colspan="3">Hak Akses</th>
                        <th class="two wide center aligned" rowspan="2">Aksi</th>
                    </tr>
                    <tr>
                        <th class="center aligned">Direktur</th>
                        <th class="center aligned">Petugas Adm.</th>
                        <th class="center aligned">Dokter</th>
                    </tr>

                    </thead>
                    <tbody>
                    <?php
                    $dataModule = $module->getListModule();
                    foreach ($dataModule as $data) {
                        echo "
                    <tr>
                        <td>$data[module_id]</td>
                        <td>$data[module_name]</td>
                        <td>$data[link]</td>
                        <td>$data[icon]</td>
                        <td>$data[active]</td>
                        <td class='center aligned'>";
                        if ($data['access_director'] == 'Y') {
                            echo "<i class='green checkmark icon'></i>";
                        }
                        echo "
                        </td>
                        <td class='center aligned'>";
                        if ($data['access_admin'] == 'Y') {
                            echo "<i class='green checkmark icon'></i>";
                        }
                        echo "
                        </td>
                        <td class='center aligned'>";
                        if ($data['access_doctor'] == 'Y') {
                            echo "<i class='green checkmark icon'></i>";
                        }
                        echo "
                        </td>
                        <td class='center aligned'>
                            <a href='?m=$m&act=edit&id=$data[module_id]'>Edit</a> | ";
                        if ($data['module_id'] > 11) {
                            echo "<a id='btn-delete' style='cursor: pointer;'
                                     onclick='deleteData(`$aksi?m=$m&act=hapus&id=$data[module_id]`,
                                                            `$data[module_id]`,
                                                            `$m <b>$data[module_name]</b> ? `)'>Hapus</a>";
                        }
                        // href='$aksi?m=$m&act=hapus&id=$data[module_id]'
                        // onclick='return confirm(`Hapus modul $data[module_name] ID=$data[module_id]?`);'
                        echo "
                        </td>
                    </tr>";
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
                <h2>Tambah Module</h2>
            </div>
        </div>
        <div class="ui stackable grid container">
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formModule" onsubmit="return moduleValidation()"
                      action=<?php echo "$aksi?m=$m&act=tambah" ?>>
                    <div class="field">
                        <label>Nama Modul</label>
                        <input type="text" name="module_name" placeholder="Nama Modul" autofocus>
                    </div>
                    <div class="field">
                        <label>Link (contoh => ?m=namamodule)</label>
                        <div class="ui labeled input">
                            <div class="ui label">?m=</div>
                            <input type="text" name="link" placeholder="Nama modul">
                        </div>
                    </div>
                    <div class="field">
                        <label>Ikon</label>
                        <input type="text" name="icon" placeholder="Ikon">
                        <small>Referensi ikon: <a href="https://semantic-ui.com/elements/icon.html" target="_blank">Open
                                New Tab</a></small>
                    </div>
                    <div class="inline fields">
                        <label for="access_director">Hak Akses</label>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="access_director" value="Y" tabindex="0" checked>
                                <label for="access_director">Direktur</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="access_admin" value="Y" tabindex="0">
                                <label for="access_admin">Petugas Administrasi</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="access_doctor" value="Y" tabindex="0">
                                <label for="access_doctor">Dokter</label>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>Aktif</label>
                        <div class="ui toggle checkbox">
                            <input type="checkbox" name="active" value="Y" checked>
                            <label>Tampilkan di Menu Admin</label>
                        </div>
                    </div>
                    <button class="ui basic primary button right floated" type="submit">Tambahkan</button>
                </form>
            </div>
        </div>
        <?php
        break;
    case "edit":
        $data = $module->getItemModule($_GET['id']); ?>

        <div class="ui stackable grid container">
            <div class="four wide column">
                <a onclick="self.history.back()" class="ui labeled icon button">
                    <i class="arrow left icon"></i>
                    Kembali
                </a>
            </div>
            <div class="eight wide column">
                <h2>Edit Module</h2>
            </div>
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formModule"
                      action="<?php echo "$aksi?m=$m&act=update"; ?>"
                      onsubmit="return moduleValidation()">
                    <input type="hidden" name="id" value="<?php echo $data['module_id']; ?>">
                    <div class="field">
                        <label>Nama Modul</label>
                        <input type="text" name="module_name" placeholder="<?php echo $data['module_name']; ?>"
                               value="<?php echo $data['module_name'] ?>" autofocus>
                    </div>
                    <?php
                    //menghapus ?m= supaya lebih mudah dalam mengisi nama module
                    (strpos($data['link'], '?m=') == false) ? $data['link'] = substr($data['link'], 3) : '';
                    ?>
                    <div class="field">
                        <label>Link <i>(contoh : namamodul)</i> </label>
                        <div class="ui labeled input">
                            <div class="ui label">?m=</div>
                            <input type="text" name="link" placeholder="<?php echo $data['link']; ?>"
                                   value="<?php echo $data['link']; ?>">
                        </div>
                    </div>
                    <div class="field">
                        <label>Ikon</label>
                        <input type="text" name="icon" placeholder="<?php echo $data['icon']; ?>"
                               value="<?php echo $data['icon']; ?>">
                        <small>Referensi Icon: <a href="https://semantic-ui.com/elements/icon.html" target="_blank">Open
                                New Tab</a></small>
                    </div>

                    <div class="inline fields">
                        <label for="access_director">Hak Akses</label>
                        <div class="field">
                            <div class="ui checkbox">
                                <?php ($data['access_director'] == 'Y') ? $checked_director = 'checked' : $checked_director = ''; ?>
                                <input type="checkbox" name="access_director" value="Y"
                                       tabindex="0" <?php echo $checked_director; ?>>
                                <label for="access_director">Direktur</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <?php ($data['access_admin'] == 'Y') ? $checked_admin = 'checked' : $checked_admin = ''; ?>
                                <input type="checkbox" name="access_admin" value="Y"
                                       tabindex="0" <?php echo $checked_admin; ?>>
                                <label for="access_admin">Petugas Administrasi</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <?php ($data['access_doctor'] == 'Y') ? $checked_doctor = 'checked' : $checked_doctor = ''; ?>
                                <input type="checkbox" name="access_doctor" value="Y"
                                       tabindex="0" <?php echo $checked_doctor; ?>>
                                <label for="access_doctor">Dokter</label>
                            </div>
                        </div>
                    </div>
                    <?php
                    // jika yang diedit adalah module maka sembunyikan fitur untuk menonaktifkan menu ini (karena module ini harus selalu tampil)
                    $idModul = isset($_GET['id']) ? $_GET['id'] : "";
                    if ($m == 'module' AND $idModul == 2) {

                    } else {
                        ?>
                        <div class="field">
                            <label>Aktif</label>
                            <div class="ui checked checkbox">
                                <?php ($data['active'] == 'Y') ? $checked = 'checked' : $checked = ''; ?>
                                <input type="checkbox" name="active" value="Y" <?php echo $checked; ?>>
                                <label>Tampilkan di Menu Admin</label>
                            </div>
                        </div>
                    <?php } ?>
                    <button class="ui basic primary button right floated" type="submit">Perbarui</button>
                </form>
            </div>
        </div>
        <?php
        break;
} ?>