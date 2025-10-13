-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 13, 2025 lúc 07:17 AM
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
-- Cơ sở dữ liệu: `vegetable_shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 7, '2025-08-08 02:19:49', '2025-08-08 02:19:49'),
(5, 8, '2025-08-11 01:39:28', '2025-08-11 01:39:28'),
(12, 5, '2025-10-04 03:22:54', '2025-10-04 03:22:54'),
(13, 1, '2025-10-04 18:30:23', '2025-10-04 18:30:23'),
(16, 11, '2025-10-04 20:32:25', '2025-10-04 20:32:25'),
(18, 13, '2025-10-05 02:00:06', '2025-10-05 02:00:06'),
(19, 14, '2025-10-05 02:02:10', '2025-10-05 02:02:10'),
(20, 3, '2025-10-06 18:02:26', '2025-10-06 18:02:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(37, 12, 7, 2, '2025-10-04 03:29:12', '2025-10-04 03:29:12'),
(44, 20, 3, 1, '2025-10-09 18:39:20', '2025-10-09 18:39:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `name`, `email`, `message`, `created_at`, `updated_at`) VALUES
(1, 'abc', 'abc@gmail.com', 'Giao diện website dễ sử dụng và thân thiện người dùng', '2025-09-08 18:38:43', '2025-09-08 18:38:43'),
(2, 'xxx', 'xxx@gmail.com', 'website hoạt động ổn, đa dạng sản phẩm', '2025-10-04 20:16:58', '2025-10-04 20:16:58'),
(3, 'xyz', 'xyz@gmail.com', 'abcdefg', '2025-10-04 20:17:33', '2025-10-04 20:17:33'),
(4, 'dsadasd', 'dsadasd@gmail.com', 'ádsadasdas', '2025-10-04 20:20:48', '2025-10-04 20:20:48'),
(5, 'ádas', 'adas@gmail.com', 'ádasdasd', '2025-10-04 20:21:37', '2025-10-04 20:21:37');

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
(1, '2025_08_05_105053_create_products_table', 1),
(2, '2025_08_05_105053_create_users_table', 1),
(3, '2025_08_05_105054_create_cart_table', 1),
(4, '2025_08_05_105054_create_orders_table', 1),
(5, '2025_08_05_105055_create_order_items_table', 1),
(6, '2025_08_05_105055_create_reviews_table', 1),
(7, '2025_08_05_105056_create_sessions_table', 1),
(8, '2025_08_05_123053_create_sessions_table', 2),
(9, '2025_08_06_080917_create_cart_items_table', 3),
(10, '2025_08_06_124726_create_carts_table', 4),
(11, '2025_08_06_125954_create_carts_table', 5),
(12, '2025_08_06_130442_create_cart_items_table', 6),
(13, '2025_08_07_083123_create_orders_table', 7),
(14, '2025_08_07_083125_create_order_items_table', 7),
(15, '2025_09_09_011313_create_feed_backs_table', 8),
(16, '2025_09_09_012816_create_feedbacks_table', 9),
(17, '2025_09_24_092000_create_personal_access_tokens_table', 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Đang xử lý',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address`, `total`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, '111 abc, def, ght', 135500, 'Đang xử lý', '2025-08-07 01:38:41', '2025-08-08 01:34:41'),
(2, 3, '111 abc, def, ght', 39000, 'Hoàn thành', '2025-08-07 01:39:21', '2025-08-08 01:36:02'),
(3, 3, '111 abc, def, ght', 55000, 'Đã thanh toán', '2025-08-07 01:41:36', '2025-08-07 01:41:36'),
(4, 3, '111 abc, def, ght', 19000, 'Đã thanh toán', '2025-08-07 01:43:01', '2025-08-07 01:43:01'),
(5, 3, '111 abc, def, ght', 59500, 'Đang xử lý', '2025-08-07 01:45:37', '2025-08-08 01:36:07'),
(6, 3, '111 abc, def, ght', 55000, 'Đã thanh toán', '2025-08-07 02:24:50', '2025-08-07 02:24:50'),
(7, 1, '11 aaa, bbb, ccc', 865500, 'Hoàn thành', '2025-08-07 02:35:57', '2025-08-08 01:36:13'),
(8, 1, '10 bbb, ccc, ddd', 57500, 'Đã thanh toán', '2025-08-07 02:36:18', '2025-08-07 02:36:18'),
(9, 5, '11 aaa, bbb, ccc', 98000, 'Đang xử lý', '2025-08-08 02:19:26', '2025-08-08 02:20:57'),
(10, 7, '33 ccc, ddd, eee', 216000, 'Đã thanh toán', '2025-08-08 02:20:28', '2025-08-08 02:20:28'),
(11, 8, '45 ddd, eee, fff', 395500, 'Đã thanh toán', '2025-08-11 01:40:05', '2025-08-11 01:40:05'),
(12, 7, '33 ccc, ddd, eee', 119000, 'Đã thanh toán', '2025-08-20 04:52:53', '2025-08-20 04:52:53'),
(13, 7, '33 ccc, ddd, eee', 39000, 'Đã thanh toán', '2025-08-20 04:53:05', '2025-08-20 04:53:05'),
(14, 1, 'abcxyz', 94000, 'Đã thanh toán', '2025-09-23 03:36:24', '2025-09-23 03:36:24'),
(15, 3, 'ss', 256500, 'Đang xử lý', '2025-10-04 02:19:17', '2025-10-04 02:19:17'),
(16, 3, 'aaa', 55000, 'Đang xử lý', '2025-10-04 02:21:54', '2025-10-04 02:21:54'),
(17, 3, 'sâss', 117000, 'Đang xử lý', '2025-10-04 02:52:25', '2025-10-04 02:52:25'),
(18, 3, 'sa', 220000, 'Đang xử lý', '2025-10-04 02:53:04', '2025-10-04 02:53:04'),
(19, 3, 'dfgd', 115000, 'Hoàn thành', '2025-10-04 03:02:27', '2025-10-09 21:04:41'),
(20, 5, 'ádasdasds', 314000, 'Đang xử lý', '2025-10-04 03:22:54', '2025-10-04 03:22:54'),
(21, 1, '33 ccc, ddd, eee', 697000, 'Đã thanh toán', '2025-10-04 18:30:22', '2025-10-09 21:04:46'),
(22, 3, 'lll', 55000, 'Đang xử lý', '2025-10-04 19:58:11', '2025-10-04 19:58:11'),
(23, 3, 'z', 19000, 'Đang xử lý', '2025-10-06 18:02:26', '2025-10-06 18:02:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 1, 57500, '2025-08-07 01:38:41', '2025-08-07 01:38:41'),
(2, 1, 3, 2, 39000, '2025-08-07 01:38:41', '2025-08-07 01:38:41'),
(3, 2, 3, 1, 39000, '2025-08-07 01:39:21', '2025-08-07 01:39:21'),
(4, 3, 2, 1, 55000, '2025-08-07 01:41:36', '2025-08-07 01:41:36'),
(5, 4, 1, 1, 19000, '2025-08-07 01:43:01', '2025-08-07 01:43:01'),
(6, 5, 5, 1, 59500, '2025-08-07 01:45:37', '2025-08-07 01:45:37'),
(7, 6, 2, 1, 55000, '2025-08-07 02:24:50', '2025-08-07 02:24:50'),
(8, 7, 1, 1, 19000, '2025-08-07 02:35:57', '2025-08-07 02:35:57'),
(9, 7, 6, 2, 57500, '2025-08-07 02:35:57', '2025-08-07 02:35:57'),
(10, 7, 8, 4, 168000, '2025-08-07 02:35:57', '2025-08-07 02:35:57'),
(11, 7, 5, 1, 59500, '2025-08-07 02:35:57', '2025-08-07 02:35:57'),
(12, 8, 6, 1, 57500, '2025-08-07 02:36:18', '2025-08-07 02:36:18'),
(13, 9, 11, 2, 49000, '2025-08-08 02:19:26', '2025-08-08 02:19:26'),
(14, 10, 5, 3, 59500, '2025-08-08 02:20:28', '2025-08-08 02:20:28'),
(15, 10, 4, 1, 37500, '2025-08-08 02:20:28', '2025-08-08 02:20:28'),
(16, 11, 5, 1, 59500, '2025-08-11 01:40:05', '2025-08-11 01:40:05'),
(17, 11, 8, 2, 168000, '2025-08-11 01:40:05', '2025-08-11 01:40:05'),
(18, 12, 5, 2, 59500, '2025-08-20 04:52:53', '2025-08-20 04:52:53'),
(19, 13, 3, 1, 39000, '2025-08-20 04:53:05', '2025-08-20 04:53:05'),
(20, 14, 2, 1, 55000, '2025-09-23 03:36:24', '2025-09-23 03:36:24'),
(21, 14, 3, 1, 39000, '2025-09-23 03:36:24', '2025-09-23 03:36:24'),
(22, 15, 5, 3, 59500, '2025-10-04 02:19:17', '2025-10-04 02:19:17'),
(23, 15, 3, 2, 39000, '2025-10-04 02:19:17', '2025-10-04 02:19:17'),
(24, 16, 2, 1, 55000, '2025-10-04 02:21:54', '2025-10-04 02:21:54'),
(25, 17, 3, 3, 39000, '2025-10-04 02:52:25', '2025-10-04 02:52:25'),
(26, 18, 2, 4, 55000, '2025-10-04 02:53:04', '2025-10-04 02:53:04'),
(27, 19, 6, 2, 57500, '2025-10-04 03:02:27', '2025-10-04 03:02:27'),
(28, 20, 2, 2, 55000, '2025-10-04 03:22:54', '2025-10-04 03:22:54'),
(29, 20, 4, 4, 37500, '2025-10-04 03:22:54', '2025-10-04 03:22:54'),
(30, 20, 9, 1, 54000, '2025-10-04 03:22:54', '2025-10-04 03:22:54'),
(31, 21, 8, 2, 168000, '2025-10-04 18:30:22', '2025-10-04 18:30:22'),
(32, 21, 5, 1, 59500, '2025-10-04 18:30:22', '2025-10-04 18:30:22'),
(33, 21, 6, 3, 57500, '2025-10-04 18:30:22', '2025-10-04 18:30:22'),
(34, 21, 4, 2, 37500, '2025-10-04 18:30:22', '2025-10-04 18:30:22'),
(35, 21, 9, 1, 54000, '2025-10-04 18:30:22', '2025-10-04 18:30:22'),
(36, 22, 2, 1, 55000, '2025-10-04 19:58:11', '2025-10-04 19:58:11'),
(37, 23, 1, 1, 19000, '2025-10-06 18:02:26', '2025-10-06 18:02:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'api_token', '51a65258bd111c594597bb733091802c7c4605c578e2111cb43d9b7437d896a4', '[\"*\"]', NULL, NULL, '2025-09-24 03:06:49', '2025-09-24 03:06:49'),
(36, 'App\\Models\\User', 5, 'api-token', '8cceeee3702be7848c51c1e503f2ff7bb06ce6e05cdc025e624acfb5e06fb876', '[\"*\"]', '2025-10-03 02:36:35', NULL, '2025-10-03 02:15:14', '2025-10-03 02:36:35'),
(41, 'App\\Models\\User', 5, 'api-token', 'a1197be3183c2ce69e6bb2318f1bab0d94599cd82af5f8fad806cc72df47b7b6', '[\"*\"]', '2025-10-04 03:29:13', NULL, '2025-10-04 03:22:43', '2025-10-04 03:29:13'),
(46, 'App\\Models\\User', 2, 'api-token', '5ce705c43a3fed7b8e57882aafaba589b8170a7a4d5888e358a921666038794a', '[\"*\"]', '2025-10-04 20:25:38', NULL, '2025-10-04 20:22:15', '2025-10-04 20:25:38'),
(47, 'App\\Models\\User', 2, 'api-token', '597a902da1f6d2856b40127be5502f8a35d5e474c1e99232b1d756202d4af20c', '[\"*\"]', NULL, NULL, '2025-10-04 20:25:44', '2025-10-04 20:25:44'),
(48, 'App\\Models\\User', 2, 'api-token', 'd7e6cf4bfd8d7eed3e5a5e762c13360a20f8ea91ce36fe8420f3d4bb9900b40c', '[\"*\"]', '2025-10-04 20:26:25', NULL, '2025-10-04 20:26:24', '2025-10-04 20:26:25'),
(49, 'App\\Models\\User', 2, 'api-token', '5b51282e75a8eee29751398bc8788bb6ac607ee9c0e8a2dd0758b09e898747e2', '[\"*\"]', '2025-10-04 20:29:37', NULL, '2025-10-04 20:26:32', '2025-10-04 20:29:37'),
(50, 'App\\Models\\User', 2, 'api-token', '270dd1b302beeefc944c0a2fe6d2b2d43d0e1d11790e3e4affd975ff630007c7', '[\"*\"]', '2025-10-04 20:29:44', NULL, '2025-10-04 20:29:43', '2025-10-04 20:29:44'),
(57, 'App\\Models\\User', 15, 'api-token', 'c4295bc9fa294b64d247cd1321bf0b1e5f4c22bca9f6b932cb49059fbd285706', '[\"*\"]', NULL, NULL, '2025-10-05 02:04:06', '2025-10-05 02:04:06'),
(84, 'App\\Models\\User', 11, 'api-token', 'abe2c369cdf9e6d3671cf17b8cb03e30913dd256bbb275eae9f057c4abd37a3c', '[\"*\"]', '2025-10-09 21:10:12', NULL, '2025-10-09 21:10:12', '2025-10-09 21:10:12'),
(85, 'App\\Models\\User', 11, 'api-token', '8aecba929fc94fd99a35d5ff321011dee0bf5e986b3998b476dff44934a34f5e', '[\"*\"]', '2025-10-11 19:03:19', NULL, '2025-10-11 19:03:11', '2025-10-11 19:03:19'),
(86, 'App\\Models\\User', 11, 'api-token', '1416b3f716d738f158f1d7636e3a8d1506ab3609197069d1e7ca4da18e529927', '[\"*\"]', '2025-10-12 02:37:24', NULL, '2025-10-12 02:36:32', '2025-10-12 02:37:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Ớt xiêm - 100g', 'Ớt xiêm xanh là ớt mọc hoang ở rừng các tỉnh miền Trung. ớt quả nhỏ có màu xanh, ăn có vị cay, thơm giòn đặc trưng', 19000.00, 'otxiem.jpg', NULL, NULL),
(2, 'Bắp cải tím - 500g', 'Bắp cải tím: tên khoa học là Brassica oleracea var capitata ruba là cây bắp cải có màu tím. Xuất xứ từ Địa Trung Hải, hiện nay được trồng rộng rãi khắp thế giới, thích hợp với khí hậu ôn đới và tại Việt Nam bắp cải tím được trồng nhiều ở Đà Lạt.', 55000.00, 'bapcaitim.jpg', NULL, '2025-08-08 00:40:20'),
(3, 'Cà chua - 300g', 'Cà chua beef hướng hữu cơ là giống cà chua cao cấp khác hẳn cà chua thông thường ở điểm quả cà chua to, chắc, ít hạt, cơm dày.  Cà chua beef cung cấp một lượng Vitamin A, C, K tuyệt vời. Những chất này có tác dụng giúp tăng cường thị lực, phòng bệnh quáng gà.', 39000.00, 'cachua.jpg', NULL, NULL),
(4, 'Đậu cove - 300g', 'Đậu cove thuộc họ đâu, có thân nhỏ tròn và dài như chiếc đũa, đậu có màu xanh nhạt khi còn non và xanh lục khi chín. Loại đậu này tính ôn, có tác dụng nhuận tràng, bồi bổ nguyên khí. Đậu cô ve không chỉ có chứa nhiều nguyên tố vi lượng như protein, canxi, sắt, mà còn có nhiều kali, magie, ít natri.   ', 37500.00, 'daucove.jpg', NULL, NULL),
(5, 'Giá đỗ đậu xanh - 500g', 'Giá đỗ nhà O được làm từ đậu xanh Non-GMO, được trồng hoàn toàn tự nhiên, không sử dụng hóa chất.An toàn, giàu dinh dưỡng (vitamin C, E, chất xơ), phù hợp với mọi lứa tuổi, đặc biệt trẻ nhỏ và người ăn kiêng.', 59500.00, 'giadodauxanh.png', NULL, NULL),
(6, 'Khoai mỡ - 500g', 'Tại Việt Nam, khoai mỡ được trồng nhiều ở khắp vùng nông thôn để lấy củ ăn. Khoai mỡ bắt đầu vụ thu hoạch vào cuối tháng 7, đầu tháng 8 âm lịch hàng năm và lấy giống trồng vụ mới. Khoai mỡ ở Việt Nam có hai loại: ruột trắng và ruột tím. Loại ruột trắng có giống Mộng Linh, củ chùm, nặng ký (từ 4– 5 kg/củ), năng suất cao. ', 57500.00, 'khoaimo.jpg', NULL, NULL),
(7, 'Khổ qua - 300g', 'Khổ qua (mướp đắng) – Momordia charantia L. thuộc họ Hồ lô (Cucurbitaceae). Vị đắng, tính mát, không độc. Vào kinh tâm, can, tỳ và vị. Điều trị tăng huyết áp: khổ qua tươi 250g, hành hoa, gừng băm, muối, bột nêm, nước tương (mắm), dầu mè với mỗi thứ vừa đủ. Khổ qua bổ hột, rửa sạch, trụng nước sôi 3 phút, thái sợi, trộn vào hành hoa, gừng băm, muối, bột nêm, nước tương (mắm), dầu mè, trộn đều thì dùng.   ', 45000.00, 'khoqua.jpg', NULL, NULL),
(8, 'Măng cụt - 1kg', 'Từ vùng đất đỏ bazan Long Khánh – Đồng Nai, vườn măng cụt hơn 15 năm tuổi đang vào mùa. Nhưng điều khiến những trái măng cụt này đặc biệt, không chỉ là độ chín, mà còn nằm ở chặng đường 5 năm canh tác hoàn toàn không hóa chất, để đạt chứng nhận hữu cơ Việt Nam. Mỗi cây trong vườn được chăm bằng 5 nhóm phân hữu cơ: cám, chuối, đậu nành, cá – trứng – sữa, mật rỉ, bột xương – vỏ sò, đất mùn, phân trùn tự nuôi… Tất cả đều là nguyên liệu loại tốt nhất, thậm chí con người cũng có thể dùng.', 168000.00, 'mangcut.png', NULL, NULL),
(9, 'Ớt chuông vàng - 300g', 'Ớt Chuông có nhiều màu như xanh, đỏ, cam, vàng, thân tròn như quả chuông, hương thơm, vị rất giòn ngọt, ít hăng. Ớt Chuông giàu Vitamin A, K, C, Kali, Magne, chất khoáng và chất xơ. Hổ trợ tiêu hóa, tốt cho mắt, hệ miễn dịch cao, giảm đường và cholesterol trong máu. Kích thích tuần hoàn máu, ngăn ngừa lão hóa. • Ngoài việc kích thích ngon miệng, nó còn bổ sung canxi và ngăn chặn ung thư khá cao. ', 54000.00, 'otchuong.png', NULL, NULL),
(10, 'Rau ngót ta - 300g', 'Rau ngót tính mát lạnh (nấu chín sẽ bớt lạnh), vị ngọt. Có công năng thanh nhiệt, giải độc, lợi tiểu, tăng tiết nước bọt, hoạt huyết hoá ứ, bổ huyết, cầm huyết, nhuận tràng, sát khuẩn, tiêu viêm, sinh cơ, có nhiều tác dụng chữa bệnh.', 43500.00, 'raungot.jpeg', NULL, NULL),
(11, 'Su su - 300g', NULL, 49001.00, 'susu.jpg', '2025-08-08 01:42:21', '2025-10-09 18:59:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 3, NULL, '2025-08-06 00:26:31', '2025-08-06 00:26:31'),
(4, 3, 2, 4, 'Sản phẩm khá tươi, giao hàng nhanh', '2025-08-06 00:48:04', '2025-08-06 00:48:04'),
(5, 1, 3, 5, 'Hàng tươi ngon, chất lượng', '2025-08-06 05:32:21', '2025-08-06 05:32:21'),
(6, 5, 11, 5, 'Hàng tươi, đóng gói cẩn thận', '2025-08-08 02:19:16', '2025-08-08 02:19:16'),
(7, 7, 4, 4, 'Hàng còn tươi nhưng đóng gói chưa cẩn thận lắm', '2025-08-08 02:20:17', '2025-08-08 02:20:17'),
(8, 7, 5, 5, 'Sản phẩm tươi, đóng gói cẩn thận', '2025-08-20 04:52:42', '2025-08-20 04:52:42'),
(10, 3, 4, 3, 'Hàng không còn tươi lắm', '2025-10-03 18:00:52', '2025-10-03 18:00:52'),
(12, 1, 11, 4, 'Giao hàng hơi chậm trễ', '2025-10-04 18:29:16', '2025-10-04 18:29:16'),
(13, 1, 8, 5, 'Tươi, ngon, sạch', '2025-10-04 18:29:49', '2025-10-04 18:29:49'),
(14, 1, 10, 5, 'Rau tươi, sạch', '2025-10-05 19:26:19', '2025-10-05 19:26:19');

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
('a7F6UQsicfFHHB8fkSihIDehesKmTXgNZs6zEIgE', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNXFlUzFIYUZ1czNFeXlzQVFVeGVkczlWdzB4aHR0bE53bDZSSldwMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMS9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1760261854),
('MlQxcD25NwLfbRr3jCIiUDpuSYor0r5nfI7FdkeW', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 13; 2209116AG Build/TKQ1.221114.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/140.0.7339.207 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/528.0.0.62.107;]', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVFZhbjNQb1VKTmhNbHo2QnhHVDRmQ1pNWGFYRnRCV0xxeVFoeEdINiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NToidG9rZW4iO3M6NTE6Ijg2fFlnNEc5YVRDc0ZieDlSRmlZc0Q1UW9uUE9HNkVqTE9OSjJ6c3QxOHU1ZTViZWI3MSI7czo0OiJ1c2VyIjthOjc6e3M6MjoiaWQiO2k6MTE7czo0OiJuYW1lIjtzOjU6IkFkbWluIjtzOjU6ImVtYWlsIjtzOjE1OiJhZG1pbkBnbWFpbC5jb20iO3M6NzoiYWRkcmVzcyI7TjtzOjQ6InJvbGUiO3M6NToiYWRtaW4iO3M6MTA6ImNyZWF0ZWRfYXQiO3M6Mjc6IjIwMjUtMTAtMDVUMDM6MzI6MjQuMDAwMDAwWiI7czoxMDoidXBkYXRlZF9hdCI7czoyNzoiMjAyNS0xMC0wNVQwMzozMjoyNC4wMDAwMDBaIjt9fQ==', 1760261844),
('oOTCw6R6vEzEzQdCZ8BjZnNpqbbhKkqjQxiMS27E', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUklaTk1mcjAwdkd3NlVmR1BpNkJzbHlyRzJxcXBxOTRrMjRqQjZmUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1760261605),
('ZPqTb5MecbZDQ7t4GJCDaCxjnicrBu1480flCz5a', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidERjVDlJbGszWHhTa2NHRW5rbEZpdHJQS2JkajhKbThUSlBMcUxFdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMS9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1760261902);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `address`, `role`, `created_at`, `updated_at`) VALUES
(1, 'User 1', 'user1@gmail.com', '$2y$12$uNaHstzmpWBhVrw52SGX6ufKcVnC3V9sI1uNDkNVn6yWmkOxroA2e', NULL, 'user', '2025-08-05 05:43:17', '2025-10-09 18:29:38'),
(3, 'User 2', 'user2@gmail.com', '$2y$12$/ZYhSrCHzSAAF3LSXWvKN.3z8iRmqdmThNq/hFWdiOUf9FLbWMe.q', '123 abc, def, ghi', 'user', '2025-08-05 19:44:59', '2025-10-06 17:34:07'),
(5, 'User3', 'user3@gmail.com', '$2y$12$HyDofHKOC/snS.YyKc1L2.tdfS4G2IWDfSphyczqTSepHIS2ysK3y', '11 aaa, bbb, ccc', 'user', '2025-08-08 02:05:05', '2025-08-08 02:05:05'),
(6, 'User 4', 'user4@gmail.com', '$2y$12$w8ZdkfjiB22zbKn17KmuiOAroAxczYFOic/rpTJZ5pVhrPaowY/MC', '22 bbb, ccc, ddd', 'user', '2025-08-08 02:08:56', '2025-08-08 02:08:56'),
(7, 'User 5', 'user5@gmail.com', '$2y$12$JiYLr0bw7IpHPJwEWMYeueSRslY5Ky3Tf.2yqnD87xK/vOFiRVmbu', '33 ccc, ddd, eef', 'user', '2025-08-08 02:09:29', '2025-10-09 18:27:30'),
(8, 'User 6', 'user6@gmail.com', '$2y$12$ktt7wLlw.oEtTcKBm/zxYeYGIBu.05fiRqClaqyqi/KuhlVt0Orrq', '44 ddd, eee, fff', 'user', '2025-08-08 02:11:26', '2025-08-08 02:11:26'),
(9, 'User 10', 'user10@gmail.com', '$2y$12$ulpaPl/faqFqHZobzqsRmONtMrFz4hqxlULK9qWATbgYF74IBZMfa', NULL, 'user', '2025-09-22 22:56:15', '2025-09-22 22:56:15'),
(11, 'Admin', 'admin@gmail.com', '$2y$12$7S4OSiAws1skFZyoLd.hcud1PV.vpsq.8jRNeNqnrwL1yu0l/1YZW', NULL, 'admin', '2025-10-04 20:32:24', '2025-10-04 20:32:24'),
(13, 'User87', 'user87@gmail.com', '$2y$12$1V2JxOKIJzvg177IBBtS6.qzNFNrxlsxOdtB6mLMKQLY2Uvjv/rcy', NULL, 'user', '2025-10-05 02:00:06', '2025-10-05 02:00:06'),
(14, 'User 98', 'user98@gmail.com', '$2y$12$CLre17PU.tCkO3djpPILT.TEfdxgBKyxtEq0yDj.ARS04QKKFN8fu', NULL, 'user', '2025-10-05 02:02:09', '2025-10-05 02:02:09'),
(15, 'User 96', 'user96@gmail.com', '$2y$12$hjObuTeT7equU3DCJUKqDOs1yaMn6.9JFIg5f3d3mKflFypqw542m', NULL, 'user', '2025-10-05 02:04:06', '2025-10-05 02:04:06'),
(16, 'User 7', 'user7@gmail.com', '$2y$12$gj.YQBw3Z/OyGb8GiqUwYuID399RZrybA9CSCFd7XOWqigOygXh5u', '123, 456, 789', 'user', '2025-10-09 18:11:45', '2025-10-09 18:11:45');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

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
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
