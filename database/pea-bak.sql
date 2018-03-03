/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50051
Source Host           : localhost:3306
Source Database       : pea

Target Server Type    : MYSQL
Target Server Version : 50051
File Encoding         : 65001

Date: 2018-03-03 18:58:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tb_customer
-- ----------------------------
DROP TABLE IF EXISTS `tb_customer`;
CREATE TABLE `tb_customer` (
  `cus_id` char(13) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cus_first` int(2) NOT NULL,
  `cus_name` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cus_type` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cus_code` char(9) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cus_tax` char(13) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cus_homeid` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cus_number` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cus_village` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cus_room` varchar(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cus_floor` varchar(5) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cus_alley` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cus_alleyway` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cus_road` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cus_vilno` varchar(2) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cus_district` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cus_canton` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cus_province` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cus_post` varchar(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cus_tel` char(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cus_fax` char(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cus_email` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`cus_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_customer
-- ----------------------------
INSERT INTO `tb_customer` VALUES ('1102254587855', '0', 'พิรชัย ชัยจินดา', 'VIP', '222222222', '11111111111', '1234', '332', 'ทาวน์เฮาส์', '311', '2', '-', 'หลังชลประทาน', 'ศรีจันทร์ 31', '5', 'ในเมือง', 'เมือง', 'ขอนแก่น', '40000', '0804083856', '0432158785', 'mouse@gmail.com');
INSERT INTO `tb_customer` VALUES ('1102002129468', '2', 'ดวงมหัด ใจดี', 'ทั่วไป', '501120017', '583423600151', '001', '332', 'กระนวน', '-', '-', '-', '-', '-', '5', 'กระนวน', 'ซำสูง', 'ขอนแก่น', '40170', '0921383707', '-', 'dongdee@gmail.com');
INSERT INTO `tb_customer` VALUES ('2202002123368', '2', 'จำแลงรัก สลักใจ', 'บัตรประชาชน', '220200216', '2202002123368', '5/55', '5', 'พิมานธานร', '-', '-', 'ขวดน้ำ', 'คำชะโน้น', 'ลูกประคำ', '5', 'ขวดแก้ว', 'เมือง', 'ชลบุรี', '34255', '0879953563', '0432254536', 'jjgreen@hotmail.com');
INSERT INTO `tb_customer` VALUES ('5421121212855', '2', 'พันชราวดี ศรีดวงดาว', 'บัตรประชาชน', '584753413', '5786544241521', '114/22', '5', '-', '-', '-', 'ศรีจันทร์', 'ศรีจันทร์31', 'ศรีจันทร์', '6', 'ในเมือง', 'เมือง', 'ขอนแก่น', '40000', '0875468632', '0875468632', 'pattarawadee@hotmail.com');
INSERT INTO `tb_customer` VALUES ('1102002129222', '2', 'ดวงมหัด ใจดี', 'ทั่วไป', '501120017', '583423600151', '001', '332', 'กระนวน', '-', '-', '-', '-', '-', '5', 'กระนวน', 'ซำสูง', 'ขอนแก่น', '40170', '0921383707', '-', 'dongdee@gmail.com');
INSERT INTO `tb_customer` VALUES ('1102002222222', '2', 'ดวงมหัด ใจดี', 'ทั่วไป', '501120017', '583423600151', '001', '332', 'กระนวน', '-', '-', '-', '-', '-', '5', 'กระนวน', 'ซำสูง', 'ขอนแก่น', '40170', '0921383707', '-', 'dongdee@gmail.com');
INSERT INTO `tb_customer` VALUES ('1479988456222', '2', 'ผกามาศ ยอดสง่า', 'ประชาชน', '-', '-', '-', '45', 'หนองบัวดีหมี', '-', '-', '-', '-', '-', '4', 'ท่าพระ', 'เมือง', 'ขอนแก่น', '40000', '0821234566', '-', '-');
INSERT INTO `tb_customer` VALUES ('1479900373635', '0', 'วรชัย หมายปอง', 'ประชาชน', '-', '-', '-', '99', 'สามเหลี่ยม', '-', '-', '-', '-', '-', '17', 'ในเมือง', 'เมือง', 'ขอนแก่น', '40000', '0854111233', '-', '-');
INSERT INTO `tb_customer` VALUES ('1478889925344', '1', 'ละออง ทองคำ', 'ประชาชน', '-', '-', '-', '11/23', 'กุดกว้าง', '-', '-', '-', '-', '-', '19', 'ท่าพระ', 'เมือง', 'ขอนแก่น', '40000', '0812605578', '-', '-');
INSERT INTO `tb_customer` VALUES ('1478856325777', '0', 'มงคล สีเทา', 'ประชาชน', '-', '-', '-', '123/4', 'โนนม่วง', '-', '-', '-', '-', '-', '3', 'ศิลา', 'เมือง', 'ขอนแก่น', '40000', '0814536785', '-', '-');
INSERT INTO `tb_customer` VALUES ('1479977558666', '0', 'รวย มหาชัย', 'ประชาชน', '-', '-', '-', '5', 'หนองกุง', '-', '-', '-', '-', '-', '22', 'ศิลา', 'เมือง', 'ขอนแก่น', '40000', '0834557856', '-', '-');
INSERT INTO `tb_customer` VALUES ('1479988552211', '1', 'หนู มารวย', 'ประชาชน', '-', '-', '-', '48', 'ดอนหญ้านาง', '-', '-', '-', 'รื่นรมย์', '-', '-', 'ศิลา', 'เมือง', 'ขอนแก่น', '40000', '0875531444', '-', '-');
INSERT INTO `tb_customer` VALUES ('1256985646565', '1', 'พิชาดา สมดี', 'บัตรประชนชน', '125698564', '1256985646565', '11/22', '11', '6', '1', '2', 'ดีใจจัง', 'ดีใจจัง 31', 'ศรีจันทร์', '6', 'ไม่ดี', 'ในเมือง', 'ขอนแก่น', '40000', '0822222222', '0822222222', 'jaidee@hotmail.com');

-- ----------------------------
-- Table structure for tb_electricity
-- ----------------------------
DROP TABLE IF EXISTS `tb_electricity`;
CREATE TABLE `tb_electricity` (
  `re_id` char(12) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_date` date NOT NULL,
  `re_branch` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `user_id` char(13) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cus_id` char(13) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_place_type` int(1) NOT NULL,
  `re_place_other` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_place_name` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_place_homeid` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_place_number` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_place_village` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_place_room` varchar(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_place_floor` varchar(5) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_place_alley` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_place_alleyway` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_place_road` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_place_villno` varchar(2) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_place_district` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_place_canton` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_place_province` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_place_post` varchar(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_place_tel` char(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_place_fax` char(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_place_email` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_place_service` varchar(10) NOT NULL,
  `re_contact_place` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_contact_homeid` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_contact_number` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_contact_village` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_contact_room` varchar(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_contact_floor` varchar(5) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_contact_alley` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_contact_alleyway` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_contact_road` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_contact_villno` varchar(2) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_contact_district` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_contact_canton` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_contact_province` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_contact_post` varchar(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_contact_tel` char(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_contact_fax` char(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_contact_email` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_want_type` int(2) NOT NULL,
  `re_want_other` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_detail` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_use_type` int(1) NOT NULL,
  `re_use_other` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_dateset` date NOT NULL,
  `re_keep_type` int(1) NOT NULL,
  `re_keep_name` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_keep_homeid` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_keep_number` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_keep_village` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_keep_room` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_keep_floor` varchar(5) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_keep_alley` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_keep_alleyway` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_keep_road` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_keep_villno` varchar(2) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_keep_district` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_keep_canton` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_keep_province` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_keep_post` varchar(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_keep_tel` char(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_keep_fax` char(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_keep_email` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_picture` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_status` int(1) NOT NULL,
  `re_pay` int(1) NOT NULL,
  PRIMARY KEY  (`re_id`,`re_keep_district`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_electricity
-- ----------------------------
INSERT INTO `tb_electricity` VALUES ('120000000001', '2018-01-20', 'ท่าพระ', 'EMP00002', '1102254587855', '2', 'บ้าน', 'บ้านศรีสุข', '1234', '332', 'ทาวน์เฮาส์', '311', '2', '-', 'หลังชลประทาน', 'ศรีจันทร์ 31', '', 'ในเมือง', 'เมือง', 'ขอนแก่น', '40000', '0804083856', '0432158785', 'mouse@gmail.com', '-', '-', '1234', '332', 'ทาวน์เฮาส์', '311', '2', '-', 'หลังชลประทาน', 'ศรีจันทร์ 31', '5', 'ในเมือง', 'เมือง', 'ขอนแก่น', '40000', '0804083856', '0432158785', 'mouse@gmail.com', '0', '-', '-', '0', '', '2018-01-31', '0', '-', '1234', '332', 'ทาวน์เฮาส์', '311', '2', '-', 'หลังชลประทาน', 'ศรีจันทร์ 31', '5', 'ในเมือง', 'เมือง', 'ขอนแก่น', '40000', '0804083856', '0432158785', 'mouse@gmail.com', '../pea/img/ele/120000000001.jpg', '6', '0');
INSERT INTO `tb_electricity` VALUES ('120000000002', '2018-01-20', 'มะลิวัลย์', 'EMP00002', '1479900373635', '0', '-', '-', '-', '99', 'สามเหลี่ยม', '-', '-', '-', '-', '-', '', 'ในเมือง', 'เมือง', 'ขอนแก่น', '40000', '0854111233', '-', '-', '-', '-', '-', '99', 'สามเหลี่ยม', '-', '-', '-', '-', '-', '17', 'ในเมือง', 'เมือง', 'ขอนแก่น', '40000', '0854111233', '-', '-', '0', '-', '-', '0', '', '2018-01-21', '0', 'วัชระพล', '-', '99', 'สามเหลี่ยม', '-', '-', '-', '-', '-', '17', 'ในเมือง', 'เมือง', 'ขอนแก่น', '40000', '0854111233', '-', '-', '../pea/img/ele/120000000002.jpg', '6', '0');
INSERT INTO `tb_electricity` VALUES ('120000000003', '2018-01-20', 'ท่าพระ', 'EMP00003', '1478889925344', '0', '-', 'บ้าน', '-', '11/23', 'กุดกว้าง', '-', '-', '-', '-', '-', '', 'ท่าพระ', 'เมือง', 'ขอนแก่น', '40000', '0812605578', '-', '-', 'บ้านพักอาศ', '-', '-', '11/23', 'กุดกว้าง', '-', '-', '-', '-', '-', '19', 'ท่าพระ', 'เมือง', 'ขอนแก่น', '40000', '0812605578', '-', '-', '3', '-', '-', '0', '', '2018-01-21', '1', 'นางละออง', '-', '11/23', 'กุดกว้าง', '-', '-', '-', '-', '-', '19', 'ท่าพระ', 'เมือง', 'ขอนแก่น', '40000', '0812605578', '-', '-', '../pea/img/ele/120000000003.jpg', '4', '0');
INSERT INTO `tb_electricity` VALUES ('120000000004', '2018-01-20', 'มะลิวัลย์', 'EMP00003', '1478856325777', '0', '-', '-', '-', '123/4', 'โนนม่วง', '-', '-', '-', '-', '-', '', 'ศิลา', 'เมือง', 'ขอนแก่น', '40000', '0814536785', '-', '-', 'กิจการขนาด', '', '-', '123/4', 'โนนม่วง', '-', '-', '-', '-', '-', '3', 'ศิลา', 'เมือง', 'ขอนแก่น', '40000', '0814536785', '-', '-', '4', '-', '-', '2', '', '2018-01-22', '1', 'มงคล สีเทา', '-', '123/4', 'โนนม่วง', '-', '-', '-', '-', '-', '3', 'ศิลา', 'เมือง', 'ขอนแก่น', '40000', '0814536785', '-', '-', '../pea/img/ele/120000000004.jpg', '3', '0');
INSERT INTO `tb_electricity` VALUES ('120000000005', '2018-01-20', 'มะลิวัลย์', 'EMP00003', '1479977558666', '0', '-', '-', '-', '5', 'หนองกุง', '-', '-', '-', '-', '-', '', 'ศิลา', 'เมือง', 'ขอนแก่น', '40000', '0834557856', '-', '-', '', '-', '-', '5', 'หนองกุง', '-', '-', '-', '-', '-', '22', 'ศิลา', 'เมือง', 'ขอนแก่น', '40000', '0834557856', '-', '-', '11', '-', '-', '7', '', '2018-01-23', '0', 'นายรวย มหาชัย', '-', '5', 'หนองกุง', '-', '-', '-', '-', '-', '22', 'ศิลา', 'เมือง', 'ขอนแก่น', '40000', '0834557856', '-', '-', '../pea/img/ele/120000000005.jpg', '2', '0');
INSERT INTO `tb_electricity` VALUES ('120000000006', '2018-01-20', 'มะลิวัลย์', 'EMP00003', '1479977558666', '0', '-', '-', '-', '5', 'หนองกุง', '-', '-', '-', '-', '-', '', 'ศิลา', 'เมือง', 'ขอนแก่น', '40000', '0834557856', '-', '-', '', '', '-', '33', 'หนองใหญ่', '-', '-', '-', '-', '-', '11', 'ในเมือง', 'เมือง', 'ขอนแก่น', '40000', '0835479633', '-', '-', '8', '-', '-', '4', '', '2018-01-23', '0', 'นายรวย มหาชัย', '-', '5', 'หนองกุง', '-', '-', '-', '-', '-', '22', 'ศิลา', 'เมือง', 'ขอนแก่น', '40000', '0834557856', '-', '-', '../pea/img/ele/120000000006.jpg', '6', '0');
INSERT INTO `tb_electricity` VALUES ('120000000007', '2018-01-20', 'มะลิวัลย์', 'EMP00003', '1479988552211', '0', '-', '-', '-', '48', 'ดอนหญ้านาง', '-', '-', '-', 'รื่นรมย์', '-', '', 'ศิลา', 'เมือง', 'ขอนแก่น', '40000', '0875531444', '-', '-', '-', '-', '-', '48', 'ดอนหญ้านาง', '-', '-', '-', 'รื่นรมย์', '-', '-', 'ศิลา', 'เมือง', 'ขอนแก่น', '40000', '0875531444', '-', '-', '4', '-', '-', '0', '', '2018-01-21', '0', 'นางหนู มารวย', '-', '48', 'ดอนหญ้านาง', '-', '-', '-', 'รื่นรมย์', '-', '-', 'ศิลา', 'เมือง', 'ขอนแก่น', '40000', '0875531444', '-', '-', '../pea/img/ele/120000000007.jpg', '3', '0');
INSERT INTO `tb_electricity` VALUES ('120000000008', '2018-01-24', 'ท่าพระ', 'EMP00002', '1256985646565', '1', '-', '-', '11/22', '11', '6', '1', '2', 'ดีใจจัง', 'ดีใจจัง 31', 'ศรีจันทร์', '', 'ไม่ดี', 'ในเมือง', 'ขอนแก่น', '40000', '0822222222', '0822222222', 'jaidee@hotmail.com', '-', '-', '11/22', '11', '6', '1', '2', 'ดีใจจัง', 'ดีใจจัง 31', 'ศรีจันทร์', '6', 'ไม่ดี', 'ในเมือง', 'ขอนแก่น', '40000', '0822222222', '0822222222', 'jaidee@hotmail.com', '0', '-', '-', '0', '', '2018-02-01', '0', '-', '11/22', '11', '6', '1', '2', 'ดีใจจัง', 'ดีใจจัง 31', 'ศรีจันทร์', '6', 'ไม่ดี', 'ในเมือง', 'ขอนแก่น', '40000', '0822222222', '0822222222', 'jaidee@hotmail.com', '../pea/img/ele/120000000008.jpg', '6', '0');

-- ----------------------------
-- Table structure for tb_equipment
-- ----------------------------
DROP TABLE IF EXISTS `tb_equipment`;
CREATE TABLE `tb_equipment` (
  `equ_id` char(12) character set utf8 collate utf8_unicode_ci NOT NULL,
  `equ_date` date NOT NULL,
  `re_id` char(12) character set utf8 collate utf8_unicode_ci NOT NULL,
  `user_id` char(13) character set utf8 collate utf8_unicode_ci NOT NULL,
  `equ_tran` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `equ_tran_unit` int(10) NOT NULL,
  `equ_air` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `equ_air_unit` int(10) NOT NULL,
  `equ_lantern` int(10) NOT NULL,
  `equ_outlet` int(10) NOT NULL,
  `equ_fan` int(10) NOT NULL,
  `me_id` char(12) character set utf8 collate utf8_unicode_ci NOT NULL,
  `equ_meter_unit` int(10) NOT NULL,
  `equ_detail` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `equ_status` int(1) NOT NULL,
  PRIMARY KEY  (`equ_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_equipment
-- ----------------------------
INSERT INTO `tb_equipment` VALUES ('130000000001', '2018-01-20', '120000000001', 'EMP00005', '3 เฟส ขนาด 160 KVA', '2', '15,300 บีทียู', '2', '2', '2', '2', 'ME00002', '1', '-', '0');
INSERT INTO `tb_equipment` VALUES ('130000000002', '2018-01-20', '120000000002', 'EMP00003', '', '0', '', '0', '0', '0', '0', '', '0', 'ปรับพื้นที่ใหม่', '1');
INSERT INTO `tb_equipment` VALUES ('130000000003', '2018-01-20', '120000000002', 'EMP00003', '1 เฟส ขนาด 30 KVA', '1', '15,300 บีทียู', '2', '3', '4', '2', 'ME00002', '1', '-', '0');
INSERT INTO `tb_equipment` VALUES ('130000000004', '2018-01-20', '120000000003', 'EMP00004', '1 เฟส ขนาด 30 KVA', '1', '15,300 บีทียู', '2', '6', '6', '3', 'ME00014', '1', '-', '0');
INSERT INTO `tb_equipment` VALUES ('130000000005', '2018-01-20', '120000000004', 'EMP00005', '3 เฟส ขนาด 160 KVA', '1', '12,000 บีทียู', '1', '7', '9', '3', 'ME00022', '1', '-', '0');
INSERT INTO `tb_equipment` VALUES ('130000000006', '2018-01-20', '120000000005', 'EMP00005', '3 เฟส ขนาด 160 KVA', '1', '15,300 บีทียู', '2', '5', '6', '3', 'ME00038', '1', '-', '0');
INSERT INTO `tb_equipment` VALUES ('130000000007', '2018-01-20', '120000000007', 'EMP00005', '1 เฟส ขนาด 30 KVA', '1', '12,000 บีทียู', '1', '4', '6', '2', 'ME00021', '1', '-', '0');
INSERT INTO `tb_equipment` VALUES ('130000000008', '2018-01-24', '120000000008', 'EMP00005', '3 เฟส ขนาด 50 KVA', '1', '15,300 บีทียู', '1', '1', '1', '1', 'ME00001', '1', '-', '0');

-- ----------------------------
-- Table structure for tb_fee
-- ----------------------------
DROP TABLE IF EXISTS `tb_fee`;
CREATE TABLE `tb_fee` (
  `fee_id` char(13) collate utf8_unicode_ci NOT NULL,
  `fee_date` date NOT NULL,
  `re_id` char(12) collate utf8_unicode_ci NOT NULL,
  `rg_id` char(12) collate utf8_unicode_ci NOT NULL,
  `user_id` char(13) collate utf8_unicode_ci NOT NULL,
  `fee_price` double(10,2) NOT NULL,
  PRIMARY KEY  (`fee_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tb_fee
-- ----------------------------
INSERT INTO `tb_fee` VALUES ('140000000001', '2018-01-21', '120000000001', '', 'EMP00002', '4280.00');
INSERT INTO `tb_fee` VALUES ('140000000002', '2018-01-22', '120000000002', '', 'EMP00002', '4280.00');
INSERT INTO `tb_fee` VALUES ('140000000003', '2018-01-22', '120000000003', '', 'EMP00003', '37450.00');
INSERT INTO `tb_fee` VALUES ('140000000004', '2018-01-23', '120000000004', '', 'EMP00003', '4280.00');
INSERT INTO `tb_fee` VALUES ('140000000005', '2018-01-23', '120000000005', '', 'EMP00003', '5350.00');
INSERT INTO `tb_fee` VALUES ('140000000006', '2018-01-23', '120000000007', '', 'EMP00003', '749.00');
INSERT INTO `tb_fee` VALUES ('140000000007', '2018-01-23', '', '110000000005', 'EMP00002', '3210.00');
INSERT INTO `tb_fee` VALUES ('140000000008', '2018-01-24', '120000000008', '', 'EMP00002', '2140.00');

-- ----------------------------
-- Table structure for tb_general
-- ----------------------------
DROP TABLE IF EXISTS `tb_general`;
CREATE TABLE `tb_general` (
  `rg_id` char(12) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_date` date NOT NULL,
  `rg_branch` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `user_id` char(13) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cus_id` char(13) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_place_type` int(1) NOT NULL,
  `rg_place_other` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_place_name` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_place_homeid` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_place_number` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_place_village` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_place_room` varchar(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_place_floor` varchar(5) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_place_alley` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_place_alleyway` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_place_road` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_place_villno` varchar(2) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_place_district` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_place_canton` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_place_province` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_place_post` varchar(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_place_tel` char(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_place_fax` char(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_place_email` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_place_service` varchar(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_contact_place` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_contact_homeid` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_contact_number` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_contact_village` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_contact_room` varchar(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_contact_floor` varchar(5) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_contact_alley` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_contact_alleyway` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_contact_road` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_contact_villno` varchar(2) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_contact_district` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_contact_canton` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_contact_province` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_contact_post` varchar(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_contact_tel` char(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_contact_fax` char(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_contact_email` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_want_type` int(2) NOT NULL,
  `rg_want_other` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_detail` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rg_money` int(5) NOT NULL,
  `rg_status` int(1) NOT NULL,
  `rg_date_back` date default NULL,
  PRIMARY KEY  (`rg_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_general
-- ----------------------------
INSERT INTO `tb_general` VALUES ('110000000001', '2018-01-01', 'พระยืน', 'EMP00002', '1102254587855', '0', '', '-', '1234', '332', 'ทาวน์เฮาส์', '311', '2', '-', 'หลังชลประทาน', 'ศรีจันทร์ 31', '', 'ในเมือง', 'เมือง', 'ขอนแก่น', '40000', '0804083856', '0432158785', 'mouse@gmail.com', '-', '-', '1234', '332', 'ทาวน์เฮาส์', '311', '2', '-', 'หลังชลประทาน', 'ศรีจันทร์ 31', '5', 'ในเมือง', 'เมือง', 'ขอนแก่น', '40000', '0804083856', '0432158785', 'mouse@gmail.com', '0', '-', '-', '300', '3', '2018-02-10');
INSERT INTO `tb_general` VALUES ('110000000002', '2018-01-02', 'ท่าพระ', 'EMP00002', '1479988456222', '0', '', '-', '-', '45', 'หนองบัวดีหมี', '-', '-', '-', '-', '-', '', 'ท่าพระ', 'เมือง', 'ขอนแก่น', '40000', '0821234566', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '6', '-', '-', '0', '0', '2018-02-10');
INSERT INTO `tb_general` VALUES ('110000000003', '2018-01-04', 'มะลิวัลย์', 'EMP00003', '1479900373635', '0', '', '-', '-', '99', 'สามเหลี่ยม', '-', '-', '-', '-', '-', '', 'ในเมือง', 'เมือง', 'ขอนแก่น', '40000', '0854111233', '-', '-', '-', '-', '-', '99', 'สามเหลี่ยม', '-', '-', '-', '-', '-', '17', 'ในเมือง', 'เมือง', 'ขอนแก่น', '40000', '0854111233', '-', '-', '0', '-', '-', '300', '3', '2018-02-10');
INSERT INTO `tb_general` VALUES ('110000000004', '2018-01-05', 'พระยืน', 'EMP00002', '1479988552211', '1', '-', '-', '-', '48', 'ดอนหญ้านาง', '-', '-', '-', 'รื่นรมย์', '-', '', 'ศิลา', 'เมือง', 'ขอนแก่น', '40000', '0875531444', '-', '-', '-', '-', '-', '48', 'ดอนหญ้านาง', '-', '-', '-', 'รื่นรมย์', '-', '-', 'ศิลา', 'เมือง', 'ขอนแก่น', '40000', '0875531444', '-', '-', '3', '-', '-', '5000', '3', '2018-02-10');
INSERT INTO `tb_general` VALUES ('110000000005', '2018-01-06', 'มะลิวัลย์', 'EMP00002', '1479977558666', '1', '-', '-', '-', '5', 'หนองกุง', '-', '-', '-', '-', '-', '', 'ศิลา', 'เมือง', 'ขอนแก่น', '40000', '0834557856', '-', '-', '-', '-', '-', '5', 'หนองกุง', '-', '-', '-', '-', '-', '22', 'ศิลา', 'เมือง', 'ขอนแก่น', '40000', '0834557856', '-', '-', '8', '-', '-', '0', '3', '2018-02-10');
INSERT INTO `tb_general` VALUES ('110000000006', '2018-01-24', 'พระยืน', 'EMP00002', '1479988456222', '0', '', '-', '-', '45', 'หนองบัวดีหมี', '-', '-', '-', '-', '-', '', 'ท่าพระ', 'เมือง', 'ขอนแก่น', '40000', '0821234566', '-', '-', '-', '-', '-', '45', 'หนองบัวดีหมี', '-', '-', '-', '-', '-', '4', 'ท่าพระ', 'เมือง', 'ขอนแก่น', '40000', '0821234566', '-', '-', '9', '-', '-', '0', '1', '2018-02-10');
INSERT INTO `tb_general` VALUES ('110000000007', '2018-02-03', 'พระยืน', 'EMP00002', '1256985646565', '0', '', '5555', '11/22', '11', '6', '1', '2', 'ดีใจจัง', 'ดีใจจัง 31', 'ศรีจันทร์', '', 'ไม่ดี', 'ในเมือง', 'ขอนแก่น', '40000', '0822222222', '0822222222', 'jaidee@hotmail.com', '555', '1', '11/22', '11', '6', '1', '2', 'ดีใจจัง', 'ดีใจจัง 31', 'ศรีจันทร์', '6', 'ไม่ดี', 'ในเมือง', 'ขอนแก่น', '40000', '0822222222', '0822222222', 'jaidee@hotmail.com', '0', '-', '55', '500', '3', '2018-02-10');

-- ----------------------------
-- Table structure for tb_investigate
-- ----------------------------
DROP TABLE IF EXISTS `tb_investigate`;
CREATE TABLE `tb_investigate` (
  `ig_id` char(12) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ig_date` date NOT NULL,
  `user_id` char(13) character set utf8 collate utf8_unicode_ci NOT NULL,
  `re_id` char(12) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ig_lowtension` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ig_lowtension_amount` int(5) NOT NULL,
  `ig_lowtension_line` int(5) NOT NULL,
  `ig_power` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ig_power_speed` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ig_power_year` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ig_lowpower` int(1) NOT NULL,
  `ig_lowpower_type` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ig_lowpower_number` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ig_outlet` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ig_bstype` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ig_meter` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ig_meter_phase` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ig_meter_volt` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ig_linetype` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ig_linetype_pressure` varchar(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ig_linetype_volt` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ig_ct` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ig_vt` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ig_kwa` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ig_number_bf` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ig_number_af` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ig_linepoint` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ig_linenumber` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ig_install` int(1) NOT NULL,
  `ig_install_other` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`ig_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_investigate
-- ----------------------------
INSERT INTO `tb_investigate` VALUES ('160000000001', '2018-01-20', 'EMP00002', '120000000001', '2', '2', '2', '2', '2', '2555', '1', '222', '254524', '2*2', 'บ้าน', '24', '3', '4', '5', '50', '30', '2500', '200', '400', '-', '-', '-', '-', '1', '-');
INSERT INTO `tb_investigate` VALUES ('160000000002', '2018-01-20', 'EMP00002', '120000000002', '8', '2', '1', '3', '6', '2560', '1', '6', '785423699', '8', 'บ้านพักอาศัย', '15', '1', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '2', 'แบบแปลนไม่ถูก');
INSERT INTO `tb_investigate` VALUES ('160000000003', '2018-01-20', 'EMP00002', '120000000002', '10', '1', '3', 'substation4', '10', '2558', '1', 'เปลือย', 'pea123456', '250', 'ร้านค้า', '15', '1', '220', '6', '9', '220', '-', '-', '-', 'pea586877', 'pea6687455', '9874', 'pea6687455', '2', 'ยังไม่ติดตั้งสายกราว');
INSERT INTO `tb_investigate` VALUES ('160000000004', '2018-01-20', 'EMP00003', '120000000002', '6', '1', '2', '5', '3', '2559', '0', '6', 'pea123456', '500', 'ขนาดเล็ก', '500', '3', '220', '6', '9', '220', '0', '0', '0', 'pea586877', 'pea6687455', '9874', 'pea6687455', '1', '-');
INSERT INTO `tb_investigate` VALUES ('160000000005', '2018-01-24', 'EMP00002', '120000000008', '1', '2', '1', '1', '2', '2556', '1', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '-', '-', '-', '-', '1', '-');
INSERT INTO `tb_investigate` VALUES ('160000000006', '2018-02-03', 'EMP00002', '120000000003', '5', '5', '5', '5', '5', '2557', '1', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '2', 'เสีย');

-- ----------------------------
-- Table structure for tb_logview
-- ----------------------------
DROP TABLE IF EXISTS `tb_logview`;
CREATE TABLE `tb_logview` (
  `log_id` char(12) NOT NULL,
  `log_date` datetime default NULL,
  `re_id` char(12) default NULL,
  PRIMARY KEY  (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_logview
-- ----------------------------
INSERT INTO `tb_logview` VALUES ('LOG00009', '2018-02-10 13:58:13', '120000000002');
INSERT INTO `tb_logview` VALUES ('120000000008', '2018-02-03 17:38:00', '3');
INSERT INTO `tb_logview` VALUES ('120000000007', '2018-02-03 17:38:00', '3');
INSERT INTO `tb_logview` VALUES ('120000000006', '2018-02-03 17:38:00', '3');
INSERT INTO `tb_logview` VALUES ('120000000005', '2018-02-03 17:38:00', '3');
INSERT INTO `tb_logview` VALUES ('120000000004', '2018-02-03 17:38:00', '3');
INSERT INTO `tb_logview` VALUES ('120000000003', '2018-02-03 17:38:00', '3');
INSERT INTO `tb_logview` VALUES ('120000000002', '2018-02-03 17:38:00', '3');
INSERT INTO `tb_logview` VALUES ('120000000001', '2018-02-03 17:38:00', '3');

-- ----------------------------
-- Table structure for tb_meter
-- ----------------------------
DROP TABLE IF EXISTS `tb_meter`;
CREATE TABLE `tb_meter` (
  `me_id` char(12) collate utf8_unicode_ci NOT NULL,
  `me_name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `me_price` double(10,2) NOT NULL,
  `me_insure` double(10,2) default NULL,
  `me_type` int(2) NOT NULL,
  PRIMARY KEY  (`me_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tb_meter
-- ----------------------------
INSERT INTO `tb_meter` VALUES ('ME00001', '15(45) แอมป์ 1 เฟส 2 สาย', '2000.00', '500.00', '0');
INSERT INTO `tb_meter` VALUES ('ME00002', '15(45) แอมป์ 2 เฟส 2 สาย', '4000.00', '1000.00', '0');
INSERT INTO `tb_meter` VALUES ('ME00003', '30(100) แอมป์ 1 เฟส 2 สาย', '12000.00', '3000.00', '0');
INSERT INTO `tb_meter` VALUES ('ME00004', '15(45) แอมป์ 3 เฟส 4 สาย', '15000.00', '5000.00', '0');
INSERT INTO `tb_meter` VALUES ('ME00005', '30(100) แอมป์ 3 เฟส 4 สาย', '35000.00', '10000.00', '0');
INSERT INTO `tb_meter` VALUES ('ME00006', '15(45) แอมป์ 1 เฟส 2 สาย', '1000.00', '300.00', '2');
INSERT INTO `tb_meter` VALUES ('ME00007', '15(45) แอมป์ 1 เฟส 2 สาย', '2000.00', '500.00', '2');
INSERT INTO `tb_meter` VALUES ('ME00008', '30(100) แอมป์ 1 เฟส 2 สาย', '7000.00', '1000.00', '2');
INSERT INTO `tb_meter` VALUES ('ME00009', '15(45) แอมป์ 3 เฟส 4 สาย', '10000.00', '1500.00', '2');
INSERT INTO `tb_meter` VALUES ('ME00010', '30(100) แอมป์ 3 เฟส 4 สาย', '25000.00', '3000.00', '2');
INSERT INTO `tb_meter` VALUES ('ME00011', '5(15) แอมป์ 1 เฟส 2 สาย เป็น 15(45) แอมป์ 1 เฟส 2 สาย', '3700.00', '700.00', '3');
INSERT INTO `tb_meter` VALUES ('ME00012', '5(15) แอมป์ 1 เฟส 2 สาย เป็น 30(100) แอมป์ 1 เฟส 2 สาย', '10500.00', '2000.00', '3');
INSERT INTO `tb_meter` VALUES ('ME00013', '5(15) แอมป์ 1 เฟส 2 สาย เป็น 15(45) แอมป์ 3 เฟส 4 สาย', '14000.00', '2500.00', '3');
INSERT INTO `tb_meter` VALUES ('ME00014', '5(15) แอมป์ 1 เฟส 2 สาย เป็น 30(100) แอมป์ 3 เฟส 4 สาย', '35000.00', '5000.00', '3');
INSERT INTO `tb_meter` VALUES ('ME00015', '15(45) แอมป์ 1 เฟส 2 สาย เป็น 30(100) แอมป์ 1 เฟส 2 สาย', '7000.00', '1300.00', '3');
INSERT INTO `tb_meter` VALUES ('ME00016', '15(45) แอมป์ 1 เฟส 2 สาย เป็น 15(45) แอมป์ 3 เฟส 4 สาย', '10000.00', '2000.00', '3');
INSERT INTO `tb_meter` VALUES ('ME00017', '15(45) แอมป์ 1 เฟส 2 สาย เป็น 30(100) แอมป์ 3 เฟส 4 สาย', '32000.00', '5000.00', '3');
INSERT INTO `tb_meter` VALUES ('ME00018', '15(45) แอมป์ 3 เฟส 4 สาย เป็น 30(100) แอมป์ 3 เฟส 4 สาย', '20000.00', '4000.00', '3');
INSERT INTO `tb_meter` VALUES ('ME00019', '30(100) แอมป์ 1 เฟส 2 สาย เป็น 15(45) แอมป์ 3 เฟส 4 สาย', '3000.00', '500.00', '3');
INSERT INTO `tb_meter` VALUES ('ME00020', '30(100) แอมป์ 1 เฟส 2 สาย เป็น 30(100) แอมป์ 3 เฟส 4 สาย', '2000.00', '400.00', '3');
INSERT INTO `tb_meter` VALUES ('ME00021', '15(45) แอมป์ 1 เฟส 2 สาย', '700.00', '300.00', '4');
INSERT INTO `tb_meter` VALUES ('ME00022', '15(45) แอมป์ 1 เฟส 2 สาย', '4000.00', '1000.00', '4');
INSERT INTO `tb_meter` VALUES ('ME00023', '30(100) แอมป์ 1 เฟส 2 สาย', '12000.00', '2500.00', '4');
INSERT INTO `tb_meter` VALUES ('ME00024', '15(45) แอมป์ 3 เฟส 4 สาย', '15000.00', '3000.00', '4');
INSERT INTO `tb_meter` VALUES ('ME00025', '30(100) แอมป์ 3 เฟส 4 สาย', '35000.00', '5000.00', '4');
INSERT INTO `tb_meter` VALUES ('ME00026', '1(15) แอมป์ 1 เฟส 2 สาย', '1000.00', '300.00', '7');
INSERT INTO `tb_meter` VALUES ('ME00027', '15(45) แอมป์ 1 เฟส 2 สาย', '6000.00', '1000.00', '7');
INSERT INTO `tb_meter` VALUES ('ME00028', '30(100) แอมป์ 1 เฟส 2 สาย', '13000.00', '3500.00', '7');
INSERT INTO `tb_meter` VALUES ('ME00029', '15(45) แอมป์ 3 เฟส 4 สาย', '15000.00', '5000.00', '7');
INSERT INTO `tb_meter` VALUES ('ME00030', '30(100) แอมป์ 3 เฟส 4 สาย', '40000.00', '10000.00', '7');
INSERT INTO `tb_meter` VALUES ('ME00031', '15(45) แอมป์ 1 เฟส 2 สาย', '1000.00', '300.00', '10');
INSERT INTO `tb_meter` VALUES ('ME00032', '15(45) แอมป์ 1 เฟส 2 สาย', '4000.00', '1000.00', '10');
INSERT INTO `tb_meter` VALUES ('ME00033', '30(100) แอมป์ 1 เฟส 2 สาย', '12000.00', '3000.00', '10');
INSERT INTO `tb_meter` VALUES ('ME00034', '15(45) แอมป์ 3 เฟส 4 สาย', '15000.00', '3000.00', '10');
INSERT INTO `tb_meter` VALUES ('ME00035', '30(100) แอมป์ 3 เฟส 4 สาย', '35000.00', '8000.00', '10');
INSERT INTO `tb_meter` VALUES ('ME00036', '15(45) แอมป์ 1 เฟส 2 สาย', '1000.00', '300.00', '11');
INSERT INTO `tb_meter` VALUES ('ME00037', '15(45) แอมป์ 1 เฟส 2 สาย', '2000.00', '500.00', '11');
INSERT INTO `tb_meter` VALUES ('ME00038', '30(100) แอมป์ 1 เฟส 2 สาย', '5000.00', '1000.00', '11');
INSERT INTO `tb_meter` VALUES ('ME00039', '15(45) แอมป์ 3 เฟส 4 สาย', '7000.00', '3000.00', '11');
INSERT INTO `tb_meter` VALUES ('ME00040', '30(100) แอมป์ 3 เฟส 4 สาย', '20000.00', '3500.00', '11');
INSERT INTO `tb_meter` VALUES ('ME00041', '15(45) แอมป์ 2 เฟส 2 สาย', '1000.00', '300.00', '12');
INSERT INTO `tb_meter` VALUES ('ME00042', '15(45) แอมป์ 1 เฟส 3 สาย', '1500.00', '300.00', '12');
INSERT INTO `tb_meter` VALUES ('ME00043', '1(15) แอมป์ 1 เฟส 2 สาย', '1000.00', '300.00', '13');
INSERT INTO `tb_meter` VALUES ('ME00044', '15(45) แอมป์ 1 เฟส 2 สาย', '1000.00', '300.00', '13');
INSERT INTO `tb_meter` VALUES ('ME00045', '30(100) แอมป์ 1 เฟส 2 สาย', '1000.00', '300.00', '13');
INSERT INTO `tb_meter` VALUES ('ME00046', '15(45) แอมป์ 3 เฟส 4 สาย', '1500.00', '400.00', '13');
INSERT INTO `tb_meter` VALUES ('ME00047', '30(100) แอมป์ 3 เฟส 4 สาย', '1500.00', '400.00', '13');

-- ----------------------------
-- Table structure for tb_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `user_id` char(13) character set utf8 collate utf8_unicode_ci NOT NULL,
  `user_code` char(13) character set utf8 collate utf8_unicode_ci NOT NULL,
  `user_first` int(1) NOT NULL,
  `user_name` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `user_last` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `user_add` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `user_tel` char(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `user_pos` int(1) NOT NULL,
  `user_pass` varchar(12) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_user
-- ----------------------------
INSERT INTO `tb_user` VALUES ('EMP00001', '1219900450538', '0', 'มารุฆ', 'พึ่งตน', '106/11 อ.เมือง ต.ในเมือง จ.ขอนแก่น', '0827416082', '0', '1234');
INSERT INTO `tb_user` VALUES ('EMP00002', '1219900450539', '2', 'จิราพัชร', 'กันหา', '111/22 อ.บ้านไก่ ต.บ้านเป็ด จ.ขอนแก่น 40000', '0822222222', '1', '1111');
INSERT INTO `tb_user` VALUES ('EMP00003', '1454444444444', '2', 'ปณิสตา', 'สานุศิษย์', '295 ม. 13 ถ.ศูนย์ราชการ ต.ในเมือง อ.เมืองขอนแก่น จ.ขอนแก่น 40000', '0847431342', '1', '1234');
INSERT INTO `tb_user` VALUES ('EMP00004', '5889563523232', '2', 'อรอนงค์', 'แข่นจันทร์โส', '656/11 อ.เมือง ต.ในเมือง จ.ขอนแก่น', '0865965656', '1', '1234');
INSERT INTO `tb_user` VALUES ('EMP00005', '1132659569563', '0', 'ปองศักดิ์', 'นับชัยเกิด', '121/55 อ.บ้านเป็ด ต.บ้านเป็ด จ.ขอนแก่น', '0864846546', '1', '1234');
INSERT INTO `tb_user` VALUES ('EMP00006', '123123123', '0', 'วัชระพล', 'มานะ', '45/5 หมู่ 13 หนองหลุบ 40000', '123123123', '1', '1111');

-- ----------------------------
-- Table structure for tb_work
-- ----------------------------
DROP TABLE IF EXISTS `tb_work`;
CREATE TABLE `tb_work` (
  `work_id` char(12) collate utf8_unicode_ci NOT NULL,
  `work_date` date NOT NULL,
  `re_id` char(12) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`work_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tb_work
-- ----------------------------
INSERT INTO `tb_work` VALUES ('150000000001', '2018-01-20', '120000000001');
INSERT INTO `tb_work` VALUES ('150000000002', '2018-01-20', '120000000002');
INSERT INTO `tb_work` VALUES ('150000000003', '2018-01-20', '120000000003');
INSERT INTO `tb_work` VALUES ('150000000004', '2018-01-20', '120000000004');
INSERT INTO `tb_work` VALUES ('150000000005', '2018-01-24', '120000000007');
INSERT INTO `tb_work` VALUES ('150000000006', '2018-01-24', '120000000008');

-- ----------------------------
-- Table structure for tb_work_detail
-- ----------------------------
DROP TABLE IF EXISTS `tb_work_detail`;
CREATE TABLE `tb_work_detail` (
  `work_id` char(12) character set utf8 collate utf8_unicode_ci NOT NULL,
  `user_id` char(12) character set utf8 collate utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_work_detail
-- ----------------------------
INSERT INTO `tb_work_detail` VALUES ('150000000001', 'EMP00005');
INSERT INTO `tb_work_detail` VALUES ('150000000001', 'EMP00003');
INSERT INTO `tb_work_detail` VALUES ('150000000002', 'EMP00002');
INSERT INTO `tb_work_detail` VALUES ('150000000002', 'EMP00006');
INSERT INTO `tb_work_detail` VALUES ('150000000003', 'EMP00006');
INSERT INTO `tb_work_detail` VALUES ('150000000004', 'EMP00004');
INSERT INTO `tb_work_detail` VALUES ('150000000004', 'EMP00002');
INSERT INTO `tb_work_detail` VALUES ('150000000005', 'EMP00002');
INSERT INTO `tb_work_detail` VALUES ('150000000006', 'EMP00004');
INSERT INTO `tb_work_detail` VALUES ('150000000006', 'EMP00005');
