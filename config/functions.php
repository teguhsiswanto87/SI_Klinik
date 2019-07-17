<?php
// connect to database
function dbConnect()
{
//    connect DB untuk di rumah hosting
//    $db = new mysqli("103.8.79.214", "siswanto_root", "siswanto123321", "siswanto_atol_flight");
    $db = new mysqli("localhost", "root", "siswanto123321", "atol_flight");
    return $db;
}

// fungsi untuk menghindari injeksi dari user yang jahil
function anti_injection($data)
{
    $filter = stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES)));
    return $filter;
}

// my Input Format(0) ==> 0 whitespace collapse/nospace & lowercase
// my Input Format(1) ==> 1 whitespace collapse & lowercase
function my_inputformat($str, $space)
{
    if ($space == 1)
        return strtolower(trim(preg_replace("/\s+/", " ", $str)));
    else
        return strtolower(trim(preg_replace("/\s+/", "", $str)));
}

// get data from Module (store in side bar administrator web)
function getListModule()
{
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $res = $db->query("SELECT * FROM module WHERE active='Y' ");
        if ($res) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            $res->free();
            return $data;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

class Module
{
//    private $module_id = 0;
//    private $module_name = "";
//    private $link = "";
//    private $icon = "";
//    private $active = "";

    // get data from Module
    function getListModule()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM module";
            $res = $conn->query($sql);
            if ($res) {
                $data = $res->fetch_all(MYSQLI_ASSOC);
                $res->free();
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // get 1 data to put in edit form
    function getItemModule($module_id)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM module WHERE module_id='$module_id'";
            $res = $conn->query($sql);
            $data = $res->fetch_assoc();
            $row_cnt = $res->num_rows;

            if ($row_cnt == 1) {
                return $data;
            }

        } else {
            return false;
        }
    }

    // masukkan data module
    function insertModule($module_name, $link, $icon, $active)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "INSERT INTO module(module_name, link, icon, active) VALUES('$module_name','$link','$icon','$active') ";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

    }

    // update data module
    function updateModule($module_id, $module_name, $link, $icon, $active)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE module SET module_name='$module_name',link='$link',icon='$icon',active='$active' WHERE module_id='$module_id'";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }

    //delete 1 data module
    function deleteModule($module_id)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM module WHERE module_id='$module_id'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }

}

class Passanger
{

    // get data from Passanger
    function getListPassanger()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM passanger";
            $res = $conn->query($sql);
            if ($res) {
                $data = $res->fetch_all(MYSQLI_ASSOC);
                $res->free();
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // get 1 data to put in edit form
    function getItemPassanger($passanger)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM passanger WHERE passanger_id='$passanger'";
            $res = $conn->query($sql);
            $data = $res->fetch_assoc();
            $row_cnt = $res->num_rows;

            if ($row_cnt == 1) {
                return $data;
            }

        } else {
            return false;
        }
    }

    // masukkan data Passanger
//    function insertPassanger($passanger_id,$first_name, $last_name, $born, $address, $city, $zip, $state, $phone, $email, $password)
    function insertPassanger($first_name, $state, $email, $password, $last_name, $address, $city,$zip,$phone,$born)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
//            $sql = "INSERT INTO passanger(passanger_id,first_name, last_name, born, address, city, zip, state, phone, email, password)
//                      VALUES('$passanger_id','$first_name','$last_name','$born','$address','$city','$zip','$state','$phone','$email','$password')";
            $sql = "insert into passanger(first_name,state,email,password,last_name,address,city,zip,phone,born) values ('$first_name','$state','$email','$password','$last_name','$address','$city','$zip','$phone','$born')";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

    }

    // update data passanger
    function updatePassanger($passanger_id, $first_name, $last_name, $born, $address, $city, $zip, $state, $phone, $email)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE passanger SET first_name='$first_name',
                                        last_name='$last_name',
                                        born='$born', 
                                        address='$address', 
                                        city='$city', 
                                        zip='$zip', 
                                        state='$state', 
                                        phone='$phone', 
                                        email='$email'
                                    WHERE passanger_id='$passanger_id' ";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }

    //delete 1 data passanger
    function deletePassanger($passanger_id)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM passanger WHERE passanger_id='$passanger_id'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }

}

class BookingStatusClass
{
    // get data from Booking Status
    function getListBookingStatus()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM booking_status";
            $res = $conn->query($sql);
            if ($res) {
                $data = $res->fetch_all(MYSQLI_ASSOC);
                $res->free();
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // get 1 data to put in edit form
    function getItemBookingStatus($booking_status_id)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM booking_status WHERE booking_status_id='$booking_status_id'";
            $res = $conn->query($sql);
            $data = $res->fetch_assoc();
            $row_cnt = $res->num_rows;

            if ($row_cnt == 1) {
                return $data;
            }

        } else {
            return false;
        }
    }

    // masukkan data Booking Status
    function insertBookingStatus($status)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "INSERT INTO booking_status(status) 
                      VALUES('$status')";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

    }

    // update data Booking Status
    function updateBookingStatus($booking_status_id, $status)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE booking_status SET status='$status' WHERE booking_status_id='$booking_status_id' ";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }

    //delete 1 data Booking Status
    function deleteBookingStatus($booking_status_id)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM booking_status WHERE booking_status_id='$booking_status_id'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }
}

class FlightClass
{
    // get data from flight class
    function getListFlightClass()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM flight_class";
            $res = $conn->query($sql);
            if ($res) {
                $data = $res->fetch_all(MYSQLI_ASSOC);
                $res->free();
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // get 1 data to put in edit form
    function getItemFlightClass($flightClassId)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM flight_class WHERE flight_class_id='$flightClassId'";
            $res = $conn->query($sql);
            $data = $res->fetch_assoc();
            $row_cnt = $res->num_rows;

            if ($row_cnt == 1) {
                return $data;
            }

        } else {
            return false;
        }
    }

    // masukkan data flight class
    function insertFlightClass($class)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "INSERT INTO flight_class(class) 
                      VALUES('$class')";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

    }

    // update data flight class
    function updateFlightClass($flightClassId, $class)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE flight_class SET class='$class' WHERE flight_class_id='$flightClassId' ";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }

    //delete 1 data flight class
    function deleteFlightClass($flightClassId)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM flight_class WHERE flight_class_id='$flightClassId'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }
}

class Airplane
{
    // get data from Airplane
    function getListAirplane()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM airplane";
            $res = $conn->query($sql);
            if ($res) {
                $data = $res->fetch_all(MYSQLI_ASSOC);
                $res->free();
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // get 1 data to put in edit form
    function getItemAirplane($airplane_id)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM airplane WHERE airplane_id='$airplane_id'";
            $res = $conn->query($sql);
            $data = $res->fetch_assoc();
            $row_cnt = $res->num_rows;

            if ($row_cnt == 1) {
                return $data;
            }

        } else {
            return false;
        }
    }

    // masukkan data Airplane
    function insertAirplane($producer, $type)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "INSERT INTO airplane(airplane_id, producer, type) 
                      VALUES(null, '$producer','$type')";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

    }

    // update data airplane
    function updateAirplane($airplane_id, $producer, $type) //
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE airplane SET producer='$producer', type='$type' WHERE airplane_id='$airplane_id' ";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }

    //delete 1 data airplane
    function deleteAirplane($airplane_id)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM airplane WHERE airplane_id='$airplane_id'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }
}

class Users
{
//    private $module_id = 0;
//    private $module_name = "";
//    private $link = "";
//    private $icon = "";
//    private $active = "";

    // get data from Users
    function getListUsers()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM users";
            $res = $conn->query($sql);
            if ($res) {
                $data = $res->fetch_all(MYSQLI_ASSOC);
                $res->free();
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // get 1 data to put in edit form
    function getItemUsers($username)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM users WHERE username='$username'";
            $res = $conn->query($sql);
            $data = $res->fetch_assoc();
            $row_cnt = $res->num_rows;

            if ($row_cnt == 1) {
                return $data;
            }

        } else {
            return false;
        }
    }

    // masukkan data Users
    function insertUsers($username, $password, $full_name, $email, $phone, $position, $block)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "INSERT INTO users(username, password, full_name, email, phone, position, block) 
                      VALUES('$username','$password','$full_name','$email','$phone','$position','$block')";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

    }

    // update data users
    function updateUsers($full_name, $email, $phone, $username, $id_session) //
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE users SET full_name='$full_name',email='$email',phone='$phone' WHERE username='$username' AND id_session='$id_session'";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }

    //delete 1 data users
    function deleteUsers($username)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM users WHERE username='$username'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }

}

class LoginCheck
{
    function showError($message)
    {
        echo "<div class='ui small orange message' style='margin: 2rem 0.2rem;'>$message</div>";
    }

    function checkLogin($par)
    {
        if (isset($_GET[$par])) {
            $error = $_GET[$par];
            switch ($error) {
                default :
                    $this->showError("Unknown Error");
                    break;
                case 1 :
                    $this->showError("Username dan password tidak sesuai");
                    break;

                case 2 :
                    $this->showError("Error database. Silahkan hubungi administrator");
                    break;
                case 3 :
                    $this->showError("Koneksi ke Database gagal. Autentikasi gagal");
                    break;
                case 4 :
                    $this->showError("Anda tidak boleh mengakses halaman sebelumnya karena belum login.
                        Silahkan login terlebih dahulu");
                    break;

                case 5 :
                    $this->showError("Harap gunakan tombol Log In yang telah disediakan");
                    break;
                case 6 :
                    $this->showError("Maaf Login tidak bisa diinjeksi");
                    break;
                case 7 :
                    $this->showError("Username minimal 5 karakter");
                    break;
                case 8 :
                    $this->showError("Maaf, Anda harus login dulu");
                    break;
            }
        }
    }
}

