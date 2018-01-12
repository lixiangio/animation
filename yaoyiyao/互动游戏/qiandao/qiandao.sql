/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : qiandao

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2015-09-28 11:23:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `myguests`
-- ----------------------------
DROP TABLE IF EXISTS `myguests`;
CREATE TABLE `myguests` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of myguests
-- ----------------------------
INSERT INTO `myguests` VALUES ('1', 'John', 'Doe', 'john@example.com', '2015-07-10 19:50:53');

-- ----------------------------
-- Table structure for `sign`
-- ----------------------------
DROP TABLE IF EXISTS `sign`;
CREATE TABLE `sign` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `dateline` varchar(10) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of sign
-- ----------------------------
INSERT INTO `sign` VALUES ('1', '1389072071');
INSERT INTO `sign` VALUES ('2', '1389072735');
INSERT INTO `sign` VALUES ('10', '55555');
INSERT INTO `sign` VALUES ('11', '55555');
INSERT INTO `sign` VALUES ('12', '55555');
INSERT INTO `sign` VALUES ('13', '55555');
INSERT INTO `sign` VALUES ('14', '55555');
INSERT INTO `sign` VALUES ('15', '55555');
INSERT INTO `sign` VALUES ('16', '55555');
INSERT INTO `sign` VALUES ('17', '55555');
INSERT INTO `sign` VALUES ('18', '55555');
INSERT INTO `sign` VALUES ('19', '55555');
INSERT INTO `sign` VALUES ('20', '55555');
INSERT INTO `sign` VALUES ('21', '55555');
INSERT INTO `sign` VALUES ('22', '55555');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `telephone` int(11) NOT NULL COMMENT '签到天数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'hehe', '558');
INSERT INTO `user` VALUES ('2', '几岁', '545888');
