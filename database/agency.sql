/*
Navicat MySQL Data Transfer

Source Server         : Local Mysql Server
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : agency

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2017-05-01 18:26:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for activity_items
-- ----------------------------
DROP TABLE IF EXISTS `activity_items`;
CREATE TABLE `activity_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `activity_items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of activity_items
-- ----------------------------
INSERT INTO `activity_items` VALUES ('1', 'carpet cleaning', null, '2');
INSERT INTO `activity_items` VALUES ('2', 'cleaning of tiles', null, '2');

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', 'cleaning', '', null);
INSERT INTO `categories` VALUES ('2', 'cleaning room', null, '1');
INSERT INTO `categories` VALUES ('3', 'cleaning street', null, '1');
INSERT INTO `categories` VALUES ('4', 'wash', null, null);

-- ----------------------------
-- Table structure for clients
-- ----------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of clients
-- ----------------------------
INSERT INTO `clients` VALUES ('1', 'ViP Client');

-- ----------------------------
-- Table structure for employee_category
-- ----------------------------
DROP TABLE IF EXISTS `employee_category`;
CREATE TABLE `employee_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_category_ibfk_1` (`employee_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `employee_category_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `employee_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of employee_category
-- ----------------------------
INSERT INTO `employee_category` VALUES ('1', '1', '1');
INSERT INTO `employee_category` VALUES ('2', '2', '2');
INSERT INTO `employee_category` VALUES ('3', '1', '2');

-- ----------------------------
-- Table structure for employee_status
-- ----------------------------
DROP TABLE IF EXISTS `employee_status`;
CREATE TABLE `employee_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `of_activity_id` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `finish` datetime NOT NULL,
  `employee_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `of_activity_id` (`of_activity_id`),
  KEY `employee_id` (`employee_id`),
  CONSTRAINT `employee_status_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `employee_status_ibfk_2` FOREIGN KEY (`of_activity_id`) REFERENCES `activity_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `employee_status_ibfk_3` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of employee_status
-- ----------------------------
INSERT INTO `employee_status` VALUES ('3', '1', '1', '2017-04-29 16:29:20', '2017-04-29 20:30:20', '2');

-- ----------------------------
-- Table structure for employees
-- ----------------------------
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `gander` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `rate` int(11) NOT NULL,
  `cost` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of employees
-- ----------------------------
INSERT INTO `employees` VALUES ('1', 'Test', '25', '70', 'male', 'black', 'From messa ', '10', '500');
INSERT INTO `employees` VALUES ('2', 'New', '37', '82', 'male', 'black', 'From cat', '6', '300');
INSERT INTO `employees` VALUES ('3', 'New', '37', '82', 'male', 'black', 'From cat', '6', '300');
INSERT INTO `employees` VALUES ('4', 'New', '37', '82', 'male', 'black', 'From cat', '6', '300');
INSERT INTO `employees` VALUES ('5', 'New', '37', '55', 'male', 'black', 'From cat', '6', '300');
INSERT INTO `employees` VALUES ('6', 'New', '37', '55', 'male', 'black', 'From cat', '6', '300');
INSERT INTO `employees` VALUES ('7', 'New', '37', '55', 'male', 'black', 'From cat', '6', '300');
INSERT INTO `employees` VALUES ('8', 'New', '37', '55', 'male', 'black', 'From cat', '6', '300');

-- ----------------------------
-- Table structure for exchange_rate
-- ----------------------------
DROP TABLE IF EXISTS `exchange_rate`;
CREATE TABLE `exchange_rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cattle` int(11) NOT NULL,
  `actuale` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of exchange_rate
-- ----------------------------
SET FOREIGN_KEY_CHECKS=1;
