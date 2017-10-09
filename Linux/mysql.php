<?php 

MySql优化的层面
1.表设计层面：存储引擎,索引,列类型,范式规范（冗余）
2.服务器层面:实现数据库主从复制(读写分离)
3.编程层面：避免在循环中select数据表
4.缓存层面:使用nosql技术
5.系统层面:使用Linux操作系统作为服务器底层
6.其他方面:硬件,集群服务器,靠谱的idc供应商,靠谱的技术团队

查看引擎：show engines

数据库的目录 ：/var/lib/mysql  

.frm文件用于存储建表的结构信息(字段信息)
.MYD用于储存表的记录信息
.MYI用于储存表的索引信息(例如:主键)

蠕虫复制（倍增）： insert into 表名（字段）select (字段) from 表名

Innodb 表文件（记录文件、索引文件）共享 无法优化
专注在数据完整性和安全性方面，例如:事务等，对查询，插入数据的效率支持就比较差
Myisam
MyIsam的是追求性能的而生的 

大量查询(select)或者写入(update,insert,delete)就选择Myisam,例如:博客系统,论坛等
数据涉及利益和金钱交易，就需要很严谨和具有安全性，例如销售、财务，股票等系统，就选择innodb


压缩表文件（切换到当前数据库目录）：
    myisampack 表名.MYI （只能压缩索引文件）;
创建表索引文件：  myisamchk 表名.MYI 
刷新表文件：mysqladmin -uroot -p123456 flush-table  
解压索引文件（只有解压后才可以写文件）：myisamchk --unpack 索引文件名
记得刷新表文件

执行计划：explain  
explain select * form tab where name='lisi';

查看索引 ：show index from 表名；
           show create table 表名 //查看表结构

建表后设置主键： alter table 表名 add primary key(id);
设置自增长（依赖主键） ：  alter table 表名 modify id int auto_increment;
删除自增长：   alter table 表名  modify id int  ;
删除主键(必须先删除自增长）：   alter table 表名 drop primary key;

创建唯一索引（保证字段数据唯一）：  create unique index 索引名称 on 表名（字段）；
删除唯一  ： alter table 表名 drop index 索引名称；

创建普通索引 （字段数据可以不唯一）： create index 索引名称 on 表名（字段）；
删除索引：  alter table 表名 drop index 索引名称；

模糊查询：%号在前表示以关键字结尾 反之
select * from articles_like where title like '%mysql%';

全文索引：FullText
创建全文索引：alter table 表名 add FULLTEXT index full_intro(字段1，字段N...);
利用全文索引查询（=like）：select * from 表名 where match(全文索引的字段列) against( ‘+关键字’ in boolean mode)

查询缓存机制：大小字节表示
开启设置缓存大小  set global query_cache_size= 64*1024*1024 （64M）；
关闭缓存： 重启MySQL服务 ：service mysqld restart ;
		   set global query_cache_size =0 ;（建议）；
查看缓存是否开启 大小为0表示没开启 ：
show variables like '%query_cache_size%';

慢查询日志 query_slow_log:

开启慢日志：打开mysql的配置文件 /etc/my.cnf  进行修改

mysql 认为慢操作时间 ： show variables like 'long_query_time';
日志相关选项： show variables like '%slow%';
慢操作总数：  show status like 'Slow_queries';



第二天：------------------------------------------------------------

分页优化：select * from table where id>偏移量 limit 开始 ，结束；

表锁：$pdo->exec('lock tables 表名 write');
解锁：$pdo->exec('unlock tables');

金钱字段类型：DECIMAL(6,2);

时间字段类型：timestamp;

硬件时间：clock show 
硬件时间同步系统：clock systohc;

设置php操作时区：中国 date_default_timezone_set('PRC')；

把ip转换为数字：ip2long()
把转换后的ip变成无符号：sprintf('%u',$ip2long);
数字转换成ip ： long2ip(proper_address);

垂直分表：
数据库第一范式: 共同点；
      第二范式：主表设置主键
      第三范式：附属表某字段关联主表主键  关联性（外键 一般为普通索引）

逆范式：水平分表、
物理水平分表：不同的主题 相同的字段

逻辑水平分表：range 、list;

range:范围
1、建表的时候分表 可以添加主键
create table tab(
	id int primary key auto_increment,
	name varchar(20)
)engine=myisam charset=utf8
partition by range(id)(
	partition 分表名称1 values less than (1000),//指定id的范围1到1000
	partition 分表名称2 values less than (2000) //1001-2000 
);

insert into tab values(300,'tab1000');//添加数据到范围1-1000的分表

删除分表 ： alter table 表名 drop partition 分表名称;

建表后分表不够用继续添加range分表：
alter  table 表名 add partition(
	partition 分表名称 values less than(3000);
);


list :季度 只能设置普通索引

create table tab(
	id int,
	name varchar(20),
	add_time timestamp
)engine=myisam charset=utf8
partition by list(month(add_time))(
	partition spring values in(3,4,5),  //春季
	partition summer values in(6,7,8),  //夏季
	partition autumn values in(9,10,11), //秋季
	partition winter values in(12,1,2),  //冬季
);

删除list分表：alter table tab drip partition 分类名称 ;

建表后继续添加list分表：
alter table tab add partition(
	partition 分表名称 values in (范围)
);

数据库备份：选择到数据库的目录   mysqldump -uroot -p123456 数据库名 >保存文件的路径和名称
数据库导入：新建一个数据库  mysql -uroot -p123456 数据库名< 导入的sql文件


mysql优化第三天：

利用sphinx全文查找：
$sphinx=new SphinxClient();//实例化

$sphinx->setServer('localhost',9312);//连接

//设置搜索模式
$sphinx->setMatchMode(SPH_MATCH_ANY);

$txt=$_GET['txt'];
$arr=$sphinx->query($txt); //查询 返回键
$ids=array_keys($arr['matches']);

foreach ($ids as $key => $id) {
	$sql[]="select * from documents where id ={$id}";
}

$sqlstr=join(' union all ',$sql);

$pdo=new PDO("mysql:host=localhost;post=3306;dbname=test;charset=utf8",'root','123456');

$res=$pdo->query($sqlstr);
$rows=$res->fetchAll(PDO::FETCH_ASSOC);

$opt=array(
	'before_match'=>'<span style="color:red;font-weight:bold">',
	'after_match'=>'</span>'
	);

foreach ($rows as $key => $v) {
	
	$data=$sphinx->buildExcerpts($v,'coreSeekDocsIndex',$txt,$opt);
	echo "第<b>{$data[0]}<b>篇文章：<h3>{$data[4]}</h3><br>文章内容：<b>{$data[5]}<b><hr>";
}

var_dump($data);


修改编辑器：
export EDITOR=vim 

查询binlog 是否开启
show variables like 'log_bin'
mysql配置文件:/etc/my.cnf
修改：log_bin=binlog
重启mysql
查看binlog当前情况
show master status
查看binlog日志的二进制内容：
mysqlbinlog  ./binlog.00001 | less
保留旧binlog文件，创建新文件：
flush logs
重置binlog文件 ：reset master


克隆虚拟机后先打开主虚拟机

grant用户授权：
1、进入主服务器的数据库当中
2、查看从服务器的ip
3、主服务器mysql里授权GRANT ALL PRIVILEGES ON *.* TO 授权用户名@被授权服务器的IP IDENTIFIED BY '授权密码';
4、刷新授权：FLUSH PRIVILEGES;
5、在从服务器登录数据库 
mysql -u授权的用户名 -p授权的密码 -h  主服务器的ip 
查看授权信息 子服务器的mysql 数据库中
select host,user,password form mysql.user where user ='授权用户名';

GRANT ALL PRIVILEGES ON *.* TO tom@192.168.84.123 IDENTIFIED BY '123456';