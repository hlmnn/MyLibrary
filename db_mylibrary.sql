/*
 Navicat Premium Data Transfer

 Source Server         : MyKoneksi
 Source Server Type    : MySQL
 Source Server Version : 100418
 Source Host           : localhost:3306
 Source Schema         : db_mylibrary

 Target Server Type    : MySQL
 Target Server Version : 100418
 File Encoding         : 65001

 Date: 18/06/2022 14:40:55
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for books
-- ----------------------------
DROP TABLE IF EXISTS `books`;
CREATE TABLE `books`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_buku` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `publisher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_terbit` year NOT NULL,
  `isbn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `books_kode_buku_unique`(`kode_buku` ASC) USING BTREE,
  UNIQUE INDEX `books_isbn_unique`(`isbn` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of books
-- ----------------------------
INSERT INTO `books` VALUES (2, 'KB0002', 'Minecraft Tutorial', 'Mojang', 'Mojang', 2022, '0-021-75233-1', 'Gaming', 'book-images/vpq7jnBnjsc2YtFFXMZ87CLxQhgSuVZiiZQCcfWO.png', '2022-06-17 19:06:39', '2022-06-18 05:42:27');
INSERT INTO `books` VALUES (3, 'KB0003', 'Supremacy Games', 'MidGard', 'Webnovel', 2020, '1-232-424423-1', 'Fiksi', 'book-images/UGYaaulrEupbPt71vmOzAbxOQc01F9L6RHxonUe1.jpg', '2022-06-18 00:41:36', '2022-06-18 00:41:36');
INSERT INTO `books` VALUES (4, 'KB0004', 'Logika Algoritma & Pemrograman Dasar', 'Rosa A. S.', 'Modula', 2018, '978-602-8759-42-7', 'Programming', 'book-images/E7vZmLb5Krcr5oUgaNRYUdMUFGGmBoYEAAZVtLpU.jpg', '2022-06-18 00:48:52', '2022-06-18 00:49:43');
INSERT INTO `books` VALUES (5, 'KB0005', 'Buku Algoritma & Pemrograman', 'Rinaldi Munir', 'INFORMATIKA', 2016, '602-1514-91-7', 'Programming', 'book-images/ZmvtUUtDbH1LovH6YLVRNy3Jm21JlAnx3j4OpxRh.jpg', '2022-06-18 00:52:42', '2022-06-18 00:53:12');
INSERT INTO `books` VALUES (8, 'KB0006', 'Judul Buku yang Baru Tahun 2022', 'Hilman Fauzi', 'JYP Entertaiment', 2022, '1-232-42443-1', 'Game', 'book-images/BzqA0hSRSEyi3t5nu572TLYC2TJvoFiT1XckR84d.png', '2022-06-18 06:44:34', '2022-06-18 06:44:34');

-- ----------------------------
-- Table structure for circulations
-- ----------------------------
DROP TABLE IF EXISTS `circulations`;
CREATE TABLE `circulations`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_id` bigint UNSIGNED NOT NULL,
  `koleksi_id` bigint UNSIGNED NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `durasi` int NOT NULL,
  `tgl_kembali` date NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Dipinjam',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `circulations_kode_transaksi_unique`(`kode_transaksi` ASC) USING BTREE,
  INDEX `circulations_member_id_foreign`(`member_id` ASC) USING BTREE,
  INDEX `circulations_koleksi_id_foreign`(`koleksi_id` ASC) USING BTREE,
  CONSTRAINT `circulations_koleksi_id_foreign` FOREIGN KEY (`koleksi_id`) REFERENCES `collections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `circulations_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of circulations
-- ----------------------------

-- ----------------------------
-- Table structure for collections
-- ----------------------------
DROP TABLE IF EXISTS `collections`;
CREATE TABLE `collections`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `buku_id` bigint UNSIGNED NOT NULL,
  `kode_koleksi` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `noreg` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Baik',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `collections_kode_koleksi_unique`(`kode_koleksi` ASC) USING BTREE,
  UNIQUE INDEX `collections_noreg_unique`(`noreg` ASC) USING BTREE,
  INDEX `collections_buku_id_foreign`(`buku_id` ASC) USING BTREE,
  CONSTRAINT `collections_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of collections
-- ----------------------------
INSERT INTO `collections` VALUES (3, 2, 'KK0003', 'NR0003', 'R.02', 'Baik', 'Tersedia', '2022-06-17 19:31:20', '2022-06-18 06:27:52');
INSERT INTO `collections` VALUES (5, 3, 'KK0005', 'NR0005', 'R.01', 'Baik', 'Tersedia', '2022-06-18 01:02:27', '2022-06-18 01:02:27');
INSERT INTO `collections` VALUES (6, 3, 'KK0006', 'NR0006', 'R.02', 'Baik', 'Tersedia', '2022-06-18 01:02:40', '2022-06-18 03:14:19');
INSERT INTO `collections` VALUES (7, 4, 'KK0007', 'NR0007', 'R.02', 'Baik', 'Tersedia', '2022-06-18 01:06:00', '2022-06-18 01:06:00');
INSERT INTO `collections` VALUES (8, 4, 'KK0008', 'NR0008', 'R.01', 'Baik', 'Tersedia', '2022-06-18 01:06:14', '2022-06-18 01:06:14');
INSERT INTO `collections` VALUES (9, 4, 'KK0009', 'NR0009', 'R.03', 'Baik', 'Tersedia', '2022-06-18 01:06:29', '2022-06-18 01:06:29');
INSERT INTO `collections` VALUES (10, 5, 'KK0010', 'NR0010', 'R.01', 'Baik', 'Tersedia', '2022-06-18 01:33:07', '2022-06-18 01:33:07');
INSERT INTO `collections` VALUES (12, 4, 'KK0012', 'NR0012', 'R.02', 'Baik', 'Tersedia', '2022-06-18 06:29:41', '2022-06-18 06:29:41');
INSERT INTO `collections` VALUES (13, 8, 'KK0013', 'NR0013', 'R.01', 'Baik', 'Tersedia', '2022-06-18 06:55:29', '2022-06-18 06:55:29');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for members
-- ----------------------------
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_member` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `members_kode_member_unique`(`kode_member` ASC) USING BTREE,
  UNIQUE INDEX `members_nomor_unique`(`nomor` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of members
-- ----------------------------
INSERT INTO `members` VALUES (1, 'KM0001', 'Hilman Fauzi Herdiana', '085295338350', '2022-06-17 18:09:53', '2022-06-17 18:09:53');
INSERT INTO `members` VALUES (2, 'KM0002', 'Ghifari Octaverin', '089324353234', '2022-06-17 18:10:05', '2022-06-17 18:10:05');
INSERT INTO `members` VALUES (3, 'KM0003', 'Im Nayeon', '085232445334', '2022-06-17 18:10:25', '2022-06-17 18:10:25');
INSERT INTO `members` VALUES (4, 'KM0004', 'Myoui Mina', '081234242443', '2022-06-17 18:10:49', '2022-06-17 18:10:49');
INSERT INTO `members` VALUES (5, 'KM0005', 'Dadang', '085645445369', '2022-06-17 18:11:10', '2022-06-17 18:11:10');
INSERT INTO `members` VALUES (6, 'KM0006', 'Atang', '085343652342', '2022-06-17 18:11:29', '2022-06-17 18:11:29');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2022_06_07_140224_create_members_table', 1);
INSERT INTO `migrations` VALUES (6, '2022_06_07_180240_create_books_table', 1);
INSERT INTO `migrations` VALUES (7, '2022_06_12_114736_create_collections_table', 1);
INSERT INTO `migrations` VALUES (8, '2022_06_17_123048_create_circulations_table', 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Hilman Fauzi', 'admin', 'admin@email.com', NULL, '$2y$10$J0rnq3cPhGn8.CFpactwL.23m0XbX9sMJE1az/2cM4RZbrqQ1fu5q', NULL, '2022-06-17 18:09:53', '2022-06-17 18:09:53');

SET FOREIGN_KEY_CHECKS = 1;
