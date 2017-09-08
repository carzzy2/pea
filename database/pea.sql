-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- โฮสต์: localhost
-- เวลาในการสร้าง: 
-- รุ่นของเซิร์ฟเวอร์: 5.0.51
-- รุ่นของ PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- ฐานข้อมูล: `pea`
-- 

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `tb_customer`
-- 

CREATE TABLE `tb_customer` (
  `cus_id` char(13) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cus_first` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
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

-- 
-- dump ตาราง `tb_customer`
-- 

INSERT INTO `tb_customer` VALUES ('1102254587855', '0', 'พิรชัย ชัยจินดา', 'VIP', '222222222', '11111111111', '1234', '332', 'ทาวน์เฮาส์', '311', '2', '-', 'หลังชลประทาน', 'ศรีจันทร์ 31', '5', 'ในเมือง', 'เมือง', 'ขอนแก่น', '40000', '0804083856', '0432158785', 'mouse@gmail.com');
INSERT INTO `tb_customer` VALUES ('1102002129468', '2', 'บังอร หลวงภักดี', 'ทั่วไป', '501120017', '583423600151', '001', '332', 'กระนวน', '-', '-', '-', '-', '-', '5', 'กระนวน', 'ซำสูง', 'ขอนแก่น', '40170', '0921383707', '-', 'longpakdee@gmail.com');
INSERT INTO `tb_customer` VALUES ('2202002123368', '2', 'จำแลงรัก สลักใจ', 'บัตรประชาชน', '220200216', '2202002123368', '5/55', '5', 'พิมานธานร', '-', '-', 'ขวดน้ำ', 'คำชะโน้น', 'ลูกประคำ', '5', 'ขวดแก้ว', 'เมือง', 'ชลบุรี', '34255', '0879953563', '0432254536', 'jjgreen@hotmail.com');
INSERT INTO `tb_customer` VALUES ('asdasd', '0', 'asdasd', 'aads', 'asdasd', 'asdasd', '1', '1', '1', '1', '1', '11', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `tb_customer` VALUES ('1ๅ', '1', '55', '5', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6');
INSERT INTO `tb_customer` VALUES ('3211321', '1', 'ฟหกฟหก', '5132123', '32321', '233', '231', '32', '12', '23', '13', '213', '1', '321', '32', '123', '12', '32', '132', '1', '32', '13');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `tb_electricity`
-- 

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
  PRIMARY KEY  (`re_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `tb_electricity`
-- 

INSERT INTO `tb_electricity` VALUES ('120000000002', '2017-08-01', 'พระยืน', 'EMP00002', '1102254587855', 2, 'บ้านพักอาศัย', 'บ้านพักชัยจินดา', '1234', '200', 'พิมาน', '5', '-', '-', 'หลังมอ', 'ประชาสโมสร', '', 'ในเมือง', 'เมือง', 'ขอนแก่น', '40000', '-', '-', '-', 'หอพัก', 'บ้านพักพิรชัย ติดต่อคุณเมาส์', '5678', '411', '5', '-', '-', '-', 'ขุนพล', 'มิตรผล', '2', 'นาดี', 'กรุงศรี', 'ขอนแก่น', '40000', '0432512545', '-', 'moo1234@gmail.com', 16, 'หอพักชาย', 'ดำเนินการโดยด่วน', 8, 'หอพัก', '2017-08-31', 0, 'คุณเมาส์', '222', '245', '5', '-', '-', '-', '-', '-', '9', 'น้ำพอง', 'น้ำพอง', 'ขอนแก่น ', '40158', '0423598751', '087451254', '-', '../pea/img/ele/120000000002.jpg', 9);
INSERT INTO `tb_electricity` VALUES ('120000000001', '2017-08-01', 'มะลิวัลย์', 'EMP00002', '1102002129468', 0, '-', 'ร้านบ้านมอ', '002', '200', 'บ้านมอ', '-', '-', '-', 'หลังมอ', 'ราชพฤกษ์', '', 'บ้านม่วง', 'บ้านม่วง', 'ขอนแก่น', '40000', '0432198548', '-', '-', 'ร้านอาหาร', 'คุณเอ๋ เจ้าของร้าน', '003', '255', '-', '311', '2', '-', 'ขุนพล', 'มิตรผล', '9', 'นาดี', 'กรุงศรี', 'ขอนแก่น', '40170', '0804083596', '043257425', 'moo1234@gmail.com', 14, '-', 'ด่วนมาก', 2, '', '2017-08-06', 0, 'คุณเอ๋ เจ้าของร้าน ที่ร้านบ้านมอ', '005', '352', '5', '5', '6', '7', 'พระลับ', 'ศรีจันทร์', '7', 'พระลับ', 'พระลับ', 'ขอนแก่น', '41720', '-', '-', '-', '../pea/img/ele/120000000001.jpg', 1);
INSERT INTO `tb_electricity` VALUES ('120000000003', '2017-08-01', 'มะลิวัลย์', 'EMP00002', '1102002129468', 0, '-', '', '3000', '335', 'กันยารัตน์', '-', '-', '-', '-', '-', '', 'พระลับ', 'เมือง', 'ขอนแก่น', '40000', '0804083596', '0431254875', 'pan@hotmal.com', 'ที่พักอาศั', 'ติดต่อคุณพลอย', '4000', '152', 'รุ่งนภา', '-', '-', '-', '-', '-', '8', 'นาดี', 'เมือง', 'ขอนแก่น', '40000', '0873551865', '-', '-', 11, '-', 'จำเป็นมาก', 0, '', '2017-08-31', 0, '', '5000', '352', 'ประปา', '311', '1', '-', '-', 'ศรีจันทร์', '7', 'บ้านไผ่', 'เมืองพล', 'ขอนแก่น', '40225', '0820124521', '-', '-', '../pea/img/ele/120000000003.jpg', 0);
INSERT INTO `tb_electricity` VALUES ('120000000004', '2017-08-10', 'พระยืน', 'EMP00002', 'asdasd', 0, '-', '', '5', '5', '5', '5', '5', '5', '5', '5', '', '5', '5', '5', '5', '5', '5', '5', '5', '6565', '5', '5', '56', '56', '56', '42', '565', '65', '65', '6', '56', '5', '65', '65', '6', '56', 8, '-', '-', 3, '', '2017-08-10', 0, '', '54', '54', '5', '5', '5', '5', '5', '5', '5', '5', '55', '5', '5', '5', '5', '45', '../pea/img/ele/120000000004.jpg', 0);
INSERT INTO `tb_electricity` VALUES ('120000000005', '2017-08-10', 'พระยืน', 'EMP00002', '1102254587855', 0, '-', '', '5', '6', '6', '6', '6', '6', '6', '6', '', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', 5, '-', 'ASas', 0, '', '2017-08-10', 0, '', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '../pea/img/ele/120000000005.jpg', 0);
INSERT INTO `tb_electricity` VALUES ('120000000006', '2017-08-20', 'ท่าพระ', 'EMP00002', '3211321', 0, '-', '', '231', '32', '12', '23', '13', '213', '1', '321', '', '123', '12', '32', '132', '1', '32', '13', 'ฟหก', 'ฟหกฟหก', '231', '32', '12', '23', '13', '213', '1', '321', '32', '123', '12', '32', '132', '1', '32', '13', 4, '-', 'ฟหกฟหก', 1, '', '2017-08-20', 0, '', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '../pea/img/ele/120000000006.jpg', 9);
INSERT INTO `tb_electricity` VALUES ('120000000007', '2017-08-20', 'ท่าพระ', 'EMP00002', '1102254587855', 0, '-', '', '1234', '332', 'ทาวน์เฮาส์', '311', '2', '-', 'หลังชลประทาน', 'ศรีจันทร์ 31', '', 'ในเมือง', 'เมือง', 'ขอนแก่น', '40000', '0804083856', '0432158785', 'mouse@gmail.com', 'asdasd', 'dsfsfd', '1234', '332', 'ทาวน์เฮาส์', '311', '2', '-', 'หลังชลประทาน', 'ศรีจันทร์ 31', '5', 'ในเมือง', 'เมือง', 'ขอนแก่น', '40000', '0804083856', '0432158785', 'mouse@gmail.com', 2, '-', '-', 0, '', '2017-08-20', 0, '', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '../pea/img/ele/120000000007.jpg', 0);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `tb_equipment`
-- 

CREATE TABLE `tb_equipment` (
  `equ_id` char(12) character set utf8 collate utf8_unicode_ci NOT NULL,
  `equ_date` date NOT NULL,
  `re_id` char(12) character set utf8 collate utf8_unicode_ci NOT NULL,
  `user_id` char(13) character set utf8 collate utf8_unicode_ci NOT NULL,
  `equ_tran` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `equ_tran_unit` int(10) NOT NULL,
  `equ_air` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `equ_air_unit` int(10) NOT NULL,
  `equ_lantern` int(10) NOT NULL,
  `equ_outlet` int(10) NOT NULL,
  `equ_fan` int(10) NOT NULL,
  `equ_other` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `equ_detail` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `equ_status` int(1) NOT NULL,
  PRIMARY KEY  (`equ_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `tb_equipment`
-- 

INSERT INTO `tb_equipment` VALUES ('130000000002', '2017-08-21', '120000000001', 'EMP00001', 'asdasd', 2, 'asdasd', 1, 65, 66, 6, '-', 'ตังหมดด', 0);
INSERT INTO `tb_equipment` VALUES ('130000000001', '2017-08-21', '120000000001', 'EMP00001', '', 0, '', 0, 0, 0, 0, '', 'ผู้ใช้บริการมีปัญหา', 1);
INSERT INTO `tb_equipment` VALUES ('130000000003', '2017-08-21', '120000000006', 'EMP00002', '', 0, '', 0, 0, 0, 0, '', 'มีปัญหาภายใน', 1);
INSERT INTO `tb_equipment` VALUES ('130000000004', '2017-09-08', '120000000002', 'EMP00002', '', 0, '', 0, 0, 0, 0, '', 'ดินไม่ได้มาตรฐาน', 1);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `tb_free`
-- 

CREATE TABLE `tb_free` (
  `fee_id` char(12) NOT NULL,
  `fee_date` date NOT NULL,
  `fee_amount` double(10,2) NOT NULL,
  `re_id` char(12) NOT NULL,
  `user_id` char(13) NOT NULL,
  PRIMARY KEY  (`fee_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `tb_free`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `tb_general`
-- 

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
  `rg_money` int(10) NOT NULL,
  `rg_status` int(1) NOT NULL,
  PRIMARY KEY  (`rg_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `tb_general`
-- 

INSERT INTO `tb_general` VALUES ('110000000001', '2017-06-15', 'มะลิวัลย์', 'EMP00002', '1102254587855', 2, '-', 'วัดป่าบ้านไร่', '112', '24', '-', '112', '1', 'สัตหีบ', 'ขุนช้าง', 'เหล่านาดี', '10', 'บ้านน้อย', 'ไก่ย่าง', 'มะลิวัลย์', '40000', '0152445527', '0745878464', 'mac_11@gmail.com', 'เช่า', 'วัดป่าบ้านไร่', '112', '24', '-', '1', '1', 'สัตหีบ', 'ขุนช้าง', 'เหล่านาดี', '10', 'บ้านน้อย', 'ไก่ย่าง', 'ขอนแก่น', '40000', '0152445527', '0745878464', 'mac_11@gmail.com', 9, '-', '', 0, 2);
INSERT INTO `tb_general` VALUES ('110000000002', '2017-06-16', 'มะลิวัลย์', 'EMP00002', '1102254587855', 2, '-', 'บ้านไง', '111/12', '13', 'ไทยดี', '1', '2', '-', '-', 'เหล่านาดี', '6', 'มิ่งขวัญ', 'เสมอปลาย', 'เลย', '46530', '0864655995', '0864655995', 'mmm_15@gmail.com', 'บ้านพัก', '111/23', '111/12', '13', 'ไทยดี', '1', '2', '-', '-', 'เหล่านาดี', '6', 'มิ่งขวัญ', 'เสมอปลาย', 'เลย', '46530', '0864655995', '0864655995', 'mmm_15@gmail.com', 6, '-', '-', 0, 1);
INSERT INTO `tb_general` VALUES ('110000000003', '2017-06-16', 'มะลิวัลย์', 'EMP00002', '1102254587855', 0, '', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 6, 'ไก่', '-', 500, 1);
INSERT INTO `tb_general` VALUES ('110000000004', '2017-06-17', 'มะลิวัลย์', 'EMP00002', '1102254587855', 2, '-', 'บ้านพักคนชรา', '124', '42', 'บะขาม', '-', '0', 'บึงกาน', 'ไทยเท', 'ชาตะพดุง', '6', 'จรัญศรี', 'ชัยดี', 'เพรชบุรี', '436520', '0847274825', '0432887465', 'ssew_11@mail.com', 'บ้านพัก', '', '124', '1', 'ขามแก่น', '-', '0', '-', '-', 'ศรีจันทร์', '2', 'ศรีทันยา', 'ในเมือง', 'ขอนแก่น', '40000', '0896469565', '0437867874', 'ssew_11@mail.com', 10, '-', '-', 0, 1);
INSERT INTO `tb_general` VALUES ('110000000005', '2017-06-17', 'มะลิวัลย์', 'EMP00002', '1102254587855', 0, '', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 3, '1', '1', 0, 1);
INSERT INTO `tb_general` VALUES ('110000000006', '2017-06-27', 'มะลิวัลย์', 'EMP00002', '1102254587855', 0, '', '1', 'q1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '11', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', 5, '-', '-', 0, 1);
INSERT INTO `tb_general` VALUES ('110000000007', '2017-07-10', 'มะลิวัลย์', 'EMP00002', '1102254587855', 0, '', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', 1, '-', '-', 2000, 1);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `tb_user`
-- 

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

-- 
-- dump ตาราง `tb_user`
-- 

INSERT INTO `tb_user` VALUES ('EMP00001', '1219900450538', 0, 'พิรชัย', 'ชัยจินดา', '106/11 อ.เมือง ต.ในเมือง จ.ขอนแก่น', '0827416082', 0, '1234');
INSERT INTO `tb_user` VALUES ('EMP00002', '1219900450539', 0, 'ปกรณ์', 'ใบเนียม', '111/22 อ.บ้านไก่ ต.บ้านเป็ด จ.ขอนแก่น 40000', '0822222222', 1, '1234');
INSERT INTO `tb_user` VALUES ('EMP00003', '1454444444444', 0, 'สมใจอยาก', 'แจ่มแจ้ง', '295 ม. 13 ถ.ศูนย์ราชการ ต.ในเมือง อ.เมืองขอนแก่น จ.ขอนแก่น 40000', '0845458727', 1, '1234');
