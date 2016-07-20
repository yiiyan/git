/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1_3306
Source Server Version : 50547
Source Host           : 127.0.0.1:3306
Source Database       : we7

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2016-07-18 16:22:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for we_account
-- ----------------------------
DROP TABLE IF EXISTS `we_account`;
CREATE TABLE `we_account` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `aname` varchar(255) NOT NULL,
  `account` varchar(255) NOT NULL,
  `appid` varchar(50) NOT NULL,
  `appsecret` varchar(50) NOT NULL,
  `atoken` varchar(50) DEFAULT NULL,
  `atok` varchar(255) DEFAULT NULL,
  `aurl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`aid`),
  KEY `FK_Relationship_4` (`uid`),
  KEY `FK_Relationship_5` (`mid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for we_graphic_reply
-- ----------------------------
DROP TABLE IF EXISTS `we_graphic_reply`;
CREATE TABLE `we_graphic_reply` (
  `grid` int(11) NOT NULL AUTO_INCREMENT,
  `reid` int(11) DEFAULT NULL,
  `grtitle` varchar(50) NOT NULL,
  `grauthor` varchar(20) NOT NULL,
  `grcover` varchar(255) NOT NULL,
  `grinfo` varchar(255) NOT NULL,
  `grsource` varchar(100) NOT NULL,
  PRIMARY KEY (`grid`),
  KEY `FK_Relationship_3` (`reid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for we_ip
-- ----------------------------
DROP TABLE IF EXISTS `we_ip`;
CREATE TABLE `we_ip` (
  `iid` int(11) NOT NULL AUTO_INCREMENT,
  `iip` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `iuser` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`iid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Table structure for we_menu
-- ----------------------------
DROP TABLE IF EXISTS `we_menu`;
CREATE TABLE `we_menu` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) DEFAULT NULL,
  `mgrade` varchar(1) DEFAULT NULL,
  `mname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`mid`),
  KEY `FK_Relationship_6` (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for we_reply
-- ----------------------------
DROP TABLE IF EXISTS `we_reply`;
CREATE TABLE `we_reply` (
  `reid` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) DEFAULT NULL,
  `rename` varchar(50) DEFAULT NULL,
  `rekeyword` varchar(50) DEFAULT NULL,
  `retype` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`reid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for we_session
-- ----------------------------
DROP TABLE IF EXISTS `we_session`;
CREATE TABLE `we_session` (
  `id` char(40) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Table structure for we_text_reply
-- ----------------------------
DROP TABLE IF EXISTS `we_text_reply`;
CREATE TABLE `we_text_reply` (
  `trid` int(11) NOT NULL AUTO_INCREMENT,
  `reid` int(11) DEFAULT NULL,
  `trcontent` varchar(255) NOT NULL,
  PRIMARY KEY (`trid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for we_user
-- ----------------------------
DROP TABLE IF EXISTS `we_user`;
CREATE TABLE `we_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(30) NOT NULL,
  `upwd` varchar(50) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
