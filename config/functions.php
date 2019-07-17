<?php
// connect to model
function dbConnect()
{
//    connect DB - nya disesuaikan ya... dgn PC kalian
    $db = new mysqli("localhost", "root", "siswanto123321", "si_klinik");
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
                    $this->showError("Error model. Silahkan hubungi administrator");
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

