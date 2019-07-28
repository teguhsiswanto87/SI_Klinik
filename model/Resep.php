<?php

class resep
{
// get data from resep
    function getListresep()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM resep";
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
    function getItemresep($id_resep)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM resep WHERE id_resep='$id_resep'";
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

// get 1 last data to check id_resep
    function getLastItemresep()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT id_resep FROM resep ORDER BY id_resep DESC LIMIT 1";
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

// masukkan data resep
    function insertresep($id_resep, $id_dokter, $id_pasien,$nama_obat, $jenis)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "INSERT INTO resep(id_resep,id_dokter,id_pasien,nama_obat,jenis)
                    VALUES('$id_resep','$id_dokter', '$id_pasien', '$nama_obat', '$jenis')";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

    }

// update data resep
    function updateresep($id_resep, $id_dokter, $id_pasien, $nama_obat, $jenis)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE resep SET 
                                     id_dokter='$id_dokter',
                                     id_pasien='$id_pasien',
                                     nama_obat='$nama_obat',
                                     jenis='$jenis'  
                    WHERE id_resep='$id_resep'";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }

//delete 1 data resep
    function deleteresep($id_resep)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM resep WHERE id_resep='$id_resep'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }

}

?>