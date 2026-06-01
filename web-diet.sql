-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 17, 2026 at 11:20 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web-diet`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rekomendasi_imt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `user_id`, `judul`, `isi`, `gambar`, `rekomendasi_imt`, `created_at`, `updated_at`) VALUES
(1, 2, 'Mengenal IMT: Angka Sakti atau Sekadar Angka Biasa?', 'Pernahkah Anda berdiri di depan timbangan, melihat angka yang tertera, lalu mendadak cemas? Sebelum Anda memutuskan untuk memotong porsi makan secara drastis, ada baiknya Anda berkenalan dulu dengan yang namanya Indeks Massa Tubuh (IMT).IMT adalah rumus sederhana yang membandingkan berat badan dengan tinggi badan Anda. Rumusnya seperti ini:$$\\text{IMT} = \\frac{\\text{Berat Badan (kg)}}{(\\text{Tinggi Badan (m)})^2}$$Hasil dari pembagian ini akan memasukkan Anda ke dalam salah satu dari empat kategori: berat badan kurang, normal, berlebih, atau obesitas.Mengapa IMT Penting untuk Diet Anda?Banyak orang memulai diet tanpa tahu titik awal mereka. Mengetahui IMT membantu Anda menentukan target yang realistis. Jika IMT Anda sudah berada di kategori normal, diet yang Anda butuhkan mungkin bukan menurunkan berat badan, melainkan mengencangkan otot atau menjaga kebugaran.Namun, ingat! IMT memiliki keterbatasan. Angka ini tidak bisa membedakan antara bobot lemak dan bobot otot. Seorang binaragawan bisa saja dikategorikan \"obesitas\" oleh IMT karena ototnya yang padat, padahal kadar lemak tubuhnya sangat rendah. Jadi, gunakan IMT sebagai kompas awal, bukan sebagai satu-satunya penentu kesehatan Anda.', '1779010320_lari.png', 'Obesitas 1', '2026-05-17 02:32:00', '2026-05-17 02:32:00'),
(2, 2, 'Tips & Kesehatan Tren', '3 Strategi Diet Berdasarkan Kategori IMT Anda\r\nTidak ada satu jenis diet yang cocok untuk semua orang (one-size-fits-all). Agar usaha Anda tidak sia-sia, mari sesuaikan strategi diet berdasarkan kategori IMT Anda saat ini.\r\n\r\nKategori IMT Berlebih (Overweight hingga Obesitas):\r\n\r\nFokus: Defisit kalori yang aman dan konsisten.\r\n\r\nStrategi: Mulailah dengan mengurangi porsi karbohidrat sederhana (seperti nasi putih berlebih dan minuman manis) dan ganti dengan karbohidrat kompleks. Jangan langsung melakukan diet ekstrem; penurunan 0,5 hingga 1 kg per minggu adalah target yang sehat dan berkelanjutan.\r\n\r\nKategori IMT Normal:\r\n\r\nFokus: Komposisi tubuh (body recomposition).\r\n\r\nStrategi: Jika IMT Anda normal tetapi Anda masih merasa \"bergelambir\" (skinny fat), fokusnya adalah meningkatkan massa otot dan membakar lemak secara bersamaan. Tingkatkan konsumsi protein dan mulailah latihan beban (resistance training).\r\n\r\nKategori IMT Kurang (Underweight):\r\n\r\nFokus: Surplus kalori yang sehat.\r\n\r\nStrategi: Diet bukan selalu tentang menurunkan berat badan. Jika Anda berada di kategori ini, Anda perlu menambah asupan kalori dari makanan padat nutrisi seperti kacang-kacangan, alpukat, telur, dan susu untuk mencapai angka IMT ideal', '1779010439_speda.jpg', 'Underweight', '2026-05-17 02:33:59', '2026-05-17 02:33:59'),
(3, 2, 'Pendekatan Medis & Ilmiah', 'Hubungan Antara Hubungan IMT Tinggi, Lemak Viseral, dan Risiko Penyakit MetabolikDalam dunia medis, Indeks Massa Tubuh (IMT) yang melebihi ambang batas normal ($> 25$ untuk standar internasional, atau $> 23$ untuk standar Asia-Pasifik) sering kali menjadi indikator awal adanya penumpukan lemak berlebih di dalam tubuh. Salah satu jenis lemak yang paling berbahaya adalah lemak viseral—lemak yang membungkus organ-organ dalam di area perut.Ketika seseorang menjalani diet dengan tujuan menurunkan IMT, target utamanya sebenarnya bukan sekadar mengecilkan angka di timbangan, melainkan mengurangi volume lemak viseral ini.Kategori IMT (Standar Asia)StatusRisiko Komorbiditas (Penyakit Penyerta)$< 18,5$Berat KurangRendah (tetapi risiko masalah kesehatan lain meningkat)$18,5 - 22,9$NormalRata-rata$23,0 - 24,9$Kelebihan Berat BadanMeningkat$\\ge 25,0$ObesitasTinggi hingga Sangat TinggiPenelitian menunjukkan bahwa penurunan IMT sebesar 5% hingga 10% dari berat badan awal melalui diet rendah kalori seimbang dan olahraga dapat menurunkan risiko diabetes tipe 2, hipertensi, dan penyakit kardiovaskular secara signifikan. Oleh karena itu, diet sebaiknya tidak dilihat sebagai program jangka pendek, melainkan sebagai modifikasi gaya hidup untuk menjaga IMT dalam rentang optimal demi investasi kesehatan jangka panjang.', '1779010507_olah.jpg', 'Overweight', '2026-05-17 02:35:07', '2026-05-17 02:35:07'),
(4, 2, 'Olahraga Rutin', 'Hubungan Antara Hubungan IMT Tinggi, Lemak Viseral, dan Risiko Penyakit MetabolikDalam dunia medis, Indeks Massa Tubuh (IMT) yang melebihi ambang batas normal ($> 25$ untuk standar internasional, atau $> 23$ untuk standar Asia-Pasifik) sering kali menjadi indikator awal adanya penumpukan lemak berlebih di dalam tubuh. Salah satu jenis lemak yang paling berbahaya adalah lemak viseral—lemak yang membungkus organ-organ dalam di area perut.Ketika seseorang menjalani diet dengan tujuan menurunkan IMT, target utamanya sebenarnya bukan sekadar mengecilkan angka di timbangan, melainkan mengurangi volume lemak viseral ini.Kategori IMT (Standar Asia)StatusRisiko Komorbiditas (Penyakit Penyerta)$< 18,5$Berat KurangRendah (tetapi risiko masalah kesehatan lain meningkat)$18,5 - 22,9$NormalRata-rata$23,0 - 24,9$Kelebihan Berat BadanMeningkat$\\ge 25,0$ObesitasTinggi hingga Sangat TinggiPenelitian menunjukkan bahwa penurunan IMT sebesar 5% hingga 10% dari berat badan awal melalui diet rendah kalori seimbang dan olahraga dapat menurunkan risiko diabetes tipe 2, hipertensi, dan penyakit kardiovaskular secara signifikan. Oleh karena itu, diet sebaiknya tidak dilihat sebagai program jangka pendek, melainkan sebagai modifikasi gaya hidup untuk menjaga IMT dalam rentang optimal demi investasi kesehatan jangka panjang.', '1779010585_728.jpg', 'Obesitas 2', '2026-05-17 02:36:25', '2026-05-17 02:36:25'),
(5, 2, 'Rutin Bergerak', 'Pernahkah Anda berdiri di depan timbangan, melihat angka yang tertera, lalu mendadak cemas? Sebelum Anda memutuskan untuk memotong porsi makan secara drastis, ada baiknya Anda berkenalan dulu dengan yang namanya Indeks Massa Tubuh (IMT).IMT adalah rumus sederhana yang membandingkan berat badan dengan tinggi badan Anda. Rumusnya seperti ini:$$\\text{IMT} = \\frac{\\text{Berat Badan (kg)}}{(\\text{Tinggi Badan (m)})^2}$$Hasil dari pembagian ini akan memasukkan Anda ke dalam salah satu dari empat kategori: berat badan kurang, normal, berlebih, atau obesitas.Mengapa IMT Penting untuk Diet Anda?Banyak orang memulai diet tanpa tahu titik awal mereka. Mengetahui IMT membantu Anda menentukan target yang realistis. Jika IMT Anda sudah berada di kategori normal, diet yang Anda butuhkan mungkin bukan menurunkan berat badan, melainkan mengencangkan otot atau menjaga kebugaran.Namun, ingat! IMT memiliki keterbatasan. Angka ini tidak bisa membedakan antara bobot lemak dan bobot otot. Seorang binaragawan bisa saja dikategorikan \"obesitas\" oleh IMT karena ototnya yang padat, padahal kadar lemak tubuhnya sangat rendah. Jadi, gunakan IMT sebagai kompas awal, bukan sebagai satu-satunya penentu kesehatan Anda.', '1779010644_yoga.jpg', 'Normal', '2026-05-17 02:37:24', '2026-05-17 02:37:24'),
(6, 2, 'Jangan Lupa Minum', 'Hubungan Antara Hubungan IMT Tinggi, Lemak Viseral, dan Risiko Penyakit MetabolikDalam dunia medis, Indeks Massa Tubuh (IMT) yang melebihi ambang batas normal ($> 25$ untuk standar internasional, atau $> 23$ untuk standar Asia-Pasifik) sering kali menjadi indikator awal adanya penumpukan lemak berlebih di dalam tubuh. Salah satu jenis lemak yang paling berbahaya adalah lemak viseral—lemak yang membungkus organ-organ dalam di area perut.Ketika seseorang menjalani diet dengan tujuan menurunkan IMT, target utamanya sebenarnya bukan sekadar mengecilkan angka di timbangan, melainkan mengurangi volume lemak viseral ini.Kategori IMT (Standar Asia)StatusRisiko Komorbiditas (Penyakit Penyerta)$< 18,5$Berat KurangRendah (tetapi risiko masalah kesehatan lain meningkat)$18,5 - 22,9$NormalRata-rata$23,0 - 24,9$Kelebihan Berat BadanMeningkat$\\ge 25,0$ObesitasTinggi hingga Sangat TinggiPenelitian menunjukkan bahwa penurunan IMT sebesar 5% hingga 10% dari berat badan awal melalui diet rendah kalori seimbang dan olahraga dapat menurunkan risiko diabetes tipe 2, hipertensi, dan penyakit kardiovaskular secara signifikan. Oleh karena itu, diet sebaiknya tidak dilihat sebagai program jangka pendek, melainkan sebagai modifikasi gaya hidup untuk menjaga IMT dalam rentang optimal demi investasi kesehatan jangka panjang.', '1779010683_asa.jpg', 'Semua', '2026-05-17 02:38:03', '2026-05-17 02:38:03'),
(7, 2, 'Tidur dan Manfaatnya', 'Hubungan Antara Hubungan IMT Tinggi, Lemak Viseral, dan Risiko Penyakit MetabolikDalam dunia medis, Indeks Massa Tubuh (IMT) yang melebihi ambang batas normal ($> 25$ untuk standar internasional, atau $> 23$ untuk standar Asia-Pasifik) sering kali menjadi indikator awal adanya penumpukan lemak berlebih di dalam tubuh. Salah satu jenis lemak yang paling berbahaya adalah lemak viseral—lemak yang membungkus organ-organ dalam di area perut.Ketika seseorang menjalani diet dengan tujuan menurunkan IMT, target utamanya sebenarnya bukan sekadar mengecilkan angka di timbangan, melainkan mengurangi volume lemak viseral ini.Kategori IMT (Standar Asia)StatusRisiko Komorbiditas (Penyakit Penyerta)$< 18,5$Berat KurangRendah (tetapi risiko masalah kesehatan lain meningkat)$18,5 - 22,9$NormalRata-rata$23,0 - 24,9$Kelebihan Berat BadanMeningkat$\\ge 25,0$ObesitasTinggi hingga Sangat TinggiPenelitian menunjukkan bahwa penurunan IMT sebesar 5% hingga 10% dari berat badan awal melalui diet rendah kalori seimbang dan olahraga dapat menurunkan risiko diabetes tipe 2, hipertensi, dan penyakit kardiovaskular secara signifikan. Oleh karena itu, diet sebaiknya tidak dilihat sebagai program jangka pendek, melainkan sebagai modifikasi gaya hidup untuk menjaga IMT dalam rentang optimal demi investasi kesehatan jangka panjang.', '1779010736_asas.jpg', 'Semua', '2026-05-17 02:38:56', '2026-05-17 02:38:56'),
(8, 2, 'Semangat Bergerak', 'Pernahkah Anda berdiri di depan timbangan, melihat angka yang tertera, lalu mendadak cemas? Sebelum Anda memutuskan untuk memotong porsi makan secara drastis, ada baiknya Anda berkenalan dulu dengan yang namanya Indeks Massa Tubuh (IMT).IMT adalah rumus sederhana yang membandingkan berat badan dengan tinggi badan Anda. Rumusnya seperti ini:$$\\text{IMT} = \\frac{\\text{Berat Badan (kg)}}{(\\text{Tinggi Badan (m)})^2}$$Hasil dari pembagian ini akan memasukkan Anda ke dalam salah satu dari empat kategori: berat badan kurang, normal, berlebih, atau obesitas.Mengapa IMT Penting untuk Diet Anda?Banyak orang memulai diet tanpa tahu titik awal mereka. Mengetahui IMT membantu Anda menentukan target yang realistis. Jika IMT Anda sudah berada di kategori normal, diet yang Anda butuhkan mungkin bukan menurunkan berat badan, melainkan mengencangkan otot atau menjaga kebugaran.Namun, ingat! IMT memiliki keterbatasan. Angka ini tidak bisa membedakan antara bobot lemak dan bobot otot. Seorang binaragawan bisa saja dikategorikan \"obesitas\" oleh IMT karena ototnya yang padat, padahal kadar lemak tubuhnya sangat rendah. Jadi, gunakan IMT sebagai kompas awal, bukan sebagai satu-satunya penentu kesehatan Anda.', '1779010776_images.jpg', 'Semua', '2026-05-17 02:39:36', '2026-05-17 02:39:36');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `consultations`
--

CREATE TABLE `consultations` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `ahli_gizi_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `screening_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `consultations`
--

INSERT INTO `consultations` (`id`, `user_id`, `ahli_gizi_id`, `status`, `screening_id`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 'aktif', 1, '2026-05-17 02:52:03', '2026-05-17 02:52:03'),
(2, 5, 2, 'selesai', 2, '2026-05-17 02:56:10', '2026-05-17 03:05:42'),
(3, 6, 2, 'aktif', 3, '2026-05-17 03:10:15', '2026-05-17 03:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `diet_checkins`
--

CREATE TABLE `diet_checkins` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `target_diet_id` bigint UNSIGNED NOT NULL,
  `berat_sekarang` decimal(5,2) NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `tanggal_checkin` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diet_checkins`
--

INSERT INTO `diet_checkins` (`id`, `user_id`, `target_diet_id`, `berat_sekarang`, `catatan`, `tanggal_checkin`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '48.00', 'ttt', '2026-05-17', '2026-05-17 03:00:39', '2026-05-17 03:00:39');

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
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kalori` decimal(8,2) NOT NULL,
  `protein` decimal(8,2) NOT NULL DEFAULT '0.00',
  `karbohidrat` decimal(8,2) NOT NULL DEFAULT '0.00',
  `lemak` decimal(8,2) NOT NULL DEFAULT '0.00',
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `nama`, `kalori`, `protein`, `karbohidrat`, `lemak`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Nasi Putih', '175.00', '4.00', '38.00', '0.50', NULL, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(2, 'Ayam Bakar', '220.00', '30.00', '0.00', '10.00', NULL, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(3, 'Salad Buah Segar', '150.00', '2.00', '25.00', '5.00', NULL, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(4, 'Tempe Goreng', '200.00', '14.00', '12.00', '10.00', NULL, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(5, 'Sayur Bayam', '40.00', '3.00', '5.00', '0.50', NULL, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(6, 'Telur Rebus', '77.00', '6.00', '1.00', '5.00', NULL, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(7, 'Roti Gandum', '120.00', '5.00', '22.00', '2.00', NULL, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(8, 'Susu Full Cream', '149.00', '8.00', '12.00', '8.00', NULL, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(9, 'Pisang', '89.00', '1.00', '23.00', '0.30', NULL, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(10, 'Ikan Salmon Kukus', '180.00', '25.00', '0.00', '8.00', NULL, '2026-05-17 01:48:29', '2026-05-17 01:48:29');

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
-- Table structure for table `meal_plans`
--

CREATE TABLE `meal_plans` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status_imt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `total_kalori` decimal(8,2) NOT NULL DEFAULT '0.00',
  `total_protein` decimal(8,2) NOT NULL DEFAULT '0.00',
  `total_karbohidrat` decimal(8,2) NOT NULL DEFAULT '0.00',
  `total_lemak` decimal(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meal_plans`
--

INSERT INTO `meal_plans` (`id`, `user_id`, `status_imt`, `kategori`, `tanggal`, `total_kalori`, `total_protein`, `total_karbohidrat`, `total_lemak`, `created_at`, `updated_at`) VALUES
(1, 2, 'Normal', 'sarapan', '2026-05-17', '260.00', '33.00', '5.00', '10.50', '2026-05-17 02:59:25', '2026-05-17 02:59:25'),
(2, 2, 'Obesitas 1', 'sarapan', '2026-05-17', '626.00', '54.00', '41.00', '25.80', '2026-05-17 03:32:41', '2026-05-17 03:32:41');

-- --------------------------------------------------------

--
-- Table structure for table `meal_plan_items`
--

CREATE TABLE `meal_plan_items` (
  `id` bigint UNSIGNED NOT NULL,
  `meal_plan_id` bigint UNSIGNED NOT NULL,
  `food_id` bigint UNSIGNED NOT NULL,
  `porsi` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meal_plan_items`
--

INSERT INTO `meal_plan_items` (`id`, `meal_plan_id`, `food_id`, `porsi`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '2026-05-17 02:59:25', '2026-05-17 02:59:25'),
(2, 1, 5, 1, '2026-05-17 02:59:25', '2026-05-17 02:59:25'),
(3, 2, 2, 1, '2026-05-17 03:32:41', '2026-05-17 03:32:41'),
(4, 2, 4, 1, '2026-05-17 03:32:41', '2026-05-17 03:32:41'),
(5, 2, 5, 1, '2026-05-17 03:32:41', '2026-05-17 03:32:41'),
(6, 2, 6, 1, '2026-05-17 03:32:41', '2026-05-17 03:32:41'),
(7, 2, 9, 1, '2026-05-17 03:32:41', '2026-05-17 03:32:41');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `consultation_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `consultation_id`, `user_id`, `isi`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'Halo, saya ingin berkonsultasi.\n\n**Hasil Skrining Saya:**\n- Berat Badan: 60.00 kg\n- Tinggi Badan: 160.00 cm\n- Nilai IMT: 23.44\n- Status IMT: Overweight\n- Total Skor Kebiasaan: 25\n- Status Kebiasaan: Cukup Sehat\n', '2026-05-17 02:52:03', '2026-05-17 02:52:03'),
(2, 1, 4, 'halo dog', '2026-05-17 02:52:09', '2026-05-17 02:52:09'),
(3, 2, 5, 'Halo, saya ingin berkonsultasi.\n\n**Hasil Skrining Saya:**\n- Berat Badan: 48.00 kg\n- Tinggi Badan: 158.00 cm\n- Nilai IMT: 19.23\n- Status IMT: Normal\n- Total Skor Kebiasaan: 28\n- Status Kebiasaan: Kurang Sehat\n', '2026-05-17 02:56:10', '2026-05-17 02:56:10'),
(4, 2, 2, 'halo', '2026-05-17 02:57:16', '2026-05-17 02:57:16'),
(5, 3, 6, 'Halo, saya ingin berkonsultasi.\n\n**Hasil Skrining Saya:**\n- Berat Badan: 67.00 kg\n- Tinggi Badan: 155.90 cm\n- Nilai IMT: 27.57\n- Status IMT: Obesitas 1\n- Total Skor Kebiasaan: 18\n- Status Kebiasaan: Cukup Sehat\n', '2026-05-17 03:10:15', '2026-05-17 03:10:15');

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
(4, '2026_01_01_000000_update_users_table', 1),
(5, '2026_01_01_000001_create_skrining_tables', 1),
(6, '2026_01_01_000002_create_target_diet_tables', 1),
(7, '2026_01_01_000003_create_makanan_tables', 1),
(8, '2026_01_01_000004_create_fitur_tables', 1);

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
-- Table structure for table `physical_activities`
--

CREATE TABLE `physical_activities` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `status_kebiasaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `durasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intensitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `physical_activities`
--

INSERT INTO `physical_activities` (`id`, `nama`, `deskripsi`, `status_kebiasaan`, `durasi`, `intensitas`, `lokasi`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Jalan Santai', 'Jalan kaki 30 menit dengan kecepatan sedang untuk menjaga kebugaran.', 'Kurang Sehat', '30-45 Menit', 'Ringan', 'Luar Ruangan', '1779010042_jalankaki.png', '2026-05-17 01:48:29', '2026-05-17 02:27:22'),
(2, 'Lari Pagi', 'Lari selama 20-30 menit untuk membakar kalori dan meningkatkan kardio.', 'Kurang Sehat', '20-30 Menit', 'Ringan', 'Luar Ruangan', '1779010054_jalankaki.png', '2026-05-17 01:48:29', '2026-05-17 02:27:34'),
(3, 'Yoga', 'Latihan peregangan dan pernapasan untuk fleksibilitas dan ketenangan pikiran.', 'Cukup Sehat', '30 Menit', 'Ringan', 'Dalam Ruangan', '1779010063_jalankaki.png', '2026-05-17 01:48:29', '2026-05-17 02:27:43'),
(4, 'Renang', 'Olahraga air yang efektif membakar kalori tanpa membebani sendi.', 'Hidup Sehat', '45-60 Menit', 'Sedang', 'Dalam Ruangan', '1779010089_jalankaki.png', '2026-05-17 01:48:29', '2026-05-17 02:28:09'),
(5, 'Latihan Beban Ringan', 'Angkat beban ringan 2-3 kali seminggu untuk membangun massa otot.', 'Kurang Sehat', '30-40 Menit', 'Sedang', 'Dalam Ruangan', '1779010101_jalankaki.png', '2026-05-17 01:48:29', '2026-05-17 02:28:21'),
(6, 'Bersepeda', 'Gowes 30-45 menit untuk latihan kardio dan membakar lemak.', 'Cukup Sehat', '30-45 Menit', 'Sedang', 'Luar Ruangan', '1779010111_jalankaki.png', '2026-05-17 01:48:29', '2026-05-17 02:28:31'),
(7, 'Senam Aerobik', 'Gerakan dinamis selama 30 menit untuk meningkatkan stamina.', 'Hidup Sehat', '30 Menit', 'Ringan', 'Dalam Ruangan', '1779010120_jalankaki.png', '2026-05-17 01:48:29', '2026-05-17 02:28:40'),
(8, 'Push Up & Sit Up', 'Latihan badan tanpa alat untuk membangun kekuatan dan massa otot.', 'Kurang Sehat', '15-20 Menit', 'Sedang', 'Dalam Ruangan', '1779010127_jalankaki.png', '2026-05-17 01:48:29', '2026-05-17 02:28:47');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint UNSIGNED NOT NULL,
  `pertanyaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fase` tinyint NOT NULL DEFAULT '1',
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `pertanyaan`, `fase`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 'Seberapa sering Anda melakukan olahraga atau aktivitas fisik?', 1, 1, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(2, 'Berapa lama waktu duduk atau rebahan Anda dalam sehari (di luar waktu tidur)?', 1, 2, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(3, 'Seberapa sering Anda tidur larut malam (di atas pukul 23.00 WIB)?', 1, 3, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(4, 'Seberapa sering Anda mengonsumsi makanan cepat saji atau gorengan?', 1, 4, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(5, 'Seberapa sering Anda mengonsumsi buah dan sayur?', 1, 5, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(6, 'Berapa kali Anda makan dalam sehari?', 2, 6, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(7, 'Seberapa sering Anda mengonsumsi minuman manis?', 2, 7, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(8, 'Seberapa sering Anda tidur kurang dari 7 jam sehari?', 2, 8, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(9, 'Seberapa sering Anda menggunakan gadget sambil makan?', 2, 9, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(10, 'Seberapa sering Anda minum air putih minimal 8 gelas per hari?', 2, 10, '2026-05-17 01:48:29', '2026-05-17 01:48:29');

-- --------------------------------------------------------

--
-- Table structure for table `question_options`
--

CREATE TABLE `question_options` (
  `id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED NOT NULL,
  `jawaban` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skor` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_options`
--

INSERT INTO `question_options` (`id`, `question_id`, `jawaban`, `skor`, `created_at`, `updated_at`) VALUES
(1, 1, 'Setiap Hari', 1, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(2, 1, '3-5 kali/Minggu', 2, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(3, 1, '1-2 kali/Minggu', 3, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(4, 1, 'Tidak Pernah', 4, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(5, 2, '< 2 Jam', 1, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(6, 2, '2-4 Jam', 2, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(7, 2, '5-7 Jam', 3, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(8, 2, '> 7 Jam', 4, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(9, 3, 'Tidak Pernah', 1, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(10, 3, 'Jarang', 2, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(11, 3, 'Sering', 3, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(12, 3, 'Hampir Setiap Hari', 4, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(13, 4, 'Tidak Pernah', 1, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(14, 4, '1-2 kali/Minggu', 2, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(15, 4, '3-4 kali/Minggu', 3, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(16, 4, 'Hampir Setiap Hari', 4, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(17, 5, 'Setiap Hari', 1, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(18, 5, '3-5 kali/Minggu', 2, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(19, 5, '1-2 kali/Minggu', 3, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(20, 5, 'Tidak Pernah', 4, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(21, 6, '3 Kali Teratur', 1, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(22, 6, '2 Kali Sehari', 2, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(23, 6, 'Tidak Teratur', 3, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(24, 6, 'Sering Makan Berlebihan', 4, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(25, 7, 'Tidak Pernah', 1, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(26, 7, '1 kali/Hari', 2, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(27, 7, '2-3 kali/Hari', 3, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(28, 7, 'Lebih Dari 3 kali/Hari', 4, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(29, 8, 'Tidak Pernah', 1, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(30, 8, 'Jarang', 2, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(31, 8, 'Sering', 3, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(32, 8, 'Hampir Setiap Hari', 4, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(33, 9, 'Tidak Pernah', 1, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(34, 9, 'Jarang', 2, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(35, 9, 'Sering', 3, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(36, 9, 'Hampir Setiap Hari', 4, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(37, 10, 'Hampir Setiap Hari', 1, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(38, 10, 'Sering', 2, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(39, 10, 'Jarang', 3, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(40, 10, 'Tidak Pernah', 4, '2026-05-17 01:48:29', '2026-05-17 01:48:29');

-- --------------------------------------------------------

--
-- Table structure for table `screenings`
--

CREATE TABLE `screenings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `berat_badan` decimal(5,2) NOT NULL,
  `tinggi_badan` decimal(5,2) NOT NULL,
  `imt` decimal(5,2) NOT NULL,
  `status_imt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_skor` tinyint NOT NULL DEFAULT '0',
  `status_kebiasaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `screenings`
--

INSERT INTO `screenings` (`id`, `user_id`, `berat_badan`, `tinggi_badan`, `imt`, `status_imt`, `total_skor`, `status_kebiasaan`, `created_at`, `updated_at`) VALUES
(1, 4, '60.00', '160.00', '23.44', 'Overweight', 25, 'Cukup Sehat', '2026-05-17 02:52:00', '2026-05-17 02:52:00'),
(2, 5, '48.00', '158.00', '19.23', 'Normal', 28, 'Kurang Sehat', '2026-05-17 02:55:55', '2026-05-17 02:55:55'),
(3, 6, '67.00', '155.90', '27.57', 'Obesitas 1', 18, 'Cukup Sehat', '2026-05-17 03:09:15', '2026-05-17 03:09:15');

-- --------------------------------------------------------

--
-- Table structure for table `screening_answers`
--

CREATE TABLE `screening_answers` (
  `id` bigint UNSIGNED NOT NULL,
  `screening_id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED NOT NULL,
  `question_option_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `screening_answers`
--

INSERT INTO `screening_answers` (`id`, `screening_id`, `question_id`, `question_option_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2026-05-17 02:52:00', '2026-05-17 02:52:00'),
(2, 1, 2, 8, '2026-05-17 02:52:00', '2026-05-17 02:52:00'),
(3, 1, 3, 10, '2026-05-17 02:52:00', '2026-05-17 02:52:00'),
(4, 1, 4, 14, '2026-05-17 02:52:00', '2026-05-17 02:52:00'),
(5, 1, 5, 18, '2026-05-17 02:52:00', '2026-05-17 02:52:00'),
(6, 1, 6, 21, '2026-05-17 02:52:00', '2026-05-17 02:52:00'),
(7, 1, 7, 28, '2026-05-17 02:52:00', '2026-05-17 02:52:00'),
(8, 1, 8, 30, '2026-05-17 02:52:00', '2026-05-17 02:52:00'),
(9, 1, 9, 35, '2026-05-17 02:52:00', '2026-05-17 02:52:00'),
(10, 1, 10, 40, '2026-05-17 02:52:00', '2026-05-17 02:52:00'),
(11, 2, 1, 4, '2026-05-17 02:55:55', '2026-05-17 02:55:55'),
(12, 2, 2, 6, '2026-05-17 02:55:55', '2026-05-17 02:55:55'),
(13, 2, 3, 9, '2026-05-17 02:55:55', '2026-05-17 02:55:55'),
(14, 2, 4, 16, '2026-05-17 02:55:55', '2026-05-17 02:55:55'),
(15, 2, 5, 18, '2026-05-17 02:55:55', '2026-05-17 02:55:55'),
(16, 2, 6, 23, '2026-05-17 02:55:55', '2026-05-17 02:55:55'),
(17, 2, 7, 27, '2026-05-17 02:55:55', '2026-05-17 02:55:55'),
(18, 2, 8, 31, '2026-05-17 02:55:55', '2026-05-17 02:55:55'),
(19, 2, 9, 35, '2026-05-17 02:55:55', '2026-05-17 02:55:55'),
(20, 2, 10, 39, '2026-05-17 02:55:55', '2026-05-17 02:55:55'),
(21, 3, 1, 1, '2026-05-17 03:09:15', '2026-05-17 03:09:15'),
(22, 3, 2, 7, '2026-05-17 03:09:15', '2026-05-17 03:09:15'),
(23, 3, 3, 9, '2026-05-17 03:09:15', '2026-05-17 03:09:15'),
(24, 3, 4, 15, '2026-05-17 03:09:15', '2026-05-17 03:09:15'),
(25, 3, 5, 17, '2026-05-17 03:09:15', '2026-05-17 03:09:15'),
(26, 3, 6, 21, '2026-05-17 03:09:15', '2026-05-17 03:09:15'),
(27, 3, 7, 25, '2026-05-17 03:09:15', '2026-05-17 03:09:15'),
(28, 3, 8, 31, '2026-05-17 03:09:15', '2026-05-17 03:09:15'),
(29, 3, 9, 35, '2026-05-17 03:09:15', '2026-05-17 03:09:15'),
(30, 3, 10, 37, '2026-05-17 03:09:15', '2026-05-17 03:09:15');

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
('aAGXykTvvJBmHTH3U9NJ1aoZECJ5JNbQ6LZpZndX', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYncyTjdkbjBuZFZXbTE1U1FGVUh3M1gwZEZwZzFDT280NksySUlDbSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9rZWxvbGEtYWhsaS1naXppIjtzOjU6InJvdXRlIjtzOjIyOiJhZG1pbi5rZWxvbGFfYWhsaV9naXppIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1779015425),
('EmKJzDix14NYoLa5sx334jjs69z0gdl3N9Y17dpf', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiek5EelJPS25aY3BQbUJFbzdGTEJkakJUOTd3MEduVVN1WW1OQlhvWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9za3JpbmluZyI7czo1OiJyb3V0ZSI7czoxNzoic2tyaW5pbmcubGFuZ2thaDEiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2O30=', 1779016019),
('T2xIb5rPhCyxzZFtYcgkfpcog75sakmBIxdwEOa5', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib0lEc1RwQ2xnSVpXWG9WR0REY0xyU3p6a2VDRlNGWTdqM1FGMmZORyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9haGxpLWdpemkvYXJ0aWtlbC90YW1iYWgiO3M6NToicm91dGUiO3M6MjM6ImFobGlnaXppLmFydGlrZWwudGFtYmFoIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1779014377);

-- --------------------------------------------------------

--
-- Table structure for table `sleep_logs`
--

CREATE TABLE `sleep_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `jam_tidur` time NOT NULL,
  `jam_bangun` time NOT NULL,
  `durasi_jam` decimal(4,2) NOT NULL,
  `status_tidur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sleep_logs`
--

INSERT INTO `sleep_logs` (`id`, `user_id`, `jam_tidur`, `jam_bangun`, `durasi_jam`, `status_tidur`, `catatan`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 5, '22:31:00', '06:31:00', '8.00', 'Baik', 'dwe', '2026-05-17', '2026-05-17 02:58:41', '2026-05-17 02:58:41');

-- --------------------------------------------------------

--
-- Table structure for table `target_diets`
--

CREATE TABLE `target_diets` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `berat_target` decimal(5,2) NOT NULL,
  `target_mingguan` decimal(5,2) NOT NULL,
  `tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat_awal` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `target_diets`
--

INSERT INTO `target_diets` (`id`, `user_id`, `berat_target`, `target_mingguan`, `tujuan`, `berat_awal`, `created_at`, `updated_at`) VALUES
(1, 5, '40.00', '1.00', 'turun', '48.00', '2026-05-17 03:00:13', '2026-05-17 03:00:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pengguna',
  `umur` int DEFAULT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_online` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `umur`, `jenis_kelamin`, `is_online`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin SISD', 'admin@sisd.id', 'admin', NULL, NULL, 0, NULL, '$2y$12$u/sQEeAmiy1ALGOmKk1Y1.rhPc1dJdmaEaPHgRa6.HWIj9ThOZHRu', NULL, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(2, 'Dr. Sari Nutrisi', 'sari@sisd.id', 'ahli_gizi', NULL, NULL, 1, NULL, '$2y$12$nM/dRu18zigrAkJpyRqg7ufnCx8Jh0aALyVcw1pYsRsk5F4zqyBq2', NULL, '2026-05-17 01:48:29', '2026-05-17 03:10:04'),
(3, 'Dr. Budi Gizi', 'budi@sisd.id', 'ahli_gizi', NULL, NULL, 0, NULL, '$2y$12$mtFBUQpJkL3tiNt.iNkF.eas5YchcC8v7oG1PPngitIeJqOcZ6aey', NULL, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(4, 'Alexandra', 'user@sisd.id', 'pengguna', 25, 'P', 0, NULL, '$2y$12$3QFfIkug2RZ8cLyH2gVELeGNKeEXrx.lyzm1KTWuENOrQEGA6y7tm', NULL, '2026-05-17 01:48:29', '2026-05-17 01:48:29'),
(5, 'silvy', 'silpi@gmail.com', 'pengguna', 20, 'P', 0, NULL, '$2y$12$416dtJDweEmY6tSLVLdaxuYZAvuI4PFAUCMJqsVCULAB3xV.Wxnzu', NULL, '2026-05-17 02:54:04', '2026-05-17 02:54:04'),
(6, 'Kholis Abdullah', 'kholis2@gmail.com', 'pengguna', 21, 'Laki-laki', 0, NULL, '$2y$12$UxW1mGCsa4mDgfaZHxMskufAcNDQidE..qTuZKts5RPPogdewzcqK', NULL, '2026-05-17 03:08:45', '2026-05-17 03:11:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_user_id_foreign` (`user_id`);

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
-- Indexes for table `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consultations_user_id_foreign` (`user_id`),
  ADD KEY `consultations_ahli_gizi_id_foreign` (`ahli_gizi_id`),
  ADD KEY `consultations_screening_id_foreign` (`screening_id`);

--
-- Indexes for table `diet_checkins`
--
ALTER TABLE `diet_checkins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diet_checkins_user_id_foreign` (`user_id`),
  ADD KEY `diet_checkins_target_diet_id_foreign` (`target_diet_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `meal_plans`
--
ALTER TABLE `meal_plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meal_plans_user_id_foreign` (`user_id`);

--
-- Indexes for table `meal_plan_items`
--
ALTER TABLE `meal_plan_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meal_plan_items_meal_plan_id_foreign` (`meal_plan_id`),
  ADD KEY `meal_plan_items_food_id_foreign` (`food_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_consultation_id_foreign` (`consultation_id`),
  ADD KEY `messages_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `physical_activities`
--
ALTER TABLE `physical_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_options`
--
ALTER TABLE `question_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_options_question_id_foreign` (`question_id`);

--
-- Indexes for table `screenings`
--
ALTER TABLE `screenings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `screenings_user_id_foreign` (`user_id`);

--
-- Indexes for table `screening_answers`
--
ALTER TABLE `screening_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `screening_answers_screening_id_foreign` (`screening_id`),
  ADD KEY `screening_answers_question_id_foreign` (`question_id`),
  ADD KEY `screening_answers_question_option_id_foreign` (`question_option_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sleep_logs`
--
ALTER TABLE `sleep_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sleep_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `target_diets`
--
ALTER TABLE `target_diets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `target_diets_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `consultations`
--
ALTER TABLE `consultations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `diet_checkins`
--
ALTER TABLE `diet_checkins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meal_plans`
--
ALTER TABLE `meal_plans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `meal_plan_items`
--
ALTER TABLE `meal_plan_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `physical_activities`
--
ALTER TABLE `physical_activities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `question_options`
--
ALTER TABLE `question_options`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `screenings`
--
ALTER TABLE `screenings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `screening_answers`
--
ALTER TABLE `screening_answers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sleep_logs`
--
ALTER TABLE `sleep_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `target_diets`
--
ALTER TABLE `target_diets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `consultations`
--
ALTER TABLE `consultations`
  ADD CONSTRAINT `consultations_ahli_gizi_id_foreign` FOREIGN KEY (`ahli_gizi_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `consultations_screening_id_foreign` FOREIGN KEY (`screening_id`) REFERENCES `screenings` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `consultations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `diet_checkins`
--
ALTER TABLE `diet_checkins`
  ADD CONSTRAINT `diet_checkins_target_diet_id_foreign` FOREIGN KEY (`target_diet_id`) REFERENCES `target_diets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `diet_checkins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meal_plans`
--
ALTER TABLE `meal_plans`
  ADD CONSTRAINT `meal_plans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meal_plan_items`
--
ALTER TABLE `meal_plan_items`
  ADD CONSTRAINT `meal_plan_items_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `meal_plan_items_meal_plan_id_foreign` FOREIGN KEY (`meal_plan_id`) REFERENCES `meal_plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_consultation_id_foreign` FOREIGN KEY (`consultation_id`) REFERENCES `consultations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question_options`
--
ALTER TABLE `question_options`
  ADD CONSTRAINT `question_options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `screenings`
--
ALTER TABLE `screenings`
  ADD CONSTRAINT `screenings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `screening_answers`
--
ALTER TABLE `screening_answers`
  ADD CONSTRAINT `screening_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `screening_answers_question_option_id_foreign` FOREIGN KEY (`question_option_id`) REFERENCES `question_options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `screening_answers_screening_id_foreign` FOREIGN KEY (`screening_id`) REFERENCES `screenings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sleep_logs`
--
ALTER TABLE `sleep_logs`
  ADD CONSTRAINT `sleep_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `target_diets`
--
ALTER TABLE `target_diets`
  ADD CONSTRAINT `target_diets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
