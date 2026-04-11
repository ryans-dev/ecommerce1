-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 11, 2026 at 05:11 AM
-- Server version: 9.6.0
-- PHP Version: 8.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(7,2) NOT NULL DEFAULT '0.00',
  `quantity` int NOT NULL DEFAULT '20',
  `image_path` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `classification` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default' COMMENT 'default,exclusive,featured,upcoming',
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `short_description`, `full_description`, `price`, `quantity`, `image_path`, `image_name`, `category`, `classification`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ponytail Palm', 'A low-maintenance plant with a bulbous base and long, flowing leaves, perfect for adding a sculptural touch.', '<p>A slow-growing plant with a swollen trunk that stores water, making it extremely drought-tolerant and beginner-friendly.</p><p><strong>Water: </strong>Water sparingly; allow soil to dry out completely between watering.</p><p><strong>Sunlight:</strong> Thrives in bright light but tolerates moderate light.</p>', 250.00, 50, '/images/products/', '01KNXARYG456PYQPYAZX0K610S.webp', 'Indoor Plant', 'default', 'active', '2026-02-21 11:17:07', '2026-04-11 08:47:50'),
(13, 'Money Tree', 'A popular indoor plant with a braided trunk and lush foliage, often associated with luck and prosperity.', '<p>Perfect for homes and offices, it’s easy to care for and adapts well to indoor environments.<br><strong>Water:</strong> Water moderately; let topsoil dry slightly.<br><strong>Sunlight:</strong> Prefers bright, indirect light.</p>', 150.00, 20, '/images/products/', '01KNXBV6H0Z9SD6492KGQZ7312.webp', 'Indoor Plant', 'default', 'active', '2026-04-11 08:12:19', '2026-04-11 08:47:58'),
(14, 'Monstera Deliciosa', 'Iconic split leaves bring a bold, tropical statement to any space.', '<p>A fast-growing plant with dramatic fenestrated leaves, ideal for creating a lush indoor jungle feel.<br><strong>Water:</strong> Water when topsoil dries out.<br><strong>Sunlight:</strong> Bright, indirect light preferred.</p>', 250.00, 20, '/images/products/', '01KNXCYTX4KWW62JY1ERKB17TF.webp', 'Tropical Foliage', 'default', 'active', '2026-04-11 08:31:47', '2026-04-11 08:51:32'),
(15, 'Monstera Thai Constellation', 'A highly sought-after Monstera with stunning creamy variegation.', '<p>A premium plant prized for its marbled leaves, perfect for collectors and statement interiors.<br><strong>Water:</strong> Keep soil lightly moist.<br><strong>Sunlight:</strong> Bright, indirect light required.</p>', 300.00, 20, '/images/products/', '01KNXD1VM7DRZ7WTVA5EC04X12.webp', 'Tropical Foliage', 'default', 'active', '2026-04-11 08:33:26', '2026-04-11 08:51:20'),
(16, 'Golden Pothos', 'A hardy trailing vine with golden variegation, perfect for shelves and hanging baskets.', '<p>Extremely versatile and fast-growing, ideal for beginners and low-maintenance spaces.<br><strong>Water:</strong> Water when soil dries out.<br><strong>Sunlight:</strong> Low to bright indirect light.</p>', 90.00, 20, '/images/products/', '01KNXD4K2JZ1B8M8JBM7FY9HDQ.webp', 'Hanging Plant', 'default', 'active', '2026-04-11 08:34:55', '2026-04-11 08:34:55'),
(17, 'Jade Pothos', 'A lush green trailing plant that thrives with minimal care.', '<p>Known for its durability and adaptability, it’s perfect for filling shelves or cascading displays.<br><strong>Water:</strong> Allow soil to dry slightly between watering.<br><strong>Sunlight:</strong> Low to bright indirect light.</p>', 90.00, 20, '/images/products/', '01KNXD8HQAXXY8FGZ2W176NYWW.webp', 'Hanging Plant', 'default', 'active', '2026-04-11 08:37:05', '2026-04-11 08:48:17'),
(18, 'White Anthurium', 'Elegant white blooms paired with glossy leaves for a refined look.', '<p>Produces long-lasting flowers that brighten indoor spaces with minimal effort.<br><strong>Water:</strong> Keep soil lightly moist.<br><strong>Sunlight:</strong> Bright, indirect light.</p>', 150.00, 20, '/images/products/', '01KNXDB1SR21PVN0VD5V85BWJK.webp', 'Blooms', 'default', 'active', '2026-04-11 08:38:27', '2026-04-11 08:47:30'),
(19, 'Red Anthurium', 'Bold red blooms that add vibrant color to any interior.', '<p>A popular flowering plant known for its glossy foliage and year-round blooms.<br><strong>Water:</strong> Water regularly; keep soil slightly moist.<br><strong>Sunlight:</strong> Bright, indirect light.</p>', 130.00, 20, '/images/products/', '01KNXDDZSTST4YZEHV1DEYC7EZ.webp', 'Blooms', 'default', 'active', '2026-04-11 08:40:03', '2026-04-11 08:48:31'),
(20, 'Yellow Orchid', 'Elegant yellow blooms that bring a soft, cheerful touch.', '<p>A delicate orchid that produces long-lasting flowers when properly cared for.<br><strong>Water:</strong> Water lightly; allow roots to dry.<br><strong>Sunlight:</strong> Bright, indirect light.</p>', 120.00, 20, '/images/products/', '01KNXDFRV3DZ2RHZCJMBV1Y6KR.webp', 'Blooms', 'default', 'active', '2026-04-11 08:41:02', '2026-04-11 08:41:02'),
(21, 'Pink Watercolour Orchid', 'Artistic pink blooms with unique patterns, perfect for décor.', '<p>A visually striking orchid ideal as a centerpiece or gift plant.<br><strong>Water:</strong> Water sparingly.<br><strong>Sunlight:</strong> Bright, indirect light.</p>', 150.00, 20, '/images/products/', '01KNXDKHVTRQDCXWWKP5BAXE7X.webp', 'Blooms', 'default', 'active', '2026-04-11 08:43:06', '2026-04-11 08:43:06'),
(22, 'Snake Plant', 'A tough, upright plant that thrives in almost any condition.', '<p>Extremely resilient and ideal for beginners, known for improving indoor air quality.<br><strong>Water:</strong> Water infrequently; allow soil to dry fully.<br><strong>Sunlight:</strong> Low to bright light.</p>', 60.00, 20, '/images/products/', '01KNXDPJHEREPR4ECC8PZCWBAA.webp', 'Air-Purifying', 'default', 'active', '2026-04-11 08:44:44', '2026-04-11 08:44:44'),
(23, 'ZZ Plant', 'A glossy, hardy plant perfect for low-light and low-maintenance spaces.', '<p>Thrives on neglect and is ideal for offices or rooms with minimal natural light.<br><strong>Water:</strong> Water sparingly.<br><strong>Sunlight:</strong> Low to bright indirect light.</p>', 130.00, 20, '/images/products/', '01KNXDR3DWWV1NJK76NS9Y32G7.webp', 'Indoor Plant', 'default', 'active', '2026-04-11 08:45:35', '2026-04-11 08:45:35'),
(24, 'Ruby Ficus', 'A colorful rubber plant with pink and cream variegated leaves.', '<p>Adds vibrant tones to interiors while maintaining an elegant upright growth habit.<br><strong>Water:</strong> Water when topsoil dries.<br><strong>Sunlight:</strong> Bright, indirect light needed.</p>', 160.00, 20, '/images/products/', '01KNXDV7G1ZQGX0XTKRY21ABA5.webp', 'Tropical Foliage', 'default', 'active', '2026-04-11 08:47:17', '2026-04-11 08:47:17'),
(25, 'Bird of Paradise', 'Large, dramatic leaves create a bold tropical statement.', '<p>A fast-growing plant that can reach impressive heights, ideal for filling large spaces.<br><strong>Water:</strong> Water regularly; keep soil slightly moist.<br><strong>Sunlight:</strong> Bright light, including some direct su</p>', 300.00, 20, '/images/products/', '01KNXDZQ5JPQKX4NXX72T3J9J6.webp', 'Tropical Foliage', 'default', 'active', '2026-04-11 08:49:44', '2026-04-11 08:49:44'),
(26, 'Philodendron Pink Princess', 'A stunning plant with dark leaves splashed in vibrant pink.', '<p>Highly prized for its unique variegation, making it a standout feature plant.<br><strong>Water:</strong> Water when soil begins to dry.<br><strong>Sunlight:</strong> Bright, indirect light.</p>', 250.00, 20, '/images/products/', '01KNXE2AS4P84ZTK4P0SYEJRPG.webp', 'Indoor Plant', 'default', 'active', '2026-04-11 08:51:10', '2026-04-11 08:51:10'),
(27, 'Mermaid Tail Cactus', 'A rare, wavy cactus that resembles a mermaid’s tail.', '<p>A unique sculptural cactus that doubles as a living art piece.<br><strong>Water:</strong> Water very sparingly.<br><strong>Sunlight:</strong> Bright, direct sunlight.</p>', 140.00, 20, '/images/products/', '01KNXE5G4WAK2FKX80RJ58A3GK.webp', 'Cactus', 'default', 'active', '2026-04-11 08:52:54', '2026-04-11 08:52:54'),
(28, 'Blooming Cactus', 'A compact cactus that produces bright, colorful blooms.', '<p>Ideal for small spaces, offering occasional bursts of vibrant flowers.<br><strong>Water:</strong> Minimal watering.<br><strong>Sunlight:</strong> Bright, direct sunlight.</p>', 180.00, 20, '/images/products/', '01KNXEDGR5TFFT3TTG3MAYQMES.webp', 'Cactus', 'default', 'active', '2026-04-11 08:57:16', '2026-04-11 08:57:16'),
(29, 'Prickly Pear Cactus', 'A bold cactus with flat paddle-shaped pads and a desert aesthetic.', '<p>Extremely hardy and drought-resistant, perfect for sunny environments.<br><strong>Water:</strong> Water sparingly.<br><strong>Sunlight:</strong> Full sun required.</p>', 110.00, 20, '/images/products/', '01KNXEFENPVYZJWAY28XPCEHB6.webp', 'Cactus', 'default', 'active', '2026-04-11 08:58:20', '2026-04-11 08:58:20'),
(30, 'Aloe Vera', 'A practical plant known for its soothing, healing gel.', '<p>Combines decorative appeal with medicinal use, making it both functional and easy to care for.<br><strong>Water:</strong> Water deeply but infrequently.<br><strong>Sunlight:</strong> Bright light preferred.</p>', 80.00, 20, '/images/products/', '01KNXEHVBXTWF0PPJ4WM5EQES7.webp', 'Succulent', 'default', 'active', '2026-04-11 08:59:38', '2026-04-11 08:59:38'),
(31, 'Pink Variegated Banana Tree', 'A rare banana plant with stunning pink-variegated foliage.', '<p>A fast-growing, eye-catching plant that adds vibrant color and a tropical feel.<br><strong>Water:</strong> Keep soil consistently moist.<br><strong>Sunlight:</strong> Bright light with some direct sun.</p>', 180.00, 20, '/images/products/', '01KNXEKKGGKR52R2A8FEP08Q04.webp', 'Tropical Foliage', 'default', 'active', '2026-04-11 09:00:36', '2026-04-11 09:00:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
