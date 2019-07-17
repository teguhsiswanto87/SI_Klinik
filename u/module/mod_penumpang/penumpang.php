<?php
$m = $_GET['m'];
$aksi = "module/mod_penumpang/aksi_penumpang.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$passanger = new Passanger();

switch ($act) {
    default:
        echo "
        <div class='ui stackable grid container'>
            <div class='eleven wide column'>
                <h2 class=''>Tampil Penumpang</h2>
            </div>  
            <div class='four wide column'>
                <a onclick=window.location.href='?m=$m&act=tambah'; class='ui basic button right floated'>
                <i class='icon plus'></i>
                    Tambah Penumpang
                </a>
            </div>
            <div class='fifteen wide column'>
                <table class='ui selectable very basic table'>
                <thead>
                <tr>
                <th class='one wide'>No</th>
                <th class='four wide'>Nama lengkap</th>
                <th class='three wide'>City</th>
                <th class='three wide'>Email</th>
                <th class='one wide'>Telepon</th>
                <th class='two wide'>Aksi</th>
                </tr>
                </thead>
                <tbody>";
        $no = 1;
        $dataPassanger = $passanger->getListPassanger();
        foreach ($dataPassanger as $data) {
            echo "<tr>
                <td>$no</td>
                <td style='text-transform: capitalize;'>$data[first_name] $data[last_name]</td>
                <td style='text-transform: capitalize;'>$data[city]</td>
                <td>$data[email]</td>
                <td>$data[phone]</td>
                <td>
                <a href='?m=$m&act=edit&id=$data[passanger_id]'>Edit</a> | ";
            echo "<a href='$aksi?m=$m&act=hapus&id=$data[passanger_id]'
                    onclick='return confirm(`Hapus $_GET[m] $data[first_name] $data[last_name] ID=$data[passanger_id]?`);'
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
                <h2>Tambah Penumpang</h2>
            </div>
        </div>
        <div class="ui stackable grid container">
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formPassanger" onsubmit="return passangerValidation('tambah')"
                      action=<?php echo "$aksi?m=$m&act=tambah" ?>
                >
                    <div class="ui grid">
                        <div class="field column wide eight" id="usernameField">
                            <label>Nama Depan</label>
                            <input type="text" name="first_name" placeholder="First Name" maxlength="50"
                                   id="first_name" autofocus>
                        </div>
                        <div class="field column wide eight">
                            <label>Nama Belakang</label>
                            <input type="text" name="last_name" placeholder="Last Name" maxlength="50">
                        </div>
                        <div class="field column wide eight" id="usernameField">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="Email" maxlength="100"
                                   id="email" autofocus>
                        </div>
                        <div class="field column wide eight">
                            <label>Telepon</label>
                            <input type="number" name="phone" placeholder="Nomor Telepon">
                        </div>
                        <div class="field">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="born" value="">
                        </div>
                    </div>
                    <div class="ui grid">
                        <div class="field column wide eight">
                            <label>City</label>
                            <input type="text" name="city" placeholder="City">
                        </div>
                        <div class="field column wide eight">
                            <label>Negara</label>
                            <input type="text" name="state" placeholder="State">
                        </div>
                        <div class="field column wide sixteen">
                            <label>Alamat</label>
                            <input type="text" name="address" placeholder="Address" maxlength="100">
                        </div>
                        <div class="field column wide five">
                            <label>Kode POS</label>
                            <input type="number" name="zip" placeholder="Zip Code" maxlength="6" min="0">
                        </div>
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
                    <button class="ui basic primary button right floated" type="submit" name="btnPassangerAdd">Tambahkan
                    </button>
                </form>
            </div>
        </div>
        <?php
        break;

    case "edit":
        $data = $passanger->getItemPassanger($_GET['id']);
        echo " 
    <div class='ui stackable grid container'>
        <div class='four wide column'>
            <a onclick='self.history.back()' class='ui labeled icon button'>
                <i class='arrow left icon'></i>
                Kembali
            </a>
        </div>
        <div class='eight wide column'>
            <h2>Edit Penumpang</h2>
        </div>
     </div>
        <div class='ui stackable grid container'>
            <div class='eight wide column'>
                <h2 class='ui header'></h2>
                <form class='ui form' method='POST' name='formPassanger' onsubmit=\"return passangerValidation('update')\"
                      action='$aksi?m=$m&act=update'>
                    <div class='ui grid'>
                        <div class='field column wide eight' id='usernameField'>
                            <label>Nama Depan</label>
                            <input type='hidden' value='$_GET[id]' name='id'>
                            <input type='text' name='first_name' value='$data[first_name]' placeholder='$data[first_name]' maxlength='50'
                                   id='first_name' autofocus>
                        </div>
                        <div class='field column wide eight'>
                            <label>Nama Belakang</label>
                            <input type='text' name='last_name' value='$data[last_name]' placeholder='$data[last_name]' maxlength='50'>
                        </div>
                        <div class='field column wide eight' id='usernameField'>
                            <label>Email</label>
                            <input type='email' name='email' value='$data[email]' placeholder='$data[email]' maxlength='100'
                                   id='email' autofocus>
                        </div>
                        <div class='field column wide eight'>
                            <label>Telepon</label>
                            <input type='number' name='phone' value='$data[phone]' placeholder='$data[phone]'>
                        </div>
                        <div class='field'>
                            <label>Tanggal Lahir</label>
                            <input type='date' name='born' value='$data[born]'>
                        </div>
                    </div>
                    <div class='ui grid'>
                        <div class='field column wide eight'>
                            <label>City</label>
                            <input type='text' name='city' placeholder='$data[city]' value='$data[city]'>
                        </div>
                        <div class='field column wide eight'>
                            <label>Negara</label>
                            <input type='text' name='state' value='$data[state]' placeholder='$data[state]'>
                        </div>
                        <div class='field column wide sixteen'>
                            <label>Alamat</label>
                            <input type='text' name='address' value='$data[address]' placeholder='$data[address]' maxlength='100'>
                        </div>
                        <div class='field column wide five'>
                            <label>Kode POS</label>
                            <input type='number' name='zip' value='$data[zip]' placeholder='$data[zip]' maxlength='6' min='0'>
                        </div>
                    </div>
                    <div class='ui error message'></div>
                    <button class='ui basic primary button right floated' type='submit' name='btnPassangerAdd'>Perbarui
                    </button>
                </form>
            </div>
        </div>";
        break;
} ?>
