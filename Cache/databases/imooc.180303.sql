/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50719
 Source Host           : localhost
 Source Database       : imooc

 Target Server Type    : MySQL
 Target Server Version : 50719
 File Encoding         : utf-8

 Date: 03/03/2018 23:30:07 PM
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

-- ----------------------------
--  Table structure for `im_channel`
-- ----------------------------
DROP TABLE IF EXISTS `im_channel`;
CREATE TABLE `im_channel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `channel_id` int(11) unsigned DEFAULT NULL COMMENT '上级频道ID',
  `title` varchar(20) DEFAULT NULL COMMENT '频道名',
  `url` varchar(255) DEFAULT NULL COMMENT '频道URL',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `im_channel`
-- ----------------------------
BEGIN;
INSERT INTO `im_channel` VALUES ('1', '0', '爱逛', '#aiguang'), ('2', '0', '爱美丽', '#aimeili'), ('3', '0', '家电馆', '#jiadian'), ('4', '0', '手机派', '#shouji'), ('5', '1', '奢侈品', '#aiguang'), ('6', '2', '套装', '#aimeili'), ('7', '2', '乳液面霜', '#aimeili'), ('8', '2', '面膜', '#aimeili'), ('9', '2', '洁面', '#aimeili'), ('10', '2', '宝洁洗护', '#aimeili'), ('11', '2', '身体护理', '#aimeili'), ('12', '3', '电视家影', '#jiadian'), ('13', '3', '美容器', '#jiadian'), ('14', '3', '送电视挂架', '#jiadian'), ('15', '3', '洗衣机', '#jiadian'), ('16', '3', '满600减100', '#jiadian'), ('17', '4', '金属机身', '#shouji'), ('18', '4', '快速充电', '#shouji'), ('19', '4', '拍照神器', '#shouji'), ('20', '4', '后置双摄像', '#shouji'), ('21', '4', '双卡双待', '#shouji'), ('22', '1', '保暖羽绒服', '#aiguang'), ('23', '1', '功能箱包', '#aiguang'), ('24', '1', '时尚手表', '#aiguang'), ('25', '1', '珠宝首饰', '#aiguang');
COMMIT;

-- ----------------------------
--  Table structure for `im_goods_brand`
-- ----------------------------
DROP TABLE IF EXISTS `im_goods_brand`;
CREATE TABLE `im_goods_brand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `channel_id` int(10) unsigned NOT NULL COMMENT '频道ID',
  `brand_name` varchar(255) DEFAULT NULL COMMENT '品牌名',
  `pic_url` varchar(255) DEFAULT NULL COMMENT '图片地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `im_goods_brand`
-- ----------------------------
BEGIN;
INSERT INTO `im_goods_brand` VALUES ('9', '1', 'VERO MODA', '/img/lovelife/smimg/loveshopping/img1.jpg'), ('10', '1', 'JACK JONES', '/img/lovelife/smimg/loveshopping/img2.jpg'), ('11', '1', 'NanJiRen', '/img/lovelife/smimg/loveshopping/img3.jpg'), ('12', '1', '上海故事', '/img/lovelife/smimg/loveshopping/img4.jpg'), ('13', '1', 'BeEEL', '/img/lovelife/smimg/loveshopping/img5.jpg'), ('14', '1', 'IWC', '/img/lovelife/smimg/loveshopping/img6.jpg'), ('15', '2', 'sephora', '/img/lovelife/smimg/lovebeauty/img1.jpg'), ('16', '2', 'LANCOME', '/img/lovelife/smimg/lovebeauty/img2.jpg'), ('17', '2', 'PECHOIN', '/img/lovelife/smimg/lovebeauty/img3.jpg'), ('18', '2', '林清轩', '/img/lovelife/smimg/lovebeauty/img3.jpg'), ('19', '2', 'PG', '/img/lovelife/smimg/lovebeauty/img4.jpg'), ('20', '2', 'U', '/img/lovelife/smimg/lovebeauty/img5.jpg'), ('21', '3', 'Haier', '/img/lovelife/smimg/homeapp/img1.jpg'), ('22', '3', 'Midea', '/img/lovelife/smimg/homeapp/img2.jpg'), ('23', '3', 'Aux', '/img/lovelife/smimg/homeapp/img3.jpg'), ('24', '3', '乐视', '/img/lovelife/smimg/homeapp/img4.jpg'), ('25', '3', 'PHILIPS', '/img/lovelife/smimg/homeapp/img5.jpg'), ('26', '3', 'Blueair', '/img/lovelife/smimg/homeapp/img6.jpg'), ('27', '4', 'Apple', '/img/lovelife/smimg/phone/img1.jpg'), ('28', '4', 'Honor', '/img/lovelife/smimg/phone/img2.jpg'), ('29', '4', 'XiaoMi', '/img/lovelife/smimg/phone/img3.jpg'), ('30', '4', 'HuaWei', '/img/lovelife/smimg/phone/img4.jpg'), ('31', '4', 'SAMSUNG', '/img/lovelife/smimg/phone/img5.jpg'), ('32', '4', 'OPPO', '/img/lovelife/smimg/phone/img6.jpg');
COMMIT;

-- ----------------------------
--  Table structure for `im_goods_info`
-- ----------------------------
DROP TABLE IF EXISTS `im_goods_info`;
CREATE TABLE `im_goods_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `channel_id` int(10) unsigned NOT NULL COMMENT '频道id',
  `show_id` tinyint(4) DEFAULT '2' COMMENT '展示位ID 1为左侧2为中间3为底下',
  `title` varchar(255) DEFAULT NULL COMMENT '商品标题',
  `subtitle` varchar(255) DEFAULT NULL COMMENT '商品小标题',
  `pic_url` varchar(255) DEFAULT NULL COMMENT '商品图片url',
  `link` varchar(255) DEFAULT '#' COMMENT 'URL连接地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `im_goods_info`
-- ----------------------------
BEGIN;
INSERT INTO `im_goods_info` VALUES ('1', '1', '1', '服装城', '时尚大本营', '/img/lovelife/lovelife-list-content-leimg-img1.jpg', '#'), ('2', '1', '2', '型男衣橱', '抢大额神券', '/img/lovelife/lovelife-list-content-riimg-img1.jpg', '#'), ('3', '1', '2', '摩登女装', '满299减100券', '/img/lovelife/lovelife-list-content-riimg-img2.jpg', '#'), ('4', '1', '2', '内衣精选', '每满50减12', '/img/lovelife/lovelife-list-content-riimg-img3.jpg', '#'), ('5', '1', '2', '时尚女鞋', '跨店199减100', '/img/lovelife/lovelife-list-content-riimg-img4.jpg', '#'), ('6', '1', '3', '珠宝大卖场', '单品低至99元', '/img/lovelife/lovelife-list-content-mdimg-img1.jpg', '#'), ('7', '1', '3', '设计师推荐', '给你喜欢的', '/img/lovelife/lovelife-list-content-mdimg-img2.jpg', '#'), ('8', '1', '3', '打牌好货', '限时特惠', '/img/lovelife/lovelife-list-content-mdimg-img3.jpg', '#'), ('15', '2', '1', '个护化妆', null, '/img/lovelife/lovelife-list-content-leimg-img2.jpg', '#'), ('16', '2', '2', '美妆馆', '满199-100', '/img/lovelife/lovelife-list-content-riimg-img5.jpg', '#'), ('17', '2', '2', '面部护肤', '低至199-100', '/img/lovelife/lovelife-list-content-riimg-img6.jpg', '#'), ('18', '2', '2', '香水彩妆', '满199-100', '/img/lovelife/lovelife-list-content-riimg-img7.jpg', '#'), ('19', '2', '2', '洗发护发', '满199-100', '/img/lovelife/lovelife-list-content-riimg-img8.jpg', '#'), ('20', '2', '2', '个护大牌', null, '/img/lovelife/lovelife-list-content-mdimg-img4.jpg', '#'), ('21', '2', '2', '纸品清洁', null, '/img/lovelife/lovelife-list-content-mdimg-img5.jpg', '#'), ('22', '2', '2', '丝倍绮', null, '/img/lovelife/lovelife-list-content-mdimg-img6.jpg', '#'), ('23', '3', '1', '家电馆', '', '/img/lovelife/lovelife-list-content-leimg-img3.jpg', '#'), ('24', '3', '2', '大家电馆', '白条12期免息购', '/img/lovelife/lovelife-list-content-riimg-img9.jpg', '#'), ('25', '3', '2', '厨卫家装馆', '爆款好货低至79元', '/img/lovelife/lovelife-list-content-riimg-img10.jpg', '#'), ('26', '3', '2', '电视家影', '满5000减300', '/img/lovelife/lovelife-list-content-riimg-img11.jpg', '#'), ('27', '3', '2', '冰洗品牌日', '热销爆款提前抢', '/img/lovelife/lovelife-list-content-riimg-img12.jpg', '#'), ('28', '3', '3', '小家电', '', '/img/lovelife/lovelife-list-content-mdimg-img7.jpg', '#'), ('29', '3', '3', '健康电器', '', '/img/lovelife/lovelife-list-content-mdimg-img8.jpg', '#'), ('30', '3', '3', '健康好水', '', '/img/lovelife/lovelife-list-content-mdimg-img9.jpg', '#'), ('31', '4', '1', '手机', '', '/img/lovelife/lovelife-list-content-leimg-img4.jpg', '#'), ('32', '4', '2', '新Phone尚', '潮流新品抢先体验', '/img/lovelife/lovelife-list-content-riimg-img13.jpg', '#'), ('33', '4', '2', '促销汇', 'iPhone5s低至1899', '/img/lovelife/lovelife-list-content-riimg-img14.jpg', '#'), ('34', '4', '2', '手机通讯', 'Cool 1C火爆发售', '/img/lovelife/lovelife-list-content-riimg-img15.jpg', '#'), ('35', '4', '2', '怎么挑手机', '潮机评测', '/img/lovelife/lovelife-list-content-riimg-img16.jpg', '#'), ('36', '4', '3', '荣耀爆款', '', '/img/lovelife/lovelife-list-content-mdimg-img10.jpg', '#'), ('37', '4', '3', '魅蓝', '', '/img/lovelife/lovelife-list-content-mdimg-img11.jpg', '#'), ('38', '4', '3', '中心新品', '', '/img/lovelife/lovelife-list-content-mdimg-img12.jpg', '#');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
