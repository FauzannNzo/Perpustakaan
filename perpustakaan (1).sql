-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 22, 2025 at 05:30 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas`
--

CREATE TABLE `aktivitas` (
  `id_aktivitas` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `aktivitas_type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tabel` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `item_id` int DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci NOT NULL,
  `waktu` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aktivitas`
--

INSERT INTO `aktivitas` (`id_aktivitas`, `user_id`, `aktivitas_type`, `tabel`, `item_id`, `deskripsi`, `waktu`) VALUES
(92, NULL, 'INSERT', 'buku', 57, 'Buku baru ditambahkan: Wind', '2025-05-21 05:08:13'),
(93, NULL, 'INSERT', 'buku', 58, 'Buku baru ditambahkan: Wind', '2025-05-21 05:10:54'),
(94, NULL, 'DELETE', 'buku', 57, 'Buku yang dihapus: Wind', '2025-05-21 05:11:12'),
(95, NULL, 'INSERT', 'buku', 59, 'Buku baru ditambahkan: Wind', '2025-05-21 05:11:18'),
(96, NULL, 'INSERT', 'buku', 60, 'Buku baru ditambahkan: Wind', '2025-05-21 05:12:12'),
(97, NULL, 'DELETE', 'buku', 58, 'Buku yang dihapus: Wind', '2025-05-21 05:12:20'),
(98, NULL, 'DELETE', 'buku', 59, 'Buku yang dihapus: Wind', '2025-05-21 05:12:23'),
(99, NULL, 'DELETE', 'buku', 60, 'Buku yang dihapus: Wind', '2025-05-21 05:12:26'),
(100, NULL, 'INSERT', 'login', 49, 'Akun baru ditambahkan: Glenn Juan Aldaro (siswa)', '2025-05-21 05:22:34'),
(101, NULL, 'INSERT', 'buku', 61, 'Buku baru ditambahkan: edvwsv', '2025-05-21 06:32:28'),
(102, NULL, 'UPDATE', 'buku', 61, 'Buku diperbarui: edvwsv', '2025-05-21 06:38:46'),
(103, NULL, 'DELETE', 'buku', 61, 'Buku yang dihapus: edvwsv', '2025-05-21 06:38:50'),
(104, NULL, 'UPDATE', 'buku', 36, 'Buku diperbarui: One Punch Man', '2025-05-21 06:41:04'),
(105, NULL, 'UPDATE', 'buku', 27, 'Buku diperbarui: Otonari no tenshi', '2025-05-21 07:00:17'),
(106, NULL, 'UPDATE', 'kategori', 12, 'Kategori yang diperbarui: Pendidikan', '2025-05-21 08:34:46'),
(107, NULL, 'UPDATE', 'kategori', 17, 'Kategori yang diperbarui: Fiksi', '2025-05-21 08:43:36'),
(108, NULL, 'UPDATE', 'kategori', 18, 'Kategori yang diperbarui: Teknologi dan komputer', '2025-05-21 08:44:04'),
(109, NULL, 'UPDATE', 'kategori', 19, 'Kategori yang diperbarui: Nonfiksi', '2025-05-21 08:44:39'),
(110, NULL, 'UPDATE', 'kategori', 20, 'Kategori yang diperbarui: Fiksi visual', '2025-05-21 08:45:53'),
(111, NULL, 'UPDATE', 'buku', 27, 'Buku diperbarui: Otonari no tenshi', '2025-05-21 08:46:17'),
(112, NULL, 'UPDATE', 'buku', 28, 'Buku diperbarui: Solo Leveling', '2025-05-21 08:48:01'),
(113, NULL, 'UPDATE', 'kategori', 20, 'Kategori yang diperbarui: Fiksi visual / komik & ilustrasi', '2025-05-21 08:48:33'),
(114, NULL, 'UPDATE', 'kategori', 18, 'Kategori yang diperbarui: Teknologi dan Komputer', '2025-05-21 08:48:55'),
(115, NULL, 'UPDATE', 'kategori', 20, 'Kategori yang diperbarui: Fiksi Visual / Komik & Ilustrasi', '2025-05-21 08:49:08'),
(116, NULL, 'DELETE', 'buku', 30, 'Buku yang dihapus: Tokyo Revenger', '2025-05-21 08:49:37'),
(117, NULL, 'DELETE', 'buku', 36, 'Buku yang dihapus: One Punch Man', '2025-05-21 08:49:42'),
(118, NULL, 'UPDATE', 'kategori', 21, 'Kategori yang diperbarui: Referensi Umum', '2025-05-21 08:50:29'),
(119, NULL, 'UPDATE', 'kategori', 22, 'Kategori yang diperbarui: Anak-anak', '2025-05-21 08:51:22'),
(120, NULL, 'UPDATE', 'kategori', 25, 'Kategori yang diperbarui: Jurnal & Karya Ilmiah', '2025-05-21 08:52:07'),
(121, NULL, 'UPDATE', 'kategori', 28, 'Kategori yang diperbarui: Seni & Desain', '2025-05-21 08:56:53'),
(122, NULL, 'UPDATE', 'buku', 28, 'Buku diperbarui: Solo Leveling', '2025-05-21 09:15:17'),
(123, NULL, 'INSERT', 'buku', 62, 'Buku baru ditambahkan: Teknologi Informasi dan Komputer di Era Revolusi Industri 4.0', '2025-05-22 00:38:16'),
(124, NULL, 'DELETE', 'login', 38, 'Akun yang dihapus: Vicky (admin)', '2025-05-22 00:52:50'),
(125, NULL, 'DELETE', 'login', 44, 'Akun yang dihapus: Ibu Misbah (petugas)', '2025-05-22 00:52:55'),
(126, NULL, 'INSERT', 'buku', 63, 'Buku baru ditambahkan: Ensiklopedi Umum dalam Bahasa Indonesia', '2025-05-22 00:55:45');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int NOT NULL,
  `id_kategori` int NOT NULL,
  `cover` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `judul_buku` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pengarang` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tahun_terbit` int NOT NULL,
  `jumlah_buku` int NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `id_kategori`, `cover`, `judul_buku`, `pengarang`, `tahun_terbit`, `jumlah_buku`, `deskripsi`) VALUES
(27, 20, 'https://th.bing.com/th/id/OIP.j3dKrIjiuSnWaGxgJNP1QwHaGl?cb=iwp2&rs=1&pid=ImgDetMain', 'Otonari no tenshi', 'Saekisan', 2019, 100, 'Otonari no tenshi menceritakan Mahiru Shiina yang pantas dia dijuluki \"Malaikat\" dia adalah wanita cantik yang dicintai oleh semua orang, dan dia unggul dalam hal akademik dan atletik.\r\n\r\nShiina hidup di dunia yang sama sekali ebrebda dari Amane Fujimiya, tetangga sebelahnya. Meskipun mereka tingga sangat dekat, mereka tidak pernah berbicara satu kali pun.\r\n\r\nNamun, keheningan mereka pecah saat Fujimiya melihat Shiina duduk dengan murung di ayunan di tengah hujan badai yang lebat dan meminjamkan payungnya.\r\n\r\nSaat Fujimiya masuk angin keesokan harinya, Shiina ingin membalas budi atas payungnya itu dengan cara merawatnya hingga dia sembuh. Percaya jika ini akan menjadi interaksi pertama dan terakhir mereka, dia diam-diam menghargai kebaikannya.\r\n\r\nNamun, Shiina yang tidak bisa tida dia khawatir tentang kurangnya kerapian dan nutrisi Fujimiya yang mulai memasak dan membersihkan untuknya.\r\n\r\nSaat pasangan yang tidak mungkin itu menghabiskan waktu  bersama di apartemen Fujimiya, mereka mengeksplorasi hubungan mereka dan emosi lembut yang muncul darinya.\r\n'),
(28, 20, 'https://th.bing.com/th/id/OIP.0Ikf3DTyKC2EjulM1cWYfgAAAA?cb=iwp2&rs=1&pid=ImgDetMain', 'Solo Leveling', 'Chugong', 2016, 100, '10 tahun yang lalu, sebuah gerbang yang menghubungkan dunia manusia dengan alam yang berisi sihir dan monster tiba-tiba muncul dan disebut dengan nama \"gate\". Untuk mengalahkan monster-monster ganas ini, manusia biasa yang menerima kekuatan super dikenal sebagai \"hunter\" akan masuk ke gate dan mengalahkannya. Sung Jin-woo adalah salah satu dari hunter yang dikenal sebegai yang \"terlemah\", dikarenakan kemampuannya yang hampir tidak ada. Tetapi dia tetap bersusah payah masuk ke gate untuk membayar tagihan rumah sakit ibunya.\r\n\r\nKehidupan menyedihkan Sung Jin-woo berubah setelah dia menjadi satu-satunya yang selamat dari misi dan membuka matanya tiga hari kemudian dengan sebuah layar misterius muncul di depan wajahnya. \"Daftar Misi\" menuntut Jin Woo untuk menyelesaikan program pelatihan yang intens dan tidak realistis, yang disertai dengan hukuman jika tidak dilakukan. Dengan enggan dia melakukannya tanpa menyadari bahwa sebentar lagi dia akan menjadi salah satu hunter paling menakutkan di dunia.'),
(62, 18, 'https://image.gramedia.net/rs:fit:0:0/plain/https://cdn.gramedia.com/uploads/items/img20211202_11253177.jpg', 'Teknologi Informasi dan Komputer di Era Revolusi Industri 4.0', 'Janner Simarmata, Naeklan Simbolon, dkk.', 2021, 100, 'Revolusi industri keempat atau sering disingkat dengan panggilan RI 4.0, merupakan fase keempat dari perjalanan sejarah revolusi industri yang telah dimulai pada abad ke-18. Revolusi industri mengalami puncaknya saat ini dengan lahirnya teknologi digital yang berdampak masif terhadap hidup manusia di seluruh bagian dunia.\r\n\r\nIndonesia sendiri telah menetapkan 10 langkah prioritas nasional untuk menghadapi industri 4.0 ini dan langkah ini merupakan suatu upaya untuk mengimplementasikan peta jalan Making Indonesia 4.0. Dari strategi tersebut, diyakini dapat mempercepat pengembangan industri manufaktur nasional, agar lebih berdaya saing global di tengah era digital saat ini.\r\n\r\nDengan posisi Making Indonesia 4.0, pemerintah berusaha untuk mengupayakan revitalisasi industri Indonesia secara menyeluruh, dimana hal ini dilakukan untuk mewujudkan pembukaan sepuluh juta lapangan kerja baru di tahun 2030, dengan begitu industri Indonesia diharapkan akan mampu mengimplementasikan industri 4.0 dan bersaing dengan negara-negara lainnya.\r\n\r\nBuku ini menjabarkan tentang Sejarah Revolusi Industri Keempat, Tren dan Aplikasi: Gambaran Kemajuan Teknologi, Internet of Things (IoT), Blockchain, Big Data, Kecerdasan Buatan, Teknologi Robotika, Komputasi Awan, Realitas Tertambah, dan Manufaktur Aditif. Diharapkan dengan terbitnya buku ini dapat menambah wawasan dan pemahaman kita tentang revolusi industri keempat serta dapat digunakan oleh para mahasiswa, guru, dosen, dan praktisi sebagai buku referensi.'),
(63, 21, 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9c/Ensiklopedi_Adinegoro.jpg/1024px-Ensiklopedi_Adinegoro.jpg', 'Ensiklopedi Umum dalam Bahasa Indonesia', 'Adi Negoro', 1954, 100, 'Terbitan ini merupakan terbitan ensiklopedia pertama di Indonesia, dan merupakan usaha pribadi penyusunnya. Terbitan diawali dengan salinan naskah proklamasi, pidato Presiden pada 17 Agustus 1953, pendahuluan oleh Prof. Mr. Dr. Supomo, dan juga Mr. Muh. Yamin, yang tidak lain adalah kakak tiri Adi Negoro. Penyusunan ensiklopedia ini bertujuan menyediakan sarana rujukan secara umum untuk masyarakat Indonesia. Di sisi lain diharap dapat menjadi dasar untuk dikembangkan menjadi ensiklopedia setarap dengan Encyclopædia Britannica dll. Adapun cakupan isi terbitan ini mencakup masalah umum yang diperkirakan dapat memenuhi kebutuhan dan memberi kejelasan bagi masyarakat yang membutuhkan. Istilah yang memiliki makna ganda dijelaskan dengan menggunakan nomor urut. Susunan entri berdasarkan abjad kata atau ungkapan atau masalah. Untuk menjelaskan semua keterangan yang diperlukan menggunakan bahasa Indonesia.');

--
-- Triggers `buku`
--
DELIMITER $$
CREATE TRIGGER `after_buku_delete` AFTER DELETE ON `buku` FOR EACH ROW BEGIN
    DECLARE user_id INT;
    -- Get current user ID
    SET user_id = (SELECT @current_user_id);
    
    INSERT INTO aktivitas (user_id, aktivitas_type, tabel, item_id, deskripsi)
    VALUES (user_id, 'DELETE', 'buku', OLD.id_buku, 
           CONCAT('Buku yang dihapus: ', OLD.judul_buku));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_buku_insert` AFTER INSERT ON `buku` FOR EACH ROW BEGIN
    DECLARE user_id INT;
    -- Get current user ID (you need to have this available in your session)
    -- This is pseudocode, you'll need to adapt it to how you track the current user
    SET user_id = (SELECT @current_user_id);
    
    INSERT INTO aktivitas (user_id, aktivitas_type, tabel, item_id, deskripsi)
    VALUES (user_id, 'INSERT', 'buku', NEW.id_buku, 
           CONCAT('Buku baru ditambahkan: ', NEW.judul_buku));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_buku_update` AFTER UPDATE ON `buku` FOR EACH ROW BEGIN
    DECLARE user_id INT;
    -- Get current user ID
    SET user_id = (SELECT @current_user_id);
    
    INSERT INTO aktivitas (user_id, aktivitas_type, tabel, item_id, deskripsi)
    VALUES (user_id, 'UPDATE', 'buku', NEW.id_buku, 
           CONCAT('Buku diperbarui: ', NEW.judul_buku));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama`) VALUES
(12, 'Pendidikan'),
(17, 'Fiksi'),
(18, 'Teknologi dan Komputer'),
(19, 'Nonfiksi'),
(20, 'Fiksi Visual / Komik & Ilustrasi'),
(21, 'Referensi Umum'),
(22, 'Anak-anak'),
(25, 'Jurnal & Karya Ilmiah'),
(28, 'Seni & Desain');

--
-- Triggers `kategori`
--
DELIMITER $$
CREATE TRIGGER `after_kategori_delete` AFTER DELETE ON `kategori` FOR EACH ROW BEGIN
    DECLARE user_id INT;
    -- Get current user ID
    SET user_id = (SELECT @current_user_id);
    
    INSERT INTO aktivitas (user_id, aktivitas_type, tabel, item_id, deskripsi)
    VALUES (user_id, 'DELETE', 'kategori', OLD.id_kategori, 
           CONCAT('Kategori yang dihapus: ', OLD.nama));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_kategori_insert` AFTER INSERT ON `kategori` FOR EACH ROW BEGIN
    DECLARE user_id INT;
    -- Get current user ID
    SET user_id = (SELECT @current_user_id);
    
    INSERT INTO aktivitas (user_id, aktivitas_type, tabel, item_id, deskripsi)
    VALUES (user_id, 'INSERT', 'kategori', NEW.id_kategori, 
           CONCAT('Kategori baru ditambahkan: ', NEW.nama));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_kategori_update` AFTER UPDATE ON `kategori` FOR EACH ROW BEGIN
    DECLARE user_id INT;
    -- Get current user ID
    SET user_id = (SELECT @current_user_id);
    
    INSERT INTO aktivitas (user_id, aktivitas_type, tabel, item_id, deskripsi)
    VALUES (user_id, 'UPDATE', 'kategori', NEW.id_kategori, 
           CONCAT('Kategori yang diperbarui: ', NEW.nama));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `level` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `username`, `password`, `level`, `status`) VALUES
(1, 'admin', 'admin', 'admin1', 'admin', 1),
(2, 'petugas', 'petugas', 'petugas1', 'petugas', 1),
(3, 'siswa', 'siswa', 'siswa1', 'siswa', 1),
(28, 'Muhammad Fauzan', 'Fauzan', '123', 'siswa', 1),
(30, 'Muhammad Zidan Pratama', 'Zidan', '1234', 'siswa', 1),
(35, 'Muhammad Luthfi', 'lutfhi', '123', 'siswa', 1),
(42, 'Aji Ramada Dharma', 'Aji', '123', 'siswa', 1),
(49, 'Glenn Juan Aldaro', 'Glenn', '123', 'siswa', 1);

--
-- Triggers `login`
--
DELIMITER $$
CREATE TRIGGER `after_login_delete` AFTER DELETE ON `login` FOR EACH ROW BEGIN
    DECLARE user_id INT;
    -- Get current user ID
    SET user_id = (SELECT @current_user_id);
    
    INSERT INTO aktivitas (user_id, aktivitas_type, tabel, item_id, deskripsi)
    VALUES (user_id, 'DELETE', 'login', OLD.id, 
           CONCAT('Akun yang dihapus: ', OLD.name, ' (', OLD.level, ')'));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_login_insert` AFTER INSERT ON `login` FOR EACH ROW BEGIN
    DECLARE user_id INT;
    -- Get current user ID
    SET user_id = (SELECT @current_user_id);
    
    INSERT INTO aktivitas (user_id, aktivitas_type, tabel, item_id, deskripsi)
    VALUES (user_id, 'INSERT', 'login', NEW.id, 
           CONCAT('Akun baru ditambahkan: ', NEW.name, ' (', NEW.level, ')'));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_login_update` AFTER UPDATE ON `login` FOR EACH ROW BEGIN
    DECLARE user_id INT;
    -- Get current user ID
    SET user_id = (SELECT @current_user_id);
    
    INSERT INTO aktivitas (user_id, aktivitas_type, tabel, item_id, deskripsi)
    VALUES (user_id, 'UPDATE', 'login', NEW.id, 
           CONCAT('Data akun yang diperbarui: ', NEW.name));
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD PRIMARY KEY (`id_aktivitas`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktivitas`
--
ALTER TABLE `aktivitas`
  MODIFY `id_aktivitas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD CONSTRAINT `aktivitas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
