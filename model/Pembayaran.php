<?php

class Pembayaran
{
// get data from Pembayaran
    function getListPembayaran()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM pembayaran";
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
    function getItemPembayaran($no_transaksi)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM pembayaran WHERE no_transaksi='$no_transaksi'";
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

// get 1 last data to check no_transaksi
    function getLastItemPembayaran()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT no_transaksi FROM pembayaran ORDER BY no_transaksi DESC LIMIT 1";
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

// masukkan data Pembayaran
    function insertPembayaran($no_transaksi, $id_pasien, $id_petugas, $tanggal, $biaya)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "INSERT INTO pembayaran(no_transaksi,id_pasien,id_petugas,tgl,biaya)
                    VALUES('$no_transaksi','$id_pasien', '$id_petugas', '$tanggal', '$biaya')";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

    }

// update data pembayaran
    function updatePembayaran($no_transaksi, $biaya)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE pembayaran SET biaya='$biaya'
                    WHERE no_transaksi='$no_transaksi'";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }

//delete 1 data pembayaran
    function deletePembayaran($no_transaksi)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM pembayaran WHERE no_transaksi='$no_transaksi'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }

}

?>