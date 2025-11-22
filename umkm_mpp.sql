-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Nov 2025 pada 03.10
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umkm_mpp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `shipping` decimal(10,2) DEFAULT 15000.00,
  `total` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','shipped','delivered','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `customer_email`, `customer_phone`, `address`, `payment_method`, `subtotal`, `shipping`, `total`, `status`, `created_at`) VALUES
(1, 'aulia putri', 'admin@example.com', '098766745', 'smk pgri 2 ponorogo', 'cod', 50000.00, 15000.00, 65000.00, 'pending', '2025-11-22 01:15:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `price`, `quantity`, `subtotal`) VALUES
(1, 1, 17, 'nasi pecel', 50000.00, 1, 50000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(100) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `category`, `stock`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Kerajinan Tangan Kayu', 150000.00, 'uploads/1763774506_kerajinan-dari-kayu.jpeg', 'Kerajinan', 10, 'Kerajinan tangan dari kayu jati berkualitas tinggi', '2025-11-22 00:46:23', '2025-11-22 01:21:46'),
(2, 'Batik Tulis Premium', 350000.00, 'uploads/1763774620_batik.jpg', 'Fashion', 5, 'Batik tulis asli dengan motif tradisional', '2025-11-22 00:46:23', '2025-11-22 01:23:40'),
(3, 'Kopi Lokal Arabica', 85000.00, 'uploads/1763774662_ekopi.jpg', 'Makanan', 20, 'Kopi arabica pilihan dari perkebunan lokal', '2025-11-22 00:46:23', '2025-11-22 01:24:22'),
(4, 'Tas Anyaman Pandan', 200000.00, 'uploads/1763774710_tas.jpg', 'Aksesoris', 8, 'Tas anyaman dari pandan dengan desain modern', '2025-11-22 00:46:23', '2025-11-22 01:25:10'),
(5, 'Madu Hutan Asli', 120000.00, 'uploads/1763774772_madu murni.jpg', 'Makanan', 15, 'Madu hutan murni tanpa campuran', '2025-11-22 00:46:23', '2025-11-22 01:26:12'),
(6, 'Lukisan Tradisional', 500000.00, 'uploads/1763774961_lukisan2.jpg', 'Seni', 3, 'Lukisan tradisional karya seni lokal', '2025-11-22 00:46:23', '2025-11-22 01:29:21'),
(7, 'Kerupuk Udang Premium', 35000.00, 'uploads/1763775083_krupuk.jpg', 'Makanan', 30, 'Kerupuk udang premium rasa original', '2025-11-22 00:46:23', '2025-11-22 01:31:23'),
(8, 'Dompet Kulit Handmade', 180000.00, 'uploads/1763775129_dompet kulit.jpg', 'Aksesoris', 12, 'Dompet kulit handmade dengan jahitan rapi', '2025-11-22 00:46:23', '2025-11-22 01:32:09'),
(9, 'Kerajinan Tangan Kayu', 150000.00, 'uploads/1763773563_kerajinan kayu.jpeg', 'Kerajinan', 10, 'Kerajinan tangan dari kayu jati berkualitas tinggi', '2025-11-22 01:01:14', '2025-11-22 01:06:03'),
(10, 'Batik Tulis Premium', 350000.00, 'uploads/1763773624_batik tulis.jpeg', 'Fashion', 5, 'Batik tulis asli dengan motif tradisional', '2025-11-22 01:01:14', '2025-11-22 01:07:04'),
(11, 'Kopi Lokal Arabica', 85000.00, 'uploads/1763773684_kopi arabica.jpg', 'Makanan', 20, 'Kopi arabica pilihan dari perkebunan lokal', '2025-11-22 01:01:14', '2025-11-22 01:08:04'),
(12, 'Tas Anyaman Pandan', 200000.00, 'uploads/1763773768_tas anyam.png', 'Aksesoris', 8, 'Tas anyaman dari pandan dengan desain modern', '2025-11-22 01:01:14', '2025-11-22 01:09:28'),
(13, 'Madu Hutan Asli', 120000.00, 'uploads/1763773812_Madu.jpg', 'Makanan', 15, 'Madu hutan murni tanpa campuran', '2025-11-22 01:01:14', '2025-11-22 01:10:12'),
(14, 'Lukisan Tradisional', 500000.00, 'uploads/1763774338_lukisan.jpg', 'Seni', 3, 'Lukisan tradisional karya seni lokal', '2025-11-22 01:01:14', '2025-11-22 01:18:58'),
(15, 'Kerupuk Udang Premium', 35000.00, 'uploads/1763774382_krupuk udang.jpg', 'Makanan', 30, 'Kerupuk udang premium rasa original', '2025-11-22 01:01:14', '2025-11-22 01:19:42'),
(16, 'Dompet Kulit Handmade', 180000.00, 'uploads/1763774437_dompet.jpg', 'Aksesoris', 12, 'Dompet kulit handmade dengan jahitan rapi', '2025-11-22 01:01:14', '2025-11-22 01:20:37'),
(17, 'nasi pecel', 50000.00, 'uploads/1763774076_nasi pecel.jpg', 'Makanan', 9, 'nasi pecel khas ponorogo  rasa stoberi', '2025-11-22 01:14:36', '2025-11-22 01:15:11');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
