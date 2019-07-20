<?php
// call Class Pengguna
include "../model/Pengguna.php";

$m = $_GET['m'];
$aksi = "module/mod_pengguna/aksi_pengguna.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$pengguna = new Pengguna();

switch ($act) {
    default:
        echo "
        <div class='ui stackable grid container'>
            <div class='eleven wide column'>
                <h2 class=''>Tampil Pengguna</h2>
            </div>  
            <div class='four wide column'>
                <a onclick=window.location.href='?m=$m&act=tambah'; class='ui basic button right floated'>
                <i class='icon plus'></i>
                    Tambah Pengguna
                </a>
            </div>
            <div class='fifteen wide column'>
                <table class='ui selectable very basic table'>
                <thead>
                <tr>
                <th class='one wide'>No</th>
                <th class='one wide'>Username</th>
                <th class='four wide'>Nama lengkap</th>
                <th class='two wide'>Aksi</th>
                </tr>
                </thead>
                <tbody>";
        $session = session_id();
        $no = 1;
        $dataUsers = $pengguna->getListPengguna();
        foreach ($dataUsers as $data) {
            echo "<tr>
                <td>$no</td>
                <td>$data[username]</td>
                <td>$data[nama]</td>
                <td style='display: none' >
                    <a href='?m=$m&act=edit&id=$data[id_pengguna]'>Edit</a>  
                    <a href='$aksi?m=$m&act=hapus&id=$data[id_pengguna]'
                        onclick='return confirm(`Hapus $data[username] ID=$data[id_pengguna]?`);'>Hapus
                    </a>
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
                <h2>Tambah Pengguna</h2>
            </div>
        </div>
        <div class="ui stackable grid container">
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formPengguna" onsubmit="return penggunaValidation('tambah')"
                      action=<?php echo "$aksi?m=$m&act=tambah" ?>
                >
                    <div class="ui grid">
                        <div class="field column wide eight" id="usernameField">
                            <label>Username</label>
                            <input type="text" name="username" placeholder="Username" minlength="4" maxlength="50"
                                   id="username" autofocus>
                        </div>
                    </div>
                    <br>
                    <div class="field">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" placeholder="Nama Lengkap">
                    </div>
                    <div class="ui grid">
                        <div class="field eight wide column" id="passwordId">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="password" id="password"
                                   onkeyup="return checkPass()">
                            <span id="message"></span>
                        </div>
                        <div class="field eight wide column" id="confirmPasswordId">
                            <label>Konfirmasi Password</label>
                            <input type="password" name="confirmPassword" placeholder="password" id="confirmPassword"
                                   onkeyup="checkPass()"
                            >
                        </div>
                    </div>
                    <div class="ui error message"></div>
                    <button class="ui basic primary button right floated" type="submit" name="btnPenggunaAdd">Tambahkan
                    </button>
                </form>
            </div>
        </div>
        <?php
        break;

    case "edit":
        $data = $pengguna->getItemPengguna($_GET['id']);
        $session = session_id();
        echo "
        <div class='ui stackable grid container'>
            <div class='four wide column'>
                <a onclick='self.history.back()' class='ui labeled icon button'>
                    <i class='arrow left icon'></i>
                    Kembali
                </a>
            </div>
            <div class='eight wide column'>
                <h2>Edit Pengguna</h2>
            </div>
            <div class='eight wide column'>
                <h2 class='ui header'></h2>
                <img class='ui small centered circular image' src='$_SESSION[photo]'>
                <form class='ui form' method='POST' name='formPengguna' onsubmit=\"return penggunaValidation('update')\"
                      action='$aksi?m=$m&act=update'>
                    <div class='ui grid'>
                        <div class='field column wide eight' id='usernameField'>
                            <label>Username</label>
                            <input type='hidden' value='$data[id_pengguna]' name='id'>
                            <input type='hidden' value='$session' name='id_session'>
                            <input type='text' name='username' placeholder='$data[username]' value='$data[username]' minlength='4' maxlength='50'
                                   id='username' autofocus>
                        </div>
                    </div>
                    <br>
                    <div class='field'>
                        <label>Nama Lengkap</label>
                        <input type='text' name='nama' placeholder='$data[nama]' value='$data[nama]' maxlength='50'>
                    </div>
                    <div class='ui error message'></div>
                    <button class='ui basic primary button right floated' type='submit' name='btnPenggunaAdd'>Perbarui
                    </button>
                </form>
                <br>
                <a href='' style='border-bottom: 1px dotted currentColor; ' title='belum cuy'> Ganti Password </a>
            </div>
            
        </div>";
        break;
} ?>
