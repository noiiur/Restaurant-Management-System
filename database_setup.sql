-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27 فبراير 2026 الساعة 05:26
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myoffer`
--

-- --------------------------------------------------------

--
-- بنية الجدول `category`
--

CREATE TABLE `category` (
  `food` int(11) NOT NULL,
  `auto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `offer`
--

CREATE TABLE `offer` (
  `id` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `org_price` decimal(8,2) NOT NULL,
  `discount` int(20) NOT NULL,
  `cat_id` int(20) NOT NULL,
  `quantity` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `creation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `offer`
--

INSERT INTO `offer` (`id`, `Title`, `image`, `description`, `org_price`, `discount`, `cat_id`, `quantity`, `user_id`, `creation_date`) VALUES
(2, 'SHAWERMA', 'uploads/offer_681dc912cf57c6.39688077.png', 'طبق شرق أوسطي نشأ في منطقة بلاد الشام في عهد الدولة العثمانية. يتكون الشَّاورما من لحم مقطع إلى شرائح رقيقة، ومكدس في مخروط مقلوب إلى الأسفل، ليتم شواءه على سيخ عمودي بطيء الدوران. يمكن أن يكون مصدر الشِّواء كهربائي أو غازي أو من الفحم.\\r\\n', 30.00, 2, 1, 10, 0, '0000-00-00 00:00:00'),
(3, 'قصر النخيل | Qasr Al-Nakheel', 'uploads/offer_681de5c8c07935.58023179.png', '\\\"بأناقة العصر الحديث. في قصر النخيل، كل وجبة هي رحلة عبر اكلات الشرق المزينة بنكهات طبيعيه والأزهار الطازجة، تجربة ملكية حيث تلتقي أطباق المطبخ العربي الأصيل\\r\\n\\r\\n', 80.00, 5, 1, 4, 0, '0000-00-00 00:00:00'),
(4, 'أوركيدا | Orchidea', 'uploads/offer_681de680528c24.52111671.png', 'طبق باستا إيطالي فاخر من مطعم \\\"’MyOffers\\\"، تورتيليني كريمية محشوة بالريكونتا، مغطاة بصلصة وبتلات أوركيد أرجوانية صالحة للأكل\\r\\n\\r\\n', 45.00, 11, 1, 10, 0, '0000-00-00 00:00:00'),
(5, 'تاج الياقوت | Taj Al-Yaqoot', 'uploads/offer_681de710b2d526.32903371.png', 'صورة فاخرة لطبق \\\"بيرياني العقيق\\\" في مطعم تاج الياقوت، يُظهر أرز البيرياني الذهبي مع قطع لحم الضأن، مُزين برقائق ذهب وبتلات ورد، داخل إناء نحاسي تقليدي.\\r\\n\\r\\n\\r\\n', 110.00, 12, 1, 10, 0, '0000-00-00 00:00:00'),
(6, 'شفاه الذهب | Shafah Al-Thahab', 'uploads/offer_681de765f32637.72151379.png', 'طبق أرز فاخر يمتزج فيه الأرز البسمتي الذهبي مع شرائح التونة الأزرق النادرة\\r\\n\\r\\nتنسيق عصري: تقديم داخل فخار مع زينة من شرائح الليمون اليوزو واعواد القرفه\\r\\n\\r\\n\\r\\n', 99.00, 8, 1, 4, 0, '0000-00-00 00:00:00'),
(7, 'حديقة الكارمن | أطباق لبنانية-إسبانية', 'uploads/offer_681de7adbb03a3.99653850.png', 'طبق فاخر يجمع بين المذاقين اللبناني والإسباني، يظهر حمص كريمي مع زيت الزيتون البكر ممتاز، مُغطى بشرائح جامون إيبيريكو بدرجة \\\"بلوتا\\\"، مع زينة من الزيتون الكلاماتا والبقدونس الطازج.\\r\\n\\r\\n\\r\\nتنسيق عصري: تقديم داخل فخار مع زينة من شرائح الليمون اليوزو واعواد القرفه\\r\\n\\r\\n\\r\\n', 70.00, 0, 1, 4, 0, '0000-00-00 00:00:00'),
(8, 'أوركيدا | Orchidea', 'uploads/offer_681e45064a31e3.30613433.png', 'طبق باستا إيطالي فاخر من مطعم \\\\\\\"’MyOffers\\\\\\\"، تورتيليني كريمية محشوة بالريكونتا، مغطاة بصلصة وبتلات أوركيد أرجوانية صالحة للأكل\\\\r\\\\n\\\\r\\\\n\\r\\n\\r\\n', 50.00, 2, 1, 4, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- بنية الجدول `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(8) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `password`, `address`, `mobile`) VALUES
(9, 'dalal', 'alotb', 'll555aa@gmail.com', 'n', 'bvhk,-660-jll', '0557787522');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
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
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
