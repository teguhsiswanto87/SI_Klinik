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

// masukkan data Pasien
    function insertPasien($nama_pasien, $tempat_lahir, $tgl_lahir, $jenis_kelamin, $alamat, $kontak)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "INSERT INTO pasien(username, password, nama)
                    VALUES('$username','$password','$nama')";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

}

// update data pasien
function updatePasien($id_pasien, $username, $nama, $id_session)
{
    $conn = dbConnect();
    if ($conn->connect_errno == 0) {
        $sql = "UPDATE pasien SET username='$username',nama='$nama' 
                    WHERE id_pasien='$id_pasien' AND id_session='$id_session' ";
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