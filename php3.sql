-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 28, 2025 lúc 04:17 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `php3`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Thời sự', NULL, NULL),
(2, 'Kinh doanh', NULL, NULL),
(3, 'Công nghệ', NULL, NULL),
(4, 'Khoa học', NULL, NULL),
(5, 'Thể thao', NULL, NULL),
(6, 'Sức khỏe', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `members`
--

INSERT INTO `members` (`id`, `name`, `email`, `password`, `token`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Tuấn Vũ', 'tuanvu280605@gmail.com', '$2y$12$oCbscp.F0GoPqfDDghuyQelpmYHtuVPQlMkhYNe.aCW0wPQvXwrr.', NULL, 0, '2025-03-27 01:24:03', '2025-03-27 01:24:03'),
(2, 'Tuấn Vũ', 'tuanvu28ww0605@gmail.com', '$2y$12$iE0zLyR3PIodz8OKrblqler3jiu8leRdgz.775UgrDN8uWkwS83za', NULL, 0, '2025-03-27 01:31:35', '2025-03-27 01:31:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_03_27_073616_create_members_table', 1),
(5, '2025_03_27_073635_create_posts_table', 1),
(6, '2025_03_28_104415_create_categories_table', 2),
(7, '2025_03_28_104417_create_posts_table', 2),
(8, '2025_03_28_110119_create_posts_table', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('nguyenthihuyen2722005@gmail.com', '274851', '2025-03-27 11:36:48'),
('tuanvu280605@gmail.com', '088398', '2025-03-28 07:56:29'),
('vutrinhphamtuan@gmail.com', '296452', '2025-03-27 11:40:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `content` text NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `image` text DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `title`, `summary`, `content`, `views`, `image`, `category_id`, `created_at`, `updated_at`) VALUES
(3, 'Bị phạt vì giăng lưới, chặn đường ở TP HCM để đánh bóng bàn\r\n', 'Hai người đàn ông giăng lưới, đặt bàn đánh bóng giữa đường hẻm ở quận Gò Vấp bị xử phạt 225.000 đồng vì chặn lối đi để chơi thể thao.\r\n\r\n', 'Ngày 28/3, tổ địa bàn quận Gò Vấp (Phòng CSGT TP HCM) ra quyết định xử phạt hai người đàn ông cùng 59 tuổi về hành vi chơi thể thao trái phép trên đường bộ theo Nghị định 168/2024.\r\n<p></p>\r\nTrước đó, một tài xế ôtô đăng tải đoạn video ghi cảnh 4 người đàn ông giăng lưới, đặt bàn bóng chơi thể thao chắn ngang đường rộng hơn 5 m ở hẻm Tân Sơn, phường 12, khiến phương tiện không thể qua lại.\r\n<p></p>\r\nLàm việc với lực lượng chức năng, người vi phạm cho biết đặt bàn giữa đường mục đích đánh bóng cùng với hàng xóm vào sáng sớm, giăng lưới xung quanh bàn để bóng không văng ra ngoài. Hai người còn lại trong nhóm do đang đi tỉnh nên cơ quan chức năng xử phạt sau.', 7, 'image/z6451479487462_3342b7f30a109ba480b2b5314a154c27.jpg', 1, '2025-03-28 11:32:16', '2025-03-28 08:12:05'),
(4, 'Cảng lớn nhất Đồng Nai \'chia tải\' hàng hóa với Cát Lái\r\n', 'Vận hành đầu năm nay, cảng Phước An, Đồng Nai vừa hợp tác với Tân Cảng Sài Gòn nhằm \"chia tải\" hàng hóa cho cảng Cát Lái.', 'Việc ký kết hợp tác chiều 28/3 nhằm đẩy mạnh khai thác hiệu quả cảng biển lớn nhất Đồng Nai. Đồng thời Tân Cảng sẽ mở rộng hệ sinh thái logistics tại khu vực phía Nam, phục vụ tốt hơn nhu cầu xuất nhập khẩu ngày càng gia tăng của doanh nghiệp trong khu vực trọng điểm kinh tế phía Nam.\r\n                    <p></p>\r\n\r\nÔng Nguyễn Phương Nam, Phó tổng giám đốc Tổng công ty Tân Cảng Sài Gòn, đơn vị khai thác cảng container hàng đầu Việt Nam, cho biết mô hình khai thác tàu tại một cảng đối tác ngoài hệ thống là một tiền lệ chưa từng có. \"Tuy nhiên, đó là quyết tâm của chúng tôi nhằm tháo gỡ điểm nghẽn hạ tầng, tìm kiếm giải pháp vận hành linh hoạt, thích ứng với bối cảnh tăng trưởng hiện nay\", ông Nam nói.\r\n                    <p></p>\r\n\r\nSau buổi ký kết, lần đầu tiên cảng Phước An đón tàu Minhe của hãng SITC (Hong Kong, Trung Quốc), chuyến tàu đầu tiên từ tuyến dịch vụ quốc tế tại Tân Cảng - Cát Lái chuyển sang.\r\nCảng Phước An rộng 164,5 ha, bến dài 2.830m, gồm 9 bến container thuộc huyện Nhơn Trạch, có khả năng đón tàu có tải trọng 100.000 DWT. Với quy mô, năng lực khai thác 7 triệu TEUs (1 TEU tương đương container 20 feet) ở cả 3 phân kỳ. Năm 2025, dự kiến công suất cảng đạt 1,3 triệu TEUs/năm, sau đó tăng dần và sẽ đạt 4 triệu TEUs/năm vào năm 2026.\r\n                    <p></p>\r\n\r\nHướng tới mục tiêu phát triển cảng xanh bền vững, Cảng Phước An tiên phong áp dụng các tiêu chuẩn Green Port, đầu tư hệ thống hạ tầng hiện đại, sử dụng năng lượng sạch, công nghệ số và giải pháp vận hành thông minh nhằm giảm thiểu tác động môi trường, tối ưu hiệu quả khai thác.\r\n                    <p></p>\r\n\r\nCùng với cảng Phước An, sân bay Long Thành và hàng loạt dự án giao thông liên kết vùng sẽ đi vào hoạt động thời gian tới, Đồng Nai tin rằng địa phương sẽ đạt mục đích tăng trưởng 10% theo kế hoạch đề ra.', 1, 'image/z6452217390823_cc87466361b4547c5d33be45ccfb6cdd.jpg\r\n', 2, '2025-03-28 15:11:09', '2025-03-28 08:12:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('wqXkPlTQ2ouLwgPt7e6fVJ2iehXiHgw4sHLmY0qU', 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOVlOejdUVVd2VFRRbks5UDFSTVZKdUtic2l6SkF1NVpmVWRsZVVSaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wb3N0cy80Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6OTt9', 1743174738);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'Tuấn Vũ', 'tuanvu280605@gmail.com', NULL, '$2y$12$uhttZ.FTlVrCt5FtXr47/uLYsVkonExxHE3gz4JINAU68NqS25pcy', NULL, '2025-03-27 04:05:53', '2025-03-28 07:56:21'),
(6, 'ngu', 'nguyenthihuyen2722005@gmail.com', NULL, '$2y$12$TIObwBJNuaUbzJeVIS7eHuuuKPHpzvfRWECj4g1rcSVqqx9tXqaZ2', NULL, '2025-03-27 11:30:32', '2025-03-27 11:30:32'),
(7, 'Anh Phong', 'vutrinhphamtuan@gmail.com', NULL, '$2y$12$mbx1.NDqW5os3AFwuXUEZOyoUR.uYYwSYawyohceFfQEw4tFI6sMC', NULL, '2025-03-27 11:40:11', '2025-03-27 11:40:11'),
(9, 'Quyền Đậu', 'quyendau1603@gmail.com', NULL, '$2y$12$TtSk0Fgp0ZlhTNHBtQ521.yx6yky9VdvsXr5Lu9ZPAwCBzLCcQzNW', NULL, '2025-03-28 08:01:52', '2025-03-28 08:03:10');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_email_unique` (`email`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
