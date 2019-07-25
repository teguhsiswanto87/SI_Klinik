<?php

class Petugas
{
// get data from Petugas
    function getListPetugas()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM petugas_administrasi";
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
    function getItemPetugas($id_petugas)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM petugas_administrasi WHERE id_petugas='$id_petugas'";
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

// get 1 last data to check id_petugas
    function getLastItemPetugas()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT id_petugas FROM petugas_administrasi ORDER BY id_petugas DESC LIMIT 1";
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

// masukkan data Petugas
    function insertPetugas($id_petugas, $nama_pegawai, $alamat, $kontak)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "INSERT INTO petugas_administrasi(id_petugas, nama_pegawai, alamat, kontak)
                        VALUES('$id_petugas','$nama_pegawai','$alamat','$kontak')";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

    }

// update data petugas_administrasi
    function updatePetugas($id_petugas, $nama_pegawai, $alamat, $kontak)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE petugas_administrasi SET nama_pegawai='$nama_pegawai',alamat='$alamat',kontak='$kontak' 
                    WHERE id_petugas='$id_petugas' ";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }

//delete 1 data petugas_administrasi
    function deletePetugas($id_petugas)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM petugas_administrasi WHERE id_petugas='$id_petugas'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }

}

?>