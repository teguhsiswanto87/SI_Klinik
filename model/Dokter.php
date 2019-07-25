<?php

class Dokter
{
// get data from Dokter
    function getListDokter()
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

// get 1 data to put in edit form
    function getItemDokter($id_dokter)
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

// get 1 last data to check id_dokter
    function getLastItemDokter()
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

// masukkan data Dokter
    function insertDokter($id_dokter, $nama_dokter, $spesialisasi, $jadwal)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "INSERT INTO dokter(id_dokter, nama_dokter, spesialisasi, jadwal)
                        VALUES('$id_dokter','$nama_dokter','$spesialisasi','$jadwal')";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

    }

// update data dokter
    function updateDokter($id_dokter, $nama_dokter, $spesialisasi, $jadwal)
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

//delete 1 data dokter
    function deleteDokter($id_dokter)
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