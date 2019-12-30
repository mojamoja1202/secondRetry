CREATE TABLE `secondRetry_student` (
  `sn` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '索引',
  `id` varchar(255) NOT NULL COMMENT '考生編號',
  `name` varchar(255) NOT NULL COMMENT '考生姓名',
  `sex` varchar(255) NOT NULL COMMENT '考生性別',
  `school` varchar(255) NOT NULL COMMENT '就讀學校',
  `originschool` varchar(255) NOT NULL COMMENT '原學校',
  PRIMARY KEY (`sn`)
) ENGINE=MyISAM;

CREATE TABLE `secondRetry_check1` (
  `sn` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '索引',
  `right_num1` smallint(5) UNSIGNED NOT NULL COMMENT '答對題數',
  `T1` smallint(5) UNSIGNED NOT NULL COMMENT 'T分數',
  `PR1` smallint(5) UNSIGNED NOT NULL COMMENT 'PR值',
  PRIMARY KEY (`sn`)
) ENGINE=MyISAM;

CREATE TABLE `secondRetry_check2` (
  `sn` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '索引',
  `right_num2` smallint(5) UNSIGNED NOT NULL COMMENT '答對題數',
  `T2` smallint(5) UNSIGNED NOT NULL COMMENT 'T分數',
  `PR2` smallint(5) UNSIGNED NOT NULL COMMENT 'PR值',
  PRIMARY KEY (`sn`)
) ENGINE=MyISAM;

CREATE TABLE `secondRetry_check3` (
  `sn` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '索引',
  `right_num3` smallint(5) UNSIGNED NOT NULL COMMENT '答對題數',
  `T3` smallint(5) UNSIGNED NOT NULL COMMENT 'T分數',
  `PR3` smallint(5) UNSIGNED NOT NULL COMMENT 'PR值',
  PRIMARY KEY (`sn`)
) ENGINE=MyISAM;

CREATE TABLE `secondRetry_grade` (
  `sn` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '索引',
  `id` varchar(255) NOT NULL COMMENT '鑑定證編號',
  `name` varchar(255) NOT NULL COMMENT '姓名',
  `school` varchar(255) NOT NULL COMMENT '學校',
  `o1` smallint(5) UNSIGNED NOT NULL COMMENT '原始分數1',
  `s1` smallint(5) UNSIGNED NOT NULL COMMENT '標準分數1',
  `o2` smallint(5) UNSIGNED NOT NULL COMMENT '原始分數2',
  `s2` smallint(5) UNSIGNED NOT NULL COMMENT '標準分數2',
  `o3` smallint(5) UNSIGNED NOT NULL COMMENT '原始分數3',
  `s3` smallint(5) UNSIGNED NOT NULL COMMENT '標準分數3',
  `o4` smallint(5) UNSIGNED NOT NULL COMMENT '原始分數4',
  `s4` smallint(5) UNSIGNED NOT NULL COMMENT '標準分數4',
  `o5` smallint(5) UNSIGNED NOT NULL COMMENT '原始分數5',
  `s5` smallint(5) UNSIGNED NOT NULL COMMENT '標準分數5',
  `o6` smallint(5) UNSIGNED NOT NULL COMMENT '原始分數6',
  `s6` smallint(5) UNSIGNED NOT NULL COMMENT '標準分數6',
  `o7` smallint(5) UNSIGNED NOT NULL COMMENT '原始分數7',
  `s7` smallint(5) UNSIGNED NOT NULL COMMENT '標準分數7',
  `o8` smallint(5) UNSIGNED NOT NULL COMMENT '原始分數8',
  `s8` smallint(5) UNSIGNED NOT NULL COMMENT '標準分數8',
  `sL` smallint(5) UNSIGNED NOT NULL COMMENT '語言標準分數',
  `snonL` smallint(5) UNSIGNED NOT NULL COMMENT '非語言標準分數',
  `sall` smallint(5) UNSIGNED NOT NULL COMMENT '標準分數合計',
  `note` varchar(255) NOT NULL COMMENT '缺考',
  PRIMARY KEY (`sn`)
) ENGINE=MyISAM;