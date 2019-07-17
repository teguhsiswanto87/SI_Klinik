<?php
$m = $_GET['m'];
$aksi = "module/mod_penerbangankelas/aksi_penerbangankelas.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$flightClass = new FlightClass();

switch ($act) {
    default:
        echo "
        <div class='ui stackable grid container'>
            <div class='eight wide column'>
                <h2 class=''>Tampil Penerbangan Kelas</h2>
            </div>  
            <div class='four wide column'>
                <a onclick=window.location.href='?m=$m&act=tambah'; class='ui basic button right floated'>
                <i class='icon plus'></i>
                    Tambah Penerbangan Kelas
                </a>
            </div>
            <div class='twelve wide column'>
                <table class='ui selectable very basic table'>
                <thead>
                <tr>
                <th class='one wide'>No</th>
                <th class='two wide'>Kelas</th>
                <th class='one wide'>Aksi</th>
                </tr>
                </thead>
                <tbody>";
        $no = 1;
        $dataFlightClass = $flightClass->getListFlightClass();
        foreach ($dataFlightClass as $data) {
            echo "<tr>
                <td>$no</td>
                <td style='text-transform: capitalize;'>$data[class]</td>
                <td>
                <a href='?m=$m&act=edit&id=$data[flight_class_id]'>Edit</a> | ";
            echo "<a href='$aksi?m=$m&act=hapus&id=$data[flight_class_id]'
                    onclick='return confirm(`Hapus modul $data[class] ID=$data[flight_class_id]?`);'
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
                <h2>Tambah Penerbangan Kelas</h2>
            </div>
        </div>
        <div class="ui stackable grid container">
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formFlightClass" onsubmit="return flightClassValidation()"
                      action=<?php echo "$aksi?m=$m&act=tambah"; ?>>
                    <div class="field">
                        <label>Penerbangan Kelas</label>
                        <input type="text" name="class" placeholder="Nama Penerbangan Kelas" maxlength="15" autofocus>
                    </div>
                    <div class="ui error message"></div>
                    <button class="ui basic primary button right floated" type="submit" name="btnFlightClassAdd">
                        Tambahkan
                    </button>
                </form>
            </div>
        </div>
        <?php
        break;

    case "edit":
        $data = $flightClass->getItemFlightClass($_GET['id']);
        echo " 
        <div class='ui stackable grid'>
            <div class='four wide column'>
                <a onclick='self.history.back()' class='ui labeled icon button'>
                    <i class='arrow left icon'></i>
                    Kembali
                </a>
            </div>
            <div class='eight wide column'>
                <h2>Edit Penerbangan Kelas</h2>
            </div>
        </div>
        <div class='ui stackable grid container'>
            <div class='eight wide column'>
                <h2 class='ui header'></h2>
                <form class='ui form' method='POST' name='formFlightClass' onsubmit='return flightClassValidation()'
                      action='$aksi?m=$m&act=update'>
                    <div class='field'>
                        <label>Penerbangan Kelas</label>
                        <input type='hidden' name='id' value='$_GET[id]'>
                        <input type='text' name='class' placeholder='$data[class]' value='$data[class]' maxlength='15' autofocus>
                    </div>
                    <div class='ui error message'></div>
                    <button class='ui basic primary button right floated' type='submit' name='btnFlightClassAdd'>Perbarui
                    </button>
                </form>
            </div>
        </div>";
        break;
} ?>
