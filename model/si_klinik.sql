-- Sumber yang kami gunakan
-- model: https://1drv.ms/w/s!Alh7exiLCBttpx-T6bAOAqYQYtYy
-- UI: https://semantic-ui.com
-- icons : icons8.com
-- PHP : native
-- Referensi Lain: -

-- buat schema model

create database si_klinik;
use si_klinik;

-- 1
create table pasien(
    id_pasien int(3) primary key auto_increment,
    nama_pasien varchar(50) not null,
    tempat_lahir varchar(50),
    tgl_lahir date,
    jenis_kelamin enum('L','P') not null,
    alamat varchar(100),
    kontak varchar(13)
);

-- 2
create table pengguna(
    id_pengguna int(3) primary key auto_increment,
    username varchar(50) not null,
    password varchar(50) not null,
    status varchar(50) not null,
    url_photo varchar(100),
    id_session varchar(50)
);

-- 3
create table petugas_administrasi(
    id_petugas int(3) primary key auto_increment,
    id_pengguna int(3),
    nama_pegawai varchar(50) not null,
    nama varchar(50) not null,
    alamat varchar(100),
    kontak varchar(13),

    constraint fk_pa_pengguna foreign key(id_pengguna) references pengguna(id_pengguna)

);
-- 4
create table dokter(
    id_dokter int(3) primary key auto_increment,
    id_pengguna int(3),
    nama_dokter varchar(50) not null,
    spesialisasi varchar(50) not null,
    jadwal varchar(50) not null,

    constraint fk_dok_pengguna foreign key(id_pengguna) references pengguna(id_pengguna)

);
-- 5
create table resep_dokter(
    id_obat int(3) primary key auto_increment,
    id_dokter int(3),
    id_pasien int(3),
    nama_obat varchar(50) not null,
    jenis varchar(50),

    constraint fk_rd_dokter foreign key(id_dokter) references dokter(id_dokter),
    constraint fk_rd_pasien foreign key(id_pasien) references pasien(id_pasien)

);
-- 6
create table info_pemeriksaan(
    id_pemeriksaan int(3) primary key auto_increment,
    id_dokter int(3),
    id_pasien int(3),
    tgl_periksa date not null,
    hasil_periksa varchar(50),

    constraint fk_ip_pasien foreign key(id_pasien) references pasien(id_pasien),
    constraint fk_ip_dokter foreign key(id_dokter) references dokter(id_dokter)

);
-- 7
create table pembayaran(
    no_transaksi int(3) primary key auto_increment,
    id_pasien int(3),
    id_petugas int(3),
    tgl date not null,
    biaya int(12),

    constraint fk_pbayar_petugas foreign key(id_petugas) references petugas_administrasi(id_petugas),
    constraint fk_pbayar_pasien foreign key(id_pasien) references pasien(id_pasien)

);
-- 8
create table direktur_utama(
    id_direktur int(3) primary key auto_increment,
    id_pengguna int(3),
    nama_direktur varchar(50),

    constraint fk_dirut_pengguna foreign key(id_pengguna) references pengguna(id_pengguna)

);


-- untuk mengelola modul/data menu pada halaman administrator
create table module(
    module_id int primary key auto_increment,
    module_name varchar(50) not null,
    link varchar(50),
    icon varchar(50),
    active enum('Y','N') not null default 'Y',
    access_director enum('Y','N'),
    access_admin enum('Y','N'),
    access_doctor enum('Y','N')
)Engine=InnoDB;
-- ### INSERT DATA MODULE
insert into module(module_id, module_name, link, icon, active, access_director, access_admin, access_doctor) values
(1, "beranda","?m=beranda","home","Y","Y","Y","Y"),
(2, "module","?m=module","clone","Y","Y","Y","Y"),
(3, "pasien","?m=pasien","users","Y","Y","Y","Y"),
(4, "pengguna","?m=pengguna","user circle outline","Y","Y","Y","Y"),
(5, "petugas","?m=petugas","user outline","Y","Y","Y","Y"),
(6, "dokter","?m=dokter","heartbeat","Y","Y","Y","Y"),
(7, "resep","?m=resep","first aid","Y","Y","Y","Y"),
(8, "pemeriksaan","?m=pemeriksaan","check square outline","Y","Y","Y","Y"),
(9, "pembayaran","?m=pembayaran","dollar sign","Y","Y","Y","Y"),
(10, "laporan","?m=laporan","book","Y","Y","Y","Y"),
(null, "pertanyaan","?m=pertanyaan","question circle orange","Y","Y","Y","Y");

-- Insert Pengguna => untuk login admin
insert into pengguna(id_pengguna, username, password, status, url_photo) values
(null, 'dokter',sha1('dokter'),'dokter','https://img.icons8.com/color/48/000000/doctor-male.png'),
(null, 'admin',sha1('admin'),'admin','https://img.icons8.com/color/48/000000/administrator-male.png'),
(null, 'dirut',sha1('dirut'),'dirut','https://img.icons8.com/dusk/50/000000/admin-settings-male.png');
-- (null, 'rashil',sha1('rashil'),'Rashil Alif','https://akademik.unikom.ac.id/foto/10117042.jpg'),
-- (null, 'rizal',sha1('rizal'),'Rizal Alif Nugraha','https://akademik.unikom.ac.id/foto/10117048.jpg'),
-- (null, 'aher',sha1('aher'),'Angga Heru Saputra','https://akademik.unikom.ac.id/foto/10117058.jpg'),
-- (null, 'wahid',sha1('wahid'),'Wahid Herlambang Suroso','https://akademik.unikom.ac.id/foto/10117064.jpg'),
-- (null, 'brigita',sha1('brigita'),'Brigita Julia PNG','https://akademik.unikom.ac.id/foto/10117074.jpg'),
-- (null, 'amin',sha1('admin'),'Teguh Siswanto','https://akademik.unikom.ac.id/foto/10117065.jpg');


insert into petugas_administrasi(id_petugas, id_pengguna, nama_pegawai, nama, alamat, kontak) values ;
()