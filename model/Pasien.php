<?php

class Pasien
{
// get data from Pasien
    function getListPasien()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM pasien";
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
    function getItemPasien($id_pasien)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM pasien WHERE id_pasien='$id_pasien'";
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

// get 1 last data to check id_pasien
    function getLastItemPasien()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT id_pasien FROM pasien ORDER BY id_pasien DESC LIMIT 1";
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

// masukkan data Pasien
    function insertPasien($id_pasien, $nama_pasien, $tempat_lahir, $tgl_lahir, $jenis_kelamin, $alamat, $kontak)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "INSERT INTO pasien(id_pasien,nama_pasien,tempat_lahir,tgl_lahir,jenis_kelamin, alamat, kontak)
                    VALUES('$id_pasien','$nama_pasien', '$tempat_lahir', '$tgl_lahir', '$jenis_kelamin', '$alamat', '$kontak')";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

    }

// update data pasien
    function updatePasien($id_pasien, $nama_pasien, $tempat_lahir, $tgl_lahir, $jenis_kelamin, $alamat, $kontak)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE pasien SET nama_pasien='$nama_pasien',
                                      tempat_lahir='$tempat_lahir',
                                     tgl_lahir='$tgl_lahir',
                                     jenis_kelamin='$jenis_kelamin',
                                     alamat='$alamat',
                                     kontak='$kontak'
                    WHERE id_pasien='$id_pasien'";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }

//delete 1 data pasien
    function deletePasien($id_pasien)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM pasien WHERE id_pasien='$id_pasien'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }

}

?>