<?php

class Laporan
{

// get jumlah pasien
    function getJumlahPasien()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $tanggal = date("Y-m-d");
            $sql = "SELECT count(id_pasien) as jml FROM info_pemeriksaan where tgl_periksa='$tanggal'";
            $res = $conn->query($sql);
            $data = $res->fetch_assoc();
//            if ($res) {
//                $data = $res->fetch_all(MYSQLI_ASSOC);
//                $res->free();
            return $data;
//            } else {
//                return false;
//            }
        } else {
            return false;
        }
    }

// get jumlah pasien
    function getJumlahPasienTotal()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT count(id_pasien) as jml FROM info_pemeriksaan";
            $res = $conn->query($sql);
            $data = $res->fetch_assoc();
            return $data;
        } else {
            return false;
        }
    }

    // get jumlah pasien
    function getTotalPembayaran()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "select sum(biaya) as totalbiaya from pembayaran;";
            $res = $conn->query($sql);
            $data = $res->fetch_assoc();
            return $data;
        } else {
//            select sum(biaya) from pembayaran;

            return false;
        }
    }

    // get jumlah pasien
    function getTotalPasienBayar()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "select count(no_transaksi) as transaksi from pembayaran;";
            $res = $conn->query($sql);
            $data = $res->fetch_assoc();
            return $data;
        } else {
//            select sum(biaya) from pembayaran;

            return false;
        }
    }

//    --------------------------------------------------------
// get data from Laporan
    function getListLaporan()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM dokter";
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

// get data from Laporan but only not registered in pengguna
    function getListLaporanAksesPengguna()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM dokter WHERE id_pengguna is null ";
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
    function getItemLaporan($id_dokter)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM dokter WHERE id_dokter='$id_dokter'";
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

// get 1 data with requirement
    function getItemLaporanBy($value, $column)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM dokter WHERE $column='$value'";
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

// get 1 last data to check id_dokter
    function getLastItemLaporan()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT id_dokter FROM dokter ORDER BY id_dokter DESC LIMIT 1";
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

// masukkan data Laporan
    function insertLaporan($id_dokter, $nama_dokter, $spesialisasi, $jadwal)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "INSERT INTO dokter(id_dokter, nama_dokter, spesialisasi, jadwal)
                        VALUES('$id_dokter','$nama_dokter','$spesialisasi','$jadwal')";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

    }

// update data Laporan
    function updateLaporanAksesPegguna($id_dokter, $id_pengguna)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE dokter SET id_pengguna='$id_pengguna' 
                    WHERE id_dokter='$id_dokter' ";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }


// update data dokter
    function updateLaporan($id_dokter, $nama_dokter, $spesialisasi, $jadwal)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE dokter SET nama_dokter='$nama_dokter',spesialisasi='$spesialisasi',jadwal='$jadwal' 
                    WHERE id_dokter='$id_dokter' ";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }

//delete 1 data dokter by column
    function deleteLaporanBy($value, $column)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM dokter WHERE $column='$value'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }

//delete 1 data dokter
    function deleteLaporan($id_dokter)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM dokter WHERE id_dokter='$id_dokter'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }

}

?>