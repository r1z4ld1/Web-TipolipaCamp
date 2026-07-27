-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 17, 2026 at 12:27 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_camping_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas`
--

CREATE TABLE `aktivitas` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `aktor_nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aktor_role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` bigint UNSIGNED DEFAULT NULL,
  `data_lama` json DEFAULT NULL,
  `data_baru` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aktivitas`
--

INSERT INTO `aktivitas` (`id`, `user_id`, `aktor_nama`, `aktor_role`, `jenis`, `aksi`, `judul`, `deskripsi`, `model_type`, `model_id`, `data_lama`, `data_baru`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin Camping', 'Admin', 'kategori', 'tambah', 'Kategori baru ditambahkan', 'Menambahkan kategori: gelas.', 'App\\Models\\Kategori', 11, NULL, '{\"id\": 11, \"slug\": \"gelas\", \"status\": \"aktif\", \"deskripsi\": \"untuk  minum\", \"created_at\": \"2026-05-19T07:36:25.000000Z\", \"updated_at\": \"2026-05-19T07:36:25.000000Z\", \"nama_kategori\": \"gelas\"}', '2026-05-19 07:36:25', '2026-05-19 07:36:25'),
(2, 1, 'Admin Camping', 'Admin', 'kategori', 'edit', 'Kategori diperbarui', 'Memperbarui kategori: gelass.', 'App\\Models\\Kategori', 11, '{\"id\": 11, \"slug\": \"gelas\", \"status\": \"aktif\", \"deskripsi\": \"untuk  minum\", \"created_at\": \"2026-05-19T07:36:25.000000Z\", \"updated_at\": \"2026-05-19T07:36:25.000000Z\", \"nama_kategori\": \"gelas\"}', '{\"id\": 11, \"slug\": \"gelass\", \"status\": \"aktif\", \"deskripsi\": \"untuk  minummmmmm\", \"created_at\": \"2026-05-19T07:36:25.000000Z\", \"updated_at\": \"2026-05-19T07:37:36.000000Z\", \"nama_kategori\": \"gelass\"}', '2026-05-19 07:37:36', '2026-05-19 07:37:36'),
(3, 1, 'Admin Camping', 'Admin', 'kategori', 'hapus', 'Kategori dihapus', 'Menghapus kategori: gelass. Alasan: Data duplikat untuk percobaan', 'App\\Models\\Kategori', 11, '{\"id\": 11, \"slug\": \"gelass\", \"status\": \"aktif\", \"deskripsi\": \"untuk  minummmmmm\", \"created_at\": \"2026-05-19T07:36:25.000000Z\", \"updated_at\": \"2026-05-19T07:37:36.000000Z\", \"nama_kategori\": \"gelass\"}', NULL, '2026-05-19 07:43:37', '2026-05-19 07:43:37'),
(4, 1, 'Admin Camping', 'Admin', 'barang', 'edit', 'Alat camping diperbarui', 'Memperbarui data alat camping: Lampu Tenda.', 'App\\Models\\Barang', 28, '{\"id\": 28, \"foto\": \"barangs/yrOjoUCBY4cYi0AimKDDo6LslLIcWL9L76YaoKDC.png\", \"slug\": \"lampu-tenda\", \"stok\": 10, \"status\": \"tersedia\", \"kondisi\": \"baik\", \"deskripsi\": \"Lampu tenda portable yang dapat digantung di bagian dalam tenda untuk memberikan penerangan saat malam hari. Ukurannya kecil, ringan, dan praktis digunakan untuk membaca, merapikan barang, atau beraktivitas di dalam tenda. Cocok untuk camping, hiking, kegiatan pramuka, atau perlengkapan penerangan outdoor.\", \"created_at\": \"2026-05-18T13:01:40.000000Z\", \"harga_sewa\": \"15000.00\", \"updated_at\": \"2026-05-18T13:01:40.000000Z\", \"kategori_id\": 6, \"nama_barang\": \"Lampu Tenda\"}', '{\"id\": 28, \"foto\": \"barangs/yrOjoUCBY4cYi0AimKDDo6LslLIcWL9L76YaoKDC.png\", \"slug\": \"lampu-tenda\", \"stok\": 15, \"status\": \"tersedia\", \"kondisi\": \"baik\", \"kategori\": {\"id\": 6, \"slug\": \"penerangan\", \"status\": \"aktif\", \"deskripsi\": \"Kategori untuk alat penerangan seperti lampu camping, headlamp, dan lentera portable.\", \"created_at\": \"2026-05-12T23:10:47.000000Z\", \"updated_at\": \"2026-05-12T23:10:47.000000Z\", \"nama_kategori\": \"Penerangan\"}, \"deskripsi\": \"Lampu tenda portable yang dapat digantung di bagian dalam tenda untuk memberikan penerangan saat malam hari. Ukurannya kecil, ringan, dan praktis digunakan untuk membaca, merapikan barang, atau beraktivitas di dalam tenda. Cocok untuk camping, hiking, kegiatan pramuka, atau perlengkapan penerangan outdoor.\", \"created_at\": \"2026-05-18T13:01:40.000000Z\", \"harga_sewa\": \"15000.00\", \"updated_at\": \"2026-05-19T07:56:27.000000Z\", \"kategori_id\": 6, \"nama_barang\": \"Lampu Tenda\"}', '2026-05-19 07:56:27', '2026-05-19 07:56:27'),
(5, 1, 'Admin Camping', 'Admin', 'stok', 'edit', 'Stok alat camping berubah', 'Mengubah stok Lampu Tenda dari 10 unit menjadi 15 unit. Selisih stok: Bertambah +5 unit.', 'App\\Models\\Barang', 28, '{\"stok\": 10, \"nama_barang\": \"Lampu Tenda\"}', '{\"stok\": 15, \"selisih\": 5, \"nama_barang\": \"Lampu Tenda\"}', '2026-05-19 07:56:27', '2026-05-19 07:56:27');

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `nama_barang` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `harga_sewa` decimal(12,2) NOT NULL DEFAULT '0.00',
  `stok` int NOT NULL DEFAULT '0',
  `kondisi` enum('baik','rusak_ringan','rusak_berat') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'baik',
  `status` enum('tersedia','tidak_tersedia') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tersedia',
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `kategori_id`, `nama_barang`, `slug`, `deskripsi`, `harga_sewa`, `stok`, `kondisi`, `status`, `foto`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tenda Dome 4 Orang', 'tenda-dome-4-orang', 'Tenda dome kapasitas 4 orang yang cocok untuk camping keluarga.', 50000.00, 5, 'baik', 'tersedia', 'barangs/LThfupa5PibmRaT6mk3mqQIB5rWRxGxlqckxNP4B.png', '2026-05-12 23:32:18', '2026-05-15 06:35:13'),
(3, 1, 'Tenda Dome 2 Orang', 'tenda-dome-2-orang', 'Tenda dome kapasitas 2 orang yang ringan dan praktis untuk camping berdua, pendakian, atau perjalanan outdoor singkat.', 40000.00, 5, 'baik', 'tersedia', 'barangs/Dw3izYxSc4BrF8tkt4HdwauFhlh1eGDgM8llemIW.png', '2026-05-17 09:27:29', '2026-05-17 09:27:29'),
(4, 1, 'Tenda Tunnel 4 Orang', 'tenda-tunnel-4-orang', 'Tenda model tunnel kapasitas 4 orang dengan ruang lebih luas dan ventilasi yang baik, cocok untuk camping keluarga atau kegiatan outdoor bersama teman.', 60000.00, 5, 'baik', 'tersedia', 'barangs/3UXt65PjG1HTOJYtKhpnh0osXPuPHGp4YJvz8gt0.png', '2026-05-17 09:35:05', '2026-05-17 09:35:05'),
(5, 1, 'Tenda Tunnel 2 Orang', 'tenda-tunnel-2-orang', 'Tenda model tunnel kapasitas 2 orang dengan desain lebih ringkas dan mudah dipasang. Memiliki ruang tidur yang nyaman untuk dua orang, ventilasi yang baik, serta pintu depan yang cukup luas. Cocok untuk camping berdua, hiking, backpacking ringan, atau kegiatan outdoor singkat.', 45000.00, 3, 'baik', 'tersedia', 'barangs/6vG5g2n4oF1xTs029dOxqeS1IP4Mo1cOYTMISejN.png', '2026-05-17 09:45:48', '2026-05-17 09:45:48'),
(6, 1, 'Tenda Family 6 Orang', 'tenda-family-6-orang', 'Tenda family kapasitas 6 orang dengan ukuran besar dan ruang yang luas. Dilengkapi pintu depan lebar, beberapa jendela ventilasi, serta area dalam yang nyaman untuk camping keluarga atau kegiatan outdoor bersama rombongan. Desain kokoh dengan model tunnel membuat tenda lebih stabil dan cocok digunakan di area perkemahan.', 85000.00, 3, 'baik', 'tersedia', 'barangs/0hGov3TQCwC9277g3OfAzKO97Gfnqh6tWtmn7aPe.png', '2026-05-17 09:50:51', '2026-05-18 07:04:37'),
(8, 2, 'Sleeping Bag Mummy', 'sleeping-bag-mummy', 'Sleeping bag model mummy dengan bentuk mengikuti tubuh dan menyempit di bagian kaki. Dilengkapi bagian kepala seperti hood untuk membantu menjaga suhu tubuh tetap hangat saat tidur di alam terbuka. Cocok digunakan untuk camping, hiking, pendakian, atau kegiatan outdoor di daerah dingin.', 25000.00, 8, 'baik', 'tersedia', 'barangs/WwEqQWxvb4ciSxbVppbNEXnYzUo6MW8xJJvzvZA6.png', '2026-05-18 11:31:33', '2026-05-18 11:31:33'),
(9, 2, 'Sleeping Bag Envelope  Persegi', 'sleeping-bag-envelope-persegi', 'Sleeping bag model envelope atau persegi dengan bentuk kotak memanjang yang memberikan ruang gerak lebih luas saat tidur. Dapat digunakan seperti kantong tidur biasa atau dibuka menjadi selimut. Cocok untuk camping santai, kegiatan keluarga, acara outdoor, atau menginap di area perkemahan dengan cuaca normal.', 20000.00, 10, 'baik', 'tersedia', 'barangs/x3Je0Zu2PmngUPyOFH4LbwWu5W2cfjSwZuwWE6DZ.png', '2026-05-18 11:34:00', '2026-05-18 11:34:00'),
(10, 2, 'Sleeping Bag Double', 'sleeping-bag-double', 'Sleeping bag ukuran besar yang dirancang untuk 2 orang. Memiliki bentuk lebar dengan ruang tidur lebih luas, bahan empuk, serta desain yang nyaman digunakan saat camping bersama pasangan, teman, atau keluarga. Dapat digunakan sebagai kantong tidur double atau dibuka menjadi selimut besar.', 35000.00, 4, 'baik', 'tersedia', 'barangs/k4CDtZrJUqRMpJkOxoCEmC6llpmfQZLMD8nUOZYA.png', '2026-05-18 11:37:11', '2026-05-18 11:37:11'),
(11, 2, 'Sleeping Bag Ultralight', 'sleeping-bag-ultralight', 'Sleeping bag ultralight dengan desain ringan, ramping, dan mudah dibawa. Dilengkapi kantong kompresi sehingga praktis disimpan di dalam tas carrier. Cocok untuk hiking, trekking, backpacking, pendakian, atau camping dengan perlengkapan minimalis.', 30000.00, 7, 'baik', 'tersedia', 'barangs/dvfDwoBubtEmCvfcy6ouITDSCYhSCjkMAaNX7zdg.png', '2026-05-18 11:40:02', '2026-05-18 11:40:02'),
(12, 2, 'Sleeping Bag Anak', 'sleeping-bag-anak', 'Sleeping bag berukuran kecil yang dirancang khusus untuk anak-anak. Memiliki bahan yang lembut, nyaman, dan hangat, dengan motif menarik sehingga cocok digunakan untuk camping keluarga, kegiatan sekolah, acara outdoor, atau menginap bersama keluarga.', 20000.00, 9, 'baik', 'tersedia', 'barangs/OqHYj3cabFKe5PjPVsERxUe3Hc1RerWUqt1ZdIgp.png', '2026-05-18 11:43:35', '2026-05-18 11:43:35'),
(13, 3, 'Carrier 40L', 'carrier-40l', 'Carrier kapasitas 40 liter dengan ukuran sedang yang cocok untuk hiking singkat, camping 1–2 hari, atau perjalanan outdoor ringan. Dilengkapi kompartemen utama, saku depan, saku samping, tali bahu empuk, serta pengikat tambahan untuk membantu membawa perlengkapan dengan lebih rapi dan nyaman.', 30000.00, 7, 'baik', 'tersedia', 'barangs/josMJUrgwHgnocvIguCW2PIujaLOntlxjnX8LE4J.png', '2026-05-18 11:46:38', '2026-05-18 11:46:38'),
(14, 3, 'Carrier 60L', 'carrier-60l', 'Carrier kapasitas 60 liter dengan ukuran besar yang cocok untuk camping beberapa hari atau pendakian 2–4 hari. Dilengkapi kompartemen utama yang luas, saku depan, saku samping, tali kompresi, tali bahu empuk, serta hip belt untuk membantu menopang beban agar lebih nyaman saat dibawa. Dapat digunakan untuk membawa pakaian, sleeping bag, matras, perlengkapan masak, dan kebutuhan outdoor lainnya.', 40000.00, 6, 'baik', 'tersedia', 'barangs/qS454FBcf8j4YarZ1Tm3hAb4onJO6lFGDwKc09Ai.png', '2026-05-18 11:52:12', '2026-05-18 11:52:12'),
(15, 3, 'Carrier 80L', 'carrier-80l', 'Carrier kapasitas 80 liter dengan ukuran ekstra besar yang cocok untuk ekspedisi, pendakian panjang, camping lebih dari 4 hari, atau membawa perlengkapan kelompok. Dilengkapi kompartemen utama yang luas, saku depan, saku samping, tali kompresi, hip belt tebal, tali bahu empuk, serta pengikat tambahan untuk membawa matras, botol minum, trekking pole, dan perlengkapan outdoor lainnya.', 50000.00, 4, 'baik', 'tersedia', 'barangs/J7IJ7igPhQYhGfkrUNvOz03Sy4eoU4ItG3A2mhMP.png', '2026-05-18 11:55:04', '2026-05-18 11:55:04'),
(16, 3, 'Carrier Anak', 'carrier-anak', 'Carrier berukuran kecil yang dirancang khusus untuk anak-anak atau remaja. Memiliki desain ringan, warna menarik, tali bahu empuk, saku depan, dan saku samping untuk membawa botol minum atau perlengkapan kecil. Cocok digunakan untuk camping sekolah, pramuka, hiking ringan, atau kegiatan outdoor keluarga.', 25000.00, 8, 'baik', 'tersedia', 'barangs/XreWfBzGcFfb5FNEmHeXG0BnP7KelQecTwlqmM5d.png', '2026-05-18 12:00:08', '2026-05-18 12:00:08'),
(17, 3, 'Carrier Waterproof', 'carrier-waterproof', 'Carrier waterproof dengan bahan tahan air dan dilengkapi pelindung hujan atau rain cover untuk menjaga barang bawaan tetap aman saat terkena hujan. Memiliki kompartemen utama yang luas, saku depan, saku samping, tali bahu empuk, tali kompresi, serta hip belt untuk kenyamanan saat dibawa. Cocok digunakan untuk pendakian, camping, hiking, atau kegiatan outdoor saat cuaca tidak menentu.', 45000.00, 5, 'baik', 'tersedia', 'barangs/wkFLSjb1wnOQfRcQr2dmgqtzJWCdLbTI9vv6Ij3f.png', '2026-05-18 12:02:51', '2026-05-18 12:02:51'),
(18, 4, 'Matras Gulung', 'matras-gulung', 'Matras gulung berbahan busa ringan yang praktis digunakan sebagai alas tidur atau alas duduk saat camping. Mudah digulung, dibawa, dan disimpan karena dilengkapi tali pengikat. Cocok untuk kegiatan camping, pramuka, hiking ringan, atau perlengkapan tidur di dalam tenda.', 15000.00, 9, 'baik', 'tersedia', 'barangs/tbOsha44ONZHJeRuLQYQPSIl4aG185lGj5ixi7yk.png', '2026-05-18 12:07:25', '2026-05-18 12:07:25'),
(19, 4, 'Matras Lipat', 'matras-lipat', 'Matras lipat dengan desain beberapa panel yang mudah dilipat dan disimpan. Memiliki permukaan bertekstur untuk memberikan kenyamanan saat digunakan sebagai alas tidur atau alas duduk di area camping. Cocok untuk camping keluarga, kegiatan pramuka, hiking ringan, atau perlengkapan tidur di dalam tenda.', 20000.00, 8, 'baik', 'tersedia', 'barangs/Sess3QgjWnP9jLPZGq1Gr7ozqKyhMhbh2CMqSYSi.png', '2026-05-18 12:09:53', '2026-05-18 12:09:53'),
(20, 4, 'Matras Angin', 'matras-angin', 'Matras angin yang digunakan dengan cara dipompa hingga mengembang. Memiliki permukaan empuk dan nyaman untuk alas tidur saat camping, sehingga cocok digunakan di dalam tenda maupun area perkemahan. Praktis digunakan karena dapat dikempiskan kembali setelah dipakai agar mudah dibawa dan disimpan.', 25000.00, 6, 'baik', 'tersedia', 'barangs/mT6rnN3IHxrb21JaDT85hrG6cFqDjcACEXrBGCFT.png', '2026-05-18 12:14:45', '2026-05-18 12:14:45'),
(21, 4, 'Matras Self Inflating', 'matras-self-inflating', 'Matras self inflating yang dapat mengembang sendiri saat katup udara dibuka. Memiliki bantalan yang empuk dan nyaman untuk digunakan sebagai alas tidur di dalam tenda atau area camping. Praktis digunakan karena tidak memerlukan pompa besar, mudah dikempiskan, dan cocok untuk camping, hiking, maupun perjalanan outdoor yang membutuhkan kenyamanan lebih.', 30000.00, 5, 'baik', 'tersedia', 'barangs/wkKzGKisM1PxlK3YQBOFOOmccnFdcExNML6kWjjW.png', '2026-05-18 12:25:47', '2026-05-18 12:25:47'),
(22, 4, 'Matras Alumunium Foil', 'matras-alumunium-foil', 'Matras camping dengan lapisan alumunium foil yang berfungsi membantu menahan suhu dingin dari tanah. Memiliki permukaan reflektif, ringan, dan mudah digulung sehingga praktis dibawa saat camping atau pendakian. Cocok digunakan sebagai alas tidur di dalam tenda, terutama di daerah pegunungan atau tempat dengan suhu dingin.', 18000.00, 9, 'baik', 'tersedia', 'barangs/2SeI0t5HeUx0ezLT1NODdetU75lz3AHkgR5gVq2z.png', '2026-05-18 12:29:14', '2026-05-18 12:29:14'),
(23, 5, 'Kompor Portable', 'kompor-portable', 'Kompor portable berukuran ringkas yang mudah dibawa dan digunakan saat camping atau kegiatan outdoor. Cocok untuk memasak makanan sederhana, merebus air, membuat kopi, mie instan, atau kebutuhan memasak ringan lainnya di area perkemahan.', 20000.00, 10, 'baik', 'tersedia', 'barangs/Lel6NNlWvxaHWlRDlM5hftcSLL7dChTrnGzFRGo5.png', '2026-05-18 12:40:34', '2026-05-18 12:40:34'),
(24, 5, 'Nesting Cookset', 'nesting-cookset', 'Nesting cookset adalah satu set alat masak camping yang terdiri dari panci, wajan kecil, dan wadah masak yang dapat disusun menjadi satu. Desainnya ringkas dan hemat tempat sehingga mudah dibawa saat camping, hiking, atau kegiatan outdoor. Cocok digunakan untuk memasak makanan sederhana, merebus air, membuat kopi, atau menyiapkan makanan di area perkemahan.', 25000.00, 7, 'baik', 'tersedia', 'barangs/wg2KOjJy0Mg1NffHwUZjLRZN04q3BxfmUQZSMuDV.png', '2026-05-18 12:42:53', '2026-05-18 12:42:53'),
(25, 5, 'Gas Kaleng', 'gas-kaleng', 'Gas kaleng berisi bahan bakar butane yang digunakan untuk kompor portable saat camping atau kegiatan outdoor. Ukurannya ringkas, mudah dipasang, dan praktis dibawa sebagai perlengkapan memasak di alam terbuka. Cocok untuk memasak makanan sederhana, merebus air, membuat kopi, atau kebutuhan memasak ringan lainnya.', 10000.00, 13, 'baik', 'tersedia', 'barangs/VMJW4yBewGnksUZDXe5Ic8qJRa2RwKprmXpRuoG4.png', '2026-05-18 12:46:48', '2026-05-18 12:46:48'),
(26, 5, 'Grill Portable', 'grill-portable', 'Grill portable adalah alat panggangan kecil yang praktis dibawa untuk kegiatan camping atau barbeque di luar ruangan. Dilengkapi rangka kaki lipat dan permukaan panggangan yang cukup luas untuk memanggang sosis, daging, ikan, jagung, atau makanan lainnya. Cocok digunakan saat camping keluarga, piknik, atau kegiatan outdoor bersama teman.', 30000.00, 5, 'baik', 'tersedia', 'barangs/Z3cnabidFvhxWWitvywNadxc16jeTAdYVxtlurE9.png', '2026-05-18 12:55:42', '2026-05-18 12:55:42'),
(27, 5, 'Cooking Set Stainless', 'cooking-set-stainless', 'Cooking set stainless adalah set peralatan masak dan makan berbahan stainless steel yang kuat, tahan lama, dan mudah dibersihkan. Biasanya terdiri dari panci, mangkuk, piring, gelas, sendok, dan garpu. Cocok digunakan untuk camping, piknik, hiking ringan, atau kegiatan outdoor bersama keluarga dan teman.', 25000.00, 6, 'baik', 'tersedia', 'barangs/xFzGmR0AgzujerZENyLcAMswFqs5BboObjsrJnw8.png', '2026-05-18 12:58:19', '2026-05-18 12:58:19'),
(28, 6, 'Lampu Tenda', 'lampu-tenda', 'Lampu tenda portable yang dapat digantung di bagian dalam tenda untuk memberikan penerangan saat malam hari. Ukurannya kecil, ringan, dan praktis digunakan untuk membaca, merapikan barang, atau beraktivitas di dalam tenda. Cocok untuk camping, hiking, kegiatan pramuka, atau perlengkapan penerangan outdoor.', 15000.00, 15, 'baik', 'tersedia', 'barangs/yrOjoUCBY4cYi0AimKDDo6LslLIcWL9L76YaoKDC.png', '2026-05-18 13:01:40', '2026-05-19 07:56:27'),
(29, 6, 'Headlamp', 'headlamp', 'Headlamp adalah lampu kepala dengan tali elastis yang nyaman digunakan saat beraktivitas di malam hari. Lampu ini membantu memberikan penerangan tanpa perlu digenggam, sehingga tangan tetap bebas untuk memasak, berjalan, mencari barang, atau memasang perlengkapan camping. Cocok untuk camping, hiking, pendakian, pramuka, dan kegiatan outdoor malam hari.', 15000.00, 8, 'baik', 'tersedia', 'barangs/CJ7wsh8zU2irNNfSBOHXPaBPUnEMVqGdEMTDTPDZ.png', '2026-05-18 13:04:18', '2026-05-18 13:04:18'),
(30, 6, 'Senter LED', 'senter-led', 'Senter LED genggam dengan cahaya terang dan hemat energi, cocok digunakan untuk penerangan saat camping, hiking, pendakian, atau keadaan darurat. Ukurannya ringkas, mudah dibawa, dan nyaman digenggam untuk membantu melihat area sekitar pada malam hari.', 12000.00, 10, 'baik', 'tersedia', 'barangs/BQ0js8BBM3gjNQHgLUGDeQN9oRyqfOdOloRdKGR1.png', '2026-05-18 13:07:12', '2026-05-18 13:07:12'),
(31, 6, 'Lentera Camping', 'lentera-camping', 'Lentera camping portable yang dapat diletakkan di meja atau digantung untuk menerangi area sekitar tenda. Memiliki cahaya yang menyebar sehingga cocok digunakan untuk makan malam outdoor, memasak, berkumpul, atau beraktivitas di area perkemahan saat malam hari.', 18000.00, 8, 'baik', 'tersedia', 'barangs/9UqygtNV0TB6o7VsLnb3tXMD9sATBPHrpJGHItKN.png', '2026-05-18 13:10:49', '2026-05-18 13:10:49'),
(32, 6, 'Lampu Emergency', 'lampu-emergency', 'Lampu emergency portable dengan cahaya LED terang yang dapat digunakan sebagai penerangan cadangan saat kondisi gelap atau listrik tidak tersedia. Dilengkapi pegangan sehingga mudah dibawa, praktis digunakan, dan cocok untuk camping, kegiatan outdoor malam hari, rumah, atau keadaan darurat.', 15000.00, 6, 'baik', 'tersedia', 'barangs/rRO5U67yKeBq0zf3klwUo73L0SnK08Ym840ltlJ4.png', '2026-05-18 13:16:17', '2026-05-18 13:16:17'),
(33, 7, 'Kursi Lipat Camping', 'kursi-lipat-camping', 'Kursi lipat camping portable yang ringan, praktis, dan mudah dibawa. Dilengkapi sandaran punggung, dudukan kain yang nyaman, rangka besi yang kokoh, serta armrest untuk bersantai di area outdoor. Cocok digunakan untuk camping, piknik, memancing, acara outdoor, atau duduk santai di sekitar tenda.', 20000.00, 8, 'baik', 'tersedia', 'barangs/PULsq1sVLoi8vOVycySqpQ47ze7I1wzRSqIMvI6k.png', '2026-05-18 13:22:50', '2026-05-18 13:22:50'),
(35, 7, 'Meja Lipat Camping', 'meja-lipat-camping', 'Meja lipat camping portable dengan desain ringkas dan kaki yang dapat dilipat. Cocok digunakan untuk meletakkan makanan, minuman, alat masak, kompor portable, atau perlengkapan camping lainnya. Mudah dibawa dan praktis digunakan saat camping, piknik, memancing, maupun kegiatan outdoor bersama keluarga atau teman.', 25000.00, 6, 'baik', 'tersedia', 'barangs/UHplRxo0rKUuvw8pwbg4Zw34GNBdpj6awxpkxpfF.png', '2026-05-18 13:28:00', '2026-05-18 13:28:00'),
(36, 7, 'Hammock', 'hammock', 'Hammock adalah tempat tidur gantung portable yang dipasang di antara dua pohon atau tiang menggunakan tali pengikat. Cocok digunakan untuk bersantai, tidur siang, membaca, atau menikmati suasana alam saat camping. Bahannya ringan, mudah dilipat, dan praktis dibawa untuk kegiatan outdoor.', 20000.00, 7, 'baik', 'tersedia', 'barangs/IFlh2iB8kiO7sfPObNnvgeO4Uu75iBwKrHGX7jqx.png', '2026-05-18 13:32:48', '2026-05-18 13:32:48'),
(37, 7, 'Kasur Lipat Camping', 'kasur-lipat-camping', 'Kasur lipat camping portable dengan bantalan empuk dan desain beberapa panel yang mudah dilipat. Cocok digunakan sebagai alas tidur tambahan di dalam tenda atau area camping agar tidur lebih nyaman. Praktis dibawa, mudah disimpan, dan sesuai untuk camping keluarga, pramuka, piknik, atau kegiatan outdoor yang membutuhkan kenyamanan lebih.', 30000.00, 5, 'baik', 'tersedia', 'barangs/Q2GYb0v1kORX0M7WNH7NhuR00ktLdFsu1mocNm5t.png', '2026-05-18 13:35:16', '2026-05-18 13:35:16'),
(38, 7, 'Rak Portable Camping', 'rak-portable-camping', 'Rak portable camping dengan desain lipat yang praktis digunakan untuk menyusun perlengkapan saat berada di area perkemahan. Cocok untuk meletakkan alat masak, makanan, minuman, sepatu, lampu, atau perlengkapan camping lainnya agar lebih rapi dan mudah dijangkau. Mudah dilipat, ringan, dan nyaman dibawa untuk camping, piknik, maupun kegiatan outdoor.', 25000.00, 5, 'baik', 'tersedia', 'barangs/PYtFREnwJy3D0e72QnSx7yD4inwTiZ2OTxDRmpG8.png', '2026-05-18 13:37:32', '2026-05-18 13:37:32'),
(39, 8, 'Trekking Pole', 'trekking-pole', 'Trekking pole adalah tongkat bantu jalan yang digunakan saat hiking, trekking, atau pendakian. Alat ini membantu menjaga keseimbangan tubuh, mengurangi beban pada lutut, serta memberikan pijakan tambahan saat melewati jalur menanjak, menurun, licin, atau berbatu.', 20000.00, 7, 'baik', 'tersedia', 'barangs/VP9VWVsDUX4PtCzskgauJOX56RsBJ3Ucf7yZn03n.png', '2026-05-18 13:40:54', '2026-05-22 22:35:56'),
(40, 8, 'Jas Hujan / Poncho', 'jas-hujan-poncho', 'Jas hujan atau poncho adalah perlengkapan pelindung tubuh dari hujan saat camping, hiking, pendakian, atau kegiatan outdoor lainnya. Memiliki desain longgar sehingga nyaman digunakan dan dapat menutupi sebagian barang bawaan. Ringan, mudah dilipat, dan praktis dibawa di dalam tas.', 15000.00, 10, 'baik', 'tersedia', 'barangs/GZsWSnp56pwJKYrmqSpwBiTFhfN07uFCdiCRtOOz.png', '2026-05-18 13:43:44', '2026-05-18 13:43:44'),
(41, 8, 'Flysheet', 'flysheet', 'Flysheet adalah kain pelindung tambahan yang dipasang di atas tenda atau area camping untuk melindungi dari panas matahari dan hujan ringan. Dapat digunakan sebagai atap terbuka untuk area bersantai, memasak, atau menyimpan perlengkapan agar tetap terlindungi. Ringan, mudah dipasang, dan praktis dibawa saat camping maupun kegiatan outdoor.', 25000.00, 6, 'baik', 'tersedia', 'barangs/x4nVTMObCjT21YaxyVBoV7jNkbiDbAetXQypdhoL.png', '2026-05-18 13:47:25', '2026-05-18 13:47:25'),
(42, 8, 'Tali Paracord', 'tali-paracord', 'Tali paracord adalah tali serbaguna yang kuat, ringan, dan praktis digunakan untuk berbagai kebutuhan outdoor. Cocok untuk memasang flysheet, mengikat perlengkapan, membuat jemuran, menggantung barang, atau kebutuhan darurat saat camping dan hiking.', 10000.00, 15, 'baik', 'tersedia', 'barangs/3komcDCaWM1xSPONFzDLK8ATHNSMJxiaKYO6VgSS.png', '2026-05-18 13:51:36', '2026-05-18 13:51:44'),
(43, 8, 'Dry Bag', 'dry-bag', 'Dry bag adalah tas tahan air yang digunakan untuk melindungi barang bawaan agar tetap kering saat camping, hiking, atau kegiatan outdoor. Cocok untuk menyimpan pakaian, handphone, kamera, dokumen, makanan ringan, atau perlengkapan penting lainnya agar aman dari hujan dan cipratan air.', 15000.00, 6, 'baik', 'tersedia', 'barangs/TPJd2sORxqyKcnJYdJ9c6N0brYjgF4KhxDgIqx8b.png', '2026-05-18 13:54:59', '2026-05-18 13:54:59');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('camping-rental-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:39:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:15:\"dashboard.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:10:\"user.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:11:\"user.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:9:\"user.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:11:\"user.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:10:\"role.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:11:\"role.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:9:\"role.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:11:\"role.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:16:\"permission.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:17:\"permission.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:15:\"permission.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:17:\"permission.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:14:\"kategori.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:15:\"kategori.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:13:\"kategori.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:15:\"kategori.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:12:\"barang.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:13:\"barang.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:11:\"barang.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:13:\"barang.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:15:\"penyewaan.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:22;a:3:{s:1:\"a\";i:23;s:1:\"b\";s:16:\"penyewaan.create\";s:1:\"c\";s:3:\"web\";}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:14:\"penyewaan.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:16:\"penyewaan.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:16:\"penyewaan.status\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:18:\"pengembalian.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:27;a:3:{s:1:\"a\";i:28;s:1:\"b\";s:19:\"pengembalian.create\";s:1:\"c\";s:3:\"web\";}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:17:\"pengembalian.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:29;a:3:{s:1:\"a\";i:30;s:1:\"b\";s:19:\"pengembalian.delete\";s:1:\"c\";s:3:\"web\";}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:13:\"laporan.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:10:\"alat.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:11:\"sewa.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:12:\"sewa.riwayat\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:11:\"sewa.status\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:35;a:3:{s:1:\"a\";i:36;s:1:\"b\";s:14:\"laporan.create\";s:1:\"c\";s:3:\"web\";}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:14:\"laporan.export\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:13:\"laporan.cetak\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:15:\"aktivitas.index\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}}s:5:\"roles\";a:4:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"Admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:7:\"Petugas\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:7:\"Penyewa\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:5:\"Owner\";s:1:\"c\";s:3:\"web\";}}}', 1782978590);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_penyewaans`
--

CREATE TABLE `detail_penyewaans` (
  `id` bigint UNSIGNED NOT NULL,
  `penyewaan_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL DEFAULT '1',
  `harga_sewa` decimal(12,2) NOT NULL DEFAULT '0.00',
  `subtotal` decimal(12,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_penyewaans`
--

INSERT INTO `detail_penyewaans` (`id`, `penyewaan_id`, `barang_id`, `jumlah`, `harga_sewa`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 50000.00, 100000.00, '2026-05-13 18:44:48', '2026-05-13 18:44:48'),
(2, 2, 1, 1, 50000.00, 100000.00, '2026-05-13 18:47:15', '2026-05-13 18:47:15'),
(3, 3, 6, 1, 85000.00, 170000.00, '2026-05-18 06:54:48', '2026-05-18 06:54:48'),
(4, 4, 39, 1, 20000.00, 40000.00, '2026-05-19 08:09:41', '2026-05-19 08:09:41'),
(5, 5, 39, 1, 20000.00, 20000.00, '2026-05-22 22:34:40', '2026-05-22 22:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama_kategori`, `slug`, `deskripsi`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Tenda', 'tenda', 'Kategori untuk berbagai jenis tenda camping seperti tenda dome, tenda kapasitas kecil, dan tenda keluarga.', 'aktif', '2026-05-12 23:10:47', '2026-05-12 23:21:59'),
(2, 'Sleeping Bag', 'sleeping-bag', 'Kategori untuk perlengkapan tidur outdoor seperti sleeping bag polar, waterproof, dan ultralight.', 'aktif', '2026-05-12 23:10:47', '2026-05-12 23:10:47'),
(3, 'Carrier', 'carrier', 'Kategori untuk tas gunung atau carrier berbagai ukuran untuk kegiatan hiking dan camping.', 'aktif', '2026-05-12 23:10:47', '2026-05-12 23:10:47'),
(4, 'Matras', 'matras', 'Kategori untuk alas tidur camping seperti matras gulung, matras aluminium, dan matras inflatable.', 'aktif', '2026-05-12 23:10:47', '2026-05-12 23:10:47'),
(5, 'Peralatan Masak', 'peralatan-masak', 'Kategori untuk perlengkapan masak outdoor seperti nesting cookware, kompor portable, panci, dan teko camping.', 'aktif', '2026-05-12 23:10:47', '2026-05-12 23:10:47'),
(6, 'Penerangan', 'penerangan', 'Kategori untuk alat penerangan seperti lampu camping, headlamp, dan lentera portable.', 'aktif', '2026-05-12 23:10:47', '2026-05-12 23:10:47'),
(7, 'Furniture Camping', 'furniture-camping', 'Kategori untuk perlengkapan duduk dan meja seperti kursi lipat, meja lipat, dan hammock.', 'aktif', '2026-05-12 23:10:47', '2026-05-12 23:10:47'),
(8, 'Perlengkapan Outdoor', 'perlengkapan-outdoor', 'Kategori untuk perlengkapan pendukung outdoor seperti trekking pole, jas hujan, dan jaket outdoor.', 'aktif', '2026-05-12 23:10:47', '2026-05-12 23:10:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_13_024905_create_permission_tables', 2),
(5, '2026_05_13_070718_create_kategoris_table', 3),
(6, '2026_05_13_072309_create_barangs_table', 4),
(7, '2026_05_13_123221_create_penyewaans_table', 5),
(8, '2026_05_13_123230_create_detail_penyewaans_table', 5),
(9, '2026_05_14_021901_add_bukti_identitas_to_penyewaans_table', 6),
(10, '2026_05_14_042911_add_pengembalian_fields_to_penyewaans_table', 7),
(11, '2026_05_19_151645_create_aktivitas_table', 8),
(12, '2026_05_19_160409_add_denda_to_penyewaans_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 11);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penyewaans`
--

CREATE TABLE `penyewaans` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kode_penyewaan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_sewa` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `tanggal_dikembalikan` date DEFAULT NULL,
  `kondisi_pengembalian` enum('baik','rusak_ringan','rusak_berat') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_pengembalian` text COLLATE utf8mb4_unicode_ci,
  `lama_sewa` int NOT NULL DEFAULT '1',
  `terlambat_hari` int NOT NULL DEFAULT '0',
  `denda_per_hari` decimal(12,2) NOT NULL DEFAULT '0.00',
  `total_denda` decimal(12,2) NOT NULL DEFAULT '0.00',
  `total_bayar` decimal(12,2) NOT NULL DEFAULT '0.00',
  `total_harga` decimal(12,2) NOT NULL DEFAULT '0.00',
  `bukti_identitas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','disetujui','ditolak','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penyewaans`
--

INSERT INTO `penyewaans` (`id`, `user_id`, `kode_penyewaan`, `tanggal_sewa`, `tanggal_kembali`, `tanggal_dikembalikan`, `kondisi_pengembalian`, `catatan_pengembalian`, `lama_sewa`, `terlambat_hari`, `denda_per_hari`, `total_denda`, `total_bayar`, `total_harga`, `bukti_identitas`, `status`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 3, 'SW-20260514024447-3', '2026-05-14', '2026-05-16', '2026-05-16', 'baik', 'masih baik.', 2, 0, 0.00, 0.00, 0.00, 100000.00, 'KTP', 'selesai', 'Alat dipakai untuk liburan di pantai', '2026-05-13 18:44:47', '2026-05-13 20:34:43'),
(2, 3, 'SW-20260514024715-3', '2026-05-14', '2026-05-16', NULL, NULL, NULL, 2, 0, 0.00, 0.00, 0.00, 100000.00, 'SIM', 'selesai', 'dipakai untuk liburan ke tambing', '2026-05-13 18:47:15', '2026-05-13 20:14:42'),
(3, 3, 'SW-20260518145448-3', '2026-05-18', '2026-05-20', '2026-05-25', 'baik', 'ffddgb', 2, 0, 0.00, 0.00, 0.00, 170000.00, 'SIM', 'selesai', 'gfdhtfhf', '2026-05-18 06:54:48', '2026-05-18 07:01:29'),
(4, 3, 'SW-20260519160941-3', '2026-05-19', '2026-05-21', '2026-05-23', 'baik', 'banyak alasannya.', 2, 2, 10000.00, 20000.00, 60000.00, 40000.00, 'Kartu Pelajar', 'selesai', 'pakai naik gunung', '2026-05-19 08:09:41', '2026-05-19 08:10:58'),
(5, 11, 'SW-20260522183440-11', '2026-05-22', '2026-05-23', NULL, NULL, NULL, 1, 0, 0.00, 0.00, 20000.00, 20000.00, 'Kartu Mahasiswa', 'disetujui', 'Untuk tektok', '2026-05-22 22:34:40', '2026-05-22 22:35:56');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard.index', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(2, 'user.index', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(3, 'user.create', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(4, 'user.edit', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(5, 'user.delete', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(6, 'role.index', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(7, 'role.create', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(8, 'role.edit', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(9, 'role.delete', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(10, 'permission.index', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(11, 'permission.create', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(12, 'permission.edit', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(13, 'permission.delete', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(14, 'kategori.index', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(15, 'kategori.create', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(16, 'kategori.edit', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(17, 'kategori.delete', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(18, 'barang.index', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(19, 'barang.create', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(20, 'barang.edit', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(21, 'barang.delete', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(22, 'penyewaan.index', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(23, 'penyewaan.create', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(24, 'penyewaan.edit', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(25, 'penyewaan.delete', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(26, 'penyewaan.status', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(27, 'pengembalian.index', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(28, 'pengembalian.create', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(29, 'pengembalian.edit', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(30, 'pengembalian.delete', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(31, 'laporan.index', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(32, 'alat.index', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(33, 'sewa.create', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(34, 'sewa.riwayat', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(35, 'sewa.status', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(36, 'laporan.create', 'web', '2026-05-12 20:41:40', '2026-05-12 20:41:40'),
(37, 'laporan.export', 'web', '2026-05-12 20:49:40', '2026-05-12 20:49:40'),
(38, 'laporan.cetak', 'web', '2026-05-12 20:49:50', '2026-05-12 20:49:50'),
(39, 'aktivitas.index', 'web', '2026-05-19 07:27:40', '2026-05-19 07:27:40');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(2, 'Petugas', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(3, 'Penyewa', 'web', '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(4, 'Owner', 'web', '2026-05-12 20:25:06', '2026-05-12 20:25:06');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(29, 1),
(31, 1),
(32, 1),
(37, 1),
(38, 1),
(1, 2),
(14, 2),
(15, 2),
(16, 2),
(18, 2),
(19, 2),
(20, 2),
(22, 2),
(24, 2),
(26, 2),
(27, 2),
(29, 2),
(31, 2),
(38, 2),
(1, 3),
(32, 3),
(33, 3),
(34, 3),
(35, 3),
(1, 4),
(31, 4),
(37, 4),
(38, 4),
(39, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('z9kpLW8sL4aJnCoExEhVoqC7Cihqq8r2zg7FCfvl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRjk3b2RVaHoyVmZjRWVYa2ZDY2pOb0V6NWdZMDdMaHFrNWJjSHNuMiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9fQ==', 1782892404);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Camping', 'admin@camping.com', NULL, '$2y$12$5VyRjuNxSTgNMd/Th.NkSOd2Bc/vdTu8nG7NnU2UgVhYw3YBZlvFi', NULL, '2026-05-12 18:51:53', '2026-05-12 18:51:53'),
(2, 'Petugas Camping', 'petugas@camping.com', NULL, '$2y$12$1fT42RIT6JRMpdBEOzOamuXUdZmdiGtgnWgMpIUBEPGIZIvw4gBdy', NULL, '2026-05-12 18:51:54', '2026-05-12 18:51:54'),
(3, 'Penyewa', 'penyewa@camping.com', NULL, '$2y$12$4XPXKaGoh9gKLTmOpyhkleE28fReJKl7AMDcJKW1C0BQXgYon8M8C', NULL, '2026-05-12 18:51:54', '2026-05-19 08:39:32'),
(5, 'Owner Camping', 'owner@camping.com', NULL, '$2y$12$rkjGsb/Z5To5j9BE1Z6g8eBWVrAqWM3G/IgCAZTIY1/UlDBUmvyAS', NULL, '2026-05-13 20:51:46', '2026-05-13 20:51:46'),
(11, 'Alya', 'alya@camping.com', NULL, '$2y$12$7kGFLZpVMflgaGAVm9gfq.weLdFT1m9ZCHVDgCPjQo6ohxIcwDLLi', NULL, '2026-05-22 22:33:41', '2026-05-22 22:33:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aktivitas_user_id_foreign` (`user_id`);

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barangs_slug_unique` (`slug`),
  ADD KEY `barangs_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `detail_penyewaans`
--
ALTER TABLE `detail_penyewaans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_penyewaans_penyewaan_id_foreign` (`penyewaan_id`),
  ADD KEY `detail_penyewaans_barang_id_foreign` (`barang_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategoris_slug_unique` (`slug`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `penyewaans`
--
ALTER TABLE `penyewaans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `penyewaans_kode_penyewaan_unique` (`kode_penyewaan`),
  ADD KEY `penyewaans_user_id_foreign` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktivitas`
--
ALTER TABLE `aktivitas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `detail_penyewaans`
--
ALTER TABLE `detail_penyewaans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `penyewaans`
--
ALTER TABLE `penyewaans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD CONSTRAINT `aktivitas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `barangs`
--
ALTER TABLE `barangs`
  ADD CONSTRAINT `barangs_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `detail_penyewaans`
--
ALTER TABLE `detail_penyewaans`
  ADD CONSTRAINT `detail_penyewaans_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barangs` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_penyewaans_penyewaan_id_foreign` FOREIGN KEY (`penyewaan_id`) REFERENCES `penyewaans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penyewaans`
--
ALTER TABLE `penyewaans`
  ADD CONSTRAINT `penyewaans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
