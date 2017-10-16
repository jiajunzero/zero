CREATE TABLE `tp_logistics` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL COMMENT '公司名称',
  `code` varchar(100) NOT NULL COMMENT '接口代号',
  `sortorder` tinyint(3) UNSIGNED NOT NULL DEFAULT '20' COMMENT '排序号(升序)'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='物流公司' ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `tp_logistics`
--

INSERT INTO `tp_logistics` (`id`, `name`, `code`, `sortorder`) VALUES
(1, '顺丰速递', 'shunfeng', 20),
(2, 'EMS', 'ems', 20),
(3, '广东邮政', 'guangdongyouzhengwuliu', 20),
(4, '申通快递', 'shentong', 20),
(5, '天天快递', 'tiantian', 20),
(6, '圆通速递', 'yuantong', 20),
(7, '韵达快运', 'yunda', 20),
(8, '运通快递', 'yuntongkuaidi', 20),
(9, '中通速递', 'zhongtong', 20),
(10, '宅急送', 'zhaijisong', 20),
(11, '优速物流', 'youshuwuliu', 20),
(12, 'UPS', 'ups', 20),