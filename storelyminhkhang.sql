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


-- Dumping database structure for storelyminhkhang
CREATE DATABASE IF NOT EXISTS `storelyminhkhang` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `storelyminhkhang`;

-- Dumping structure for table storelyminhkhang.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table storelyminhkhang.category: ~5 rows (approximately)
INSERT INTO `category` (`id`, `name`, `description`) VALUES
	(1, 'Điện thoại', 'Danh mục các loại điện thoại'),
	(2, 'Laptop', 'Danh mục các loại laptop'),
	(3, 'Máy tính bảng', 'Danh mục các loại máy tính bảng'),
	(4, 'Phụ kiện', 'Danh mục phụ kiện điện tử'),
	(5, 'Thiết bị âm thanh', 'Danh mục loa, tai nghe, micro');

-- Dumping structure for table storelyminhkhang.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `fullname` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `total_money` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table storelyminhkhang.orders: ~3 rows (approximately)
INSERT INTO `orders` (`id`, `user_id`, `fullname`, `phone`, `address`, `total_money`, `created_at`) VALUES
	(1, 2, 'khangtest', '21313111', '213132', 360000.00, '2026-03-04 07:59:08'),
	(2, 3, 'khangtest2', '0905344444', 'hcm', 10690000.00, '2026-03-04 08:00:11'),
	(3, 3, 'khangtest2', '14165516551', 'adsadasdasdasd', 10690000.00, '2026-03-04 08:09:32');

-- Dumping structure for table storelyminhkhang.order_details
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table storelyminhkhang.order_details: ~3 rows (approximately)
INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `price`, `quantity`) VALUES
	(1, 1, 7, 360000.00, 1),
	(2, 2, 6, 10690000.00, 1),
	(3, 3, 6, 10690000.00, 1);

-- Dumping structure for table storelyminhkhang.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table storelyminhkhang.product: ~8 rows (approximately)
INSERT INTO `product` (`id`, `name`, `description`, `price`, `image`, `category_id`) VALUES
	(1, 'iPhone 17 Pro Max 512GB | Chính hãng', '	\r\nMàn hình Luôn Bật, ProMotion 120Hz, HDR, True Tone, Dải màu rộng (P3), Haptic Touch, Tỷ lệ tương phản 2.000.000:1, Độ sáng 1000 nit (tiêu chuẩn), 1600 nit (HDR), 3000 nit (ngoài trời) / tối thiểu 1 nit, Lớp phủ kháng dầu, Chống phản chiếu, Hỗ trợ đa ngôn', 43890000.00, 'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-17-pro-cam_3.jpg', 1),
	(2, 'iPhone 16 Pro Max 1TB | Chính hãng VN/A', 'Dynamic Island\r\nMàn hình Luôn Bật\r\nCông nghệ ProMotion với tốc độ làm mới thích ứng lên đến 120Hz\r\nMàn hình HDR\r\nTrue Tone\r\nDải màu rộng (P3)\r\nHaptic Touch\r\nTỷ lệ tương phản 2.000.000:1', 43990000.00, 'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-pro-max_2.png', 1),
	(3, 'Laptop Acer Aspire Lite Gen 2 AL14-52M-32KV', 'Laptop Acer Aspire Lite Gen 2 AL14-52M-32KV nổi bật với màn hình IPS 14 inches WUXGA, bộ vi xử lý Intel Core i3-1305U, và RAM 8GB cho hiệu năng ổn định. Máy sở hữu SSD 256GB PCIe, kết nối Wi-Fi 6, Bluetooth 5.1, cùng đa dạng cổng giao tiếp như USB Type-C, HDMI 1.4 và đầu đọc thẻ MicroSD. Thiết kế gọn nhẹ 1.5kg cùng bàn phím tiêu chuẩn mang đến sự tiện lợi cho hầu hết công việc.', 12490000.00, 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/g/r/group_659_1__4.png', 2),
	(4, 'Laptop Lenovo LOQ 15ARP10E 83S0007AVN', 'Laptop Lenovo LOQ 15ARP10E 83S0007AVN sử dụng CPU AMD Ryzen 7 7735HS, cung cấp đạt hiệu suất ổn định khi xử lý các tác vụ nặng và đáp ứng nhu cầu làm việc. Model sở hữu GPU RTX 3050 6GB GDDR6 hỗ trợ dựng hình ổn định. Máy dùng RAM DDR5-4800 giúp người dùng đa nhiệm tốt trong nhiều bối cảnh.', 26290000.00, 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/e/text_d_i_8_16.png', 2),
	(5, 'iPad Pro chip M5 11 inch Wifi 256GB | Chính hãng Apple Việt Nam', 'iPad Pro 11 2025 M5 Wifi 256GB gây ấn tượng với chip M5 xử lý mạnh mẽ, RAM lên tới 12GB cùng màn hình OLED Ultra Retina XDR 120Hz hiển thị mượt mà. Máy hỗ trợ WiFi 7, cổng Thunderbolt tốc độ cao cùng pin 31,29Wh. Camera sau 12MP quay 4K HDR, cho hình ảnh sắc nét và chuyên nghiệp.', 29090000.00, 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/ipad-pro-m5.jpg', 3),
	(6, 'Samsung Galaxy Tab S10 FE Wifi 12GB 256GB', 'Tab S10 FE Wifi 12GB 256GB sở hữu RAM 12GB mạnh mẽ, tích hợp chip Exynos 1580, hỗ trợ đa nhiệm mượt mà, xử lý nhanh chóng mọi ứng dụng và tác vụ nặng. ROM 256GB cung cấp không gian lưu trữ rộng lớn, thoải mái chứa hàng nghìn ảnh, video, tài liệu và ứng dụng. Thiết bị sở hữu màn hình 10.9 inch sắc nét, pin 8000mAh và sạc nhanh 45W tiện lợi.', 10690000.00, 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/m/a/may-tinh-bang-samsung-galaxy-tab-s10-fe.1_1_1.png', 3),
	(7, 'Dán kính cường lực màn hình Apple iPhone 17 Zeelot Solidsleek Ultra HD Full Cao Cấp', 'Kính cường lực iPhone 17 Zeelot Solidsleek Ultra HD Full có độ cứng cao, bảo vệ hiệu quả, hạn chế trầy xước hiệu quả với cấu trúc Explosion-Proof. Lớp phủ oleophobic trên bề mặt hạn chế bám vân tay, đồng thời cho cảm giác vuốt chạm mượt mà. Sản phẩm có độ trong suốt đến 92.5% hiển thị rõ nét.', 360000.00, 'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/k/i/kinh-cuong-luc-iphone-17-zeelot-solidsleek-ultra-hd-full_1_.png', 4),
	(8, 'Bao Da Mutural Design Folio cho iPad Pro 11 2021', 'Bao da Mutural Design Folio cho Apple iPad Pro 11 2021 – Thẩm mỹ, cao cấp\r\nBao da Mutural Design Folio cho Apple iPad Pro 11 2021 là món phụ kiện phổ biến mà người dùng iPad 11 2021 không thể không trang bị. Với thiết kế mềm dẻo cùng khả năng chống sốc tốt, sản phẩm sẽ giúp bảo vệ iPad của bạn được an toàn và mang đến trải nghiệm tốt cho người dùng.', 53100.00, 'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/b/a/bao-da-mutural-ipad-pro-11-update.png', 4);

-- Dumping structure for table storelyminhkhang.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','khach') DEFAULT 'khach',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table storelyminhkhang.user: ~3 rows (approximately)
INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES
	(1, 'admin', '12345', 'admin'),
	(2, 'khangtest', '123123', 'khach'),
	(3, 'khangtest2', '123123', 'khach');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
