/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 50509
 Source Host           : 127.0.0.1
 Source Database       : dashboard

 Target Server Type    : MySQL
 Target Server Version : 50509
 File Encoding         : utf-8

 Date: 04/25/2012 11:54:02 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `api_keys`
-- ----------------------------
DROP TABLE IF EXISTS `api_keys`;
CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `api_keys`
-- ----------------------------
BEGIN;
INSERT INTO `api_keys` VALUES ('4', '7b7ecd6b708340da94fa08134c46f34c2fce159b', '10', '1', '1334851066'), ('7', '009a25f7e606b52fa3587d531df4f1b44d930565', '1', '1', '1334852251'), ('8', 'de4f198253fc7dd62a1b6731cb3f351c9991874a', '1', '1', '1335251033');
COMMIT;

-- ----------------------------
--  Table structure for `api_logs`
-- ----------------------------
DROP TABLE IF EXISTS `api_logs`;
CREATE TABLE `api_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text NOT NULL,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `time` int(11) NOT NULL,
  `authorized` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `api_rate_limits`
-- ----------------------------
DROP TABLE IF EXISTS `api_rate_limits`;
CREATE TABLE `api_rate_limits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `onetime_password`
-- ----------------------------
DROP TABLE IF EXISTS `onetime_password`;
CREATE TABLE `onetime_password` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `values` longtext,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `flags` enum('normal','deleted') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `open_ids`
-- ----------------------------
DROP TABLE IF EXISTS `open_ids`;
CREATE TABLE `open_ids` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(10) NOT NULL DEFAULT '0',
  `service` enum('facebook') NOT NULL,
  `uid` bigint(30) NOT NULL,
  `access_token` longtext,
  `created_at` datetime NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_user_id` (`service`,`uid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `open_ids`
-- ----------------------------
BEGIN;
INSERT INTO `open_ids` VALUES ('2', '10', 'facebook', '100000389829908', null, '2012-04-24 10:56:15', null);
COMMIT;

-- ----------------------------
--  Table structure for `publishers`
-- ----------------------------
DROP TABLE IF EXISTS `publishers`;
CREATE TABLE `publishers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `active` tinyint(4) NOT NULL,
  `flags` enum('normal','deleted') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `resources`
-- ----------------------------
DROP TABLE IF EXISTS `resources`;
CREATE TABLE `resources` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `controller` varchar(30) NOT NULL,
  `action` varchar(30) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `group` varchar(50) DEFAULT NULL,
  `types` enum('access','keyword') NOT NULL DEFAULT 'access',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `controller_action` (`controller`,`action`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `resources`
-- ----------------------------
BEGIN;
INSERT INTO `resources` VALUES ('3', '#all', '#all', 'Access all site, you shouldn\'t give this to anyone except God.', 'Admin', 'access', '1'), ('5', 'home:home', 'index', 'Home page, the top of website.', 'Home', 'access', '1'), ('6', 'labs:labs', '#all', 'Access al labs.', 'Labs', 'access', '1'), ('7', 'dashboard:dashboard', 'user', 'User dashboard.', 'Dashboard', 'access', '1'), ('8', 'dashboard:admin', 'index', 'Admin dashboard.', 'Dashboard', 'access', '1'), ('9', 'dashboard:dashboard', 'publisher', 'Publisher dashboard.', 'Dashboard', 'access', '1'), ('10', 'roles:admin', 'resources_manage', 'Manage resources and apply to a role.', 'Roles', 'access', '1'), ('11', 'users:auth', 'sign_in', 'The page for user sign in.', 'Users', 'access', '1'), ('12', 'users:auth', 'sign_out', 'The page for user sign out.', 'Users', 'access', '1'), ('13', 'dashboard:dashboard', 'index', 'Just a redirection to user dashboard.', 'Dashboard', 'access', '1'), ('14', 'roles:admin', 'index', 'Just a redirection to role listing.', 'Roles', 'access', '1'), ('15', 'roles:admin', 'roles_manage', 'The list of roles.', 'Roles', 'access', '1'), ('17', 'users:auth', 'index', 'Just a redirection to sign in page.', 'Users', 'access', '1'), ('18', 'users:auth', 'connect', 'Login using social connect.', 'Users', 'access', '1'), ('19', 'users:register', 'index', 'Just a redirection to user register.', 'Users', 'access', '1'), ('20', 'users:register', 'user', 'The form register to be a user.', 'Users', 'access', '1'), ('21', 'users:register', 'publisher', 'The form register to be a publisher.', 'Users', 'access', '1'), ('22', 'users:register', 'connect', 'Sign up using social connect', 'Users', 'access', '1'), ('23', 'users:register', 'merge', 'Merge existing account with social connect.', 'Users', 'access', '1'), ('24', 'roles:admin', 'resources_add', null, 'Roles', 'access', '1');
COMMIT;

-- ----------------------------
--  Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` varchar(100) NOT NULL,
  `inherit` varchar(100) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `flags` enum('normal','deleted') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `inherit` (`inherit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `roles`
-- ----------------------------
BEGIN;
INSERT INTO `roles` VALUES ('Admin', 'Moderator', 'Admin', 'User who add something to our site', '7', '2012-04-09 21:41:45', '2012-04-09 21:41:47', '1', 'normal'), ('Editor', 'Publisher', 'Editor', 'User who review our site', '4', '2012-04-08 17:45:55', '2012-04-08 17:45:57', '1', 'normal'), ('God', 'Admin', 'God', 'User who create our site', '8', '2012-04-09 21:41:50', '2012-04-09 21:41:52', '1', 'normal'), ('Guest', null, 'Guest', 'Low level of user ', '1', '2012-04-08 17:44:20', '2012-04-08 17:44:23', '1', 'normal'), ('Moderator', 'Tester', 'Moderator', 'User who control our site', '6', '2012-04-09 21:41:39', '2012-04-09 21:41:42', '1', 'normal'), ('Publisher', 'User', 'Publisher', 'User who become a merchant', '3', '2012-04-08 17:45:13', '2012-04-08 17:45:17', '1', 'normal'), ('Tester', 'Editor', 'Tester', 'User who test flow our site', '5', '2012-04-08 17:45:33', '2012-04-08 17:45:35', '1', 'normal'), ('User', 'Guest', 'User', 'User who registered', '2', '2012-04-08 17:44:35', '2012-04-08 17:44:38', '1', 'normal');
COMMIT;

-- ----------------------------
--  Table structure for `roles_has_resources`
-- ----------------------------
DROP TABLE IF EXISTS `roles_has_resources`;
CREATE TABLE `roles_has_resources` (
  `role_id` varchar(100) NOT NULL,
  `resource_id` bigint(30) NOT NULL,
  `allow` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`role_id`,`resource_id`),
  KEY `role_id` (`role_id`),
  KEY `resource_id` (`resource_id`),
  CONSTRAINT `roles_resources_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `roles_has_resources`
-- ----------------------------
BEGIN;
INSERT INTO `roles_has_resources` VALUES ('Admin', '1', '1'), ('Admin', '2', '1'), ('Admin', '3', '0'), ('Admin', '4', '1'), ('Admin', '5', '1'), ('Admin', '6', '1'), ('Admin', '7', '1'), ('Admin', '8', '1'), ('Admin', '9', '1'), ('Admin', '24', '1'), ('Editor', '1', '1'), ('Editor', '2', '1'), ('Editor', '3', '0'), ('Editor', '4', '1'), ('Editor', '5', '1'), ('Editor', '6', '1'), ('Editor', '7', '1'), ('Editor', '8', '0'), ('Editor', '9', '1'), ('God', '1', '1'), ('God', '2', '1'), ('God', '3', '1'), ('God', '4', '1'), ('God', '5', '1'), ('God', '6', '1'), ('God', '7', '1'), ('God', '8', '1'), ('God', '9', '1'), ('Guest', '3', '0'), ('Guest', '5', '1'), ('Guest', '6', '1'), ('Guest', '7', '0'), ('Guest', '10', '0'), ('Guest', '11', '1'), ('Guest', '12', '1'), ('Guest', '13', '0'), ('Guest', '14', '0'), ('Guest', '15', '0'), ('Guest', '17', '1'), ('Guest', '18', '1'), ('Guest', '19', '1'), ('Guest', '20', '1'), ('Guest', '21', '0'), ('Guest', '22', '1'), ('Guest', '23', '1'), ('Guest', '27', '1'), ('Guest', '28', '1'), ('Guest', '29', '1'), ('Moderator', '3', '0'), ('Moderator', '5', '1'), ('Moderator', '6', '1'), ('Moderator', '7', '1'), ('Moderator', '8', '1'), ('Moderator', '9', '1'), ('Moderator', '10', '1'), ('Moderator', '11', '1'), ('Moderator', '12', '1'), ('Moderator', '13', '1'), ('Moderator', '14', '1'), ('Moderator', '15', '1'), ('Moderator', '17', '1'), ('Moderator', '18', '1'), ('Moderator', '19', '1'), ('Moderator', '20', '1'), ('Moderator', '21', '1'), ('Moderator', '22', '1'), ('Moderator', '23', '1'), ('Publisher', '1', '1'), ('Publisher', '2', '1'), ('Publisher', '3', '0'), ('Publisher', '4', '1'), ('Publisher', '5', '1'), ('Publisher', '6', '1'), ('Publisher', '7', '1'), ('Publisher', '8', '0'), ('Publisher', '9', '1'), ('User', '1', '1'), ('User', '2', '1'), ('User', '3', '0'), ('User', '4', '1'), ('User', '5', '1'), ('User', '6', '0'), ('User', '7', '1'), ('User', '8', '0'), ('User', '9', '0'), ('User', '10', '0'), ('User', '11', '1'), ('User', '12', '1'), ('User', '13', '1'), ('User', '14', '0'), ('User', '15', '0'), ('User', '17', '1'), ('User', '18', '1'), ('User', '19', '1'), ('User', '20', '1'), ('User', '21', '1'), ('User', '22', '1'), ('User', '23', '1');
COMMIT;

-- ----------------------------
--  Table structure for `terms`
-- ----------------------------
DROP TABLE IF EXISTS `terms`;
CREATE TABLE `terms` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `pub_id` bigint(20) DEFAULT NULL,
  `vocabulary_id` int(10) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text NOT NULL,
  `weight` mediumint(5) DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `flags` enum('normal','deleted') NOT NULL DEFAULT 'normal',
  PRIMARY KEY (`id`),
  KEY `user_id_vocabulary_id` (`user_id`,`vocabulary_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `terms`
-- ----------------------------
BEGIN;
INSERT INTO `terms` VALUES ('1', null, null, '1', 'A', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'normal'), ('2', null, null, '1', 'B', '', '-1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'normal'), ('3', null, null, '1', 'C', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'normal'), ('4', null, null, '1', 'B-1', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'normal'), ('5', null, null, '1', 'B-2', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'normal'), ('6', null, null, '1', 'B-1-1', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'normal'), ('7', null, null, '1', 'B-1-2', '', '-1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'normal'), ('8', null, null, '1', 'B-1-1-1', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'normal'), ('9', null, null, '1', 'B-1-1-1-1', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'normal');
COMMIT;

-- ----------------------------
--  Table structure for `terms_hierarchies`
-- ----------------------------
DROP TABLE IF EXISTS `terms_hierarchies`;
CREATE TABLE `terms_hierarchies` (
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `pub_id` bigint(20) NOT NULL,
  `term_id` int(10) NOT NULL DEFAULT '0',
  `term_parent_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`,`term_parent_id`),
  KEY `term_id` (`term_id`),
  KEY `term_parent_id` (`term_parent_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `terms_hierarchies`
-- ----------------------------
BEGIN;
INSERT INTO `terms_hierarchies` VALUES ('0', '0', '1', '0'), ('0', '0', '2', '0'), ('0', '0', '3', '0'), ('0', '0', '4', '2'), ('0', '0', '5', '2'), ('0', '0', '6', '4'), ('0', '0', '7', '4'), ('0', '0', '8', '6'), ('0', '0', '9', '8');
COMMIT;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `role_id` varchar(50) NOT NULL DEFAULT 'User',
  `username` varchar(200) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(50) DEFAULT NULL,
  `last_access` datetime DEFAULT NULL,
  `registered` enum('web','facebook','twitter') NOT NULL DEFAULT 'web',
  `verified` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `flags` enum('normal','deleted') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  KEY `role_id` (`role_id`),
  KEY `identity` (`email`,`password`,`username`) USING BTREE,
  CONSTRAINT `users_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', 'God', 'teepluss', 'teepluss@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '0000-00-00 00:00:00', 'web', '0', '2012-04-24 23:42:38', '2012-04-24 23:42:40', '1', 'normal'), ('10', 'User', 'facebook100000389829908', 'jquerytips@hotmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2012-04-25 00:25:39', 'facebook', '1', '2012-04-23 15:14:58', null, '1', 'normal'), ('11', 'Admin', 'admin', 'admin@dashboard.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2012-04-25 10:48:00', 'web', '0', '2012-04-24 23:42:31', '2012-04-24 23:42:33', '1', 'normal');
COMMIT;

-- ----------------------------
--  Table structure for `users_profile`
-- ----------------------------
DROP TABLE IF EXISTS `users_profile`;
CREATE TABLE `users_profile` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `vocabularies`
-- ----------------------------
DROP TABLE IF EXISTS `vocabularies`;
CREATE TABLE `vocabularies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `slug` varchar(50) NOT NULL,
  `comment` longtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `vocabularies`
-- ----------------------------
BEGIN;
INSERT INTO `vocabularies` VALUES ('1', 'Publisher Types', 'A main terms of publisher', 'publisher_types', null), ('2', 'Publisher Products Types', 'A main terms of products', 'product_types', null), ('3', 'Products Types', 'Publisher products terms', 'products', null);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
