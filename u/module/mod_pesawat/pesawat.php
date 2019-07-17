<?php
$m = $_GET['m'];
$aksi = "module/mod_pesawat/aksi_pesawat.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$airplane = new Airplane();

switch ($act) {
    default:
        echo "
        <div class='ui stackable grid container'>
            <div class='ten wide column'>
                <h2 class=''>Tampil Pesawat</h2>
            </div>  
            <div class='four wide column'>
                <a onclick=window.location.href='?m=$m&act=tambah'; class='ui basic button right floated'>
                <i class='icon plus'></i>
                    Tambah Pesawat
                </a>
            </div>
            <div class='fourteen wide column'>
                <table class='ui selectable very basic table'>
                <thead>
                <tr>
                <th class='one wide'>No</th>
                <th class='three wide'>Producer</th>
                <th class='three wide'>Type</th>
                <th class='two wide'>Aksi</th>
                </tr>
                </thead>
                <tbody>";
        $no = 1;
        $dataAirplane = $airplane->getListAirplane();
        foreach ($dataAirplane as $data) {
            echo "<tr>
                <td>$no</td>
                <td style='text-transform: capitalize;'>$data[producer]</td>
                <td style='text-transform: capitalize;'>$data[type]</td>
                <td>
                <a href='?m=$m&act=edit&id=$data[airplane_id]'>Edit</a> | ";
            echo "<a href='$aksi?m=$m&act=hapus&id=$data[airplane_id]'
                    onclick='return confirm(`Hapus modul $data[producer] ID=$data[airplane_id]?`);'
                    >Hapus</a>";
            echo "
                </td>
                </tr>";
            $no++;
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
                <h2>Tambah Pesawat</h2>
            </div>
        </div>
        <div class="ui stackable grid container">
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formAirplane" onsubmit="return airplaneValidation()"
                      action=<?php echo "$aksi?m=$m&act=tambah"; ?>>
                    <div class="field">
                        <label>Nama Maskapai Pesawat</label>
                        <input type="text" name="producer" placeholder="Producer" maxlength="50" autofocus>
                    </div>
                    <div class="field">
                        <label>Tipe Pesawat</label>
                        <input type="text" name="type" placeholder="Type">
                    </div>
                    <div class="ui error message"></div>
                    <button class="ui basic primary button right floated" type="submit" name="btnAirplaneAdd">Tambahkan
                    </button>
                </form>
            </div>
        </div>
        <?php
        break;

    case "edit":
        $data = $airplane->getItemAirplane($_GET['id']);
        echo " 
    <div class='ui stackable grid'>
            <div class='four wide column'>
                <a onclick='self.history.back()' class='ui labeled icon button'>
                    <i class='arrow left icon'></i>
                    Kembali
                </a>
            </div>
            <div class='eight wide column'>
                <h2>Edit Pesawat</h2>
            </div>
        </div>
        <div class='ui stackable grid container'>
            <div class='eight wide column'>
                <h2 class='ui header'></h2>
                <form class='ui form' method='POST' name='formAirplane' onsubmit='return airplaneValidation()'
                      action='$aksi?m=$m&act=update'>
                    <div class='field'>
                        <label>Nama Maskapai Pesawat</label>
                        <input type='hidden' name='id' value='$_GET[id]'>
                        <input type='text' name='producer' placeholder='$data[producer]' maxlength='50' value='$data[producer]'>
                    </div>
                    <div class='field'>
                        <label>Tipe Pesawat</label>
                        <input type='text' name='type' placeholder='$data[type]' maxlength='50' value='$data[type]'>
                    </div>
                    <div class='ui error message'></div>
                    <button class='ui basic primary button right floated' type='submit' name='btnAirplaneAdd'>Perbarui
                    </button>
                </form>
            </div>
        </div>";
        break;
} ?>
