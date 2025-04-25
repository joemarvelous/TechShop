-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 22, 2025 at 12:06 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'leang', '1234'),
(6, 'leang', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text,
  `items` text,
  `total` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `phone`, `address`, `items`, `total`, `created_at`) VALUES
(1, 'FANTA', '015796200', 'Siem reap', '[{\"id\":\"33\",\"name\":\"Seagate Barracuda 2TB HDD\",\"price\":59,\"image\":\"2be60532-f47c-4e94-ace8-a588a03254b7.jpg\"},{\"id\":\"34\",\"name\":\"Kingston NV2 2TB NVMe\",\"price\":89,\"image\":\"71QVd4FLxJL.jpg\"}]', 148.00, '2025-04-21 18:52:15');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `category` varchar(100) DEFAULT NULL,
  `specs` text,
  `price` decimal(10,2) DEFAULT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `discount` int DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name_kh` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category`, `specs`, `price`, `old_price`, `discount`, `image`, `created_at`, `name_kh`) VALUES
(1, 'ASUS ROG Zephyrus G16 (2024)', 'High-performance gaming and creator laptop with powerful specs and a premium slim design.\r\n', 'Laptops', 'Intel Core Ultra 9, RTX 4070, 32GB RAM, 1TB SSD, 16\" QHD 240Hz', 2399.00, 2599.00, 8, '6A42560A-BF3E-4940-9AE6-DF6D3794C70A.png', '2025-04-21 16:09:28', NULL),
(2, 'Apple MacBook Pro 14\" (M3 Pro, 2024)', 'Sleek and powerful for professionals, creators, and Apple fans.', 'Laptops', 'M3 Pro chip, 18GB RAM, 1TB SSD, 14\" Liquid Retina XDR', 2199.00, 2499.00, 12, 'mbp16-silver-select-202410.png', '2025-04-21 16:13:17', NULL),
(3, 'Lenovo Legion 5 Pro Gen 8', 'Premium gaming and multitasking laptop with high refresh rate display.', 'Laptops', 'AMD Ryzen 7 7745HX, RTX 4070, 32GB RAM, 1TB SSD, 16\" WQXGA 240Hz', 1899.00, 2099.00, 10, 'Lenovo-Legion-Pro-5-Gen-8-yaratech.ma-5.png', '2025-04-21 16:15:25', NULL),
(4, 'Dell XPS 13 Plus (2024)', 'Minimalist and futuristic design, ideal for productivity and everyday use.', 'Laptops', 'Intel Core Ultra 7, 16GB RAM, 1TB SSD, 13.4\" OLED Touch', 1699.00, 1899.00, 11, 'b5fadd03-9ba2-4b34-8896-8ee2be8cea65.png', '2025-04-21 16:17:16', NULL),
(5, 'HP Spectre x360 14 (2024)', 'Ultra-flexible 2-in-1 laptop for students, business, or creators.', 'Laptops', 'Intel Core i7 1355U, 16GB RAM, 1TB SSD, 13.5\" OLED Touch', 1499.00, 1699.00, 12, 'HP-Spectre-x360-front-Abstract-Background-SOURCE-HP.png', '2025-04-21 16:18:49', NULL),
(6, 'Acer Predator Helios Neo 16', 'Performance-focused gaming laptop with RGB style and solid cooling.', 'Laptops', 'Intel Core i9-13900HX, RTX 4060, 16GB RAM, 1TB SSD, 16\" WQXGA 165Hz', 1599.00, 1799.00, 11, 'acer-1758-2.jpg', '2025-04-21 16:20:34', NULL),
(7, 'Corsair Vengeance DDR5 32GB (2x16GB) 6000MHz', 'High-speed DDR5 RAM ideal for gaming and multitasking.', 'RAM', 'DDR5, 6000MHz, CL36, Dual Channel, Heatsink', 129.00, 159.00, 19, '717xrBf92wL.jpg', '2025-04-21 16:22:31', NULL),
(8, 'G.Skill Trident Z5 RGB 32GB (2x16GB) 6400MHz', 'RGB-enhanced high-performance RAM for enthusiasts.', 'RAM', 'DDR5, 6400MHz, CL32, Intel XMP, RGB', 149.00, 179.00, 17, '61AgF0b76xL.jpg', '2025-04-21 16:23:35', NULL),
(9, 'Kingston Fury Beast DDR4 16GB (2x8GB) 3200MHz', 'Reliable and affordable RAM for all types of builds.', 'RAM', 'DDR4, 3200MHz, CL16, Plug-and-play', 49.00, 65.00, 25, 'LD0005854927_1.jpg', '2025-04-21 16:25:02', NULL),
(10, 'TeamGroup T-Force Delta RGB DDR5 32GB (2x16GB) 5600MHz', 'Stylish and powerful RAM with vibrant RGB lighting.', 'RAM', 'DDR5, 5600MHz, CL36, Intel XMP, RGB', 119.00, 139.00, 14, '03.jpg', '2025-04-21 16:26:03', NULL),
(11, 'Crucial DDR5 16GB 4800MHz', 'Entry-level DDR5 memory, great for basic to mid setups.', 'RAM', 'DDR5, 4800MHz, CL40, Non-ECC', 69.00, 85.00, 19, '71rIspMTJwL.jpg', '2025-04-21 16:27:02', NULL),
(12, 'ADATA XPG Lancer RGB DDR5 32GB (2x16GB) 6000MHz', 'Aggressive design and next-gen speed with stable performance.', 'RAM', 'DDR5, 6000MHz, CL40, RGB, XMP 3.0', 135.00, 159.00, 15, '869_gallery_05.png', '2025-04-21 16:28:05', NULL),
(13, 'NVIDIA GeForce RTX 4090', 'The most powerful consumer GPU for 4K gaming, AI, and 3D rendering.', 'GPU', '24GB GDDR6X, Ray Tracing, DLSS 3.5, PCIe 4.0', 1699.00, 1999.00, 15, '51EL-FaK4XL._AC_SL1002_.jpg', '2025-04-21 16:29:42', NULL),
(14, 'NVIDIA GeForce RTX 4080 SUPER', 'Enhanced version of the 4080 with more cores and memory speed.', 'GPU', '16GB GDDR6X, DLSS 3.5, 10240 CUDA Cores', 1099.00, 1199.00, 8, '04YKmVFjbhKbuUJidQ7nLwu-3.png', '2025-04-21 16:31:06', NULL),
(15, 'NVIDIA GeForce RTX 4070 Ti SUPER', 'Great balance of power and price for 1440p or light 4K gaming.', 'GPU', '16GB GDDR6X, DLSS 3.5, Ray Tracing', 799.00, 899.00, 11, '1024_3002577c-dcca-451f-97c9-34ed95c7380c.png', '2025-04-21 16:32:37', NULL),
(16, 'AMD Radeon RX 7900 XTX', 'AMD’s flagship GPU with massive VRAM and top-tier 4K performance.', 'GPU', '24GB GDDR6, RDNA 3, DisplayPort 2.1', 949.00, 1099.00, 14, '81il2WdPPJL._AC_SL1500_.jpg', '2025-04-21 16:33:37', NULL),
(17, 'AMD Radeon RX 7900 GRE (Golden Rabbit Edition)', 'Great performance-to-price AMD GPU, ideal for mid to high-end builds.', 'GPU', '16GB GDDR6, 256-bit, RDNA 3', 549.00, 649.00, 15, 'ISO-Flat-Front-Rabbit-1.jpg', '2025-04-21 16:34:54', NULL),
(18, 'Intel Arc A770 16GB (2024 Rev. Edition)', 'Intel’s latest GPU with improved drivers and AI features.', 'GPU', '16GB GDDR6, Xe HPG Architecture, Ray Tracing, AV1 Encode', 349.00, 399.00, 13, '71rzJRZ7lIL.jpg', '2025-04-21 16:35:43', NULL),
(19, 'Intel Core i9-14900K (14th Gen)', 'Top-tier Intel CPU with hybrid architecture, ideal for gaming and productivity.', 'CPU', '24 Cores (8P + 16E), 32 Threads, up to 6.0 GHz, LGA 1700', 599.00, 699.00, 14, '1518.png', '2025-04-21 16:38:47', NULL),
(20, 'Intel Core i7-14700K', 'High-end processor perfect for gaming, streaming, and multitasking.', 'CPU', '20 Cores (8P + 12E), up to 5.6 GHz, LGA 1700', 429.00, 499.00, 14, 'Intel Core i7___ 14700KF-500x500.jpg', '2025-04-21 16:40:10', NULL),
(21, 'AMD Ryzen 9 7950X3D', 'Top AMD chip with 3D V-Cache for insane gaming performance.', 'CPU', '16 Cores / 32 Threads, 5.7 GHz Boost, AM5 Socket, 3D V-Cache', 629.00, 699.00, 10, '2c2a68f3-b5ff-4a86-a9b1-4b2d45ef4d0b.png', '2025-04-21 16:41:21', NULL),
(22, 'AMD Ryzen 7 7800X3D', 'Best value gaming CPU with advanced 3D cache tech.', 'CPU', '8 Cores / 16 Threads, up to 5.0 GHz, AM5, PCIe 5.0', 399.00, 459.00, 13, '85495ffd-aa4b-47a1-b3aa-5f94b6f27a3e.png', '2025-04-21 16:44:57', NULL),
(23, 'Intel Core Ultra 9 185H (Meteor Lake, Laptop CPU)', 'Intel’s AI-enhanced chip for next-gen laptops, efficient and fast.', 'CPU', '16 Cores (6P+8E+2LP), AI NPU, up to 5.1 GHz, 45W', 549.00, 599.00, 8, 'Intel-Core-Ultra-9-Badge-2023.png', '2025-04-21 16:46:22', NULL),
(24, 'AMD Ryzen 5 8600G (APU with Radeon 760M Graphics)', 'Budget CPU with strong integrated graphics — no GPU required.', 'CPU', '6 Cores / 12 Threads, 5.0 GHz, Radeon 760M, AM5', 229.00, 259.00, 12, '615TPN-DayL._AC_UF894,1000_QL80_.jpg', '2025-04-21 16:47:13', NULL),
(25, 'LG UltraGear 27GP850-B', '27\" QHD monitor with 165Hz refresh rate and 1ms response time. Great for gaming.', 'Monitors', '27\", QHD, 165Hz, Nano IPS, 1ms', 349.00, 399.00, 13, '71RTz-BRMrS.jpg', '2025-04-21 16:54:56', NULL),
(26, 'ASUS TUF Gaming VG28UQL1A', '4K UHD 144Hz monitor with HDMI 2.1, built for next-gen gaming.', 'Monitors', '28\", 4K UHD, 144Hz, HDMI 2.1', 599.00, 699.00, 14, '71wa5QUIfRL._AC_UF1000,1000_QL80_.jpg', '2025-04-21 16:56:05', NULL),
(27, 'Samsung Odyssey G7', 'Curved 32\" gaming monitor with ultra-fast 240Hz refresh rate.', 'Monitors', '32\", QHD, 240Hz, Curved 1000R', 549.00, 629.00, 13, 'LD0006205089.jpg', '2025-04-21 16:57:38', NULL),
(28, 'Gigabyte M32U', '32\" 4K IPS monitor for gamers and content creators.', 'Monitors', '32\", 4K UHD, 144Hz, IPS', 629.00, 699.00, 10, '71PqY4-jbHL.jpg', '2025-04-21 16:58:31', NULL),
(29, 'Dell S2721DGF', 'Color-accurate QHD monitor with smooth 165Hz refresh rate.', 'Monitors', '27\", QHD, 165Hz, IPS', 379.00, 449.00, 16, '81m3vlnUPuL._AC_UF1000,1000_QL80_.jpg', '2025-04-21 16:59:38', NULL),
(30, 'Samsung 990 Pro 1TB NVMe', 'Top-tier Gen 4 SSD with blazing fast 7450MB/s speed.', 'Storage', 'PCIe 4.0, 7450MB/s, DRAM Cache', 139.00, 169.00, 18, 'Samsung-990-Pro-1.jpg', '2025-04-21 17:01:16', NULL),
(31, 'Crucial P5 Plus 1TB', 'Reliable PCIe 4.0 NVMe SSD with solid performance.', 'Storage', 'Gen 4, 6600MB/s, M.2 NVMe', 99.00, 129.00, 23, '73Fk8dL8V3eBNWD6MwNwSn.jpg', '2025-04-21 17:02:31', NULL),
(32, 'WD Blue 1TB SATA SSD', 'Budget-friendly 2.5\" SSD for fast system performance.', 'Storage', '2.5\", 560MB/s, TLC NAND', 49.00, 65.00, 25, 'wd-blue-sa510-sata-2-5-ssd-1TB-front.png.thumb.319.319.png', '2025-04-21 17:11:09', NULL),
(33, 'Seagate Barracuda 2TB HDD', 'Reliable desktop HDD for bulk storage needs.', 'Storage', '7200RPM, 3.5\", 256MB Cache', 59.00, 75.00, 21, '2be60532-f47c-4e94-ace8-a588a03254b7.jpg', '2025-04-21 17:12:06', NULL),
(34, 'Kingston NV2 2TB NVMe', 'High-capacity Gen 4 SSD for everyday performance.', 'Storage', 'PCIe 4.0, 3500MB/s, Budget', 89.00, 109.00, 18, '71QVd4FLxJL.jpg', '2025-04-21 17:13:17', NULL),
(35, 'Corsair RM850x (2023)', 'Fully modular 850W PSU with 80+ Gold efficiency.', 'Power Supply', '850W, 80+ Gold, Fully Modular', 139.00, 159.00, 13, '8117adIRj9L.jpg', '2025-04-21 17:29:20', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
