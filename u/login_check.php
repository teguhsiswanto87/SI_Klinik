<?php
if (!isset($_POST['btnLogin'])) {
    header("location: index.php?error=5");
} else {
    include "../config/functions.php";
    $conn = dbConnect();

    // fungsi untuk menghindari injeksi dari user yang jahil
    $username = anti_injection($_POST['username']);
    $password = anti_injection(sha1($_POST['password']));

    // menghindari sql injection
    $injeksi_username = $conn->real_escape_string($username);
    $injeksi_password = $conn->real_escape_string($password);

    // pastikan username dan password adalah berupa huruf atau angka.
    if (!ctype_alnum($injeksi_username) OR !ctype_alnum($injeksi_password)) {
        //Login tidak bisa diinjeksi ya...
        header("location: index.php?error=6");
    } else {
        $res = $conn->query("SELECT * FROM users WHERE username='$username' AND password='$password' AND block='N' ");
        $user_data = $res->fetch_assoc();
        $row_cnt = $res->num_rows;

        // Apabila username dan password ditemukan (benar) & hanya satu
        if ($row_cnt == 1) {
            session_start();

            // bikin variabel session
            $_SESSION['username'] = $user_data['username'];
            $_SESSION['password'] = $user_data['password'];
            $_SESSION['full_name'] = $user_data['full_name'];
            $_SESSION['position'] = $user_data['position'];

            // bikin id_session yang unik dan mengupdatenya agar saat login langsung berubah
            // agar user biasa sulit untuk mengganti password Administrator
            $sid_lama = session_id();
            session_regenerate_id();
            $sid_baru = session_id();
            $conn->query("UPDATE users SET id_session='$sid_baru' WHERE username='$username'");

            //langsung direct ke modul
            header("location:media.php?m=module");
        } else {
            header("location: index.php?error=1");
        }
    }
}
?>