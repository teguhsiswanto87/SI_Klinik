// DROPDOWN :: untuk menampilkan dropdown dari jenis_kelamin
$('.ui.dropdown')
    .dropdown();
// MODAL :: memunculkan modal
// $('.mini.modal')
//     .modal('show');

// MESSAGE :: saat ada message/notification
$('.message')
    .transition('set looping')
    .transition('bounce', '2000ms')
    //saat pointer datang
    .on('mouseover', function () {
        $(this)
            .transition('remove looping')
    })
    //saat pointer keluar
    .on('mouseout', function () {
        $(this)
            .transition('set looping')
            .transition('bounce', '2000ms');
    })
    // untuk hide the message
    .on('click', function () {
        $(this)
            .remove('.message')
            .transition('remove looping')
            .transition('fade')

    });
$('#btn-logout')
    .on('click', function () {
        $('.ui.modal.logout').modal({
            closable: true,
            onDeny: function () {

            },
            onApprove: function () {
                window.location.href = 'logout.php';
            }
        }).modal('show');
    });

// $('#btn-delete')
//     .on('click', function () {
//         $('.ui.modal.delete').modal({
//             closable: true,
//             onDeny: function () {
//
//             },
//             onApprove: function () {
//                 window.alert('Approved!');
//             }
//         }).modal('show')
//     });

// modul Pengguna :: jika jabatan dipilih maka akan menampilkan daftar nama yang akan diberi akses sesuai dengan jabatannya
// $(function () {
//     $('#cbStatusPengguna').change(function () {
//         $("#cbAksesKepada").hide();
//     });
// });
function beriAkses(jabatan) {
    if (jabatan.value == 'dokter') {
        $('#cbDokter').show();
        $('#cbPetugas').hide();
        $('#cbDirektur').hide();
        $('#cb_fields').removeClass('disabled');
    } else if (jabatan.value == 'petugas') {
        $('#cbPetugas').show();
        $('#cbDirektur').hide();
        $('#cbDokter').hide();
        $('#cb_fields').removeClass('disabled');
    } else if (jabatan.value == 'dirut') {
        $('#cbDirektur').show();
        $('#cbPetugas').hide();
        $('#cbDokter').hide();
        $('#cb_fields').removeClass('disabled');
    } else {
        $('#cb_fields').addClass('disabled');
    }
}

function deleteData($link, $title = "", $text = "") {
    $('.ui.modal.delete').modal({
        closable: true,
        onDeny: function () {

        },
        onApprove: function () {
            location.replace($link);
        }
    }).modal('show');
    $('#delete-modal-title').append($title);
    $('#delete-modal-text').append($text);
}

// ----------------VALIDATION MANUAL
//validasi login
function loginAuth() {
    var username = document.formLogin.username.value.trim();
    var password = document.formLogin.password.value.trim();

    if (username.length < 4) {
        alert("Username minimal 4 karakter"); //kalau mau pakai alert
        // window.location.href = "index.php?error=7"; //ini pakai ?error=
        document.formLogin.username.focus();
        return false;
    }

    var regex = /^[A-Za-z0-9]+$/;
    if (!regex.test(username)) {
        alert("Username harus berupa huruf dan angka saja, tanpa spasi");
        document.formUsers.username.focus();
        return false;
    }

    if (password.length < 4) {
        alert("Password minimal 4 karakter");
        // window.location.href = "index.php?error=7";
        document.formLogin.password.focus();
        return false;
    }

    var regex = /^[A-Za-z0-9]+$/;
    if (!regex.test(password)) {
        alert("Password harus berupa huruf dan angka saja, tanpa spasi");
        document.formUsers.username.focus();
        return false;
    }

}

//validasi Module
function moduleValidation() {
    var module_name = document.formModule.module_name.value.trim();
    if (module_name.length == 0) {
        alert("Nama module tidak boleh kosong");
        // window.location.href = "index.php?error=7";
        document.formModule.module_name.focus();
        return false;
    }
}

//validasi Pengguna
function penggunaValidation(jenis) {
    var username = document.formPengguna.username.value.trim();
    var nama = document.formPengguna.nama.value.trim();
    var password = document.formPengguna.password.value;
    var confirmPassword = document.formPengguna.confirmPassword.value;

    if (jenis === 'update' || jenis === 'tambah') {

        if (username.length < 4) {
            alert("Username minimal 4 karakter");
            document.formPengguna.username.focus();
            return false;
        }
        //pastikan username hanya mengandung huruf dan angka
        var regex = /^[A-Za-z0-9]+$/;
        if (!regex.test(username)) {
            alert("Username harus berupa huruf dan angka saja, tanpa spasi");
            document.formPengguna.username.focus();
            return false;
        }
        //jika nama kosong
        if (nama.length == 0) {
            alert("Nama lengkap tidak boleh kosong");
            document.formPengguna.nama.focus();
            return false;
        }
        //pastikan nama hanya mengandung huruf dan angka
        var regex2 = /^[A-Za-z\s]+$/;
        if (!regex2.test(nama)) {
            alert("Nama Lengkap harus berupa huruf");
            document.formPengguna.nama.focus();
            return false;
        }

    }

    if (jenis == 'tambah') {
        //jika password & confirmPassword kurang dari 4 karakter
        if (password.length < 4) {
            alert("password minimal 4 karakter");
            document.formPengguna.password.focus();
            return false;
        } else if (confirmPassword.length < 4) {
            alert("Konfirmasi password minimal 4 karakter");
            document.formPengguna.confirmPassword.focus();
            return false;
        }
        if (password !== confirmPassword || password.length !== confirmPassword.length) {
            alert("Password dan konfirmasinya tidak valid");
            document.formPengguna.password.focus();
            return false;
        }
        //jika password mengandung spasi
        if (/\s/.test(password) || /\s/.test(confirmPassword)) {
            alert("Password tidak boleh mengandung spasi");
            document.formPengguna.password.focus();
            return false;
        }
    }
}


//password & repeat password validation
function checkPass() {
    //element
    var message = document.getElementById("message");
    var confirmPassword = document.getElementById("confirmPasswordId");
    var password = document.getElementById("passwordId");

    if (document.getElementById("password").value
        == document.getElementById("confirmPassword").value) {
        password.classList.remove("error");
        confirmPassword.classList.remove("error");
        message.innerHTML = 'Password cocok';
        message.style.color = 'green';
    } else {
        message.style.color = 'red';
        password.classList.add("error");
        confirmPassword.classList.add("error");
        message.innerHTML = 'Konfirmasi password tidak valid';
    }
    return false;
}

