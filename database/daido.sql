-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 02 Mar 2023 pada 16.07
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daido`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot`
--

CREATE TABLE `bobot` (
  `id_bobot` int(11) NOT NULL,
  `skala` int(11) NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bobot`
--

INSERT INTO `bobot` (`id_bobot`, `skala`, `keterangan`) VALUES
(1, 4, 'sangat penting'),
(2, 3, 'penting'),
(3, 2, 'cukup penting'),
(4, 1, 'kurang penting');

-- --------------------------------------------------------

--
-- Struktur dari tabel `departemen`
--

CREATE TABLE `departemen` (
  `id_departemen` int(11) NOT NULL,
  `nama_departemen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `departemen`
--

INSERT INTO `departemen` (`id_departemen`, `nama_departemen`) VALUES
(1, 'Purchase & S-Marketing'),
(2, 'Production'),
(3, 'PPIC'),
(4, 'ENG-MTC'),
(5, 'QA-QC'),
(6, 'Admin'),
(7, 'HR'),
(8, 'FA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_keputusan`
--

CREATE TABLE `detail_keputusan` (
  `id_detail_keputusan` int(11) NOT NULL,
  `id_keputusan` int(11) NOT NULL,
  `id_pelamar` int(11) NOT NULL,
  `vektor_v` double NOT NULL,
  `vektor_s` double NOT NULL,
  `keputusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_keputusan`
--

INSERT INTO `detail_keputusan` (`id_detail_keputusan`, `id_keputusan`, `id_pelamar`, `vektor_v`, `vektor_s`, `keputusan`) VALUES
(8, 5, 12, 80, 0.5, '5'),
(9, 5, 13, 80, 0.5, '5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penilaian`
--

CREATE TABLE `detail_penilaian` (
  `id` int(10) NOT NULL,
  `id_penilaian` int(10) NOT NULL,
  `id_kriteria` varchar(3) NOT NULL,
  `nilai` int(10) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_penilaian`
--

INSERT INTO `detail_penilaian` (`id`, `id_penilaian`, `id_kriteria`, `nilai`, `keterangan`) VALUES
(1, 30, 'C1', 80, ''),
(2, 30, 'C2', 80, ''),
(3, 30, 'C3', 80, ''),
(4, 30, 'C4', 80, ''),
(5, 30, 'C5', 80, ''),
(6, 30, 'C6', 80, ''),
(7, 31, 'C1', 80, ''),
(8, 31, 'C2', 80, ''),
(9, 31, 'C3', 80, ''),
(10, 31, 'C4', 80, ''),
(11, 31, 'C5', 80, ''),
(12, 31, 'C6', 80, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen_pelamar`
--

CREATE TABLE `dokumen_pelamar` (
  `id_dokumen` int(11) NOT NULL,
  `id_pelamar` int(11) NOT NULL,
  `id_tipe_dokumen` int(11) NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `interview`
--

CREATE TABLE `interview` (
  `id_interview` int(11) NOT NULL,
  `id_pelamar` int(11) NOT NULL,
  `tgl_interview` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keputusan`
--

CREATE TABLE `keputusan` (
  `id_keputusan` int(11) NOT NULL,
  `id_lowongan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keputusan`
--

INSERT INTO `keputusan` (`id_keputusan`, `id_lowongan`, `tahun`, `tanggal`) VALUES
(5, 4, 2023, '2023-02-19 10:42:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` varchar(3) NOT NULL,
  `kriteria` varchar(25) NOT NULL,
  `id_bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kriteria`, `id_bobot`) VALUES
('C1', 'Lari', 2),
('C2', 'Pull Up Chinning', 1),
('C3', 'Sit Up', 4),
('C4', 'Push Up', 4),
('C5', 'Shuttle Run', 1),
('C6', 'Matematika', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_pelamar`
--

CREATE TABLE `login_pelamar` (
  `id_login_pelamar` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `login_pelamar`
--

INSERT INTO `login_pelamar` (`id_login_pelamar`, `nama`, `email`, `password`, `tanggal`, `status`) VALUES
(8, 'Julian Reza', 'zulfianfreza04@gmail.com', 'zulfian', '2023-03-01 09:11:05', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lowongan`
--

CREATE TABLE `lowongan` (
  `id_lowongan` int(11) NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_berakhir` date NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lowongan`
--

INSERT INTO `lowongan` (`id_lowongan`, `id_departemen`, `tgl_mulai`, `tgl_berakhir`, `deskripsi`) VALUES
(4, 2, '2023-02-01', '2023-02-28', '<p><strong>Posisi :&nbsp;</strong>Operator Produksi</p>\r\n<p><strong>Kualifikasi</strong></p>\r\n<ul>\r\n<li>Pendidikan: min SMA/SMK/MAN</li>\r\n<li>Usia : 18 - 21 tahun</li>\r\n<li>Belum menikah</li>\r\n<li>Sehat (Dengan SKD)</li>\r\n<li>Tidak buta warna (Dengan SKD)</li>\r\n</ul>'),
(5, 1, '2023-01-01', '2023-01-15', '<p>Kualifikasi</p>\r\n<ul>\r\n<li>Pendidikan min SMA sederajat.</li>\r\n<li>Berkelakuan Baik</li>\r\n<li>Memiliki kemampuan komunikasi yang baik.</li>\r\n</ul>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` varchar(10) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(2) NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `jenis_kelamin`, `id_departemen`, `status`) VALUES
('0022', 'Asep Komarudin', 'M', 2, 'Tetap'),
('0041', 'Heri Setiawan', 'M', 2, 'Tetap'),
('0051', 'Rupoko', 'M', 3, 'Tetap'),
('0058', 'Suparno', 'M', 3, 'Tetap'),
('0061', 'Tri Wiyanto I', 'M', 2, 'Tetap'),
('0066', 'Edirman D', 'M', 2, 'Tetap'),
('0067', 'Aristiyono', 'M', 3, 'Tetap'),
('0084', 'Muslihat', 'M', 3, 'Tetap'),
('0088', 'Herman', 'M', 2, 'Tetap'),
('0092', 'Andi Kurniawan', 'M', 2, 'Tetap'),
('0095', 'Andi Pradikta', 'M', 2, 'Tetap'),
('0099', 'Rahmanto', 'M', 3, 'Tetap'),
('0100', 'Abdul Hoir', 'M', 2, 'Tetap'),
('0102', 'Ahmad', 'M', 2, 'Tetap'),
('0105', 'Murwanto', 'M', 5, 'Tetap'),
('0109', 'Agus Yogo Trapsilo', 'M', 2, 'Tetap'),
('0125', 'Solihin', 'M', 5, 'Tetap'),
('0129', 'Joko Priyono', 'M', 2, 'Tetap'),
('0132', 'Muamar', 'M', 3, 'Tetap'),
('0135', 'Alan', 'M', 2, 'Tetap'),
('0150', 'Muhammad Tarmuji', 'M', 2, 'Tetap'),
('0154', 'Abdul Rohman', 'M', 2, 'Tetap'),
('0156', 'Mohamad Rohim', 'M', 2, 'Tetap'),
('0164', 'Ade Jamaludin', 'M', 3, 'Tetap'),
('0165', 'Ade Sunandar', 'M', 2, 'Tetap'),
('0166', 'Ahmad Zaenal Arifin', 'M', 5, 'Tetap'),
('0169', 'Asep Endry', 'M', 5, 'Tetap'),
('0173', 'Dadan Hamdan', 'M', 5, 'Tetap'),
('0177', 'Eki Hermana', 'M', 2, 'Tetap'),
('0180', 'Iwan', 'M', 3, 'Tetap'),
('0182', 'Koharudin', 'M', 2, 'Tetap'),
('0188', 'Saeful Anwar', 'M', 2, 'Tetap'),
('0192', 'Sukarna', 'M', 2, 'Tetap'),
('0209', 'Aang Ruhaedin', 'M', 7, 'Tetap'),
('0210', 'Adung', 'M', 2, 'Tetap'),
('0218', 'Eko Setia Gunawan', 'M', 2, 'Tetap'),
('0219', 'Gunawan', 'M', 2, 'Tetap'),
('0227', 'Iwan Kurniawan', 'M', 5, 'Tetap'),
('0232', 'Parikin', 'M', 2, 'Tetap'),
('0235', 'Suherman', 'M', 5, 'Tetap'),
('0237', 'Suroto', 'M', 2, 'Tetap'),
('0238', 'Suryadi', 'M', 2, 'Tetap'),
('0240', 'Wiwit Santosa Nugroho', 'M', 2, 'Tetap'),
('0243', 'Dadang Hermawan', 'M', 3, 'Tetap'),
('0255', 'Suparyono', 'M', 2, 'Tetap'),
('0257', 'Herlin Heriyanto', 'M', 3, 'Tetap'),
('0258', 'Sutrisno', 'M', 3, 'Tetap'),
('0260', 'Heri Suherman', 'M', 5, 'Tetap'),
('0264', 'Irwan Kusnandar', 'M', 5, 'Tetap'),
('0266', 'Deki Erwan Juliansyah', 'M', 2, 'Tetap'),
('0267', 'Tahyudin', 'M', 2, 'Tetap'),
('0268', 'Ujang Sunardi', 'M', 2, 'Tetap'),
('0270', 'Suparman Larasman L', 'M', 5, 'Tetap'),
('0271', 'Zaenal Abidin', 'M', 2, 'Tetap'),
('0272', 'Anton Pramono', 'M', 2, 'Tetap'),
('0282', 'Darman', 'M', 2, 'Tetap'),
('0285', 'Haerudin', 'M', 2, 'Tetap'),
('0288', 'Rossi En Dani', 'M', 2, 'Tetap'),
('0289', 'Subandi', 'M', 2, 'Tetap'),
('0298', 'Deden Ismail', 'M', 2, 'Tetap'),
('0299', 'Deni Hidayat', 'M', 2, 'Tetap'),
('0300', 'Rosyid', 'M', 2, 'Tetap'),
('0306', 'Wacin', 'M', 2, 'Tetap'),
('0309', 'Darli', 'M', 2, 'Tetap'),
('0312', 'Dudi Yudha', 'M', 2, 'Tetap'),
('0318', 'Ipan Hermawan', 'M', 2, 'Tetap'),
('0323', 'Asmuni', 'M', 2, 'Tetap'),
('0328', 'Yudianto', 'M', 2, 'Tetap'),
('0329', 'Ocim', 'M', 2, 'Tetap'),
('0335', 'Dwi Susanto', 'M', 2, 'Tetap'),
('0338', 'Antonius Eko Andiyanto', 'M', 2, 'Tetap'),
('0345', 'Eko Cahyono', 'M', 2, 'Tetap'),
('0353', 'Totok Sulasto', 'M', 2, 'Tetap'),
('0370', 'Catur Haryadi', 'M', 2, 'Tetap'),
('0371', 'Yadi Samsudin', 'M', 2, 'Tetap'),
('0382', 'Tata Suman Jaya', 'M', 2, 'Tetap'),
('0383', 'Agus Miarso', 'M', 3, 'Tetap'),
('0384', 'Donny Mulyadi', 'M', 2, 'Tetap'),
('0388', 'Guntur Andi Utomo', 'M', 3, 'Tetap'),
('0409', 'Vicky Pradana', 'M', 2, 'Tetap'),
('0414', 'Fikri Romadhan', 'M', 2, 'Tetap'),
('0415', 'Andri Novarianto', 'M', 2, 'Tetap'),
('0417', 'Tantri Septiani', 'F', 5, 'Tetap'),
('0420', 'Nurazizah Almaqiyyah', 'F', 3, 'Tetap'),
('0422', 'Muhammad Djafar Shiddiq', 'M', 2, 'Tetap'),
('0425', 'Yayu Miana', 'F', 2, 'Tetap'),
('0436', 'Habib Yasin Amilul Muchtar', 'M', 2, 'Tetap'),
('0437', 'Asep Abdul Rohman', 'M', 2, 'Tetap'),
('0438', 'Nadya Siti Adawiyah', 'F', 2, 'Tetap'),
('0440', 'Neng Nurjanah', 'F', 7, 'Tetap'),
('0441', 'Rizky Reza Saputra', 'M', 1, 'Tetap'),
('0442', 'Ellda Sahilla Maskur', 'F', 8, 'Tetap'),
('0443', 'Chindi Triyana', 'F', 2, 'Tetap'),
('0444', 'Irvan Mohammad Regent', 'M', 2, 'Tetap'),
('0445', 'Hermawan', 'M', 2, 'Tetap'),
('K1108', 'Sindi Yuliana', 'F', 2, 'Kontrak'),
('K1111', 'Dini Damayanti', 'F', 2, 'Kontrak'),
('K1113', 'Indah Nur Fitria', 'F', 2, 'Kontrak'),
('K1114', 'Nina Herawati', 'F', 2, 'Kontrak'),
('K1115', 'Rini Agustini', 'F', 2, 'Kontrak'),
('K1116', 'Sri Rahayu Oktrizalni', 'F', 2, 'Kontrak'),
('K1117', 'Alni Julyani', 'F', 2, 'Kontrak'),
('K1118', 'Rika Martika', 'F', 2, 'Kontrak'),
('K1119', 'Hafizah Putri Apriliani', 'F', 2, 'Kontrak'),
('K1120', 'Sari Lestari', 'F', 2, 'Kontrak'),
('K1121', 'Dewi Kurnia Yunita', 'F', 2, 'Kontrak'),
('K1122', 'Diana Fazra Syahwal', 'F', 2, 'Kontrak'),
('K1123', 'Fickah Ayuningsih', 'F', 2, 'Kontrak'),
('K1124', 'Lia Hapitri', 'F', 2, 'Kontrak'),
('K1126', 'Rahma Tunisa Putri', 'F', 5, 'Kontrak'),
('K1128', 'Badrul Akbar', 'M', 2, 'Kontrak'),
('K1130', 'Ahmad Husien Rahmatullah', 'M', 2, 'Kontrak'),
('K1131', 'Mahatma Abhista Fatah', 'M', 2, 'Kontrak'),
('K1132', 'Entin', 'F', 2, 'Kontrak'),
('K1133', 'Helma Malini Putri', 'F', 2, 'Kontrak'),
('K1134', 'Erika Pitaloka', 'F', 5, 'Kontrak'),
('K1135', 'Fatur Rochman', 'M', 2, 'Kontrak'),
('K1136', 'Tia Dwiastuti', 'F', 2, 'Kontrak'),
('K1138', 'Elsya Hermawati', 'F', 5, 'Kontrak'),
('K1139', 'Iceu Nurani', 'F', 2, 'Kontrak'),
('K1140', 'Putri Oktavia', 'F', 2, 'Kontrak'),
('K1141', 'Salsabila Nur Fitriana', 'F', 2, 'Kontrak'),
('K1142', 'Siti Patimah', 'F', 2, 'Kontrak'),
('K1143', 'Megawati Rumahorbo', 'F', 2, 'Kontrak'),
('K1144', 'Naila Rifda Ar rahadatul Aisy', 'F', 2, 'Kontrak'),
('K1147', 'Ibnu Ali Nursafa', 'M', 2, 'Kontrak'),
('K1148', 'Kulsum Anggini', 'F', 2, 'Kontrak'),
('K1150', 'Adzie Pangestu', 'M', 2, 'Kontrak'),
('K1151', 'Mahmudah Alinda Kulsum', 'F', 2, 'Kontrak'),
('K1152', 'Maulana Ibrahim Wijaya', 'M', 2, 'Kontrak'),
('K1153', 'Rio Aditya Al Fauzi', 'M', 2, 'Kontrak'),
('K1154', 'Topik Maulana', 'M', 2, 'Kontrak'),
('K1155', 'Afifa Nur Khasanah', 'F', 2, 'Kontrak'),
('K1156', 'Ardinda Ranti Rosanti', 'F', 2, 'Kontrak'),
('K1157', 'Irfa Setiawati', 'F', 2, 'Kontrak'),
('K1158', 'Mira Nurdiyani', 'F', 2, 'Kontrak'),
('K1159', 'Vina Trinita Ramadhani', 'F', 2, 'Kontrak'),
('K1160', 'Adi Rahman Supriatna', 'M', 2, 'Kontrak'),
('K1161', 'Chandra Wijaya', 'M', 2, 'Kontrak'),
('K1162', 'M Rizki', 'M', 2, 'Kontrak'),
('K1163', 'Ryan Maulana', 'M', 2, 'Kontrak'),
('K1164', 'Yoga Muhamad Yesi', 'M', 2, 'Kontrak'),
('K1165', 'Lia Sopiyatul Jamaliyah', 'F', 2, 'Kontrak'),
('K1166', 'M Ariel Saefudin', 'M', 2, 'Kontrak'),
('K1167', 'Syahrul Nur Kusumah', 'M', 2, 'Kontrak'),
('K1168', 'Anita Sari', 'F', 2, 'Kontrak'),
('K1169', 'Ega Dwi Anjani Putri', 'F', 2, 'Kontrak'),
('K1170', 'Ine Pratiwi', 'F', 2, 'Kontrak'),
('K1174', 'Esa Gunawarman', 'M', 2, 'Kontrak'),
('K1175', 'Henry Julio', 'M', 2, 'Kontrak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelamar`
--

CREATE TABLE `pelamar` (
  `id_pelamar` int(10) NOT NULL,
  `id_lowongan` int(11) NOT NULL,
  `nama_pelamar` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tlp` int(15) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(10) NOT NULL,
  `id_pelamar` int(10) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_pelamar`, `tanggal`) VALUES
(30, 12, '2023-02-19 01:19:55'),
(31, 13, '2023-02-19 16:31:56');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `perbaikan_bobot`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `perbaikan_bobot` (
`id_kriteria` varchar(3)
,`kriteria` varchar(25)
,`skala` int(11)
,`keterangan` varchar(20)
,`perbaikan_bobot` decimal(14,4)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaan_karyawan`
--

CREATE TABLE `permintaan_karyawan` (
  `id_permintaan_karyawan` int(11) NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `tgl_diminta` date NOT NULL,
  `status_karyawan` varchar(20) NOT NULL,
  `jumlah_karyawan_pria` int(5) NOT NULL,
  `jumlah_karyawan_wanita` int(11) NOT NULL,
  `posisi` varchar(50) NOT NULL,
  `tgl_bergabung` date NOT NULL,
  `pendidikan` varchar(20) NOT NULL,
  `pengalaman` varchar(20) NOT NULL,
  `pelatihan` varchar(20) NOT NULL,
  `keahlian` varchar(20) NOT NULL,
  `kualifikasi_lain` varchar(20) NOT NULL,
  `diminta_oleh` varchar(50) NOT NULL,
  `disetujui_oleh` varchar(50) NOT NULL,
  `diketahui_oleh` varchar(50) NOT NULL,
  `ringkasan_tugas` text NOT NULL,
  `tgl_rekrutmen` date NOT NULL,
  `ptkbd` varchar(25) NOT NULL,
  `pewawancara` varchar(25) NOT NULL,
  `status_permintaan` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `permintaan_karyawan`
--

INSERT INTO `permintaan_karyawan` (`id_permintaan_karyawan`, `id_departemen`, `tgl_diminta`, `status_karyawan`, `jumlah_karyawan_pria`, `jumlah_karyawan_wanita`, `posisi`, `tgl_bergabung`, `pendidikan`, `pengalaman`, `pelatihan`, `keahlian`, `kualifikasi_lain`, `diminta_oleh`, `disetujui_oleh`, `diketahui_oleh`, `ringkasan_tugas`, `tgl_rekrutmen`, `ptkbd`, `pewawancara`, `status_permintaan`) VALUES
(8, 2, '2023-03-02', 'Kontrak', 10, 5, 'Operator', '2023-03-02', 'sma', 'ya', 'ya', 'ya', 'ya', 'Purchase & S-Marketing', 'Purchase & S-Marketing', 'Purchase & S-Marketing', 'Contoh', '2023-03-10', 'internal', 'terkait', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`id_status`, `status`) VALUES
(1, 'Tahap Cek Berkas'),
(2, 'Lolos Tahap Cek Berkas'),
(3, 'Gagal Tahap Cek Berkas'),
(4, 'Tahap Cek Fisik & Materi'),
(5, 'Lolos Tahap Cek Fisik & Materi'),
(6, 'Gagal Tahap Cek Fisik & Materi'),
(7, 'Tahap Interview'),
(8, 'Lolos Tahap Interview'),
(9, 'Gagal Tahap Interview');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tes_fisik`
--

CREATE TABLE `tes_fisik` (
  `id_cek_fisik` int(11) NOT NULL,
  `id_pelamar` int(11) NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe_dokumen`
--

CREATE TABLE `tipe_dokumen` (
  `id_tipe_dokumen` int(11) NOT NULL,
  `tipe_dokumen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tipe_dokumen`
--

INSERT INTO `tipe_dokumen` (`id_tipe_dokumen`, `tipe_dokumen`) VALUES
(1, 'Surat Lamaran'),
(2, 'Surat Keterangan Dokter'),
(3, 'SKCK'),
(4, 'Surat Disnaker'),
(5, 'Kartu Keluarga'),
(6, 'Akta Lahir'),
(7, 'Ijazah Terakhir'),
(8, 'Piagam/Sertifikat Training'),
(9, 'Penghargaan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `level` int(10) NOT NULL,
  `id_departemen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `level`, `id_departemen`) VALUES
(1255, 'hrd', 'hrd', 'HRD', 1, 0),
(1257, 'manajer_hrd', 'manajer_hrd', 'Manajer HRD', 2, 0),
(1262, 'admin', 'admin', 'Admin', 0, 0),
(1265, 'kadiv_ppic', 'kadiv_ppic', 'Kepala Divisi PPIC', 3, 3),
(1266, 'kadiv_production', 'kadiv_production', 'Kepala Divisi Production', 3, 2);

-- --------------------------------------------------------

--
-- Struktur untuk view `perbaikan_bobot`
--
DROP TABLE IF EXISTS `perbaikan_bobot`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `perbaikan_bobot`  AS SELECT `k1`.`id_kriteria` AS `id_kriteria`, `k1`.`kriteria` AS `kriteria`, `b1`.`skala` AS `skala`, `b1`.`keterangan` AS `keterangan`, `b1`.`skala`/ (select sum(`bobot`.`skala`) from (`kriteria` join `bobot` on(`kriteria`.`id_bobot` = `bobot`.`id_bobot`))) AS `perbaikan_bobot` FROM (`kriteria` `k1` join `bobot` `b1` on(`k1`.`id_bobot` = `b1`.`id_bobot`))  ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bobot`
--
ALTER TABLE `bobot`
  ADD PRIMARY KEY (`id_bobot`);

--
-- Indeks untuk tabel `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_departemen`);

--
-- Indeks untuk tabel `detail_keputusan`
--
ALTER TABLE `detail_keputusan`
  ADD PRIMARY KEY (`id_detail_keputusan`),
  ADD KEY `id_keputusan` (`id_keputusan`);

--
-- Indeks untuk tabel `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penilaian` (`id_penilaian`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indeks untuk tabel `dokumen_pelamar`
--
ALTER TABLE `dokumen_pelamar`
  ADD PRIMARY KEY (`id_dokumen`),
  ADD KEY `id_pelamar` (`id_pelamar`),
  ADD KEY `id_tipe_dokumen` (`id_tipe_dokumen`);

--
-- Indeks untuk tabel `interview`
--
ALTER TABLE `interview`
  ADD PRIMARY KEY (`id_interview`),
  ADD KEY `id_pelamar` (`id_pelamar`);

--
-- Indeks untuk tabel `keputusan`
--
ALTER TABLE `keputusan`
  ADD PRIMARY KEY (`id_keputusan`),
  ADD KEY `id_lowongan` (`id_lowongan`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`),
  ADD KEY `id_bobot` (`id_bobot`);

--
-- Indeks untuk tabel `login_pelamar`
--
ALTER TABLE `login_pelamar`
  ADD PRIMARY KEY (`id_login_pelamar`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `lowongan`
--
ALTER TABLE `lowongan`
  ADD PRIMARY KEY (`id_lowongan`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_departemen` (`id_departemen`);

--
-- Indeks untuk tabel `pelamar`
--
ALTER TABLE `pelamar`
  ADD PRIMARY KEY (`id_pelamar`),
  ADD KEY `id_lowongan` (`id_lowongan`),
  ADD KEY `email` (`email`);

--
-- Indeks untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `id_pelamar` (`id_pelamar`) USING BTREE;

--
-- Indeks untuk tabel `permintaan_karyawan`
--
ALTER TABLE `permintaan_karyawan`
  ADD PRIMARY KEY (`id_permintaan_karyawan`),
  ADD KEY `fk_departemen` (`id_departemen`);

--
-- Indeks untuk tabel `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `tes_fisik`
--
ALTER TABLE `tes_fisik`
  ADD PRIMARY KEY (`id_cek_fisik`),
  ADD KEY `id_pelamar` (`id_pelamar`);

--
-- Indeks untuk tabel `tipe_dokumen`
--
ALTER TABLE `tipe_dokumen`
  ADD PRIMARY KEY (`id_tipe_dokumen`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id_departemen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `detail_keputusan`
--
ALTER TABLE `detail_keputusan`
  MODIFY `id_detail_keputusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `dokumen_pelamar`
--
ALTER TABLE `dokumen_pelamar`
  MODIFY `id_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `interview`
--
ALTER TABLE `interview`
  MODIFY `id_interview` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `keputusan`
--
ALTER TABLE `keputusan`
  MODIFY `id_keputusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `login_pelamar`
--
ALTER TABLE `login_pelamar`
  MODIFY `id_login_pelamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `lowongan`
--
ALTER TABLE `lowongan`
  MODIFY `id_lowongan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pelamar`
--
ALTER TABLE `pelamar`
  MODIFY `id_pelamar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `permintaan_karyawan`
--
ALTER TABLE `permintaan_karyawan`
  MODIFY `id_permintaan_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tes_fisik`
--
ALTER TABLE `tes_fisik`
  MODIFY `id_cek_fisik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tipe_dokumen`
--
ALTER TABLE `tipe_dokumen`
  MODIFY `id_tipe_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1267;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_keputusan`
--
ALTER TABLE `detail_keputusan`
  ADD CONSTRAINT `detail_keputusan_ibfk_1` FOREIGN KEY (`id_keputusan`) REFERENCES `keputusan` (`id_keputusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dokumen_pelamar`
--
ALTER TABLE `dokumen_pelamar`
  ADD CONSTRAINT `dokumen_pelamar_ibfk_1` FOREIGN KEY (`id_pelamar`) REFERENCES `pelamar` (`id_pelamar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dokumen_pelamar_ibfk_2` FOREIGN KEY (`id_tipe_dokumen`) REFERENCES `tipe_dokumen` (`id_tipe_dokumen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `interview`
--
ALTER TABLE `interview`
  ADD CONSTRAINT `interview_ibfk_1` FOREIGN KEY (`id_pelamar`) REFERENCES `pelamar` (`id_pelamar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keputusan`
--
ALTER TABLE `keputusan`
  ADD CONSTRAINT `keputusan_ibfk_1` FOREIGN KEY (`id_lowongan`) REFERENCES `lowongan` (`id_lowongan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_departemen`) REFERENCES `departemen` (`id_departemen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pelamar`
--
ALTER TABLE `pelamar`
  ADD CONSTRAINT `pelamar_ibfk_1` FOREIGN KEY (`id_lowongan`) REFERENCES `lowongan` (`id_lowongan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pelamar_ibfk_2` FOREIGN KEY (`email`) REFERENCES `login_pelamar` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `permintaan_karyawan`
--
ALTER TABLE `permintaan_karyawan`
  ADD CONSTRAINT `fk_departemen` FOREIGN KEY (`id_departemen`) REFERENCES `departemen` (`id_departemen`);

--
-- Ketidakleluasaan untuk tabel `tes_fisik`
--
ALTER TABLE `tes_fisik`
  ADD CONSTRAINT `tes_fisik_ibfk_1` FOREIGN KEY (`id_pelamar`) REFERENCES `pelamar` (`id_pelamar`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
