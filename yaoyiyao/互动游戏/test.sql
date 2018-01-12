/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2015-09-28 11:20:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `config`
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `counts` int(3) NOT NULL,
  `day_counts` int(3) NOT NULL,
  `update_time` int(11) NOT NULL,
  `start_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('1', 'jindi', '431', '27', '1442448000', '2015-09-14 14:41:52', '2015-09-24 14:41:38');

-- ----------------------------
-- Table structure for `data`
-- ----------------------------
DROP TABLE IF EXISTS `data`;
CREATE TABLE `data` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phonenum` varchar(15) NOT NULL,
  `submit_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of data
-- ----------------------------
INSERT INTO `data` VALUES ('119', 'dd', '22', '2015-09-17 16:35:18');
INSERT INTO `data` VALUES ('120', '换行导图', '22', '2015-09-17 16:51:40');
INSERT INTO `data` VALUES ('121', '滴答', '333', '2015-09-17 17:07:46');
INSERT INTO `data` VALUES ('122', '滴答', '333', '2015-09-17 17:10:02');
INSERT INTO `data` VALUES ('123', 's', '43', '2015-09-17 17:18:08');

-- ----------------------------
-- Table structure for `demo`
-- ----------------------------
DROP TABLE IF EXISTS `demo`;
CREATE TABLE `demo` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `project` varchar(20) NOT NULL,
  `counts` int(3) NOT NULL,
  `counts2` int(3) NOT NULL,
  `counts3` int(3) NOT NULL,
  `update_time` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of demo
-- ----------------------------
INSERT INTO `demo` VALUES ('33', 'demo', '3', '10', '20', '1443139200');
