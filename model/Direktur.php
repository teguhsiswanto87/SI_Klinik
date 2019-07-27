<?php

class Direktur
{
// get data from Direktur
    function getListDirektur()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM direktur_utama";
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

// get data from Direktur but olny not registered in pengguna
    function getListDirekturAksesPengguna()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM direktur_utama WHERE id_pengguna is null ";
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
    function getItemDirektur($id_direktur)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM direktur_utama WHERE id_direktur='$id_direktur'";
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
    function getItemDirekturBy($value, $column)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM direktur_utama WHERE $column='$value'";
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

// get 1 last data to check id_direktur
    function getLastItemDirektur()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT id_direktur FROM direktur_utama ORDER BY id_direktur DESC LIMIT 1";
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

// masukkan data Direktur
    function insertDirektur($id_direktur, $nama_direktur)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "INSERT INTO direktur_utama(id_direktur, nama_direktur)
                        VALUES('$id_direktur','$nama_direktur')";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

    }

// update data direktur
    function updateDirekturAksesPegguna($id_direktur, $id_pengguna)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE direktur_utama SET id_pengguna='$id_pengguna' 
                    WHERE id_direktur='$id_direktur' ";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }

// update data direktur
    function updateDirektur($id_direktur, $nama_direktur)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE direktur_utama SET nama_direktur='$nama_direktur' 
                    WHERE id_direktur='$id_direktur' ";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }

// update data direktur by column
    function updateDirekturBy($setColumn, $setValue, $whereColumn, $whereValue)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE direktur_utama SET $setColumn='$setValue' 
                    WHERE $whereColumn='$whereValue' ";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }

//delete 1 data direktur
    function deleteDirektur($id_direktur)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM direktur_utama WHERE id_direktur='$id_direktur'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }

}

?>