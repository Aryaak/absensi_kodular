-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for absensi_kodular
CREATE DATABASE IF NOT EXISTS `absensi_kodular` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `absensi_kodular`;

-- Dumping structure for table absensi_kodular.absensi
CREATE TABLE IF NOT EXISTS `absensi` (
  `id_absensi` int unsigned NOT NULL AUTO_INCREMENT,
  `id_siswa` int unsigned NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `foto_masuk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `foto_pulang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `lokasi_masuk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lokasi_pulang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tanggal_masuk` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_pulang` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_absensi`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table absensi_kodular.absensi: ~6 rows (approximately)
REPLACE INTO `absensi` (`id_absensi`, `id_siswa`, `keterangan`, `foto_masuk`, `foto_pulang`, `lokasi_masuk`, `lokasi_pulang`, `tanggal_masuk`, `tanggal_pulang`) VALUES
	(2, 2, 'Masuk Kelas', 'img/masuk/2.jpg', 'img/pulang/2.jpg', '-7.25525344825327, 112.75584425506926', '-7.2560729534311585, 112.75394525115328', '2023-09-04 00:00:00', '2023-09-04 09:00:00'),
	(3, 3, 'Masuk Kelas', 'img/masuk/3.jpg', 'img/pulang/3.jpg', '-7.25525344825327, 112.75584425506926', '-7.2560729534311585, 112.75394525147328', '2023-09-04 00:00:00', '2023-09-04 09:00:00'),
	(4, 4, 'Masuk Kelas', 'img/masuk/4.jpg', 'img/pulang/4.jpg', '-7.25525344825327, 112.75584425506926', '-7.2560729534311585, 112.75394524117328', '2023-09-04 00:00:00', '2023-09-04 09:00:00'),
	(5, 5, 'Masuk Kelas', 'img/masuk/5.jpg', 'img/pulang/5.jpg', '-7.25525344825327, 112.75584425506926', '-7.2560729534311585, 112.75394522117328', '2023-09-04 00:00:00', '2023-09-04 09:00:00'),
	(6, 6, 'Masuk Kelas', 'img/masuk/6.jpg', 'img/pulang/6.jpg', '-7.25525344825327, 112.75584425506926', '-7.2560729534311585, 112.75394521117328', '2023-09-04 00:00:00', '2023-09-04 09:00:00'),
	(8, 1, 'Pulang', 'img/masuk\\93b769814391aeefa166b0b495293902.jpg', 'img/pulang\\93b769814391aeefa166b0b495293902.jpg', '-7.25525344825327, 112.75584425506926', '-7.25525344825327, 112.75584425506926', '2023-09-04 10:36:37', '2023-09-04 10:36:56');

-- Dumping structure for table absensi_kodular.guru
CREATE TABLE IF NOT EXISTS `guru` (
  `id_guru` int unsigned NOT NULL AUTO_INCREMENT,
  `kode_guru` int unsigned NOT NULL,
  `nama_guru` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_guru`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table absensi_kodular.guru: ~4 rows (approximately)
REPLACE INTO `guru` (`id_guru`, `kode_guru`, `nama_guru`, `password`) VALUES
	(1, 1111, 'Teacher Tiara Indra', '$2y$10$K6ZcMCkRnHct7XYdVyoBg.Qz.tIbLU1yb7kF7bPC0IKkaow5d0KZq'),
	(2, 2222, 'Teacher Alex Smith', '$2y$10$6mVGRaFX3ZQbQNGoRjAXGOZ1YvcgAj.5M.xcgJAhCLYhZrTKbHolC'),
	(3, 3333, 'Teacher Emily Davis', '$2y$10$.uACyucCm2YZZmmVEn3.Su.EDR1.ZdG4uq0U8Mtc9tf5ygJ1Fa9fS'),
	(4, 4444, 'Teacher John Doe', '$2y$10$kXwPvWw4W3N0jKNWgSmkfOLXdTmR42igVmKnwuuf.qdTCBdDUkgj.');

-- Dumping structure for table absensi_kodular.siswa
CREATE TABLE IF NOT EXISTS `siswa` (
  `id_siswa` int unsigned NOT NULL,
  `nisn` bigint unsigned NOT NULL DEFAULT '0',
  `password_siswa` varchar(255) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nama_ortu` varchar(255) NOT NULL,
  `email_ortu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password_orangtua` varchar(255) NOT NULL,
  PRIMARY KEY (`id_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table absensi_kodular.siswa: ~5 rows (approximately)
REPLACE INTO `siswa` (`id_siswa`, `nisn`, `password_siswa`, `nama_siswa`, `kelas`, `alamat`, `nama_ortu`, `email_ortu`, `password_orangtua`) VALUES
	(1, 132017100745, '$2y$10$aWOTkEmf6eOCQDbokadtre2trPgw9QllWJHx7FegKjKdgt6t2SD9m', 'Craig Westervelt', '12-A', 'Surabaya, Jawa Timur', 'Ortu Craig Westervelt', 'ortu.craig@gmail.com', '$2y$10$UBqoelNzLN5nDsZFHANgNO/4NrWEJZnLyKX1atVzLNHDLDiINnvHW'),
	(2, 132017100751, '$2y$10$kwqyME1b4j.w5330YpNg.OL9AZ6UL1F9OjMX9F6Owvz/bIVthkLGO', 'Zain George', '12-A', 'Surabaya, Jawa Timur', 'Ortu Zain George', 'ortu.zain@gmail.com', '$2y$10$lFOl1S2gZji0Dr/wi0SKzu3i4UUOb17w9jY.uR8ifPM8/QSrAb98u'),
	(3, 132017100744, '$2y$10$owxUvz6zUUWxiPDR09Otv.ObtW6rt.V1Jv9n8UWxuHY1Ilra6Lkvu', 'Kaiya Geidt', '12-A', 'Surabaya, Jawa Timur', 'Ortu Kaiya Geidt', 'ortu.kaiya@gmail.com', '$2y$10$RwkM2Tr.1BPzNQR3e5o.ZuTdVBO9EBCqXFJ6oM3/9hJvlZQ9fbaIi'),
	(4, 132017100613, '$2y$10$.AcQHy3FWavUGBbgh1FOVO8jInJLUxFwrsvr/G7MTdFzUrUDdJgTu', 'Tiara Indra Arifien', '12-A', 'Surabaya, Jawa Timur', 'Ortu Tiara Indra Arifien', 'ortu.tiara@gmail.com', '$2y$10$WtZ.yC08ljnxSgi4eJsFxORkNHmCuGba7LsU0ONGlx7Fr4sCPHKmu'),
	(5, 132017100745, '$2y$10$mrWTBH8hBBfuT0.3BaazC.z.xQiTKXOBJFjqeoEq4S9e/hXmgKaTW', 'Ellijah Ntare Zachary', '12-A', 'Surabaya, Jawa Timur', 'Ortu Ellijah Ntare Zachary', 'ortu.ellijah@gmail.com', '$2y$10$WHuO.JvpHu53X9M4rI5.N.zSubJrTuRgTxIl3m3GccXjivP37A2u.');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
