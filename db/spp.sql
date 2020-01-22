-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Inang: localhost
-- Waktu pembuatan: 14 Apr 2019 pada 22.39
-- Versi Server: 5.5.27
-- Versi PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `spp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `description` text,
  `input_date` timestamp NULL DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `nama_lengkap`, `password`, `email`, `description`, `input_date`, `last_update`) VALUES
(1, 'admin', 'Admin', 'd6e289ef194a67084587cefaf52ed78f0731e966', 'admin@example.com', '<p>Admin default</p>', '2018-12-30 21:32:54', '2019-03-06 17:07:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('019bafa9c08acdbb373520ad77b20ccac860b4f2', '::1', 1553532150, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535333533313938363b),
('29b369c036df91d05f0d974a4c66629cf7ee7377', '::1', 1553532455, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535333533323435323b);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembangunan`
--

CREATE TABLE IF NOT EXISTS `pembangunan` (
  `kode_bayar` varchar(11) NOT NULL,
  `siswa_nisn` int(11) NOT NULL,
  `tgl_byr` date NOT NULL,
  `jmlh_byr` double NOT NULL,
  `bendahara` varchar(25) NOT NULL,
  PRIMARY KEY (`kode_bayar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembangunan`
--

INSERT INTO `pembangunan` (`kode_bayar`, `siswa_nisn`, `tgl_byr`, `jmlh_byr`, `bendahara`) VALUES
('BGN001', 2147483646, '2019-04-12', 5000000, 'Upik'),
('BGN002', 2147483647, '2019-04-19', 2000000, 'Abu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE IF NOT EXISTS `pengeluaran` (
  `kode_keluar` varchar(11) NOT NULL,
  `tgl_pengeluaran` date NOT NULL,
  `ket` text NOT NULL,
  `biaya` double NOT NULL,
  `bendahara` varchar(25) NOT NULL,
  PRIMARY KEY (`kode_keluar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`kode_keluar`, `tgl_pengeluaran`, `ket`, `biaya`, `bendahara`) VALUES
('KLR002', '2019-03-25', 'Contoh Pengeluaran', 50000, 'Upik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `kode_siswa` varchar(11) NOT NULL,
  `siswa_nisn` varchar(11) NOT NULL,
  `siswa_nama` varchar(255) DEFAULT NULL,
  `siswa_tmpt_lhr` varchar(45) DEFAULT NULL,
  `siswa_tgl_lhr` date DEFAULT NULL,
  `siswa_jk` varchar(11) NOT NULL,
  `siswa_tgl_masuk` date NOT NULL,
  PRIMARY KEY (`kode_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`kode_siswa`, `siswa_nisn`, `siswa_nama`, `siswa_tmpt_lhr`, `siswa_tgl_lhr`, `siswa_jk`, `siswa_tgl_masuk`) VALUES
('SSW001', '2147483646', 'Doyok', 'Dumai', '1999-10-20', 'Laki-laki', '2019-01-01'),
('SSW002', '2147483647', 'Muhamad Rezki', 'Dumai', '2000-11-21', 'Laki-laki', '2019-01-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spp`
--

CREATE TABLE IF NOT EXISTS `spp` (
  `kode_bayar` varchar(11) NOT NULL,
  `kode_siswa` varchar(11) NOT NULL,
  `tgl_byr` date NOT NULL,
  `biaya_spp` double NOT NULL,
  `total_biaya` double NOT NULL,
  `bendahara` varchar(25) NOT NULL,
  PRIMARY KEY (`kode_bayar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `spp`
--

INSERT INTO `spp` (`kode_bayar`, `kode_siswa`, `tgl_byr`, `biaya_spp`, `total_biaya`, `bendahara`) VALUES
('SPP001', 'SSW001', '2019-03-22', 100000, 100000, 'Upik'),
('SPP002', 'SSW002', '2019-03-29', 100000, 100000, 'Upik'),
('SPP003', 'SSW002', '2019-04-13', 100000, 200000, 'Upik'),
('SPP004', 'SSW002', '2019-04-11', 100000, 100000, 'Upik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spp_detail`
--

CREATE TABLE IF NOT EXISTS `spp_detail` (
  `kode_bayar` varchar(11) NOT NULL,
  `kode_siswa` varchar(11) NOT NULL,
  `bulan` varchar(12) NOT NULL,
  `tahun` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `spp_detail`
--

INSERT INTO `spp_detail` (`kode_bayar`, `kode_siswa`, `bulan`, `tahun`) VALUES
('SPP001', 'SSW001', 'Januari', '2019'),
('SPP002', 'SSW002', 'Februari', '2019'),
('SPP003', 'SSW002', 'Januari', '2019'),
('SPP003', 'SSW002', 'Maret', '2019'),
('SPP004', 'SSW002', 'Januari', '2019');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
