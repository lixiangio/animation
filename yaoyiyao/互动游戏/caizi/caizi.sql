/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : caizi

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2015-09-28 11:22:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `demo`
-- ----------------------------
DROP TABLE IF EXISTS `demo`;
CREATE TABLE `demo` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `answer` text,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of demo
-- ----------------------------
INSERT INTO `demo` VALUES ('9', '呵呵', null);
INSERT INTO `demo` VALUES ('10', '你好啊', null);
INSERT INTO `demo` VALUES ('11', '你好啊', null);
INSERT INTO `demo` VALUES ('12', '你好啊', null);
INSERT INTO `demo` VALUES ('13', '嘻嘻', null);
INSERT INTO `demo` VALUES ('44', '嘻嘻', null);
INSERT INTO `demo` VALUES ('45', '真的好吗', null);
INSERT INTO `demo` VALUES ('46', '真的好吗', null);
INSERT INTO `demo` VALUES ('47', '呵呵', null);
INSERT INTO `demo` VALUES ('48', '呵呵', null);
INSERT INTO `demo` VALUES ('49', '呵呵', null);
INSERT INTO `demo` VALUES ('50', '呵呵真', null);
INSERT INTO `demo` VALUES ('51', '1', null);
INSERT INTO `demo` VALUES ('52', '1', null);
INSERT INTO `demo` VALUES ('53', '这样真的好吗', null);
INSERT INTO `demo` VALUES ('54', '这样真的好吗', null);
INSERT INTO `demo` VALUES ('55', '1', null);
INSERT INTO `demo` VALUES ('56', '哈哈哈！', null);
INSERT INTO `demo` VALUES ('57', '哈哈哈！', null);
INSERT INTO `demo` VALUES ('58', '哈哈哈！', null);
INSERT INTO `demo` VALUES ('59', '哈哈哈！', null);
INSERT INTO `demo` VALUES ('60', '哈哈哈！', null);
INSERT INTO `demo` VALUES ('61', '哈哈哈！', null);
INSERT INTO `demo` VALUES ('62', '哈哈哈！', null);
INSERT INTO `demo` VALUES ('63', '哈哈哈！', null);
INSERT INTO `demo` VALUES ('64', '哈哈哈！', null);
INSERT INTO `demo` VALUES ('65', '哈哈哈！', null);
INSERT INTO `demo` VALUES ('66', '哈哈哈！', null);
INSERT INTO `demo` VALUES ('67', '哈哈哈！', null);
INSERT INTO `demo` VALUES ('68', '222', null);
INSERT INTO `demo` VALUES ('69', '222', null);
INSERT INTO `demo` VALUES ('70', 'ff', null);
INSERT INTO `demo` VALUES ('71', '呵呵', null);
INSERT INTO `demo` VALUES ('72', '呵呵', null);
INSERT INTO `demo` VALUES ('73', '嘻嘻', null);
INSERT INTO `demo` VALUES ('74', '嘻嘻', null);
INSERT INTO `demo` VALUES ('75', '嘻嘻', null);
INSERT INTO `demo` VALUES ('76', '呵呵，猜猜我是谁！', null);
INSERT INTO `demo` VALUES ('77', '呵呵！', null);
INSERT INTO `demo` VALUES ('78', '呵呵2！', null);
INSERT INTO `demo` VALUES ('79', '可以看到初始的目录结构如下', '可以 到初始  录结 如下');
INSERT INTO `demo` VALUES ('80', '呵呵！', null);
INSERT INTO `demo` VALUES ('81', '呵呵呵', null);
INSERT INTO `demo` VALUES ('82', '说说', null);
INSERT INTO `demo` VALUES ('83', '2222', null);
INSERT INTO `demo` VALUES ('84', 'sddd', null);
INSERT INTO `demo` VALUES ('85', 'sddd', null);
INSERT INTO `demo` VALUES ('86', 'sddd', null);
INSERT INTO `demo` VALUES ('87', 'sddd', null);
INSERT INTO `demo` VALUES ('88', '你好', null);
INSERT INTO `demo` VALUES ('89', '你好', null);
INSERT INTO `demo` VALUES ('90', '你好', null);
INSERT INTO `demo` VALUES ('91', '你好', null);
INSERT INTO `demo` VALUES ('92', '你好！！', null);
INSERT INTO `demo` VALUES ('93', '你好', null);
INSERT INTO `demo` VALUES ('94', 'xixi', null);
INSERT INTO `demo` VALUES ('95', 'xixi', null);
INSERT INTO `demo` VALUES ('96', 'xihao', null);
INSERT INTO `demo` VALUES ('97', 'xihao', null);
INSERT INTO `demo` VALUES ('98', 'xihao1', null);
INSERT INTO `demo` VALUES ('99', 'sssa', null);
INSERT INTO `demo` VALUES ('100', '22222', null);
INSERT INTO `demo` VALUES ('101', '22222', null);
INSERT INTO `demo` VALUES ('102', '你好啊', null);
INSERT INTO `demo` VALUES ('103', '你好啊', null);
INSERT INTO `demo` VALUES ('104', '嘻嘻', null);
INSERT INTO `demo` VALUES ('105', '嘻嘻', null);
INSERT INTO `demo` VALUES ('106', '嘻嘻', null);
INSERT INTO `demo` VALUES ('107', '额', null);
INSERT INTO `demo` VALUES ('108', '额', null);
INSERT INTO `demo` VALUES ('109', '额', null);
INSERT INTO `demo` VALUES ('110', 'hehe', null);
INSERT INTO `demo` VALUES ('111', 'hehe', null);
INSERT INTO `demo` VALUES ('112', 'xix', null);
INSERT INTO `demo` VALUES ('113', 'xixi', null);
INSERT INTO `demo` VALUES ('114', 'xixi', null);
INSERT INTO `demo` VALUES ('115', 'xixi', null);
INSERT INTO `demo` VALUES ('116', '呵', null);
INSERT INTO `demo` VALUES ('117', '呵呵呵呵！', null);
INSERT INTO `demo` VALUES ('118', '呵呵', null);
INSERT INTO `demo` VALUES ('119', '呵呵', null);
INSERT INTO `demo` VALUES ('120', '嘻嘻', null);
INSERT INTO `demo` VALUES ('121', '嘻嘻', null);
INSERT INTO `demo` VALUES ('122', '嘻嘻', null);
INSERT INTO `demo` VALUES ('123', '嘻嘻', null);
INSERT INTO `demo` VALUES ('124', '呵呵', null);
INSERT INTO `demo` VALUES ('125', '呵呵', null);
INSERT INTO `demo` VALUES ('126', '呵呵', null);
INSERT INTO `demo` VALUES ('127', '呵呵', null);
INSERT INTO `demo` VALUES ('128', '呵呵', null);
INSERT INTO `demo` VALUES ('129', '你好', null);
INSERT INTO `demo` VALUES ('130', 'xixi', null);
INSERT INTO `demo` VALUES ('131', '你好啊！！！！！！！', null);
INSERT INTO `demo` VALUES ('132', '呵呵', null);
INSERT INTO `demo` VALUES ('133', '嘻嘻', null);
INSERT INTO `demo` VALUES ('134', '嘻嘻，哈哈！', null);
INSERT INTO `demo` VALUES ('135', '和', null);
INSERT INTO `demo` VALUES ('136', '嘻嘻', null);
INSERT INTO `demo` VALUES ('137', '呵呵', null);
INSERT INTO `demo` VALUES ('138', 'xxxx', null);
INSERT INTO `demo` VALUES ('139', '1', null);
INSERT INTO `demo` VALUES ('140', '呵呵', null);
INSERT INTO `demo` VALUES ('141', null, '哈哈哈哈哈哈');
INSERT INTO `demo` VALUES ('142', '11111111111111 111111', '111111111111111111111');
INSERT INTO `demo` VALUES ('143', '', '啊啊啊啊 啊啊啊');
INSERT INTO `demo` VALUES ('144', '', '嘻 嘻');
INSERT INTO `demo` VALUES ('145', '嘻嘻嘻', '嘻 嘻');
INSERT INTO `demo` VALUES ('146', '哈哈哈哈哈哈哈哈哈', '哈哈 哈 哈 哈哈');
INSERT INTO `demo` VALUES ('147', '啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊', '啊啊啊啊啊啊啊 啊啊啊啊啊啊啊啊啊啊');
INSERT INTO `demo` VALUES ('148', '嘻嘻，真有意识', '嘻嘻，真有意识');
INSERT INTO `demo` VALUES ('149', '嘻嘻真有意识', '嘻嘻 有意识');
INSERT INTO `demo` VALUES ('150', '呵呵呵呵呵', '呵呵 呵呵');
INSERT INTO `demo` VALUES ('151', '呵呵呵', '呵 呵');
INSERT INTO `demo` VALUES ('152', '呵呵', '呵呵呵呵呵');
INSERT INTO `demo` VALUES ('153', '呵呵', '呵');
INSERT INTO `demo` VALUES ('154', '呵呵', '呵');
INSERT INTO `demo` VALUES ('155', '1111111', '1111111');
INSERT INTO `demo` VALUES ('156', '111111', '11 111');
INSERT INTO `demo` VALUES ('157', '112', '呵  呵 呵');
INSERT INTO `demo` VALUES ('158', '111222', '');
INSERT INTO `demo` VALUES ('159', '宿舍看书看书看看思考思考解放军减肥减肥减肥减肥就减肥减肥减肥减肥减肥减肥经济实际上就是计算机世界就是计算机世界', 'http://szvanke.juzhen.com/2015/SwLucheng/index.shtml?from=singlemessage&isappinstalled=0');
INSERT INTO `demo` VALUES ('160', '呵呵呵呵呵呵额呵呵呵', '');
INSERT INTO `demo` VALUES ('161', '11111122222222', '');
INSERT INTO `demo` VALUES ('162', '112222', '');
INSERT INTO `demo` VALUES ('163', '1122223333344', 'Array');
INSERT INTO `demo` VALUES ('164', '1122222', 'Array');
INSERT INTO `demo` VALUES ('165', '1122222', '11222');
INSERT INTO `demo` VALUES ('166', '哈哈哈哈哈', '    ');
INSERT INTO `demo` VALUES ('167', '11222', '11 22');
INSERT INTO `demo` VALUES ('168', '呵呵呵呵呵呵额呵呵', '呵呵呵呵呵呵额 呵');
INSERT INTO `demo` VALUES ('169', '你好', '你 ');
INSERT INTO `demo` VALUES ('170', '呵呵呵休息休息', '呵 呵 息休息');
