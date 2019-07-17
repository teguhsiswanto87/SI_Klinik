<?php
$m = $_GET['m'];
$aksi = "module/mod_bookingstatus/aksi_bookingstatus.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$bookingStatus = new BookingStatusClass();

switch ($act) {
    default:
        echo "
        <div class='ui stackable grid container'>
            <div class='eight wide column'>
                <h2 class=''>Tampil Booking Status</h2>
            </div>  
            <div class='four wide column'>
                <a onclick=window.location.href='?m=$m&act=tambah'; class='ui basic button right floated'>
                <i class='icon plus'></i>
                    Tambah Booking Status
                </a>
            </div>
            <div class='twelve wide column'>
                <table class='ui selectable very basic table'>
                <thead>
                <tr>
                <th class='one wide'>No</th>
                <th class='two wide'>Status</th>
                <th class='one wide'>Aksi</th>
                </tr>
                </thead>
                <tbody>";
        $no = 1;
        $dataBookingStatus = $bookingStatus->getListBookingStatus();
        foreach ($dataBookingStatus as $data) {
            echo "<tr>
                <td>$no</td>
                <td style='text-transform: capitalize;'>$data[status]</td>
                <td>
                <a href='?m=$m&act=edit&id=$data[booking_status_id]'>Edit</a> | ";
            echo "<a href='$aksi?m=$m&act=hapus&id=$data[booking_status_id]'
                    onclick='return confirm(`Hapus modul $data[status] ID=$data[booking_status_id]?`);'
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
                <h2>Tambah Booking Status</h2>
            </div>
        </div>
        <div class="ui stackable grid container">
            <div class="eight wide column">
                <h2 class="ui header"></h2>
                <form class="ui form" method="POST" name="formBookingStatus" onsubmit="return bookingStatusValidation()"
                      action=<?php echo "$aksi?m=$m&act=tambah"; ?>>
                    <div class="field">
                        <label>Status</label>
                        <input type="text" name="status" placeholder="Booking Status" maxlength="50" autofocus>
                    </div>
                    <div class="ui error message"></div>
                    <button class="ui basic primary button right floated" type="submit" name="btnBookingStatusAdd">
                        Tambahkan
                    </button>
                </form>
            </div>
        </div>
        <?php
        break;

    case "edit":
        $data = $bookingStatus->getItemBookingStatus($_GET['id']);
        echo " 
        <div class='ui stackable grid'>
            <div class='four wide column'>
                <a onclick='self.history.back()' class='ui labeled icon button'>
                    <i class='arrow left icon'></i>
                    Kembali
                </a>
            </div>
            <div class='eight wide column'>
                <h2>Edit Booking Status</h2>
            </div>
        </div>
        <div class='ui stackable grid container'>
            <div class='eight wide column'>
                <h2 class='ui header'></h2>
                <form class='ui form' method='POST' name='formBookingStatus' onsubmit='return bookingStatusValidation()'
                      action='$aksi?m=$m&act=update'>
                    <div class='field'>
                        <label>Booking Status</label>
                        <input type='hidden' name='id' value='$_GET[id]'>
                        <input type='text' name='status' placeholder='$data[status]' value='$data[status]' maxlength='50' autofocus>
                    </div>
                    <div class='ui error message'></div>
                    <button class='ui basic primary button right floated' type='submit' name='btnBookingStatusAdd'>Perbarui
                    </button>
                </form>
            </div>
        </div>";
        break;
} ?>
