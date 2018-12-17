-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Aug 03, 2016 at 12:26 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `aspek`
--

CREATE TABLE IF NOT EXISTS `aspek` (
  `id_aspek` int(11) NOT NULL AUTO_INCREMENT,
  `nama_aspek` varchar(32) NOT NULL,
  PRIMARY KEY (`id_aspek`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `aspek`
--

INSERT INTO `aspek` (`id_aspek`, `nama_aspek`) VALUES
(1, 'Aspek Kerapihan'),
(2, 'Aspek Kerajinan'),
(3, 'Aspek Kelakuan'),
(4, 'Aspek Lain-Lain');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
  `nip` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  PRIMARY KEY (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nip`, `nama`) VALUES
(11, 'Guru BP'),
(12, 'Agus'),
(555, 'Odang');

-- --------------------------------------------------------

--
-- Table structure for table `konseling`
--

CREATE TABLE IF NOT EXISTS `konseling` (
  `id_konseling` int(11) NOT NULL AUTO_INCREMENT,
  `berkas` text NOT NULL,
  `keterangan` text NOT NULL,
  `tgl_upload` date NOT NULL,
  `judul` varchar(32) NOT NULL,
  `type` int(3) NOT NULL COMMENT '1 konseling,  2 Peraturan',
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  PRIMARY KEY (`id_konseling`),
  KEY `id_konseling` (`id_konseling`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `konseling`
--

INSERT INTO `konseling` (`id_konseling`, `berkas`, `keterangan`, `tgl_upload`, `judul`, `type`, `year`, `semester`) VALUES
(8, 'konseling_20160705091426.jpeg', 'Lalala', '2016-07-05', 'Form Panggilang Orang tua', 1, 2016, 1),
(9, 'konseling_20160705093904.jpeg', 'Peraturan umum 1', '2016-07-21', 'Peraturan umum 1', 2, 2016, 1),
(10, 'konseling_20160705094659.jpeg', 'Peraturan umum 2', '2016-07-28', 'Peraturan umum 2', 2, 2016, 1),
(12, 'konseling_20160705095027.jpeg', 'Peraturan umum 3', '2016-07-14', 'Peraturan umum 3', 2, 2016, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran`
--

CREATE TABLE IF NOT EXISTS `pelanggaran` (
  `idpelanggaran` int(11) NOT NULL AUTO_INCREMENT,
  `id_aspek` int(11) NOT NULL,
  `jenis_pelanggaran` varchar(250) NOT NULL,
  `poin_pelanggaran` int(11) NOT NULL,
  `sanksi_pelanggaran` varchar(250) NOT NULL,
  PRIMARY KEY (`idpelanggaran`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `pelanggaran`
--

INSERT INTO `pelanggaran` (`idpelanggaran`, `id_aspek`, `jenis_pelanggaran`, `poin_pelanggaran`, `sanksi_pelanggaran`) VALUES
(9, 1, 'Memakai baju tidak rapi/tidak dimasukkan', 5, 'Merapikan baju'),
(10, 1, 'Tidak memakai atribut lengkap dan tidak tertib saat mengikuti upacara', 10, 'Membuat prosedur upacara yang baik sesuai dengan tata tertib pelaksanaan upacara. Mengikuti pembinaan di lapangan upacara selama 15 menit setelah upacara selesai'),
(11, 1, 'Tidak memakai sepatu berwarna hitam', 15, 'Pulang untuk mengganti sepatu dengan sepatu warna hitam'),
(12, 1, 'Tidak memakai kaos kaki berwarna putih', 5, 'Teguran dan pembinaan'),
(13, 1, 'Mengenakan pakaian ketat, rok mini', 30, 'Pulang untuk mengganti pakaian dengan yang seharusnya sesuai dengan aturan berpakaian'),
(14, 1, 'Tidak memakai ikat pinggang', 5, 'Teguran dan pembinaan'),
(15, 1, 'Memakai ikat pinggang tidak sesuai dengan ketentuan', 5, 'Ikat pinggang tersebut dicopot, disimpan diloker siswa tersebut. Teguran dan pembinaan'),
(16, 2, 'Siswa Terlambat masuk sekolah / kelas pada awal jam pelajaran, pergantian jam pelajaran dan setelah istirahat. (Lebih dari 5 menit)', 15, 'Satu jam pelajaran tersebut tidak masuk kelas, belajar di perpustakaan dengan membuat rangkuman materi pelajaran pada jam tersebut, diketahui pustakawan guru mata pelajaran dan wali kelas'),
(17, 2, 'Siswa tidak masuk sekolah tanpa keterangan yang jelas (alpa)', 10, 'Menyerahkan surat keterangan dari orang tua pada hari berikutnya, membuat catatan materi yang ditinggalkannya. Menyelesaikan tugas/latihan mata pelajaran yang tidak diikutinya pada hari tersebut'),
(18, 2, 'Siswa tidak mengerjakan tugas/PR yang diberikan guru', 20, 'Tidak boleh mengikuti mata pelajaran pada hari tersebut, dan dianggap alpa oleh guru mata pelajaran tersebut. Menyelesaikan PR tersebut dan tugas/latihan tambahan '),
(19, 2, 'Siswa meninggalkan sekolah/ kelas tanpa izin', 20, 'Menyerahkan surat keterangan dari orang tua/wali siswa tersebut. Pada jam pertama keesokan harinya “diadili” oleh wali kelas, guru BP/BK dan guru piket. Membuat catatan materi mata pelajaran yang ditinggalkan pada hari tersebut'),
(20, 2, 'Siswa tidak masuk sekolah dengan membuat surat palsu', 30, 'Pada jam pertama keesokan harinya “diadili” oleh wali kelas, guru BP/BK dengan disaksikan orang tua/walinya. Membuat surat perjanjian bahwa hal tersebut tidak akan diulangi lagi. '),
(21, 2, 'Siswa tidak mengikuti upacara bendera', 20, 'Melakukan upacara sendiri selama satu jam pelajaran. Mengikuti pembinaan dari kesiswaan'),
(22, 1, 'Memakai celana panjang berbelah/terinjak pada bagian bawah, model tidak sesuai ketentuan', 10, 'Pulang untuk mengganti pakaian dengan yang seharusnya sesuai dengan aturan berpakaian'),
(23, 1, 'Memakai rok rempel tidak sesuai dengan aturan', 15, 'Pulang untuk mengganti pakaian dengan yang seharusnya sesuai dengan aturan berpakaian'),
(24, 1, 'Memakai seragam tidak sesuai dengan hari peruntukkannya', 15, 'Pulang untuk mengganti pakaian dengan yang seharusnya sesuai dengan aturan berpakaian'),
(25, 1, 'Memakai jacket/sweater didalam lingkungan sekolah', 10, 'Jacket/sweater dilepas, disimpan diruang piket, dan diambil kembali pada saat pulang'),
(26, 1, 'Membuang sampah tidak pada tempatnya', 20, 'Mengambil sampah tersebut dan membuangnya ketempatnya'),
(27, 1, 'Siswa berambut gondrong (menutupi kerah, telinga, mata) atau dipotong tidak rapi/tidak wajar', 20, 'Dipotong/dirapikan oleh bagian kesiswaan/guru piket'),
(28, 1, 'Siswa tidak memakai seragam olahraga pada saat jam pelajaran praktek olahraga', 15, 'Tidak boleh mengikuti pelajaran olahraga dan dianggap alpa oleh guru pada jam pelajaran tersebut'),
(29, 1, 'Siswa tidak memakai kaos dalam berwarna putih', 5, 'Teguran dan pembinaan, kaos (T-Shirt) berwarna yang dipakai harus dibuka dan disimpan diruang piket untuk diambil kembali pada saat pulang'),
(30, 1, 'Siswa mengotori dan atau mencoret-coret sarana milik sekolah meja, kursi, tembok, buku, perpustakaan, dan lain-lain', 25, 'Membersihkan, merapikan kembali, mengganti yang rusak'),
(31, 1, 'Siswa memakai seragam olahraga sejak dari rumah', 15, 'Pulang untuk mengganti pakaian dengan yang seharusnya sesuai dengan aturan berpakaian'),
(33, 3, 'Siswa berdandan/berhias/ memakai perhiasan berlebihan (putri)', 20, 'Berganti dandanan sesuai aturan'),
(34, 3, 'Siswa memakai gelang, anting, kalung atau perhiasan (putra)', 20, 'Dilepas kemudian disimpan di dalam loker siswa tersebut'),
(35, 3, 'Siswa berada diluar kelas saat kegiatan belajar berlangsung tanpa izin guru yang bersangkutan', 20, 'Belajar di perpustakaan pada jam pelajaran tersebut, diketahui guru piket, pustakawan, dan guru mata pelajaran.'),
(36, 3, 'Siswa membawa dan atau bermain kartu domino, remi, Playstation, di dalam lingkungan sekolah', 25, 'Kartu domino/remi dimusnahkan, playstation disimpan di dalam loker siswa tersebut untuk diambil ketika pulang'),
(37, 3, 'Siswa membuat kegaduhan di kelas saat kegiatan belajar berjalan (ada maupun tidak ada guru)', 15, 'Berdiri di depan kelas dan menyampaikan pelajaran yang dipahaminya kepada teman-temannya'),
(38, 3, 'Siswa mencontek/memberikan contekan saat ulangan.', 50, 'Memperoleh nilai 0 (nol) pada ulangan tersebut'),
(39, 3, 'Siswa membawa/mengaktifkan HP saat kegiatan belajar atau ulangan', 30, 'Dilarang membawa HP ke sekolah'),
(40, 3, 'Siswa menyalahgunakan uang pembayaran sekolah', 50, 'Siswa membuat surat pernyataan di saksikan wali kelas, orang tua, dan guru BP lalu di skorsing'),
(41, 3, 'Siswa dengan sengaja berada disekitar lokasi tawuran', 30, 'Kembali ke lingkungan sekolah (jika di saat jam sekolah) atau pulang ke rumah (jika suda diluar jam sekolah)'),
(42, 3, 'Siswa melompati pagar halaman sekolah', 30, 'Siswa diberi hukuman lari 3 keliling lapangan sekolah'),
(43, 3, 'Siswa merusak fasilitas milik sekolah/guru (termasuk tanaman)', 50, 'Siswa membersihkan toilet/WC'),
(44, 3, 'Siswa melakukan pelecehan di dalam lingkungan sekolah', 25, 'Siswa berjanji tidak akan mengulangi perbuatannya dihadapan teman-teman sekelasnya'),
(45, 3, 'Siswa membawa foto/gambar/majalah/VCD porno', 40, 'Foto/gambar/majalah/VCD porno disita dan dimusnahkan'),
(46, 3, 'Siswa membawa rokok/merokok di lingkungan sekolah', 25, 'Rokok disita dan dimusnahkan'),
(47, 3, 'Siswa berbuat ulah/iseng/usil/yang berlebihan terhadap siswa lain', 25, 'Siswa meminta maaf dengan tulus di hadapan kelas kepada siswa yang menjadi objek perbuatannya'),
(48, 3, 'Siswa terbukti mencuri memalak, menjambret, atau menodong', 100, 'Dikeluarkan'),
(49, 3, 'Siswa berkelahi dengan teman', 50, 'Skorsing'),
(50, 3, 'Siswa membawa senjata tajam di lingkungan sekolah', 75, 'Senjata tajam tersebut disimpan di dalam loker siswa untuk diambil oleh orang tua/walinya'),
(51, 3, 'Siswa menyalahgunakan senjata tajam dilingkungan sekolah', 100, 'Dikeluarkan'),
(52, 3, 'Siswa membawa, memakai atau memperjualbelikan Miras, Narkoba, dan sejenisnya', 100, 'Dikeluarkan dan dilaporkan ke kepolisian setempat'),
(53, 3, 'Siswa terlibat tawuran dengan siswa sekolah lain', 75, 'Skorsing'),
(54, 3, 'Siswa mengancam Kepala Sekolah, guru dan karyawan', 100, 'Dikeluarkan'),
(55, 3, 'Siswa melawan secara fisik terhadap Kepala Sekolah, guru dan karyawan', 100, 'Dikeluarkan'),
(56, 3, 'Siswa ditangkap aparat keamanan karena melakukan tindak kriminal', 100, 'Dikeluarkan'),
(57, 3, 'Siswa nongkrong di pinggir jalan dan menimbulkan keresahan', 50, '“Disidangkan”'),
(58, 3, 'Siswa menikah/hamil', 100, 'Dikeluarkan'),
(59, 4, 'Siswa tidak membawa kartu peserta pada saat ulangan umum', 10, 'Dikeluarkan dari ruangan untuk mengambil kartunya'),
(60, 4, 'Rambut disambung/memakai rambut palsu', 15, 'Rambut palsu tersebut dirampas dan disimpan di dalam loker siswa tersebut'),
(61, 4, 'Siswa bersolek ketika pelajaran berlangsung', 15, 'Dikeluarkan dari dalam kelas untuk belajar di perpustakaan, alat berhiasnya dirampas dan disimpan di dalam loker siswa tersebut'),
(62, 4, 'Menghilangkan Bukti Pelanggaran Siswa', 10, 'Menuliskan kembali pelanggaran yang telah dilakukan tersebut didalam buku siswa'),
(63, 4, 'Mencharga HP di dalam kelas/ di dalam lingkungan sekolah', 5, 'HP dan Chargernya diambil untuk disimpan di dalam loker siswa tersebut yang kemudian diambil kembali saat pulang');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran_siswa`
--

CREATE TABLE IF NOT EXISTS `pelanggaran_siswa` (
  `id_pelanggaran_siswa` int(11) NOT NULL AUTO_INCREMENT,
  `nis` int(11) NOT NULL,
  `id_aspek` int(11) NOT NULL,
  `idpelanggaran` int(11) NOT NULL,
  `tgl_pelanggaran` date NOT NULL,
  `nip` int(11) NOT NULL,
  `poin_pel` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  PRIMARY KEY (`id_pelanggaran_siswa`),
  KEY `nip` (`nip`),
  KEY `idpel` (`idpelanggaran`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `pelanggaran_siswa`
--

INSERT INTO `pelanggaran_siswa` (`id_pelanggaran_siswa`, `nis`, `id_aspek`, `idpelanggaran`, `tgl_pelanggaran`, `nip`, `poin_pel`, `year`, `semester`) VALUES
(12, 30110425, 1, 9, '2016-08-03', 0, 5, 2016, 1),
(13, 30110425, 2, 16, '2016-08-17', 0, 15, 2016, 1),
(14, 30110425, 3, 38, '2016-08-11', 0, 50, 2016, 1),
(15, 30110425, 3, 35, '2016-08-17', 0, 20, 2016, 2),
(16, 30110425, 4, 59, '2016-08-17', 0, 10, 2016, 1),
(17, 30110425, 2, 16, '2016-08-03', 0, 15, 2016, 1);

-- --------------------------------------------------------

--
-- Table structure for table `prestasi`
--

CREATE TABLE IF NOT EXISTS `prestasi` (
  `idprestasi` int(11) NOT NULL AUTO_INCREMENT,
  `nis` int(32) NOT NULL,
  `kategori_prestasi` varchar(32) NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `apresiasi` varchar(150) NOT NULL,
  `tanggal` date NOT NULL,
  `foto` text NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  PRIMARY KEY (`idprestasi`),
  KEY `idprestasi` (`idprestasi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `prestasi`
--

INSERT INTO `prestasi` (`idprestasi`, `nis`, `kategori_prestasi`, `keterangan`, `apresiasi`, `tanggal`, `foto`, `year`, `semester`) VALUES
(8, 9090, 'Akademik', 'sad', 'das', '2016-06-28', 'prestasi_20160704230545.png', 2016, 1),
(9, 30110425, 'Akademik', 'dsakjd', 'dlfgj', '2016-07-08', 'prestasi_20160705115250.png', 2016, 1);

-- --------------------------------------------------------

--
-- Table structure for table `school_setting`
--

CREATE TABLE IF NOT EXISTS `school_setting` (
  `school_setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  PRIMARY KEY (`school_setting_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `school_setting`
--

INSERT INTO `school_setting` (`school_setting_id`, `year`, `semester`) VALUES
(1, 2016, 1);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `nis` int(11) NOT NULL,
  `namasiswa` varchar(50) NOT NULL,
  `jurusan` varchar(25) NOT NULL,
  `kelas` varchar(25) NOT NULL,
  PRIMARY KEY (`nis`),
  KEY `nis` (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `namasiswa`, `jurusan`, `kelas`) VALUES
(909, 'Rizky Liyanoviar', '1', '0'),
(9090, 'Shani Indira', '2', '0'),
(30110425, 'udin ', '3', '0');

-- --------------------------------------------------------

--
-- Table structure for table `start_semester`
--

CREATE TABLE IF NOT EXISTS `start_semester` (
  `start_periode_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_year` int(11) NOT NULL,
  `start_semester` int(11) NOT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  PRIMARY KEY (`start_periode_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100375 ;

--
-- Dumping data for table `start_semester`
--

INSERT INTO `start_semester` (`start_periode_id`, `start_year`, `start_semester`, `from_date`, `to_date`) VALUES
(100373, 2016, 1, '2016-07-27', '2016-12-29'),
(100374, 2016, 2, '2017-01-04', '2017-07-12');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `nis` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `password` varchar(15) NOT NULL,
  `status` int(3) NOT NULL COMMENT '1=bk, 2=kesiswaan, 3=orangtua',
  `user_active` int(11) NOT NULL,
  `user_desc` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `username`, `nis`, `nip`, `password`, `status`, `user_active`, `user_desc`) VALUES
(2, 'bp', 0, 11, 'bp', 1, 1, NULL),
(3, 'guru', 0, 12, 'guru', 2, 1, NULL),
(5, '9090', 9090, 0, '9090', 3, 1, ''),
(6, '30110425', 30110425, 0, '30110425', 3, 2, 'bannned'),
(7, '909', 909, 0, '909', 3, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE IF NOT EXISTS `user_activity` (
  `id_activity` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `aktivitas` text NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  PRIMARY KEY (`id_activity`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`id_activity`, `iduser`, `tgl`, `aktivitas`, `year`, `semester`) VALUES
(1, 2, '2016-07-31', 'Login', 1, 2016),
(2, 2, '2016-07-31', 'Tambah Prestasi Siswa', 1, 2016),
(3, 2, '2016-07-31', 'Tambah Prestasi Siswa', 1, 2016),
(4, 2, '2016-07-31', 'Login', 1, 2016),
(5, 2, '2016-07-31', 'Ubah Data Guru', 1, 2016),
(6, 2, '2016-07-31', 'logout', 1, 2016),
(7, 3, '2016-07-31', 'Login', 1, 2016),
(8, 3, '2016-07-31', 'Ubah Data Guru', 1, 2016),
(9, 3, '2016-07-31', 'logout', 1, 2016),
(10, 2, '2016-07-31', 'Login', 1, 2016),
(11, 2, '2016-07-31', 'Login', 1, 2016),
(12, 2, '2016-07-31', 'Ubah Data Siswa', 1, 2016),
(13, 2, '2016-07-31', 'Ubah Data Siswa', 1, 2016),
(14, 2, '2016-07-31', 'Tambah Pelanggaran Siswa', 1, 2016),
(15, 2, '2016-07-31', 'Tambah Pelanggaran Siswa', 1, 2016),
(16, 2, '2016-07-31', 'logout', 1, 2016),
(17, 3, '2016-07-31', 'Login', 2016, 1),
(18, 3, '2016-07-31', 'logout', 2016, 1),
(19, 2, '2016-07-31', 'Login', 2016, 1),
(20, 2, '2016-07-31', 'logout', 2016, 1),
(21, 2, '2016-08-01', 'Login', 2016, 1),
(22, 2, '2016-08-01', 'Ubah Data Siswa', 2016, 1),
(23, 2, '2016-08-01', 'Ubah Data Guru', 2016, 1),
(24, 2, '2016-08-01', 'Ubah Data Guru', 2016, 1),
(25, 2, '2016-08-01', 'Ubah Data Guru', 2016, 1),
(26, 2, '2016-08-01', 'Ubah Data Guru', 2016, 1),
(27, 2, '2016-08-01', 'Ubah Data Guru', 2016, 1),
(28, 2, '2016-08-01', 'Ubah Data Guru', 2016, 1),
(29, 2, '2016-08-01', 'Ubah Data Guru', 2016, 1),
(30, 2, '2016-08-01', 'Ubah Data Guru', 2016, 1),
(31, 2, '2016-08-01', 'Tambah Pelanggaran Siswa', 2016, 1),
(32, 2, '2016-08-01', 'Tambah Pelanggaran Siswa', 2016, 1),
(33, 2, '2016-08-01', 'Tambah Pelanggaran Siswa', 2016, 1),
(34, 2, '2016-08-01', 'Update Pelanggaran Siswa', 2016, 1),
(35, 2, '2016-08-01', 'logout', 2016, 1),
(36, 2, '2016-08-01', 'Login', 2016, 1),
(37, 2, '2016-08-01', 'Login', 2016, 1),
(38, 2, '2016-08-01', 'logout', 2016, 1),
(39, 2, '2016-08-02', 'Login', 2016, 1),
(40, 2, '2016-08-02', 'Tambah Pelanggaran Siswa', 2016, 1),
(41, 2, '2016-08-02', 'Tambah Pelanggaran Siswa', 2016, 1),
(42, 2, '2016-08-02', 'Tambah Pelanggaran Siswa', 2016, 1),
(43, 2, '2016-08-02', 'Tambah Pelanggaran Siswa', 2016, 1),
(44, 2, '2016-08-02', 'Login', 2016, 1),
(45, 2, '2016-08-02', 'Login', 2016, 1),
(46, 2, '2016-08-02', 'Tambah Pelanggaran Siswa', 2016, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
