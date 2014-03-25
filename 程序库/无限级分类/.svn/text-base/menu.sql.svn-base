-- phpMyAdmin SQL Dump
-- version 2.8.2.4
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost:3306
-- 生成日期: 2007 年 05 月 21 日 09:35
-- 服务器版本: 5.0.24
-- PHP 版本: 5.1.6
-- 
-- 数据库: `menu`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `menu`
-- 

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL auto_increment,
  `fid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `pathint` varchar(200) NOT NULL,
  `pathchar` varchar(400) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

-- 
-- 导出表中的数据 `menu`
-- 

INSERT INTO `menu` (`id`, `fid`, `name`, `pathint`, `pathchar`) VALUES (1, 0, '软件', ':1', ':软件'),
(2, 0, '硬件', ':2', ':硬件'),
(3, 2, '主板', ':2:3', ':硬件:主板'),
(4, 2, '显卡', ':2:4', ':硬件:显卡'),
(5, 2, 'CPU', ':2:5', ':硬件:CPU'),
(6, 5, '英特尔', ':2:5:6', ':硬件:CPU:英特尔'),
(7, 5, 'AMD', ':2:5:7', ':硬件:CPU:AMD'),
(8, 1, '软件应用', ':1:8', ':软件:软件应用'),
(9, 1, '传统编程', ':1:9', ':软件:传统编程'),
(10, 1, '网络编程', ':1:10', ':软件:网络编程'),
(11, 9, 'C语言', ':1:9:11', ':软件:传统编程:C语言'),
(12, 9, 'VB语言', ':1:9:12', ':软件:传统编程:VB语言'),
(13, 10, 'PHP开发', ':1:10:13', ':软件:网络编程:PHP开发'),
(14, 10, 'ASP', ':1:10:14', ':软件:网络编程:ASP'),
(15, 10, 'JSP', ':1:10:15', ':软件:网络编程:JSP'),
(16, 10, 'ASP.net', ':1:10:16', ':软件:网络编程:ASP.net'),
(17, 13, 'PHP入门', ':1:10:13:17', ':软件:网络编程:PHP开发:PHP入门'),
(18, 13, 'PHP进阶', ':1:10:13:18', ':软件:网络编程:PHP开发:PHP进阶'),
(19, 18, '模板应用', ':1:10:13:18:19', ':软件:网络编程:PHP开发:PHP进阶:模板应用'),
(20, 18, '框架', ':1:10:13:18:20', ':软件:网络编程:PHP开发:PHP进阶:框架'),
(21, 18, 'PEAR类库', ':1:10:13:18:21', ':软件:网络编程:PHP开发:PHP进阶:PEAR类库');

-- --------------------------------------------------------

-- 
-- 表的结构 `news`
-- 

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL auto_increment,
  `tid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `concent` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `news`
-- 

INSERT INTO `news` (`id`, `tid`, `title`, `concent`) VALUES (1, 17, '如何连接mysql数据库', '连接mysql数据库有几种方式,第一种是PHP内置函数,第二种是写封装类,第三种是利用成熟的类库.');
