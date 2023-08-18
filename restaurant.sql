-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th4 28, 2023 lúc 12:53 AM
-- Phiên bản máy phục vụ: 8.0.31
-- Phiên bản PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `restaurant`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'Phương Quyên', 'phuongquyen134', '1234'),
(2, 'Phạm Hoàng Bảo An', 'baoan1265', '123456789'),
(20, 'Phạm Thị Thu Hạnh', 'thuhanh123', '25f9e794323b453885f5181f1b624d0b');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(24, 'Desserts', 'Food_Category_341.jpg', 'Yes', 'Yes'),
(25, 'Drinks', 'Food_Category_958.jpg', 'Yes', 'Yes'),
(26, 'Salad', 'Food_Category_301.jpg', 'Yes', 'Yes'),
(27, 'Pasta', 'Food_Category_809.jpg', 'Yes', 'Yes'),
(28, 'Pizza', 'Food_Category_232.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customer`
--

DROP TABLE IF EXISTS `tbl_customer`;
CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `phone` int NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `full_name`, `phone`, `email`) VALUES
(57, 'Huỳnh Lê Ngân Anh', 234348932, 'ngananh213@gmail.com'),
(58, 'Lý Thị Mỹ Ngọc', 32132, 'myngojj123@gmail.com'),
(56, 'Nguyễn Lệ Nam Anh', 2892293, 'lenam232@gmail.com'),
(53, 'Trần Thị Tú Nhi', 92943204, 'jane.doe@live.fr'),
(54, 'Tôn Nữ Huỳnh Như', 3982392, 'bdhlxmctd@gmail.com'),
(55, 'Nguyễn Đức Duy', 29923892, 'phuongquyen_828@yahoo.com.vn'),
(52, 'Lê Huỳnh Minh Anh', 293283191, 'chiencon197@gmail.com'),
(51, 'fdsfsdf', 938493, 'fsdfs'),
(50, 'Nguyễn Thị Phương Quyên', 973404627, 'phuongquyen1342002@gmail.com'),
(59, 'Nguyễn Thị Kim Chi ', 12389381, 'kimchi@gmail.com'),
(60, 'Bùi Thị Quỳnh Hương', 4284792, 'quynhhuongw1924@gmail.com'),
(61, 'Hồ Hoài Anh', 34283472, 'hoaianh231@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_food`
--

DROP TABLE IF EXISTS `tbl_food`;
CREATE TABLE IF NOT EXISTS `tbl_food` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int NOT NULL,
  `featured` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(9, 'Vegetarian Spaghetti', 'Vegetarian Spaghetti Bolognese with Mushrooms', '120', 'Food_548.jpg', 27, 'Yes', 'Yes'),
(8, 'Cheese Pizza', 'Mozzareala, Parmesan, Camembert', '167', 'Food_77.png', 28, 'Yes', 'Yes'),
(10, 'Tomato Spaghetti', 'Tomato Spaghetti with Home-made Mascarpone Cheese', '140', 'Food_367.jpg', 27, 'Yes', 'Yes'),
(11, 'Clams & Basil Sauce Spaghetti', 'Dary clam nuts', '160', 'Food_769.jpg', 27, 'No', 'Yes'),
(12, 'Bolognese Spaghetti', 'Bolognese Spaghetti with House-made Smoked Cheese', '150', 'Food_172.jpg', 27, 'Yes', 'Yes'),
(13, 'Vegetarian Pizza', 'Mushrooms, Kale. olive and caper sauce', '100', 'Food_66.jpg', 28, 'Yes', 'Yes'),
(14, 'Creamy Cajun Shrimp Pasta ', 'Linguine swirled around a spicy cajun sauce, seasoned shrimp and tomatoes.', '180', 'Food_396.jpg', 27, 'Yes', 'Yes'),
(15, 'Creamy Pasta', 'Cheesy, creamy and made from scratch..', '140', 'Food_218.jpg', 27, 'Yes', 'Yes'),
(16, 'BBQ Chicken Pizza', 'BBQ sauce and sprinkled with tons of mozzarella and gouda.', '240', 'Food_659.jpg', 28, 'Yes', 'Yes'),
(17, 'Onion Soup Pizza', 'The Most Epic French Onion Soup Pizza.', '200', 'Food_346.jpg', 28, 'Yes', 'Yes'),
(18, 'Parma Ham Pizza', 'Burrata Parma Ham Margherita', '250', 'Food_426.jpg', 28, 'Yes', 'Yes'),
(19, ' Smoked Salmon Salad', 'Smoked Salmon Salad with creamy caper chive.', '70', 'Food_716.png', 26, 'Yes', 'Yes'),
(20, 'Nutty Avocado and Mango Salad', 'mango, coriander, mint, ginger, and nuts for crunch and texture.', '50', 'Food_678.png', 26, 'Yes', 'Yes'),
(21, 'Roasted sweet potato salad ', 'Mixed greens with roasted sweet potato, wild rice, cranberries, almonds, avocado.', '45', 'Food_759.png', 26, 'Yes', 'Yes'),
(22, 'Blood Mascarpone Panna Cotta', 'Served with vibrant blood orange sauce and fresh raspberries and rose petals. ', '60', 'Food_165.png', 24, 'Yes', 'Yes'),
(23, 'Vanilla Bean Creme Brulee', 'Creme Brulee recipe is delicious, creamy, and the most perfect French dessert.', '55', 'Food_609.png', 24, 'Yes', 'Yes'),
(24, 'Vanilla Mousse with Chocolate', 'An European dessert with creamy base and silky chocolate topping.', '40', 'Food_553.png', 24, 'Yes', 'Yes'),
(25, 'Coconut Ginger Ice Cream', 'This fabulous vegan ice cream is so simple to make and packed full of rich.', '35', 'Food_192.png', 24, 'Yes', 'Yes'),
(26, 'Vegan Mango Ice Cream', 'Vegan Mango Ice Cream is made with coconut milk and some secret ingredients to make more colorful and flavorful too. ', '35', 'Food_713.png', 24, 'Yes', 'Yes'),
(27, 'Vanilla Yoghurt Panna Cotta with Peaches', 'Vanilla Yoghurt Panna Cotta with balsamic thyme roasted peaches and nectarines', '55', 'Food_598.png', 24, 'Yes', 'Yes'),
(28, 'Tomato Burrata Salad', 'The best caprese salad recipe uses a handful of fresh, juicy ingredients.', '75', 'Food_657.png', 26, 'Yes', 'Yes'),
(29, 'Cast Iron Pizza', 'This cast iron pizza with spicy Italian sausage.', '175', 'Food_274.png', 28, 'Yes', 'Yes'),
(30, 'Peperoni Pizza', 'It makes a pizza crust like you get at Italian wood fired pizzerias.', '220', 'Food_147.png', 28, 'Yes', 'Yes'),
(31, 'Spiced Honey Bourbon ', 'Simply mix everything together for a cocktail that’s perfectly sweetened, spiced, and so delicious!', '60', 'Food_494.png', 25, 'Yes', 'Yes'),
(32, 'Winter Buddha Bowl', 'It’s a brand new year and that means two things: setting new goals and getting back on track with old ones.', '65', 'Food_42.png', 25, 'Yes', 'Yes'),
(33, 'Strawberry Volka Mojito', 'Strawberry Vodka Mojito-sweet strawberries muddled with lime, mint, grenadine, and vodka, soda water. ', '70', 'Food_256.png', 25, 'Yes', 'Yes'),
(34, 'Classic Mojito', 'The classic mojito is a refreshing summer favorite.', '49', 'Food_238.png', 25, 'Yes', 'Yes'),
(35, 'Orange Juice', 'Orange ', '35', 'Food_327.png', 25, 'No', 'Yes'),
(36, 'Pomegranate Juice', 'Pomegranate ', '38', 'Food_540.png', 25, 'Yes', 'Yes'),
(37, 'Mulled Wine', 'Mulled Wine', '80', 'Food_495.png', 25, 'No', 'Yes'),
(38, 'Rose Wine', 'Rose Wine', '80', 'Food_383.png', 25, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_khung_gio`
--

DROP TABLE IF EXISTS `tbl_khung_gio`;
CREATE TABLE IF NOT EXISTS `tbl_khung_gio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `tbl_khung_gio`
--

INSERT INTO `tbl_khung_gio` (`id`, `time_start`, `time_end`) VALUES
(1, '11:00:00', '13:00:00'),
(2, '11:30:00', '13:30:00'),
(3, '12:00:00', '14:00:00'),
(4, '12:30:00', '14:30:00'),
(5, '13:00:00', '15:00:00'),
(6, '13:30:00', '15:30:00'),
(7, '14:00:00', '16:00:00'),
(8, '14:30:00', '16:30:00'),
(9, '15:00:00', '17:00:00'),
(10, '15:30:00', '17:30:00'),
(11, '16:00:00', '18:00:00'),
(12, '16:30:00', '18:30:00'),
(13, '17:00:00', '19:00:00'),
(14, '17:30:00', '19:30:00'),
(15, '18:00:00', '20:00:00'),
(16, '18:30:00', '20:30:00'),
(17, '19:00:00', '21:00:00'),
(18, '19:30:00', '21:30:00'),
(19, '20:00:00', '22:00:00'),
(20, '20:30:00', '22:00:00'),
(21, '21:00:00', '22:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_lich_dat_ban`
--

DROP TABLE IF EXISTS `tbl_lich_dat_ban`;
CREATE TABLE IF NOT EXISTS `tbl_lich_dat_ban` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_khung_gio` int NOT NULL,
  `id_ban` int NOT NULL,
  `ngay_den` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `tbl_lich_dat_ban`
--

INSERT INTO `tbl_lich_dat_ban` (`id`, `id_khung_gio`, `id_ban`, `ngay_den`) VALUES
(32, 2, 1, '2023-04-13'),
(31, 2, 3, '2023-04-13'),
(30, 16, 16, '2023-04-30'),
(29, 15, 7, '2023-04-30'),
(28, 15, 3, '2023-04-30'),
(27, 14, 2, '2023-04-30'),
(26, 8, 4, '2023-04-25'),
(25, 9, 8, '2023-04-21'),
(24, 5, 5, '2023-04-13'),
(23, 18, 5, '2023-05-23'),
(22, 2, 2, '2023-04-13'),
(21, 3, 1, '2023-04-13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_reservation`
--

DROP TABLE IF EXISTS `tbl_reservation`;
CREATE TABLE IF NOT EXISTS `tbl_reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_khach_hang` int NOT NULL,
  `id_lich_dat_ban` int NOT NULL,
  `request` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `status` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `tbl_reservation`
--

INSERT INTO `tbl_reservation` (`id`, `id_khach_hang`, `id_lich_dat_ban`, `request`, `status`, `timestamp`) VALUES
(16, 53, 23, '', 'confirmed', '2023-04-27 14:52:17'),
(17, 54, 24, 'none', 'completed', '2023-04-27 14:53:05'),
(15, 52, 22, 'my birthday', 'canceled', '2023-04-27 14:51:47'),
(14, 50, 21, 'party', 'completed', '2023-04-27 14:50:47'),
(18, 55, 25, 'private party', 'completed', '2023-04-27 15:28:37'),
(19, 56, 26, 'none', 'canceled', '2023-04-27 15:29:23'),
(20, 57, 27, 'none', 'pending', '2023-04-27 15:30:03'),
(21, 58, 28, 'none', 'confirmed', '2023-04-27 15:31:38'),
(22, 50, 29, '', 'confirmed', '2023-04-27 15:32:13'),
(23, 59, 30, 'company party', 'pending', '2023-04-27 15:37:29'),
(24, 60, 31, '', 'confirmed', '2023-04-27 15:49:48'),
(25, 61, 32, 'party', 'pending', '2023-04-27 15:56:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_table`
--

DROP TABLE IF EXISTS `tbl_table`;
CREATE TABLE IF NOT EXISTS `tbl_table` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `type_table` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `tbl_table`
--

INSERT INTO `tbl_table` (`id`, `name`, `type_table`) VALUES
(1, 'Table 1', 1),
(2, 'Table 2', 1),
(3, 'Table 3', 1),
(4, 'Table 4', 1),
(5, 'Table 5', 1),
(6, 'table 6', 2),
(7, 'Table 7', 2),
(8, 'Table 8', 2),
(9, 'table 9', 2),
(10, 'Table 10', 3),
(11, 'Table 11', 3),
(12, 'Table 12', 3),
(13, 'Table 13', 4),
(14, 'Table 14', 4),
(15, 'Table 15', 6),
(16, 'Table 16', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_type_table`
--

DROP TABLE IF EXISTS `tbl_type_table`;
CREATE TABLE IF NOT EXISTS `tbl_type_table` (
  `id` int NOT NULL AUTO_INCREMENT,
  `num_of_chairs` int NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `tbl_type_table`
--

INSERT INTO `tbl_type_table` (`id`, `num_of_chairs`, `description`) VALUES
(1, 2, 'Table can accommodate 2 people'),
(2, 6, 'Table can accommodate 6 people'),
(3, 8, 'Table can accommodate 8 people'),
(4, 10, 'Table can accommodate 10 people'),
(6, 15, 'Table can accommodate 15 people');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
