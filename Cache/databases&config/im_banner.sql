/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 50719
 Source Host           : localhost
 Source Database       : imooc

 Target Server Type    : MySQL
 Target Server Version : 50719
 File Encoding         : utf-8

 Date: 02/13/2018 13:41:31 PM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `im_banner`
-- ----------------------------
DROP TABLE IF EXISTS `im_banner`;
CREATE TABLE `im_banner` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pic` varchar(255) DEFAULT NULL COMMENT '图片URL',
  `url` varchar(255) DEFAULT NULL COMMENT '图片链接地址',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `status` tinyint(2) DEFAULT '1' COMMENT '状态',
  `order` int(11) DEFAULT '0' COMMENT '排序权重',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `im_banner`
-- ----------------------------
BEGIN;
INSERT INTO `im_banner` VALUES ('1', '\\static\\images\\banner\\slider8.jpg', '1.html', '电脑装备5折抢', '1', '8'), ('2', '\\static\\images\\banner\\slider2.jpg', '2.html', '白酒年货节', '1', '6'), ('3', '\\static\\images\\banner\\slider5.jpg', '3.html', '抢年货过美年', '1', '5'), ('4', '\\static\\images\\banner\\slider6.jpg', '4.html', '女士奢品箱包', '1', '8'), ('5', '\\static\\images\\banner\\slider1.jpg', '5.html', '手机大卖场', '1', '2'), ('6', '\\static\\images\\banner\\slider3.jpg', '6.html', '运动户外大牌', '1', '1'), ('7', '\\static\\images\\banner\\slider4.jpg', '7.html', 'ThinkPad超级本', '1', '3'), ('8', '\\static\\images\\banner\\slider8.jpg', '8.html', '抢装备抢', '0', '8'), ('9', '\\static\\images\\banner\\slider9.jpg', '1.html', '电脑装备', '0', '4'), ('10', '\\static\\images\\banner\\slider10.jpg', '1.html', '5折抢', '0', '8');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
