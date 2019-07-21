<?php
// call Class Module
include "../model/Module.php";

$m = $_GET['m'];
$aksi = "module/mod_module/aksi_module.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$module = new Module();

switch ($act) {
    default:
        echo "
        <div class='ui stackable grid container'>
            <div class='twelve wide column'>
                <h2 class=''>Tampil Module</h2>
            </div>  
            <div class='four wide column'>
                <a onclick=window.location.href='?m=$m&act=tambah' class='ui basic button right floated'>
                <i class='icon plus'></i>
                    Tambah Module
                </a>
            </div>
            <div class='sixteen wide column'>";

        // show notification
        $info = new InfoCheck();
        $info->checkInfo("info");

        echo "
        <table class='ui selectable very basic structured table'>
            <thead>
            <tr>
                <th class='one wide' rowspan='2'>ID</th>
                <th class='three wide' rowspan='2'>Nama Modul</th>
                <th class='three wide' rowspan='2'>Link</th>
                <th class='one wide' rowspan='2'>Ikon</th>
                <th class='one wide' rowspan='2'>Aktif</th>
                <th class='four wide center aligned' colspan='3'>Hak Akses</th>
                <th class='two wide center aligned' rowspan='2'>Aksi</th>
            </tr>
            <tr>
                <th class='center aligned'>Direktur</th>
                <th class='center aligned'>Admin</th>
                <th class='center aligned'>Dokter</th>
            </tr>

            </thead>
            <tbody>";
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
            if ($data['module_id'] > 10) {
                echo "<a id='btn-delete' style='cursor: pointer;'
                                            onclick='deleteData(`$aksi?m=$m&act=hapus&id=$data[module_id]`,
                                                            `$data[module_id]`,
                                                            `$m <b>$data[module_name]</b> ? `)'
                    >Hapus</a>";
            }
//            href='$aksi?m=$m&act=hapus&id=$data[module_id]'
//                             onclick='return confirm(`Hapus modul $data[module_name] ID=$data[module_id]?`);'
            echo "
                </td>
            </tr>
            ";
        }
        echo "
            </tbody>
        </table>
        </div>
        </div>
        ";
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
                        <input type="text" name="link" placeholder="Link">
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
        $data = $module->getItemModule($_GET['id']);
        echo "
    <div class='ui stackable grid container'>
        <div class='four wide column'>
            <a onclick='self.history.back()' class='ui labeled icon button'>
                <i class='arrow left icon'></i>
                Kembali
            </a>
        </div>
        <div class='eight wide column'>
            <h2>Edit Module</h2>
        </div>
        <div class='eight wide column'>
            <h2 class='ui header'></h2>
            <form class='ui form' method='POST' name='formModule' action='$aksi?m=$m&act=update' onsubmit='return moduleValidation()'>
                <input type='hidden' name='id' value='$data[module_id]'>
                <div class='field'>
                    <label>Nama Modul</label>
                    <input type='text' name='module_name' placeholder='$data[module_name]' value='$data[module_name]' autofocus>
                </div>
                <div class='field'>
                    <label>Link</label>
                    <input type='text' name='link' placeholder='$data[link]' value='$data[link]'>
                </div>
                <div class='field'>
                    <label>Ikon</label>
                    <input type='text' name='icon' placeholder='$data[icon]' value='$data[icon]'>
                    <small>Referensi Icon: <a href='https://semantic-ui.com/elements/icon.html' target='_blank'>Open New Tab</a></small>
                </div>
                <div class=\"inline fields\">
                        <label for=\"access_director\">Hak Akses</label>
                        <div class=\"field\">
                            <div class=\"ui checkbox\">";
        ($data['access_director'] == 'Y') ? $checked_director = 'checked' : $checked_director = '';
        echo "
                                <input type=\"checkbox\" name=\"access_director\" value=\"Y\" tabindex=\"0\" $checked_director>
                                <label for=\"access_director\">Direktur</label>
                            </div>
                        </div>
                        <div class=\"field\">
                            <div class=\"ui checkbox\">";
        ($data['access_admin'] == 'Y') ? $checked_admin = 'checked' : $checked_admin = '';
        echo "
                                <input type=\"checkbox\" name=\"access_admin\" value=\"Y\" tabindex=\"0\" $checked_admin>
                                <label for=\"access_admin\">Petugas Administrasi</label>
                            </div>
                        </div>
                        <div class=\"field\">
                            <div class=\"ui checkbox\">";
        ($data['access_doctor'] == 'Y') ? $checked_doctor = 'checked' : $checked_doctor = '';
        echo "
                                <input type=\"checkbox\" name=\"access_doctor\" value=\"Y\" tabindex=\"0\" $checked_doctor>
                                <label for=\"access_doctor\">Dokter</label>
                            </div>
                        </div>
                    </div>
                <div class='field'>
                    <label>Aktif</label>
                    <div class='ui checked checkbox'>";
        ($data['active'] == 'Y') ? $checked = 'checked' : $checked = '';
        echo "
                        <input type='checkbox' name='active' value='Y' $checked>
                        <label>Tampilkan di Menu Admin</label>
                    </div>
                </div>
                <button class='ui basic primary button right floated' type='submit'>Perbarui</button>
            </form>
        </div>
    </div>";
        break;
} ?>