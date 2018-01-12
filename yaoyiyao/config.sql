/*
Navicat MySQL Data Transfer

Source Server         : 美亨投资
Source Server Version : 50165
Source Host           : meihengtouzi.gotoftp4.com:3306
Source Database       : meihengtouzi

Target Server Type    : MYSQL
Target Server Version : 50165
File Encoding         : 65001

Date: 2015-09-23 10:19:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `config`
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `project` varchar(20) NOT NULL,
  `counts` int(3) NOT NULL,
  `day_counts` int(3) NOT NULL,
  `update_time` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('30', 'xindi', '10', '4', '1442851200');

-- ----------------------------
-- Table structure for `data`
-- ----------------------------
DROP TABLE IF EXISTS `data`;
CREATE TABLE `data` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phonenum` varchar(15) NOT NULL,
  `zone` varchar(15) NOT NULL,
  `submit_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=144 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of data
-- ----------------------------
INSERT INTO `data` VALUES ('127', '黄垅', '15918644590', '', '2015-09-22 14:37:13');
