<?php
$m = $_GET['m'];
$aksi = "module/mod_module/aksi_module.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$module = new Module();

switch ($act) {
    default:
        echo "
        <div class='ui stackable grid container'>
            <div class='eight wide column'>
                <h2 class=''>Tampil Module</h2>
            </div>  
            <div class='four wide column'>
                <a onclick=window.location.href='?m=$m&act=tambah' class='ui basic button right floated'>
                <i class='icon plus'></i>
                    Tambah Module
                </a>
            </div>
            <div class='twelve wide column'>
                <table class='ui selectable very basic table'>
                <thead>
                <tr>
                <th class='one wide'>ID</th>
                <th class='three wide'>Nama Modul</th>
                <th class='three wide'>Link</th>
                <th class='one wide'>Ikon</th>
                <th class='one wide'>Aktif</th>
                <th class='two wide'>Aksi</th>
                </tr>
                </thead>
                <tbody>";
        $dataModule = $module->getListModule();
        foreach ($dataModule as $data) {
            echo "<tr>
                <td>$data[module_id]</td>
                <td>$data[module_name]</td>
                <td>$data[link]</td>
                <td>$data[icon]</td>
                <td>$data[active]</td>
                <td>
                <a href='?m=$m&act=edit&id=$data[module_id]'>Edit</a> | ";
            if ($data['module_id'] > 10) {
                echo "<a href='$aksi?m=$m&act=hapus&id=$data[module_id]'
                    onclick='return confirm(`Hapus modul $data[module_name] ID=$data[module_id]?`);'
                    >Hapus</a>";
            }
            echo "
                </td>
                </tr>";
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
                        <label>Link (contoh =>  ?m=namamodule)</label>
                        <input type="text" name="link" placeholder="Link">
                    </div>
                    <div class="field">
                        <label>Ikon</label>
                        <input type="text" name="icon" placeholder="Ikon">
                        <small>Referensi ikon: <a href="https://semantic-ui.com/elements/icon.html" target="_blank">Open
                                New Tab</a></small>
                    </div>
                    <div class="field">
                        <label>Aktif</label>
                        <div class="ui checked checkbox">
                            <input type="checkbox" name="active" value="Y" checked>
                            <label>Tampilkan di Menu Admin</label>
                        </div>
                    </div>
                    <div class="ui error message"></div>
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
                    <input type='text' name='module_name' placeholder='$data[module_name]' value='$data[module_name]'>
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
                <div class='field'>
                    <label>Aktif</label>
                    <div class='ui checked checkbox'>";
        ($data['active'] == 'Y') ? $checked = 'checked' : $checked = '';
        echo "
                        <input type='checkbox' name='active' value='Y' $checked>
                        <label>Tampilkan di Menu Admin</label>
                    </div>
                </div>
                <div class='ui error message'></div>
                <button class='ui basic primary button right floated' type='submit'>Perbarui</button>
            </form>
        </div>
    </div>";
        break;
} ?>