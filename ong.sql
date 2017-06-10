-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.18-0ubuntu0.16.04.1 - (Ubuntu)
-- OS do Servidor:               Linux
-- HeidiSQL Versão:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para ong
CREATE DATABASE IF NOT EXISTS `ong` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ong`;

-- Copiando estrutura para tabela ong.category_patrimonies
CREATE TABLE IF NOT EXISTS `category_patrimonies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ong.category_patrimonies: ~0 rows (aproximadamente)
DELETE FROM `category_patrimonies`;
/*!40000 ALTER TABLE `category_patrimonies` DISABLE KEYS */;
/*!40000 ALTER TABLE `category_patrimonies` ENABLE KEYS */;

-- Copiando estrutura para tabela ong.employees
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `begin_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `situation` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_user_id_unique` (`user_id`),
  KEY `employees_image_id_foreign` (`image_id`),
  CONSTRAINT `employees_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ong.employees: ~2 rows (aproximadamente)
DELETE FROM `employees`;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` (`id`, `name`, `slug`, `cpf`, `address`, `position`, `begin_date`, `end_date`, `situation`, `created_at`, `updated_at`, `image_id`, `user_id`) VALUES
	(2, 'Funcionario do mes ', 'funcionario-do-mes', '025.735.600-23', 'Rua 15 de Novembro,321, sala 503', NULL, '2017-06-05', NULL, 1, '2017-06-05 19:54:12', '2017-06-09 14:32:49', NULL, 2),
	(3, 'João Funcionário', 'joao-funcionario', '025.735.600-23', 'Bairro São Geraldo, Rua São Boaventura, 142, Bl.4, Apto.403, teste', NULL, '2017-05-12', NULL, 1, '2017-06-09 14:42:24', '2017-06-09 14:42:54', NULL, 4);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;

-- Copiando estrutura para tabela ong.envent_patrimony
CREATE TABLE IF NOT EXISTS `envent_patrimony` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patrimony_id` int(10) unsigned NOT NULL,
  `event_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `envent_patrimony_patrimony_id_foreign` (`patrimony_id`),
  KEY `envent_patrimony_event_id_foreign` (`event_id`),
  CONSTRAINT `envent_patrimony_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `envent_patrimony_patrimony_id_foreign` FOREIGN KEY (`patrimony_id`) REFERENCES `patrimonies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ong.envent_patrimony: ~0 rows (aproximadamente)
DELETE FROM `envent_patrimony`;
/*!40000 ALTER TABLE `envent_patrimony` DISABLE KEYS */;
/*!40000 ALTER TABLE `envent_patrimony` ENABLE KEYS */;

-- Copiando estrutura para tabela ong.events
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `organizer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `begin_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `situation` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events_image_id_foreign` (`image_id`),
  CONSTRAINT `events_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ong.events: ~3 rows (aproximadamente)
DELETE FROM `events`;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` (`id`, `name`, `slug`, `description`, `place`, `organizer`, `begin_date`, `end_date`, `situation`, `created_at`, `updated_at`, `image_id`) VALUES
	(1, '1º Espaço Easy - Frederico Westphalen', '1o-espaco-easy-frederico-westphalen', 'dsads', 'Frederico Westphalen - Ecco Eventos', 'Vinícius Ribas Samuel dos Santos', '2017-05-24', '2017-05-31', 1, '2017-05-26 00:46:14', '2017-05-26 00:46:14', NULL),
	(3, '2º encontro de ONGs de Frederico Westphalen', '2o-encontro-de-ongs-de-frederico-westphalen', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'CTG Rodeio da Querência - FW', 'Vinicisu', '2017-06-09', '2017-06-17', 1, '2017-06-09 18:39:40', '2017-06-09 18:39:55', NULL),
	(4, 'evento 3', 'evento-3', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'URI - salão de atos', 'Andre', '2017-06-10', '2017-06-11', 1, '2017-06-09 23:12:47', '2017-06-09 23:12:47', NULL);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;

-- Copiando estrutura para tabela ong.images
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `src` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ext` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ong.images: ~0 rows (aproximadamente)
DELETE FROM `images`;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
/*!40000 ALTER TABLE `images` ENABLE KEYS */;

-- Copiando estrutura para tabela ong.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message_id` int(10) unsigned DEFAULT NULL,
  `user_send` int(10) unsigned NOT NULL,
  `user_receiver` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_message_id_foreign` (`message_id`),
  KEY `messages_user_send_foreign` (`user_send`),
  KEY `messages_user_receiver_foreign` (`user_receiver`),
  CONSTRAINT `messages_message_id_foreign` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `messages_user_receiver_foreign` FOREIGN KEY (`user_receiver`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `messages_user_send_foreign` FOREIGN KEY (`user_send`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ong.messages: ~0 rows (aproximadamente)
DELETE FROM `messages`;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

-- Copiando estrutura para tabela ong.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ong.migrations: ~23 rows (aproximadamente)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2017_05_02_143428_entrust_setup_tables', 1),
	(4, '2017_05_05_134325_create_teachers_table', 1),
	(5, '2017_05_05_134349_create_students_table', 1),
	(6, '2017_05_05_134450_create_patrimonies_table', 1),
	(7, '2017_05_05_135229_create_employees_table', 1),
	(9, '2017_05_05_144051_create_events_table', 1),
	(11, '2017_05_05_171312_create_category_patrimonies_table', 1),
	(12, '2017_05_05_174848_create_messages_table', 1),
	(13, '2017_05_05_175031_create_images_table', 1),
	(14, '2017_05_05_184459_events_patrimonies', 1),
	(16, '2017_05_05_184554_students_tests', 1),
	(17, '2017_05_05_200253_image_add_columns', 1),
	(21, '2017_05_05_135957_create_subjects_table', 2),
	(22, '2017_05_26_133914_create_subject_times_table', 2),
	(23, '2017_05_27_184519_students_subjects', 2),
	(24, '2017_05_27_185912_addColumnSubjectinSubjectTime', 3),
	(25, '2017_05_27_195353_create_tests_table', 4),
	(27, '2017_05_27_224421_create_reserves_table', 5),
	(30, '2017_06_02_235748_addUserRelation', 6),
	(33, '2017_06_07_205744_addColumnweekdayinSubjectTime', 7),
	(35, '2017_06_08_164602_create_notations_table', 8);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Copiando estrutura para tabela ong.notations
CREATE TABLE IF NOT EXISTS `notations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nota` int(11) NOT NULL,
  `test_id` int(10) unsigned DEFAULT NULL,
  `student_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notations_test_id_foreign` (`test_id`),
  KEY `notations_student_id_foreign` (`student_id`),
  CONSTRAINT `notations_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `notations_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ong.notations: ~3 rows (aproximadamente)
DELETE FROM `notations`;
/*!40000 ALTER TABLE `notations` DISABLE KEYS */;
INSERT INTO `notations` (`id`, `nota`, `test_id`, `student_id`, `created_at`, `updated_at`) VALUES
	(1, 28, 3, 1, '2017-06-08 19:11:31', '2017-06-08 19:20:38'),
	(2, 20, 3, 2, '2017-06-08 19:11:35', '2017-06-08 19:11:35'),
	(3, 30, 4, 1, '2017-06-09 23:18:04', '2017-06-09 23:18:04');
/*!40000 ALTER TABLE `notations` ENABLE KEYS */;

-- Copiando estrutura para tabela ong.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ong.password_resets: ~0 rows (aproximadamente)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Copiando estrutura para tabela ong.patrimonies
CREATE TABLE IF NOT EXISTS `patrimonies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `qtd` int(11) NOT NULL,
  `price` double DEFAULT NULL,
  `situation` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patrimonies_image_id_foreign` (`image_id`),
  CONSTRAINT `patrimonies_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ong.patrimonies: ~1 rows (aproximadamente)
DELETE FROM `patrimonies`;
/*!40000 ALTER TABLE `patrimonies` DISABLE KEYS */;
INSERT INTO `patrimonies` (`id`, `slug`, `name`, `key`, `qtd`, `price`, `situation`, `created_at`, `updated_at`, `image_id`) VALUES
	(1, 'projetor-preto-philco-ph001-01', 'Projetor Preto Philco PH001 01', 'ONG-00001', 1, 40.6, 1, '2017-05-25 23:12:02', '2017-06-09 18:15:48', NULL);
/*!40000 ALTER TABLE `patrimonies` ENABLE KEYS */;

-- Copiando estrutura para tabela ong.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ong.permissions: ~0 rows (aproximadamente)
DELETE FROM `permissions`;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Copiando estrutura para tabela ong.permission_role
CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ong.permission_role: ~0 rows (aproximadamente)
DELETE FROM `permission_role`;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;

-- Copiando estrutura para tabela ong.reserves
CREATE TABLE IF NOT EXISTS `reserves` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `day` date NOT NULL,
  `subject_time_id` int(10) unsigned DEFAULT NULL,
  `event_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `patrimony_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reserves_subject_time_id_foreign` (`subject_time_id`),
  KEY `reserves_event_id_foreign` (`event_id`),
  KEY `reserves_user_id_foreign` (`user_id`),
  KEY `reserves_patrimony_id_foreign` (`patrimony_id`),
  CONSTRAINT `reserves_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reserves_patrimony_id_foreign` FOREIGN KEY (`patrimony_id`) REFERENCES `patrimonies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reserves_subject_time_id_foreign` FOREIGN KEY (`subject_time_id`) REFERENCES `subject_times` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reserves_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ong.reserves: ~6 rows (aproximadamente)
DELETE FROM `reserves`;
/*!40000 ALTER TABLE `reserves` DISABLE KEYS */;
INSERT INTO `reserves` (`id`, `day`, `subject_time_id`, `event_id`, `user_id`, `patrimony_id`, `created_at`, `updated_at`) VALUES
	(4, '2017-06-02', 1, NULL, 1, 1, '2017-06-02 19:57:15', '2017-06-02 19:57:15'),
	(6, '2017-06-07', NULL, 1, NULL, 1, '2017-06-07 02:32:15', '2017-06-07 02:32:15'),
	(7, '2017-06-08', 1, NULL, 3, 1, '2017-06-07 19:25:43', '2017-06-07 19:25:43'),
	(8, '2017-06-16', NULL, 3, 1, 1, '2017-06-09 18:40:09', '2017-06-09 18:40:09'),
	(9, '2017-06-10', NULL, 4, 1, 1, '2017-06-09 23:13:03', '2017-06-09 23:13:03'),
	(10, '2017-06-29', 7, NULL, 3, 1, '2017-06-09 23:15:50', '2017-06-09 23:15:50');
/*!40000 ALTER TABLE `reserves` ENABLE KEYS */;

-- Copiando estrutura para tabela ong.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ong.roles: ~3 rows (aproximadamente)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'teacher', 'Professores', 'role for teachers', NULL, NULL),
	(2, 'employee', 'Funcionarios', 'role for employee', NULL, NULL),
	(3, 'root', 'Admin', 'role for root users', NULL, NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Copiando estrutura para tabela ong.role_user
CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ong.role_user: ~6 rows (aproximadamente)
DELETE FROM `role_user`;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
	(3, 1),
	(6, 1),
	(7, 1),
	(2, 2),
	(4, 2),
	(1, 3);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;

-- Copiando estrutura para tabela ong.students
CREATE TABLE IF NOT EXISTS `students` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `begin_date` date NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `situation` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `students_image_id_foreign` (`image_id`),
  CONSTRAINT `students_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ong.students: ~3 rows (aproximadamente)
DELETE FROM `students`;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` (`id`, `name`, `slug`, `cpf`, `address`, `begin_date`, `type`, `end_date`, `situation`, `created_at`, `updated_at`, `image_id`) VALUES
	(1, 'Aluno 1', 'aluno-1', '025.735.600-23', 'teste', '2017-05-10', NULL, NULL, 1, '2017-05-25 21:52:09', '2017-05-25 22:29:42', NULL),
	(2, 'Aluno 2', 'aluno-2', '025.735.600-23', 'fafewfaef', '2017-06-08', NULL, NULL, 1, '2017-06-08 03:03:20', '2017-06-08 03:03:20', NULL),
	(4, 'Aluno 3 ', 'aluno-3', '025.735.600-23', 'Rua Huxley, 560, sala 05', '2017-06-08', NULL, NULL, 1, '2017-06-09 15:48:14', '2017-06-09 15:48:14', NULL);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;

-- Copiando estrutura para tabela ong.student_subject_time
CREATE TABLE IF NOT EXISTS `student_subject_time` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(10) unsigned NOT NULL,
  `subject_time_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_subject_time_student_id_foreign` (`student_id`),
  KEY `student_subject_time_subject_time_id_foreign` (`subject_time_id`),
  CONSTRAINT `student_subject_time_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `student_subject_time_subject_time_id_foreign` FOREIGN KEY (`subject_time_id`) REFERENCES `subject_times` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ong.student_subject_time: ~6 rows (aproximadamente)
DELETE FROM `student_subject_time`;
/*!40000 ALTER TABLE `student_subject_time` DISABLE KEYS */;
INSERT INTO `student_subject_time` (`id`, `student_id`, `subject_time_id`, `created_at`, `updated_at`) VALUES
	(3, 2, 5, '2017-06-08 04:33:01', '2017-06-08 04:33:01'),
	(5, 1, 5, '2017-06-08 04:37:16', '2017-06-08 04:37:16'),
	(6, 1, 1, '2017-06-08 16:34:07', '2017-06-08 16:34:07'),
	(9, 4, 1, '2017-06-09 23:11:20', '2017-06-09 23:11:20'),
	(10, 1, 6, '2017-06-09 23:17:37', '2017-06-09 23:17:37'),
	(11, 2, 6, '2017-06-09 23:17:40', '2017-06-09 23:17:40');
/*!40000 ALTER TABLE `student_subject_time` ENABLE KEYS */;

-- Copiando estrutura para tabela ong.student_test
CREATE TABLE IF NOT EXISTS `student_test` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(10) unsigned NOT NULL,
  `test_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_test_student_id_foreign` (`student_id`),
  KEY `student_test_test_id_foreign` (`test_id`),
  CONSTRAINT `student_test_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `student_test_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ong.student_test: ~0 rows (aproximadamente)
DELETE FROM `student_test`;
/*!40000 ALTER TABLE `student_test` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_test` ENABLE KEYS */;

-- Copiando estrutura para tabela ong.subjects
CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `situation` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ong.subjects: ~3 rows (aproximadamente)
DELETE FROM `subjects`;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` (`id`, `name`, `slug`, `situation`, `created_at`, `updated_at`) VALUES
	(1, 'Engenharia de Software III', 'engenharia-de-software-iii', 1, '2017-05-26 14:29:39', '2017-05-26 14:30:35'),
	(3, 'Complexidade Computacional', 'complexidade-computacional', 1, '2017-06-07 21:51:49', '2017-06-09 15:49:06'),
	(4, 'Calculo 1', 'calculo-1', 1, '2017-06-09 16:15:01', '2017-06-09 16:15:01');
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;

-- Copiando estrutura para tabela ong.subject_times
CREATE TABLE IF NOT EXISTS `subject_times` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `half` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `situation` tinyint(1) NOT NULL,
  `teacher_id` int(10) unsigned NOT NULL,
  `teacher2_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `subject_id` int(10) unsigned DEFAULT NULL,
  `week_day` int(10) unsigned DEFAULT NULL,
  `credit` int(10) unsigned DEFAULT NULL,
  `place` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject_times_teacher_id_foreign` (`teacher_id`),
  KEY `subject_times_teacher2_id_foreign` (`teacher2_id`),
  KEY `subject_times_subject_id_foreign` (`subject_id`),
  CONSTRAINT `subject_times_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `subject_times_teacher2_id_foreign` FOREIGN KEY (`teacher2_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `subject_times_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ong.subject_times: ~4 rows (aproximadamente)
DELETE FROM `subject_times`;
/*!40000 ALTER TABLE `subject_times` DISABLE KEYS */;
INSERT INTO `subject_times` (`id`, `year`, `half`, `situation`, `teacher_id`, `teacher2_id`, `created_at`, `updated_at`, `subject_id`, `week_day`, `credit`, `place`) VALUES
	(1, 2017, '1-semestre', 1, 2, NULL, '2017-05-26 19:45:09', '2017-06-09 19:23:54', 1, 2, 4, 'Sala 2'),
	(5, 2017, '2-semestre', 1, 2, NULL, '2017-06-07 22:07:52', '2017-06-07 22:07:52', 3, 4, 4, 'Sala 3'),
	(6, 2017, '1-semestre', 1, 2, NULL, '2017-06-09 17:25:57', '2017-06-09 18:04:24', 1, 1, NULL, NULL),
	(7, 2017, '2-semestre', 1, 2, NULL, '2017-06-09 19:10:29', '2017-06-09 19:15:27', 4, 5, NULL, 'Sala 02');
/*!40000 ALTER TABLE `subject_times` ENABLE KEYS */;

-- Copiando estrutura para tabela ong.teachers
CREATE TABLE IF NOT EXISTS `teachers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `begin_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `situation` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teachers_user_id_unique` (`user_id`),
  KEY `teachers_image_id_foreign` (`image_id`),
  CONSTRAINT `teachers_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `teachers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ong.teachers: ~3 rows (aproximadamente)
DELETE FROM `teachers`;
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
INSERT INTO `teachers` (`id`, `name`, `slug`, `cpf`, `address`, `begin_date`, `end_date`, `situation`, `created_at`, `updated_at`, `image_id`, `user_id`) VALUES
	(2, 'João da Silva', 'teacher-2', '185.140.610-70', 'Bairro São Geraldo, Rua São Boaventura, 142, Bl.4, Apto.403', '2017-06-09', NULL, 1, '2017-06-07 02:30:43', '2017-06-09 23:10:25', NULL, 3),
	(3, 'João Professor', 'joao-professor', '025.735.600-23', 'Av Cel. Otavio Tosta, 910, Centro', '2017-04-20', NULL, 1, '2017-06-09 15:07:31', '2017-06-09 15:09:33', NULL, 6),
	(4, 'professor', 'professor', '025.735.600-23', 'teste', '2017-01-04', NULL, 1, '2017-06-09 23:14:47', '2017-06-09 23:14:47', NULL, 7);
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;

-- Copiando estrutura para tabela ong.tests
CREATE TABLE IF NOT EXISTS `tests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `weight` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `day` date NOT NULL,
  `subject_time_id` int(10) unsigned NOT NULL,
  `teacher_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tests_teacher_id_foreign` (`teacher_id`),
  KEY `tests_subject_time_id_foreign` (`subject_time_id`),
  CONSTRAINT `tests_subject_time_id_foreign` FOREIGN KEY (`subject_time_id`) REFERENCES `subject_times` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tests_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ong.tests: ~2 rows (aproximadamente)
DELETE FROM `tests`;
/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
INSERT INTO `tests` (`id`, `name`, `slug`, `weight`, `day`, `subject_time_id`, `teacher_id`, `created_at`, `updated_at`) VALUES
	(3, 'Prova de 20', '2o-prova', '30', '2017-06-16', 1, 2, '2017-06-07 20:12:34', '2017-06-08 02:04:03'),
	(4, 'Prova final', 'prova-final', '50', '2017-06-11', 6, 2, '2017-06-09 23:16:34', '2017-06-09 23:16:34');
/*!40000 ALTER TABLE `tests` ENABLE KEYS */;

-- Copiando estrutura para tabela ong.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ong.users: ~6 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'vinicius  dos santos', 'vinirssantos@gmail.com', '$2y$10$zzNoCNWxG1NmAv3xvGy14.mhM1xjJNtVhM6fnJpiek9SFbx9ognAS', 'BcCefdrmHGObxhyIwzVd2ViC5ZsTufa3xoy0geYBVp7TeoAtZsZQBFncW3hg', '2017-05-25 21:31:04', '2017-06-09 23:14:54'),
	(2, 'Vinícius Ribas Samuel dos Santos', 'vinicius@easyauth.net', '$2y$10$Y7meV6eOok8uvBfwLPkJ9.JTOzizpy34b6oRLOas3N0CxNmClldFG', NULL, '2017-06-02 23:48:53', '2017-06-03 01:11:18'),
	(3, 'João da Silva', 'teacher@goodteacher.com', '$2y$10$dRunsRHLOF/3y2McPYqcheUm4UxNLd2Knc8MUhOXESxJKxzCDeAYy', 'ceistYrPuqPep8pDnRjdl1o8hYY9thgsBvuDtyb0clsItjokRtpW9aoos7HM', '2017-06-07 02:30:21', '2017-06-09 19:09:18'),
	(4, 'João Funcionário', 'joao@funcionario.com', '$2y$10$faoehJD7DeOiLHOQPAWvsud/NAiP9RKA7Q38wmJJ1rii7HInoWp66', NULL, '2017-06-09 14:41:36', '2017-06-09 18:05:54'),
	(6, 'João Professor', 'joao@professor.com.br', '$2y$10$txE9FtW9fcnySjfoiZEkVedoMmkWXKY.zULWL7o.vdpQG.ro2XU16', NULL, '2017-06-09 15:05:02', '2017-06-09 15:05:02'),
	(7, 'Exemplo', 'exemplo@easyauth.net', '$2y$10$Jar1WDZybFZykSGRH/.X5.abRRuAom22p6ib86hxYCfWqS6A7A6PS', NULL, '2017-06-09 23:14:14', '2017-06-09 23:14:14');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
