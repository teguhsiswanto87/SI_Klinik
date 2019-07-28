-- Sumber yang kami gunakan
-- model: https://1drv.ms/w/s!Alh7exiLCBttpx-T6bAOAqYQYtYy
-- UI: https://semantic-ui.com
-- icons : icons8.com
-- PHP : native
-- Referensi Lain: -

-- buat schema model

create database si_klinik;
use si_klinik;

-- 1 // id_pasien -> ps0001
create table pasien(
    id_pasien varchar(6) primary key,
    nama_pasien varchar(50) not null,
    tempat_lahir varchar(50),
    tgl_lahir date,
    jenis_kelamin enum('L','P') not null,
    alamat varchar(100),
    kontak varchar(13)
);

-- 2 // id_pengguna -> pg0001 || status :: dokter, petugas, atau direktur
create table pengguna(
    id_pengguna varchar(6) primary key,
    username varchar(50) not null,
    password varchar(50) not null,
    status varchar(50) not null,
    url_photo varchar(100),
    id_session varchar(50)
);

-- 3 // id_petugas -> pa0001
create table petugas_administrasi(
    id_petugas varchar(6) primary key,
    id_pengguna varchar(6),
    nama_pegawai varchar(50) not null,
    alamat varchar(100),
    kontak varchar(13),

    constraint fk_pa_pengguna foreign key(id_pengguna) references pengguna(id_pengguna)

);
-- 4 // id_dokterr -> dk0001 || spesalisasi :: tht, gigi & mulut, anak, umum || jadwal = ?
create table dokter(
    id_dokter varchar(6) primary key,
    id_pengguna varchar(6),
    nama_dokter varchar(50) not null,
    spesialisasi varchar(50) not null,
    jadwal varchar(50) not null,

    constraint fk_dok_pengguna foreign key(id_pengguna) references pengguna(id_pengguna)

);
-- 5 // id_resep -> rd0001
create table resep_dokter(
    id_resep varchar(6) primary key,
    id_dokter varchar(6),
    id_pasien varchar(6),
    nama_resep varchar(50) not null,
    jenis_obat varchar(50),

    constraint fk_rd_dokter foreign key(id_dokter) references dokter(id_dokter),
    constraint fk_rd_pasien foreign key(id_pasien) references pasien(id_pasien)

);
-- 6 // id_pemeriksaan -> ip0001
create table info_pemeriksaan(
    id_pemeriksaan varchar(6) primary key,
    id_dokter varchar(6),
    id_pasien varchar(6),
    tgl_periksa date not null,
    hasil_periksa text,
    nama_pemeriksaan varchar(50),

    constraint fk_ip_pasien foreign key(id_pasien) references pasien(id_pasien),
    constraint fk_ip_dokter foreign key(id_dokter) references dokter(id_dokter)

);
-- 7 // no_transaksi -> pb0001
create table pembayaran(
    no_transaksi varchar(6) primary key,
    id_pasien varchar(6),
    id_petugas varchar(6),
    tgl date not null,
    biaya int(12),

    constraint fk_pbayar_petugas foreign key(id_petugas) references petugas_administrasi(id_petugas),
    constraint fk_pbayar_pasien foreign key(id_pasien) references pasien(id_pasien)

);
-- 8 // id_direktur -> du0001
create table direktur_utama(
    id_direktur varchar(6) primary key,
    id_pengguna varchar(6),
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
(1, 'beranda', '?m=beranda', 'home', 'Y', 'Y', 'Y', 'Y'),
(2, 'module', '?m=module', 'clone', 'Y', 'Y', 'N', 'N'),
(3, 'pasien', '?m=pasien', 'users', 'Y', 'N', 'Y', 'N'),
(4, 'pengguna', '?m=pengguna', 'user circle outline', 'Y', 'Y', 'N', 'N'),
(5, 'direktur', '?m=direktur', 'user circle', 'Y', 'Y', 'N', 'N'),
(6, 'petugas', '?m=petugas', 'user outline', 'Y', 'Y', 'N', 'N'),
(7, 'dokter', '?m=dokter', 'heartbeat', 'Y', 'Y', 'N', 'N'),
(8, 'resep', '?m=resep', 'first aid', 'Y', 'N', 'N', 'Y'),
(9, 'pemeriksaan', '?m=pemeriksaan', 'check square outline', 'Y', 'N', 'N', 'Y'),
(10, 'pembayaran', '?m=pembayaran', 'dollar sign', 'Y', 'N', 'Y', 'N'),
(11, 'laporan', '?m=laporan', 'book', 'Y', 'Y', 'N', 'N'),
(12, 'pertanyaan', '?m=pertanyaan', 'question circle orange', 'N', 'Y', 'N', 'N');

insert into pengguna(id_pengguna, username, password, status, url_photo) values
('pg0003', 'wahid', sha1('wahid'), 'dirut', ''),
('pg0004', 'rizal', sha1('rizal'), 'dirut', ''),
('pg0005', 'rashil', sha1('rashil'), 'dokter', ''),
('pg0006', 'brigita', sha1('brigita'), 'dokter', ''),
('pg0007', 'angga', sha1('angga'), 'petugas', ''),
('pg0008', 'teguh', sha1('teguh'), 'petugas', '');

INSERT INTO `direktur_utama` (`id_direktur`, `id_pengguna`, `nama_direktur`) VALUES
('dr0001', 'pg0003', 'Wahid Herlambang Suroso'),
('dr0002', 'pg0004', 'Rizal Arif Nugraha'),
('dr0003', NULL, 'Sulaksono'),
('dr0004', NULL, 'Sukamto');

insert into petugas_administrasi(id_petugas,id_pengguna ,nama_pegawai, alamat, kontak) values
('pa0001', 'pg0008', 'Teguh Siswanto', 'Jl.Sariwates Indah No.01', '08996976185'),
('pa0002', NULL, 'Akmarina', 'Jl.Sariwates Indah No.17', '089566677789'),
('pa0003', 'pg0007', 'Angga Heru', 'Jl.Layang no.1', '08111178900'),
('pa0004', NULL, 'Anwar Saputra', 'Jl.Saturnus no.13', '09989878766');

insert into dokter(id_dokter, id_pengguna, nama_dokter, spesialisasi, jadwal) values
('dk0001', NULL, 'dr. Alif Gunawan', 'dokter gigi', 'rabu'),
('dk0002', 'pg0005', 'dr. Rashil Alif', 'dokter umum', 'sabtu'),
('dk0003', NULL, 'dr. Happy Asmara', 'dokter gizi', 'senin'),
('dk0004', 'pg0006', 'dr. Brigita Julia PNG', 'dokter anak', 'selasa');


-- (null, 'rashil',sha1('rashil'),'Rashil Alif','https://akademik.unikom.ac.id/foto/10117042.jpg'),
-- (null, 'rizal',sha1('rizal'),'Rizal Alif Nugraha','https://akademik.unikom.ac.id/foto/10117048.jpg'),
-- (null, 'aher',sha1('aher'),'Angga Heru Saputra','https://akademik.unikom.ac.id/foto/10117058.jpg'),
-- (null, 'wahid',sha1('wahid'),'Wahid Herlambang Suroso','https://akademik.unikom.ac.id/foto/10117064.jpg'),
-- (null, 'brigita',sha1('brigita'),'Brigita Julia PNG','https://akademik.unikom.ac.id/foto/10117074.jpg'),
-- (null, 'amin',sha1('admin'),'Teguh Siswanto','https://akademik.unikom.ac.id/foto/10117065.jpg');

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `alamat`, `kontak`) VALUES
('ps0002', 'Siti Jenar Pengalaman', 'Semarang', '1999-09-30', 'L', 'Jl.Babakan Sari No.1 no.13', '089988877765'),
('ps0003', 'Wahyu Kolosebo', 'Yogyakarta', '1981-09-25', 'L', 'Jl.Bumi Mars No.13', '0222897867'),
('ps0004', 'Agus Kotak', 'Cilacap', '1984-02-12', 'L', 'Jl.Kebaktian No.190', '089123321123'),
('ps0005', 'Yuni', 'Bandung', '1998-09-11', 'P', 'Jl.Stasiun Selatan No.120', '0887766554433');