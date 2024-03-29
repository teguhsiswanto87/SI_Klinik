<?php

class Pengguna
{
// get data from Pengguna
    function getListPengguna()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM pengguna";
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
    function getItemPengguna($id_pengguna)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM pengguna WHERE id_pengguna='$id_pengguna'";
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

// masukkan data Pengguna
    function insertPengguna($username, $password, $nama)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "INSERT INTO pengguna(username, password, nama)
                        VALUES('$username','$password','$nama')";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

    }

// update data pengguna
    function updatePengguna($id_pengguna, $username, $nama, $id_session)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE pengguna SET username='$username',nama='$nama' 
                    WHERE id_pengguna='$id_pengguna' AND id_session='$id_session' ";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }

//delete 1 data pengguna
    function deletePengguna($id_pengguna)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM pengguna WHERE id_pengguna='$id_pengguna'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }

}

?>