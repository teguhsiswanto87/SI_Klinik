<?php

class Pemeriksaan
{
// get data from Pemeriksaan
    function getListPemeriksaan()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM info_pemeriksaan";
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
    function getItemPemeriksaan($id_pemeriksaan)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM info_pemeriksaan WHERE id_pemeriksaan='$id_pemeriksaan'";
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
    function getItemPemeriksaanBy($value, $column)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM info_pemeriksaan WHERE $column='$value'";
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

// get 1 last data to check id_pemeriksaan
    function getLastItemPemeriksaan()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT id_pemeriksaan FROM info_pemeriksaan ORDER BY id_pemeriksaan DESC LIMIT 1";
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

// masukkan data Pemeriksaan
    function insertPemeriksaan($id_pemeriksaan, $id_dokter, $id_pasien, $nama_pemeriksaan, $hasil_pemeriksa, $tgl_periksa)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "INSERT INTO info_pemeriksaan(id_pemeriksaan, id_dokter, id_pasien,nama_pemeriksaan, hasil_pemeriksa, tgl_periksa)
                        VALUES('$id_pemeriksaan','$id_dokter', '$id_pasien','$nama_pemeriksaan','$hasil_pemeriksa','$tgl_periksa')";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

    }

// update data Pemeriksaan
    function updatePemeriksaanAksesPegguna($id_pemeriksaan, $nama_pemeriksaan, $hasil_pemeriksa)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE info_pemeriksaan SET nama_pemeriksaan='$nama_pemeriksaan', hasil_periksa='$hasil_pemeriksa'
                    WHERE id_pemeriksaan='$id_pemeriksaan' ";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }


// update data info_pemeriksaan
    function updatePemeriksaan($id_pemeriksaan, $nama_pemeriksaan, $hasil_pemeriksa, $tgl_periksa)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE info_pemeriksaan SET nama_pemeriksaan='$nama_pemeriksaan',hasil_pemeriksa='$hasil_pemeriksa',tgl_periksa='$tgl_periksa' 
                    WHERE id_pemeriksaan='$id_pemeriksaan' ";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }

//delete 1 data info_pemeriksaan by column
    function deletePemeriksaanBy($value, $column)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM info_pemeriksaan WHERE $column='$value'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }

//delete 1 data info_pemeriksaan
    function deletePemeriksaan($id_pemeriksaan)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM info_pemeriksaan WHERE id_pemeriksaan='$id_pemeriksaan'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }

}

?>