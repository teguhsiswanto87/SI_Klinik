<?php

class Resep
{
// get data from Resep
    function getListResep()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM resep_dokter";
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

// get data from Resep but only not registered in pengguna
    function getListResepAksesPengguna()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM resep_dokter WHERE id_resep is null ";
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
    function getItemResep($id_resep)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM resep_dokter WHERE id_resep='$id_resep'";
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
    function getItemResepBy($value, $column)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM resep_dokter WHERE $column='$value'";
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
    function getLastItemResep()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT id_resep FROM resep_dokter ORDER BY id_resep DESC LIMIT 1";
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

// masukkan data Resep
    function insertResep($id_resep, $nama_resep, $nama_obat, $jenis)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "INSERT INTO resep_dokter(id_resep, nama_resep, nama_obat, jenis)
                        VALUES('$id_resep','$nama_resep','$nama_obat','$jenis')";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

    }

// update data Resep
    function updateResepAksesPegguna($id_resep)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE resep_dokter SET id_resep='$id_resep' 
                    WHERE id_resep='$id_resep' ";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }


// update data resep
    function updateResep($id_resep, $nama_resep, $nama_obat, $jenis)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE resep_dokter SET nama_resep='$nama_resep',nama_obat='$nama_obat',jenis='$jenis' 
                    WHERE id_resep='$id_resep' ";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }

//delete 1 data resep by column
    function deleteResepBy($value, $column)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM resep_dokter WHERE $column='$value'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }

//delete 1 data resep
    function deleteResep($id_resep)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM resep_dokter WHERE id_resep='$id_resep'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }

}

?>