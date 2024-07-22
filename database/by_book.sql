-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2024 at 09:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `by_book`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `username`, `password`) VALUES
(1, 'admin1@gmail.com', 'Admin 1', 'adminpass1'),
(2, 'admin2@gmail.com', 'Admin 2', '$2y$10$7qK7fBpPvY.5cKr0DZs50u7r8Bbpp0EoOY4g5i1tt05Eqkpx2vH6O');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(100) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `penulis` varchar(500) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `cover` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `judul`, `penulis`, `harga`, `deskripsi`, `rating`, `cover`) VALUES
(3, 'Milea Suara dari Dilan', 'Pidi Baiq', 85000, ' Milea: Suara dari Dilan, novel karya Pidi Baiq yang diterbitkan oleh Pastel Books pada tahun 2016, merupakan sekuel dari novel Dilan: Dia adalah Dilanku Tahun 1990 dan Dilan Bagian Kedua: Dia adalah Dilanku Tahun 1991.  Novel ini menceritakan kisah cinta antara Dilan dan Milea dari sudut pandang Dilan. Berbeda dengan dua novel sebelumnya, di mana kisah diceritakan dari sudut pandang Milea, Milea: Suara dari Dilan memberikan kesempatan bagi pembaca untuk menyelami pikiran dan perasaan Dilan, memahami motivasinya, dan melihat kisahnya dari kacamata yang berbeda.', 2, 'milea.jpg'),
(4, 'Negeri para Bedebah', 'Tere Liye', 95000, ' Negeri Para Bedebah: Kritik Pedas Terhadap Realitas Kelam Dunia Perbankan Negeri Para Bedebah, sebuah novel karya Tere Liye yang diterbitkan pada tahun 2012, membawa pembaca menyelami dunia perbankan yang penuh dengan manipulasi, intrik, dan konspirasi. Novel ini menghadirkan kritik pedas terhadap realitas kelam di balik gemerlapnya dunia keuangan, di mana moralitas dan nilai-nilai kemanusiaan sering kali dikesampingkan demi keuntungan pribadi.', 4, 'hwwjhrajpbdc4ctutxpzxa.jpg'),
(5, 'Laskar Pelangi', 'Andrea Hinnata', 70000, 'Laskar Pelangi, novel karya Andrea Hirata yang diterbitkan pertama kali pada tahun 2005, merupakan kisah inspiratif tentang sepuluh anak dari keluarga miskin di Belitung yang bersekolah di Sekolah Muhammadiyah Belitung. Novel ini menceritakan perjuangan mereka dalam meraih pendidikan di tengah keterbatasan, persahabatan yang kuat, dan mimpi-mimpi besar yang mereka pegang teguh.', 2, 'Laskar_pelangi_sampul.jpg'),
(6, 'Filosofi Teras', 'Levi Lesmana', 85000, 'Filosofi Teras karya Henry Manampiring adalah buku yang memaparkan tentang filsafat Stoa, sebuah mazhab filsafat Yunani-Romawi kuno yang bisa membantu kita mengatasi emosi negatif dan menghasilkan mental yang tangguh dalam menghadapi naik-turunnya kehidupan.', 2, '1.jpg'),
(7, 'Perahu Kertas', 'Dea Lestari', 45000, 'Perahu Kertas adalah sebuah novel romansa remaja yang ditulis oleh Dewi Lestari dan diterbitkan oleh Bentang Pustaka pada tahun 2009.', 3, 'pk.jpg'),
(8, 'Laut Bercerita', ' Leila S. Chudori', 60000, 'Laut Bercerita adalah novel karya Leila S. Chudori yang diterbitkan oleh Kepustakaan Populer Gramedia Jakarta pada tahun 2017. Novel ini berkisah tentang persahabatan, cinta, keluarga, dan kehilangan para tokoh-tokohnya.', 4, '186437.jpg'),
(9, 'Sebuah Seni untuk Bersikap Bodo Amat', 'Mark Manson', 55000, 'Sebuah Seni untuk Bersikap Bodo Amat adalah buku pertama karya Mark Manson, seorang narablog kenamaan dengan lebih dari 2 juta pembaca. Ia tinggal di kota New York.', 5, 'Sebuah-seni-untuk-bersikap-bodoh-amat.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `password`) VALUES
(1, 'harsya', 'harsya@gmail.com', '$2y$10$ojJoaxWYWJK6xVb7glBiF.C1AB1za4EKlTru0/i1y8iXuhVMZCPeS'),
(2, 'eriq', 'eriq@gmail.com', '$2y$10$.UxkSTPcdVppJx9wucsqU.p335//PXmBUrgB5nlIvoofmTO8Q99jS'),
(3, 'Hafiz Syawal', 'hafiz@gmail.com', '$2y$10$cbnXgi4uxd1f5z6Kpas3AeasJYVZa/mYU8Vop1kMlbogeIIpK4CFy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
