-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 14, 2022 at 01:54 PM
-- Server version: 5.7.33
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aum-u`
--

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaans`
--

CREATE TABLE `pertanyaans` (
  `kode_pertanyaan` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_kategori` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pertanyaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pertanyaans`
--

INSERT INTO `pertanyaans` (`kode_pertanyaan`, `kode_kategori`, `pertanyaan`, `created_at`, `updated_at`) VALUES
('001', 'JDK', 'Badan terlalu kurus, atau terlalu gemuk', '2022-12-10 06:32:29', '2022-12-10 06:45:04'),
('002', 'JDK', 'Warna kulit kurang memuaskan', '2022-12-10 06:45:50', '2022-12-10 06:45:50'),
('003', 'JDK', 'Berat badan terus berkurang, atau bertambah', '2022-12-10 06:46:10', '2022-12-10 06:46:10'),
('004', 'JDK', 'Badan terlalu pendek, atau terlalu gemuk', '2022-12-10 06:52:07', '2022-12-10 06:52:07'),
('005', 'JDK', 'Secara jasmaniah kurang menarik', '2022-12-10 06:52:30', '2022-12-10 06:52:30'),
('006', 'KDP', 'Belum mampu memikirkan dan memilih pekerjaan yang akan dijabat nantinya', '2022-12-10 06:53:26', '2022-12-10 06:53:26'),
('007', 'KDP', 'Belum mengetahui bakat diri sendiri untuk jabatan/pekerjaan apa', '2022-12-10 06:53:42', '2022-12-10 06:53:42'),
('008', 'KDP', 'Kurang memiliki pengetahuan yang luas tentang lapangan pekerjaan dan seluk beluk jenis-jenis pekerjaan', '2022-12-10 06:53:59', '2022-12-10 06:53:59'),
('009', 'KDP', 'Ingin memperoleh bantuan dalam mendapatkan pekerjaan sambilan untuk melatih diri bekerja sambil sekolah', '2022-12-10 06:54:19', '2022-12-10 06:54:19'),
('010', 'KDP', 'Khawatir akan pekerjaan yang dijabatnya nanti; jangan-jangan memberikan penghasilan yang tidak mencukupi', '2022-12-10 07:31:50', '2022-12-10 07:31:50'),
('011', 'PDP', 'Terpaksa atau ragu-ragu memasuki sekolah ini', '2022-12-10 07:32:27', '2022-12-10 07:32:27'),
('012', 'PDP', 'Meragukan kemanfaatan memasuki sekolah ini', '2022-12-10 07:32:41', '2022-12-10 07:32:41'),
('013', 'PDP', 'Sukar menyesuaikan diri dengan keadaan sekolah', '2022-12-10 07:32:55', '2022-12-10 07:32:55'),
('014', 'PDP', 'Kurang meminati pelajaran atau jurusan atau program yang diikuti', '2022-12-10 07:33:11', '2022-12-10 07:33:11'),
('015', 'PDP', 'Khawatir tidak dapat menamatkan sekolah pada waktu yang direncanakan', '2022-12-10 07:33:27', '2022-12-10 07:33:27'),
('016', 'JDK', 'Fungsi dan/atau kondisi kesehatan mata kurang baik', '2022-12-10 07:34:04', '2022-12-10 07:34:04'),
('017', 'JDK', 'Mengalami gangguan tertentui karena cacat jasmani', '2022-12-10 07:34:20', '2022-12-10 07:34:20'),
('018', 'JDK', 'Fungsi dan/atau kondisi kesehatan hidung kurang baik', '2022-12-10 07:34:35', '2022-12-10 07:34:35'),
('019', 'JDK', 'Kondisi kesehatan kulit sering terganggu', '2022-12-10 07:34:50', '2022-12-10 07:34:50'),
('020', 'JDK', 'Gangguan pada gigi', '2022-12-10 07:35:03', '2022-12-10 07:35:03'),
('021', 'KDP', 'Ragu akan kemampuan saya untuk sukses dalam bekerja', '2022-12-10 07:35:29', '2022-12-10 07:35:29'),
('022', 'KDP', 'Belum mampu merencanakan masa depan', '2022-12-10 07:35:46', '2022-12-10 07:35:46'),
('023', 'KDP', 'Takut akan bayangan masa depan', '2022-12-10 07:36:01', '2022-12-10 07:36:01'),
('024', 'KDP', 'Mengalami masalah karena membanding-bandingkan pekerjaan yang layak atau tidak layak untuk dijabat', '2022-12-10 07:36:20', '2022-12-10 07:36:20'),
('025', 'KDP', 'Khawatir diperlakukan secara tidak wajar atau tidak adil dalam mencari dan/atau melamar pekerjaaan', '2022-12-10 07:36:41', '2022-12-10 07:36:41'),
('026', 'PDP', 'Sering tidak masuk sekolah', '2022-12-10 07:37:13', '2022-12-10 07:37:13'),
('027', 'PDP', 'Tugas-tugas pelajaran tidak selesai pada waktunya', '2022-12-10 07:37:28', '2022-12-10 07:37:28'),
('028', 'PDP', 'Sukar memahami penjelasan guru sewaktu pelajaran berlangsung', '2022-12-10 07:37:44', '2022-12-10 07:37:44'),
('029', 'PDP', 'Mengalami kesulitan dalam membuat catatan pelajaran', '2022-12-10 07:37:58', '2022-12-10 07:37:58'),
('030', 'PDP', 'Terpaksa mengikuti mata pelajaran yang tidak disukai', '2022-12-10 07:38:13', '2022-12-10 07:38:13'),
('031', 'JDK', 'Fungsi dan/atau kondisi kerongkongan kurang baik atau sering terganggu,misalnya serak', '2022-12-10 07:38:51', '2022-12-10 07:38:51'),
('032', 'JDK', 'Gagap dalam berbicara', '2022-12-10 07:39:03', '2022-12-10 07:39:03'),
('033', 'JDK', 'Fungsi dan/atau kondisi kesehatan telinga kurang baik', '2022-12-10 07:39:17', '2022-12-10 07:39:17'),
('034', 'JDK', 'Kurang mampu berolahraga karena kondisi jasmani yang kurang baik', '2022-12-10 07:39:44', '2022-12-10 07:39:44'),
('035', 'JDK', 'Gangguan pada pencernaan makanan', '2022-12-10 07:39:57', '2022-12-10 07:39:57'),
('036', 'KDP', 'Kurang yakin terhadap kamampuan pendidikan sekarang ini dalam menyiapkan jabatan tertentu nantinya', '2022-12-10 07:40:20', '2022-12-10 07:40:20'),
('037', 'KDP', 'Ragu tentang kesempatan memperoleh pekerjaan sesuai dengan pendidikan yang diikuti sekarang ini', '2022-12-10 07:40:34', '2022-12-10 07:40:34'),
('038', 'KDP', 'Ingin mengikuti kegiatan pelajaran dan/atau latihan khusus tertentu yang benar-benar menunjang proses mencari dan melamar pekerjaan setamat pendidikan ini', '2022-12-10 07:40:50', '2022-12-10 07:40:50'),
('039', 'KDP', 'Cemas kalau menjadi penganggur setamat pendidikan ini', '2022-12-10 07:41:04', '2022-12-10 07:41:04'),
('040', 'KDP', 'Ragu apakah setamat pendidikan ini dapat bekerja secara mandiri', '2022-12-10 07:41:20', '2022-12-10 07:41:20'),
('041', 'PDP', 'Gelisah dan/atau melakukan kegiatan tidak menentu sewaktu pelajaran berlangsung, misalnya membuat coret-coretan dalam buku,cenderung mengganggu teman', '2022-12-10 07:41:35', '2022-12-10 07:41:35'),
('042', 'PDP', 'Sering malas belajar', '2022-12-10 07:41:47', '2022-12-10 09:23:20'),
('043', 'PDP', 'Kurang konsentrasi dalam mengikuti pelajaran', '2022-12-10 07:42:00', '2022-12-10 07:42:00'),
('044', 'PDP', 'Khawatir tugas-tugas pelajaran hasilnya kurang memuaskan atau rendah', '2022-12-10 07:42:14', '2022-12-10 07:42:14'),
('045', 'PDP', 'Mengalami masalah kerena kemajuan atau hasil belajar hanya diberitahukan pada akhir catur wulan', '2022-12-10 07:42:28', '2022-12-10 07:42:28'),
('046', 'JDK', 'Sering pusing dan/atau mudah sakit', '2022-12-10 08:20:03', '2022-12-10 08:20:03'),
('047', 'JDK', 'Mengalami gangguan setiap datang bulan', '2022-12-10 08:20:22', '2022-12-10 08:20:22'),
('048', 'JDK', 'Secara umum merasa tidak sehat', '2022-12-10 08:20:35', '2022-12-10 08:20:35'),
('049', 'JDK', 'Khawatir mengidap penyakit turunan', '2022-12-10 08:20:49', '2022-12-10 08:20:49'),
('050', 'JDK', 'Selera makan sering terganggu', '2022-12-10 08:21:02', '2022-12-10 08:21:02'),
('051', 'KDP', 'Hasil belajar atau nilai-nilai kurang memuaskan', '2022-12-10 08:21:18', '2022-12-10 08:21:18'),
('052', 'KDP', 'Mengalami masalah dalam belajar kelompok', '2022-12-10 08:21:31', '2022-12-10 08:21:31'),
('053', 'KDP', 'Kurang berminat dan/atau kurang mampu mempelajari buku pelajaran', '2022-12-10 08:21:48', '2022-12-10 08:21:48'),
('054', 'KDP', 'Takut dan/atau kurang mampu berbicara di dalam kelas dan/atau di luar kelas', '2022-12-10 08:22:01', '2022-12-10 08:22:01'),
('055', 'KDP', 'Mengalami kesulitan dalam ejaan, tata bahasa dan/atau perbendaharaan kata dalam Bahasa Indonesia', '2022-12-10 08:22:13', '2022-12-10 08:22:13'),
('056', 'PDP', 'Mengalami masalah dalam menjawab pertanyaan ujian', '2022-12-10 08:22:28', '2022-12-10 08:22:28'),
('057', 'PDP', 'Tidak mengetahui dan/atau tidak mampu menerapkan cara-cara belajar yang baik', '2022-12-10 08:22:44', '2022-12-10 08:22:44'),
('058', 'PDP', 'Kekurangan waktu untuk belajar', '2022-12-10 08:22:58', '2022-12-10 08:22:58'),
('059', 'PDP', 'Mengalami masalah dalam menyusun makalah, laporan atau karya tulis lainnya', '2022-12-10 08:23:11', '2022-12-10 08:23:11'),
('060', 'PDP', 'Sukar mendapatkan buku pelajaran yang diperlukan', '2022-12-10 08:23:24', '2022-12-10 08:23:24'),
('061', 'JDK', 'Mengidap penyakit kambuhan', '2022-12-10 08:24:24', '2022-12-10 08:24:24'),
('062', 'JDK', 'Alergi terhadap makanan atau keadaan tertentu', '2022-12-10 08:24:40', '2022-12-10 08:24:40'),
('063', 'JDK', 'Kurang atau susah tidur', '2022-12-10 08:24:53', '2022-12-10 08:24:53'),
('064', 'JDK', 'Mengalami gangguan akibat merokok atau minuman atau obat-obatan', '2022-12-10 08:25:06', '2022-12-10 08:25:06'),
('065', 'JDK', 'Khawatir tertular penyakit yang diderita orang lain', '2022-12-10 08:25:29', '2022-12-10 08:25:29'),
('066', 'KDP', 'Mengalami kesulitan dalam pemahaman dan penggunaan istilah dan/atau Bahasa Inggris dan/atau bahasa asing lainnya', '2022-12-10 08:25:46', '2022-12-10 08:25:46'),
('067', 'KDP', 'Kesulitan dalam membaca cepat dan/atau memahami isi buku pelajaran', '2022-12-10 08:26:02', '2022-12-10 08:26:02'),
('068', 'KDP', 'Takut menghadapi ulangan/ujian', '2022-12-10 08:26:17', '2022-12-10 08:26:17'),
('069', 'KDP', 'Khawatir memperoleh nilai rendah dalam ulangan/ujian ataupun tugas-tugas', '2022-12-10 08:26:30', '2022-12-10 08:26:30'),
('070', 'KDP', 'Kesulitan dalam mengingat materi pelajaran', '2022-12-10 08:26:45', '2022-12-10 08:26:45'),
('071', 'PDP', 'Seringkali tidak siap menghadapi ujian', '2022-12-10 08:27:00', '2022-12-10 08:27:00'),
('072', 'PDP', 'Sarana belajar di sekolah kurang memadai', '2022-12-10 08:27:12', '2022-12-10 08:27:12'),
('073', 'PDP', 'Orang tua kurang peduli dan/atau kurang membantu kegiatan belajar di sekolah dan/atau dirumah', '2022-12-10 08:27:25', '2022-12-10 08:27:25'),
('074', 'PDP', 'Anggota keluarga kurang peduli dan/atau kurang membantu kegiatan belajar di sekolah dan/atau dirumah', '2022-12-10 08:27:42', '2022-12-10 08:27:42'),
('075', 'PDP', 'Sarana belajar dirumah kurang memadai', '2022-12-10 08:27:56', '2022-12-10 08:27:56'),
('076', 'DPI', 'Sering mimpi buruk', '2022-12-10 08:28:36', '2022-12-10 08:28:36'),
('077', 'DPI', 'Cemas atau khawatir tentang sesuatu yang belum pasti', '2022-12-10 08:28:53', '2022-12-10 08:28:53'),
('078', 'DPI', 'Mudah lupa', '2022-12-10 08:31:32', '2022-12-10 08:31:32'),
('079', 'DPI', 'Sering melamun atau berkhayal', '2022-12-10 08:31:51', '2022-12-10 08:31:51'),
('080', 'DPI', 'Ceroboh atau kurang hati-hati', '2022-12-10 08:32:05', '2022-12-10 08:32:05'),
('081', 'KDP', 'Cara guru menyajikan pelajaran terlalu kaku dan/atau membosankan', '2022-12-10 08:32:33', '2022-12-10 08:32:33'),
('082', 'KDP', 'Guru kurang bersahabat dan/atau  membimbing siswa', '2022-12-10 08:32:51', '2022-12-10 08:32:51'),
('083', 'KDP', 'Mengalami masalah karena disiplin yang diterapkan oleh guru', '2022-12-10 08:33:08', '2022-12-10 08:33:08'),
('084', 'KDP', 'Dirugikan karena dalam menilai kemajuan atau keberhasilan siswa guru kurang objektif', '2022-12-10 08:33:21', '2022-12-10 08:33:21'),
('085', 'KDP', 'Guru kurang memberikan tanggung jawab kepada siswa', '2022-12-10 08:33:33', '2022-12-10 08:33:33'),
('086', 'PDP', 'Guru kurang adil atau pilih kasih', '2022-12-10 08:33:48', '2022-12-10 08:33:48'),
('087', 'PDP', 'Ingin dekat dengan guru', '2022-12-10 08:34:29', '2022-12-10 08:34:29'),
('088', 'PDP', 'Guru kurang memperhatikan kebutuhan dan/atau  keadaan siswa', '2022-12-10 08:34:43', '2022-12-10 08:34:43'),
('089', 'PDP', 'Mendapat perhatian khusus dari guru tertentu', '2022-12-10 08:35:03', '2022-12-10 08:35:03'),
('090', 'PDP', 'Dalam memberikan pelajaran dan/atau  berhubungan dengan siswa sikap dan/atau  tindakan guru sering berubah-ubah sehingga membingungkan siswa', '2022-12-10 08:35:16', '2022-12-10 08:35:16'),
('091', 'DPI', 'Sering murung dan/atau  merasa tidak bahagia', '2022-12-10 08:36:41', '2022-12-10 08:36:41'),
('092', 'DPI', 'Mengalami kerugian atau kesulitan karena terlampau hati-hati', '2022-12-10 08:36:58', '2022-12-10 08:36:58'),
('093', 'DPI', 'Kurang serius menghadapi sesuatu yang penting', '2022-12-10 08:37:13', '2022-12-10 08:37:13'),
('094', 'DPI', 'Merasa hidup ini kurang berarti', '2022-12-10 08:37:27', '2022-12-10 08:37:27'),
('095', 'DPI', 'Sering gagal dan/atau  mudah patah semangat', '2022-12-10 08:37:50', '2022-12-10 08:37:50'),
('096', 'KDP', 'Khawatir akan dipaksa melanjutkan pelajaran setamat sekolah ini', '2022-12-10 08:38:17', '2022-12-10 08:38:17'),
('097', 'KDP', 'Kekurangan informasi tentang pendidikan lanjutan yang dapat dimasuki setamat sekolah ini', '2022-12-10 08:38:30', '2022-12-10 08:38:30'),
('098', 'KDP', 'Ragu tentang kemanfaatan pendidikan lanjutan setamat sekolah ini', '2022-12-10 08:38:46', '2022-12-10 08:38:46'),
('099', 'KDP', 'Khawatir tidak mampu melanjutkan pelajaran setamat dari sekolah ini dan/atau  terlalu memikirkan pendidikan lanjutan setamat sekolah ini', '2022-12-10 08:39:04', '2022-12-10 08:39:04'),
('100', 'KDP', 'Ragu apakah sekolah sekarang ini mampu memberikan modal yang kuat bagi para siswanya untuk menempuh pendidikan yang lebih lanjut', '2022-12-10 08:39:17', '2022-12-10 08:39:17'),
('101', 'PDP', 'Khawatir tidak tersedia biaya untuk melanjutkan pekerjaan setamat sekolah ini', '2022-12-10 08:39:32', '2022-12-10 08:39:32'),
('102', 'PDP', 'Tidak dapat mengambil keputusan tentang apakah akan mencari pekerjaan atau melanjutkan pelajaran setamat sekolah ini', '2022-12-10 08:39:45', '2022-12-10 08:39:45'),
('103', 'PDP', 'Khawatir tuntutan dan proses pendidikan lanjutan setamat sekolah ini sangat berat', '2022-12-10 08:39:57', '2022-12-10 08:39:57'),
('104', 'PDP', 'Terdapat pertentangan pendapat dengan orang tua dan/atau  anggota keluarga lain tentang rencana melanjutkan pelajaran setamat sekolah ini', '2022-12-10 08:40:25', '2022-12-10 08:40:25'),
('105', 'PDP', 'Khawatir tidak mampu bersaing dalam upaya memasuki pendidikan lanjutan setamat sekolah ini', '2022-12-10 08:40:39', '2022-12-10 08:40:39'),
('106', 'DPI', 'Mudah gentar atau khawatir dalam menghadapi dan/atau  mengemukakan sesuatu', '2022-12-10 08:43:51', '2022-12-10 08:43:51'),
('107', 'DPI', 'Penakut, pemalu, dan/atau  mudah menjadi bingung', '2022-12-10 08:44:05', '2022-12-10 08:44:05'),
('108', 'DPI', 'Keras kepala atau sukar mengubah pendapat sendiri meskipun kata orang lain pendapat itu salah', '2022-12-10 08:44:18', '2022-12-10 08:44:18'),
('109', 'DPI', 'Takut mencoba sesuatu yang baru', '2022-12-10 08:44:29', '2022-12-10 08:44:29'),
('110', 'DPI', 'Mudah marah atau tidak mampu mengendalikan diri', '2022-12-10 08:44:40', '2022-12-10 08:44:40'),
('111', 'ANM', 'Mengalami masalah untuk pergi ke tempat peribadatan', '2022-12-10 08:45:12', '2022-12-10 08:45:12'),
('112', 'ANM', 'Mempunyai pandangan dan/atau  kebiasaan yang tidak sesuai dengan kaidah-kaidah agama', '2022-12-10 08:45:27', '2022-12-10 08:45:27'),
('113', 'ANM', 'Tidak mampu melaksanakan tuntutan keagamaan dan/atau khawatir tidak mampu menghindari larangan yang ditentukan oleh agama', '2022-12-10 08:45:40', '2022-12-10 08:45:40'),
('114', 'ANM', 'Kurang menyukai pembicaraan tentang agama', '2022-12-10 08:45:54', '2022-12-10 08:45:54'),
('115', 'ANM', 'Ragu dan ingin memperoleh penjelasan lebih banyak tentang kaidah-kaidah agama', '2022-12-10 08:46:07', '2022-12-10 08:46:07'),
('116', 'ANM', 'Mengalami kesulitan dalam mendalami agama', '2022-12-10 08:47:37', '2022-12-10 08:47:37'),
('117', 'ANM', 'Tidak memiliki kecakapan dan/atau  sarana untuk melaksanakan ibadah agama', '2022-12-10 08:47:52', '2022-12-10 08:47:52'),
('118', 'ANM', 'Mengalami masalah karena membandingkan agama yang satu dengan yang lainnya', '2022-12-10 08:48:04', '2022-12-10 08:48:04'),
('119', 'ANM', 'Bermasalah karena anggota keluarga tidak seagama', '2022-12-10 08:48:15', '2022-12-10 08:48:15'),
('120', 'ANM', 'Belum menjalankan ibadah agama sebagaimana diharapkan', '2022-12-10 08:48:28', '2022-12-10 08:48:28'),
('121', 'DPI', 'Merasa kesepian dan/atau takut ditinggal sendiri', '2022-12-10 08:48:52', '2022-12-10 08:48:52'),
('122', 'DPI', 'Sering bertingkah laku, bertindak, atau bersikap kekanak-kanakan', '2022-12-10 08:49:07', '2022-12-10 08:49:07'),
('123', 'DPI', 'Rendah diri atau kurang percaya diri', '2022-12-10 08:49:21', '2022-12-10 08:49:21'),
('124', 'DPI', 'Kurang terbuka terhadap orang lain', '2022-12-10 08:50:08', '2022-12-10 08:50:08'),
('125', 'DPI', 'Sering membesar-besarkan sesuatu yang sebenarnya tidak perlu', '2022-12-10 08:50:19', '2022-12-10 08:50:19'),
('126', 'ANM', 'Berkata dusta dan/atau  berbuat tidak jujur untuk tujuan-tujuan tertentu, seperti membohongi teman,berlaku curang dalam ujian', '2022-12-10 08:50:57', '2022-12-10 08:50:57'),
('127', 'ANM', 'Kurang mengetahui hal-hal yang menurut orang lain dianggap baik atau buruk,benar atau salah', '2022-12-10 08:51:10', '2022-12-10 08:51:10'),
('128', 'ANM', 'Tidak dapat mengambil keputusan tentang sesuatu karena kurang memahami baik-buruknya atau benar-salahnya sesuatu itu', '2022-12-10 08:51:23', '2022-12-10 08:51:23'),
('129', 'ANM', 'Merasa terganggu oleh kesalahan atau keburukan orang lain', '2022-12-10 08:51:37', '2022-12-10 08:51:37'),
('130', 'ANM', 'Tidak mengetahui cara-cara yang tepat untuk mengatakan kepada orang lain tentang sesuatu yang baik atau buruk,benar atau salah', '2022-12-10 08:51:53', '2022-12-10 08:51:53'),
('131', 'ANM', 'Khawatir atau merasa ketakutan akan akibat perbuatan melanggar kaidah-kaidah agama', '2022-12-10 08:52:06', '2022-12-10 08:52:06'),
('132', 'ANM', 'Kurang menyukai pembicaraan yang dilontarkan di tempat peribadatan', '2022-12-10 08:52:16', '2022-12-10 08:52:16'),
('133', 'ANM', 'Kurang taat dan/atau  kurang khusyuk dalam menjalankan ibadah agama', '2022-12-10 08:52:27', '2022-12-10 08:52:27'),
('134', 'ANM', 'Mengalami masalah karena memiliki pandangan dan/atau  sikap keagamaan yang cenderung fanatik atau berprasangka', '2022-12-10 08:52:48', '2022-12-10 08:52:48'),
('135', 'ANM', 'Meragukan manfaat ibadah dan/atau  upacara keagamaan', '2022-12-10 08:53:01', '2022-12-10 08:53:01'),
('136', 'HSO', 'Tidak menyukai atau tidak disukai seseorang', '2022-12-10 08:54:18', '2022-12-10 08:54:18'),
('137', 'HSO', 'Merasa diperhatikan, dibicarakan atau diperolokkan orang lain', '2022-12-10 08:54:35', '2022-12-10 08:54:35'),
('138', 'HSO', 'Mengalami masalah karena ingin lebih terkenal atau lebih menarik atau lebih menyenangkan bagi orang lain', '2022-12-10 08:54:46', '2022-12-10 08:54:46'),
('139', 'HSO', 'Mempunyai kawan yang kurang disukai orang lain', '2022-12-10 08:54:58', '2022-12-10 08:54:58'),
('140', 'HSO', 'Tidak mempunyai kawan akrab, hubungan sosial terbatas atau terisolir', '2022-12-10 08:55:08', '2022-12-10 08:55:08'),
('141', 'ANM', 'Merasa terganggu karena melakukan sesuatu yang menjadikan orang lain tidak senang', '2022-12-10 08:55:21', '2022-12-10 08:55:21'),
('142', 'ANM', 'Terlanjur berbicara, bertindak atau bersikap yang tidak layak kepada orang tua  dan/atau orang lain', '2022-12-10 08:55:32', '2022-12-10 08:55:32'),
('143', 'ANM', 'Sering ditegur karena dianggap melakukan kesalahan, pelanggaran atau sesuatu yang tidak layak', '2022-12-10 08:55:44', '2022-12-10 08:55:44'),
('144', 'ANM', 'Mengalami masalah karena berbohong atau berkata tidak layak meskipun sebenarnya dengan maksud sekedar berolok-olok atau menimbulkan suasana gembira', '2022-12-10 08:55:57', '2022-12-10 08:55:57'),
('145', 'ANM', 'Tidak melakukan sesuatu yang sesungguhnya perlu dilakukan', '2022-12-10 08:56:09', '2022-12-10 08:56:09'),
('146', 'ANM', 'Takut dipersalahkan karena melanggar adat', '2022-12-10 08:56:39', '2022-12-10 08:56:39'),
('147', 'ANM', 'Mengalami masalah karena memiliki kebiasaan yang berbeda dari orang lain', '2022-12-10 08:56:51', '2022-12-10 08:56:51'),
('148', 'ANM', 'Terlanjur melakukan sesuatu perbuatan yang salah, atau melanggar nilai-nilai moral atau adat', '2022-12-10 08:57:22', '2022-12-10 08:57:22'),
('149', 'ANM', 'Merasa bersalah karena terpaksa mengingkari janji', '2022-12-10 08:57:33', '2022-12-10 08:57:33'),
('150', 'ANM', 'Mengalami persoalan karena berbeda pendapat tentang suatu aturan dalam adat', '2022-12-10 08:57:45', '2022-12-10 08:57:45'),
('151', 'HSO', 'Kurang perduli terhadap orang lain', '2022-12-10 08:58:26', '2022-12-10 08:58:26'),
('152', 'HSO', 'Rapuh dalam berteman', '2022-12-10 08:58:38', '2022-12-10 08:58:38'),
('153', 'HSO', 'Merasa tidak dianggap penting, diremehkan atau dikecam oleh orang lain', '2022-12-10 08:58:53', '2022-12-10 08:59:32'),
('154', 'HSO', 'Mengalami masalah dengan orang lain karena kurang perduli terhadap diri sendiri', '2022-12-10 08:59:04', '2022-12-10 08:59:13'),
('155', 'HSO', 'Canggung dan/atau tidak lancar berkomunikasi dengan orang lain', '2022-12-10 08:59:49', '2022-12-10 08:59:49'),
('156', 'HMP', 'Membutuhkan keterangan tentang persoalan seks, pacaran dan/atau perkawinan', '2022-12-10 09:00:23', '2022-12-10 09:00:23'),
('157', 'HMP', 'Mengalami masalah karena malu dan kurang terbuka dalam membicarakan soal seks, pacar dan/atau jodoh', '2022-12-10 09:00:34', '2022-12-10 09:00:34'),
('158', 'HMP', 'Khawatir tidak mendapatkan pacar atau jodoh yang baik/cocok', '2022-12-10 09:00:47', '2022-12-10 09:00:47'),
('159', 'HMP', 'Terlalu memikirkan tentang seks, percintaan, pacaran atau perkawinan', '2022-12-10 09:00:59', '2022-12-10 09:00:59'),
('160', 'HMP', 'Mengalami masalah karena dilarang atau merasa tidak patut berpacaran', '2022-12-10 09:01:11', '2022-12-10 09:01:11'),
('161', 'KHK', 'Bermasalah karena kedua orang tua hidup berpisah atau bercerai', '2022-12-10 09:01:44', '2022-12-10 09:01:44'),
('162', 'KHK', 'Mengalami masalah karena ayah dan/atau ibu kandung telah meninggal', '2022-12-10 09:01:57', '2022-12-10 09:01:57'),
('163', 'KHK', 'Mengkhawatirkan kondisi kesehatan anggota keluarga', '2022-12-10 09:02:09', '2022-12-10 09:02:09'),
('164', 'KHK', 'Mengalami masalah karena keadaan dan perlengkapan tempat tinggal dan/atau rumah orang tua kurang memadai', '2022-12-10 09:02:24', '2022-12-10 09:02:24'),
('165', 'KHK', 'Mengkhawatirkan kondisi orang tua yang bekerja terlalu berat', '2022-12-10 09:02:37', '2022-12-10 09:22:24'),
('166', 'HSO', 'Tidak lincah dan kurang mengetahui tentang tata krama pergaulan', '2022-12-10 09:04:25', '2022-12-10 09:04:25'),
('167', 'HSO', 'Kurang pandai memimpin dan/atau mudah dipengaruhi orang lain', '2022-12-10 09:04:40', '2022-12-10 09:04:40'),
('168', 'HSO', 'Sering membantah atau tidak menyukai sesuatu yang dikatakan/dirasakan orang lain atau dikatakan sombong', '2022-12-10 09:04:52', '2022-12-10 09:04:52'),
('169', 'HSO', 'Mudah tersinggung atau sakit hati dalam berhubungan dengan orang lain', '2022-12-10 09:05:04', '2022-12-10 09:05:04'),
('170', 'HSO', 'Lambat menjalin persahabatan', '2022-12-10 09:05:26', '2022-12-10 09:05:26'),
('171', 'HMP', 'Kurang mendapat perhatian dari jenis kelamin lain atau pacar', '2022-12-10 09:05:42', '2022-12-10 09:05:42'),
('172', 'HMP', 'Mengalami masalah karena ingin mempunyai pacar', '2022-12-10 09:05:59', '2022-12-10 09:05:59'),
('173', 'HMP', 'Canggung dalam menghadapi jenis kelamin lain atau pacar', '2022-12-10 09:06:54', '2022-12-10 09:06:54'),
('174', 'HMP', 'Sukar mengendalikan dorongan seksual', '2022-12-10 09:07:09', '2022-12-10 09:07:09'),
('175', 'HMP', 'Mengalami masalah dalam memilih teman akrab dari jenis kelamin lain atau pacar', '2022-12-10 09:07:24', '2022-12-10 09:07:24'),
('176', 'KHK', 'Keluarga mengeluh tentang keadaan keuangan', '2022-12-10 09:07:55', '2022-12-10 09:07:55'),
('177', 'KHK', 'Mengkhawatirkan keadaan orang tua yang bertempat tinggal jauh', '2022-12-10 09:08:27', '2022-12-10 09:08:27'),
('178', 'KHK', 'Bermasalah karena ibu atau bapak akan kawin lagi', '2022-12-10 09:08:39', '2022-12-10 09:08:39'),
('179', 'KHK', 'Khawatir tidak mampu memenuhi tuntutan atau harapan orang tua atau anggota keluarga lain', '2022-12-10 09:08:50', '2022-12-10 09:08:50'),
('180', 'KHK', 'Membayangkan dan berpikir-pikir seandainya menjadi anak dari keluarga lain', '2022-12-10 09:09:02', '2022-12-10 09:09:02'),
('181', 'EDK', 'Mengalami masalah karena kurang mampu berhemat atau kemampuan keuangan sangat tidak mencukupi, baik untuk keperluan sehari-hari maupun keperluan pekerjaan', '2022-12-10 09:09:26', '2022-12-10 09:09:26'),
('182', 'EDK', 'Khawatir tidak mampu menamatkan sekolah ini atau putus sekolah dan harus segera bekerja', '2022-12-10 09:09:37', '2022-12-10 09:09:37'),
('183', 'EDK', 'Mengalami masalah karena terlalu berhemat dan/atau ingin menabung', '2022-12-10 09:09:50', '2022-12-10 09:09:50'),
('184', 'EDK', 'Kekurangan dalam keuangan menyebabkan dalam pengembangan diri terhambat', '2022-12-10 09:10:03', '2022-12-10 09:10:03'),
('185', 'EDK', 'Untuk memenuhi keuangan terpaksa sekolah sambil bekerja', '2022-12-10 09:10:16', '2022-12-10 09:10:16'),
('186', 'HMP', 'Mengalami masalah karena takut atau sudah terlalu jauh berhubungan dengan jenis kelamin lain atau pacar', '2022-12-10 09:10:41', '2022-12-10 09:10:41'),
('187', 'HMP', 'Bertepuk sebelah tangan dengan kawan akrab atau pacar', '2022-12-10 09:10:57', '2022-12-10 09:10:57'),
('188', 'HMP', 'Takut ditinggalkan pacar atau patah hati, cemburu atau cinta segitiga', '2022-12-10 09:11:13', '2022-12-10 09:11:13'),
('189', 'HMP', 'Khawatir akan dipaksa kawin', '2022-12-10 09:11:27', '2022-12-10 09:11:27'),
('190', 'HMP', 'Mengalami masalah karena sering dan mudah jatuh cinta dan/atau  rindu kepada pacar', '2022-12-10 09:11:39', '2022-12-10 09:11:39'),
('191', 'KHK', 'Kurang mendapat perhatian dan pengertian dari orang tua dan/atau anggota keluarga', '2022-12-10 09:12:04', '2022-12-10 09:12:04'),
('192', 'KHK', 'Mengalami kesulitan dengan bapak atau ibu tiri', '2022-12-10 09:12:19', '2022-12-10 09:12:19'),
('193', 'KHK', 'Diperlakukan tidak adil oleh orang tua atau oleh anggota keluarga lainnya', '2022-12-10 09:12:34', '2022-12-10 09:12:34'),
('194', 'KHK', 'Khawatir akan terjadinya pertentangan atau percekcokan dalam keluarga', '2022-12-10 09:12:45', '2022-12-10 09:12:45'),
('195', 'KHK', 'Hubungan dengan orang tua dan anggota keluarga kurang hangat, kurang harmonis dan/atau  kurang menggembirakan', '2022-12-10 09:12:58', '2022-12-10 09:12:58'),
('196', 'EDK', 'Mengalami masalah karena ingin berpenghasilan sendiri', '2022-12-10 09:13:27', '2022-12-10 09:13:27'),
('197', 'EDK', 'Berhutang yang  cukup memberatkan', '2022-12-10 09:13:40', '2022-12-10 09:13:40'),
('198', 'EDK', 'Besarnya uang yang diperoleh dan sumber-sumbernya tidak menentu', '2022-12-10 09:13:55', '2022-12-10 09:13:55'),
('199', 'EDK', 'Khawatir akan kondisi keuangan orang tua atau orang yang menjadi sumber keuangan; jangan-jangan harus menjual atau menggadaikan harta keluarga', '2022-12-10 09:14:15', '2022-12-10 09:14:15'),
('200', 'EDK', 'Mengalami masalah karena keuangan dikendalikan oleh orang lain', '2022-12-10 09:14:27', '2022-12-10 09:14:27'),
('201', 'WSG', 'Kekurangan waktu senggang, seprti waktu istirahat, waktu luang d sekolah ataupun dirumah, waktu libur untuk bersikap santai dan/atau melakukan kegiatan yang menyenangkan atau rekreasi', '2022-12-10 09:14:56', '2022-12-10 09:14:56'),
('202', 'WSG', 'Tidak diperkenankan atau kurang bebas dalam menggunakan waktu senggang yang tersedia untuk kegiatan yang disukai/diingini', '2022-12-10 09:15:12', '2022-12-10 09:15:12'),
('203', 'WSG', 'Mengalami masalah untuk mengikutikegiatan acara-acara gembira dan santai bersama kawan-kawan', '2022-12-10 09:15:26', '2022-12-10 09:15:26'),
('204', 'WSG', 'Tidak mempunyai kawan akrab untuk bersama-sama mengisi waktu senggang', '2022-12-10 09:15:43', '2022-12-10 09:15:43'),
('205', 'WSG', 'Mengalami masalah karena memikirkan atau membayangkan kesempatan waktu berlibur ditempat yang jauh, indah, tenang dan menyenangkan', '2022-12-10 09:15:58', '2022-12-10 09:15:58'),
('206', 'KHK', 'Mengalami masalah karena menjadi anak tunggal, anak sulung, anak bungsu, satu-satunya anak laki-laki atau satu-satunya anak perempuan', '2022-12-10 09:16:20', '2022-12-10 09:16:20'),
('207', 'KHK', 'Hubungan kurang harmonis dengan kakak atau adik atau dengan anggota keluarga lainnya', '2022-12-10 09:16:35', '2022-12-10 09:16:35'),
('208', 'KHK', 'Orang tua atau keluarga anggota lainnya terlalu berkuasa atau kurang memberi kebebasan', '2022-12-10 09:16:48', '2022-12-10 09:16:48'),
('209', 'KHK', 'Dicurigai oleh orang tua atau anggota keluarga lain', '2022-12-10 09:17:01', '2022-12-10 09:17:01'),
('210', 'KHK', 'Bermasalah karena dirumah orang tua tinggal orang atau anggota keluarga lain', '2022-12-10 09:17:15', '2022-12-10 09:21:49'),
('211', 'EDK', 'Mengalami masalah karena membanding-bandingkan kondisi keuangan sendiri dengan kondisi keuangan orang lain', '2022-12-10 09:17:45', '2022-12-10 09:17:45'),
('212', 'EDK', 'Kesulitan dalam mendapatkan penghasilan sendiri sambil sekolah', '2022-12-10 09:17:59', '2022-12-10 09:17:59'),
('213', 'EDK', 'Mempertanyakan kemungkinan memperoleh beasiswa atau dana bantuan belajar lainnya', '2022-12-10 09:18:13', '2022-12-10 09:18:13'),
('214', 'EDK', 'Orang lain menganggap pelit  dan/atau tidak mau membantu kawan yang sedang mengalami kesulitan keuangan', '2022-12-10 09:18:39', '2022-12-10 09:18:39'),
('215', 'EDK', 'Terpaksa berbagi pengeluaran keuangan dengan kakak atau adik atau anggota keluarga lain yang sama-sama membutuhkan biaya', '2022-12-10 09:18:52', '2022-12-10 09:18:52'),
('216', 'WSG', 'Tidak mengetahui cara menggunakan waktu senggang yang ada', '2022-12-10 09:19:05', '2022-12-10 09:19:05'),
('217', 'WSG', 'Kekurangan sarana, seperti biaya, kendaraan, televisi, buku-buku bacaan, dan lain-lain untuk memanfaatkan waktu senggang', '2022-12-10 09:19:17', '2022-12-10 09:19:17'),
('218', 'WSG', 'Mengalami masalah karena cara melaksanakan kegiatan atau acara yang kurang tepat dalam menggunakan waktu senggang', '2022-12-10 09:19:28', '2022-12-10 09:21:29'),
('219', 'WSG', 'Mengalami masalah dalam menggunakan waktu senggang karena tidak memiliki keterampilan tertentu, seperti bermain musik, olah raga, menari dan sebagainya', '2022-12-10 09:19:42', '2022-12-10 09:19:42'),
('220', 'WSG', 'Kurang berminat atau tidak ada hal yang menarik dalam memanfaatkan waktu senggang yang tersedia', '2022-12-10 09:19:59', '2022-12-10 09:19:59'),
('221', 'KHK', 'Tinggal di lingkungan keluarga atau tetangga yang kurang menyenangkan', '2022-12-10 09:20:16', '2022-12-10 09:20:16'),
('222', 'KHK', 'Tidak sependapat dengan orang tua atau anggota keluarga tentang sesuatu yang direncanakan', '2022-12-10 09:20:31', '2022-12-10 09:20:31'),
('223', 'KHK', 'Orang tua kurang senang kawan-kawan datang ke rumah', '2022-12-10 09:20:43', '2022-12-10 09:20:43'),
('224', 'KHK', 'Mengalami masalah karena rindu dan ingin bertemu dengan orang tua dan/atau anggota keluarga lainnya', '2022-12-10 09:20:57', '2022-12-10 09:20:57'),
('225', 'KHK', 'Tidak betah dan ingin meninggalkan rumah karena keadaannya sangat tidak menyenangkan', '2022-12-10 09:21:10', '2022-12-10 09:21:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pertanyaans`
--
ALTER TABLE `pertanyaans`
  ADD PRIMARY KEY (`kode_pertanyaan`),
  ADD KEY `pertanyaans_kode_kategori_foreign` (`kode_kategori`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pertanyaans`
--
ALTER TABLE `pertanyaans`
  ADD CONSTRAINT `pertanyaans_kode_kategori_foreign` FOREIGN KEY (`kode_kategori`) REFERENCES `kategori_masalahs` (`kode_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
