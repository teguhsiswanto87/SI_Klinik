<?php
$m = $_GET['m'];
$aksi = "module/mod_pengguna/aksi_pengguna.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$users = new Users();

switch ($act) {
    default:
        echo "
        <div class='ui stackable grid container'>
            <div class='eleven wide column'>
                <h2 class=''>Tampil Users</h2>
            </div>  
            <div class='four wide column'>
                <a onclick=window.location.href='?m=$m&act=tambah'; class='ui basic button right floated'>
                <i class='icon plus'></i>
                    Tambah Users
                </a>
            </div>
            <div class='fifteen wide column'>
                <table class='ui selectable very basic table'>
                <thead>
                <tr>
                <th class='one wide'>No</th>
                <th class='one wide'>Username</th>
                <th class='four wide'>Nama lengkap</th>
                <th class='three wide'>Email</th>
                <th class='one wide'>Telepon</th>
                <th class='one wide'>Pangkat</th>
                <th class='two wide'>Aksi</th>
                </tr>
                </thead>
                <tbody>";
        $no = 1;
        $dataUsers = $users->getListUsers();
        foreach ($dataUsers as $data) {
            echo "<tr>
                <td>$no</td>
                <td>$data[username]</td>
                <td>$data[full_name]</td>
                <td>$data[email]</td>
                <td>$data[phone]</td>
                <td>$data[position]</td>
                <td>
                <a href='?m=$m&act=edit&id=$data[username]'>Edit</a> | ";
            if ($data['position'] != 'admin') {
                echo "<a href='$aksi?m=$m&act=hapus&id=$data[username]'
                    onclick='return confirm(`Hapus modul $data[username] ID=$data[username]?`);'
                    >Hapus</a>";
            }
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
                <h2>Tambah Users</h2>
            </div>
        </div>
        <div class="ui stackable grid container">
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formUsers" onsubmit="return usersValidation('tambah')"
                      action=<?php echo "$aksi?m=$m&act=tambah" ?>
                >
                    <div class="ui grid">
                        <div class="field column wide eight" id="usernameField">
                            <label>Username*</label>
                            <input type="text" name="username" placeholder="Username" minlength="4" maxlength="50"
                                   id="username" autofocus>
                        </div>
                        <div class="field column wide eight">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="Email" maxlength="50">
                        </div>
                    </div>
                    <div class="field">
                        <label>Nama Lengkap</label>
                        <input type="text" name="full_name" placeholder="Full Name">
                    </div>
                    <div class="ui grid">
                        <div class="field column wide eight">
                            <label>Phone</label>
                            <input type="number" name="phone" placeholder="Nomor Telepon">
                        </div>
                        <div class="field column wide eight">
                            <label>Posisi*</label>
                            <div class="ui fluid selection dropdown">
                                <input type="hidden" name="position" required>
                                <div class="default text">Posisi</div>
                                <i class="dropdown icon"></i>
                                <div class="menu">
                                    <div class="item" data-value="admin">Admin</div>
                                    <div class="item" data-value="user">Pegawai Admin</div>
                                </div>
                            </div>
                        </div>
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
                    <button class="ui basic primary button right floated" type="submit" name="btnUsersAdd">Tambahkan
                    </button>
                </form>
            </div>
        </div>
        <?php
        break;

    case "edit":
        $data = $users->getItemUsers($_GET['id']);
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
            <h2>Edit Users</h2>
        </div>
     </div>
        <div class='ui stackable grid container'>
            <div class='eight wide column'>
                <h2 class='ui header'></h2>
                <form class='ui form' method='POST' name='formUsers' onsubmit=\"return usersValidation('update')\"
                    action='$aksi?m=$m&act=update&id=$_SESSION[username]' >
                    <div class='ui grid'>
                        <div class='field column wide eight disabled' id='usernameField'>
                            <label>Username*</label>
                            <input type='hidden' name='session' value='$session'>
                            <input type='text' name='username' placeholder='$data[username]' value='$data[username]' minlength='4' maxlength='50'>
                        </div>
                        <div class='field column wide eight'>
                            <label>Email</label>
                            <input type='email' name='email' placeholder='$data[email]' value='$data[email]' maxlength='50'>
                        </div>
                    </div>
                    <div class='field'>
                        <label>Nama Lengkap</label>
                        <input type='text' name='full_name' placeholder='$data[full_name]' value='$data[full_name]'>
                    </div>
                    <div class='ui grid'>
                        <div class='field column wide eight'>
                            <label>Phone</label>
                            <input type='number' name='phone' placeholder='$data[phone]' value='$data[phone]'>
                        </div>
                    </div>
                    <div class='ui error message'></div>
                    <button class='ui basic primary button right floated' type='submit' name='btnUsersAdd'>Perbarui
                    </button>
                </form>
            </div>
        </div>";
        break;
} ?>
