<?php

/*
 * PHP中include()与require()的区别:
 *1.  require 的使用方法如 require("MyRequireFile.php"); 。
 * 这个函数通常放在 PHP 程序的最前面，PHP 程序在执行前，就会先读入 require 所指定引入的文件，
 * 使它变成 PHP 程序网页的一部份。常用的函数，亦可以这个方法将它引入网页中。
 * 2. include 使用方法如 include("MyIncludeFile.php"); 。
 * 这个函数一般是放在流程控制的处理部分中。PHP 程序网页在读到 include 的文件时，才将它读进来。
 * 这种方式，可以把程序执行时的流程简单化。
 *
 * 他们两个的用途是完全一样的，不一定非得哪个放在最前面哪个放在中间。
 * 他们最根本的区别在于错误处理的方式不一样:
 * require一个文件存在错误的话，那么程序就会中断执行了，并显示致命错误
 * include一个文件存在错误的话，那么程序不会中端，而是继续执行，并显示一个警告错误。
 *
 * require(include)/require_once(include_once) ：
 * 唯一区别是php会检查该文件是否已经被包含过，
 * 如果是则不会再次包含。
 *  */

//系统内置函数

/*
 * 时间日期函数
 * date(), strtotime(), mktime(), time(), microtime(),
 * date_default_timezone_set()
 * */


/*
 * IP处理函数：
 * ip2long()
 * long2ip()
 * */

//echo sprintf("%u\n", ip2long("157.23.56.90"));


/*
 * 打印处理函数：
 *echo 、print、printf可以打印变量内容，但不能显示数组及系统超级变量数组；
 * print_r 和 var_dump不仅可以打印数组、标量变量，还可以打印对象的内容；
 * var_dump语句不仅能打印变量、数组内容，还可以显示布尔变量和资源（resource）的内容；
 * var_export 函数返回关于传递给该函数的变量的结构信息，和 var_dump()函数类似，不同的是其返回的内容是合法的php代码。
 * */


/*
 * 序列化和反序列化函数：
 * serialize() 把变量和它们的值编码成文本形式
 * unserialize() 恢复原先变量
 * */

/*
 * 字符串处理函数：
 *
strlen($str);//返回字符串长度 mb_strlen($str) 可以返回中文字符长度；
strtolower($str);//字母转小写
strtoupper($str);//字母转大写
ucwords($str);//每一个单词的首字母转大写
ucfirst($str);//首字母转大写
str_replace('a','b',$str);//b替换$str 中的a 区分大小写  ;
str_ireplace('a','b',$str);//替换 不区分大小写
htmlspecialchars($str,ENT_NOQUOTES);
//字符串转换为html 实体 ENT_COMPT(默认只编译双引号)ENT_QUOTES单引号双引号都编译,ENT_NOQUOTES不编译任何引号
trim($str);//删除字符串前后（左右）空格
ltrim($str);//只删除字符串左侧的空格
rtrim($str);//只删除字符串右侧的空格
//trim加第二个参数 就是移除指定的字符集 如ltrim($str,'0..9') 移除左侧数字开头的字符
strpos($str,'a’);//字符串a 在$str 第一次出现的位置 索引0开始 没有出现返回false 区分大小写
stripos($str,'a’);//同上 但是不区分大小写
strrpos($str,'a’);//字符串a 在$str 最后一次出现的位置 索引0开始 没有出现返回false 区分大小写
strripos($str,'a’);//同上 但是不区分大小写
substr($str,0,3);//截取字符串 $str 的第一个字符 截取长度3 长度不填默认截取到最后  参数为负数则倒数
strstr($str,'a');//截取字符串 $str 中的第一个字符'a'后的字符串 如 sabc -> abc
strrchr($str,'a');//截取字符串 $str 中最后一一个字符'a'后的字符串
strrev($str);//字符串反转 abcd->dcba
md5($str);//字符串MD5加密
str_shuffle($str);//随机打乱字符串顺序
explode('-',$str);//指定分隔符分割字符串 返回数组 ‘-’ 分割$str
implode('-',$str);//数组拼接字符串 与explode()相反
 * */


/*
 * 数组处理函数：
 *
 * 一、数组操作的基本函数
数组的键名和值
array_values($arr);  获得数组的值
array_keys($arr);  获得数组的键名
array_flip($arr);  数组中的值与键名互换（如果有重复前面的会被后面的覆盖）
in_array("apple",$arr);  在数组中检索apple
array_search("apple",$arr);  在数组中检索apple ，如果存在返回键名
array_key_exists("apple",$arr);  检索给定的键名是否存在数组中
isset($arr[apple]):   检索给定的键名是否存在数组中


数组的内部指针
current($arr);  返回数组中的当前单元
pos($arr);  返回数组中的当前单元
key($arr);  返回数组中当前单元的键名
prev($arr);  将数组中的内部指针倒回一位
next($arr);  将数组中的内部指针向前移动一位
end($arr);  将数组中的内部指针指向最后一个单元
reset($arr;  将数组中的内部指针指向第一个单元
each($arr);  将返回数组当前元素的一个键名/值的构造数组，并使数组指针向前移动一位
list($key,$value)=each($arr);  获得数组当前元素的键名和值

数组和变量之间的转换
extract($arr);用于把数组中的元素转换成变量导入到当前文件中，键名当作变量名，值作为变量值
注：（第二个参数很重要，可以看手册使用）使用方法 echo $a;
compact(var1,var2,var3);用给定的变量名创建一个数组


二、数组的分段和填充
数组的分段
array_slice($arr,0,3);  可以将数组中的一段取出，此函数忽略键名
array_splice($arr,0,3，array("black","maroon"));  可以将数组中的一段取出，与上个函数不同在于返回的序列从原数组中删除


分割多个数组
array_chunk($arr,3,TRUE);  可以将一个数组分割成多个，TRUE为保留原数组的键名

数组的填充
array_pad($arr,5,'x');  将一个数组填补到制定长度


三、数组与栈
array_push($arr,"apple","pear");  将一个或多个元素压入数组栈的末尾（入栈），返回入栈元素的个数
array_pop($arr);  将数组栈的最后一个元素弹出（出栈）

四、数组与列队
array_shift($arr);数组中的第一个元素移出并作为结果返回（数组长度减1，其他元素向前移动一位，数字键名改为从零技术，文字键名不变）
array_unshift($arr,"a",array(1,2));在数组的开头插入一个或多个元素

五、回调函数
array_walk($arr,'function','words');  使用用户函数对数组中的每个成员进行处理（第三个参数传递给回调函数function）
array_mpa("function",$arr1,$arr2);  可以处理多个数组（当使用两个或更多数组时，他们的长度应该相同）
array_filter($arr,"function");  使用回调函数过滤数组中的每个元素，如果回调函数为TRUE，数组的当前元素会被包含在返回的结果数组中，数组的键名保留不变
array_reduce($arr,"function","*");  转化为单值函数（*为数组的第一个值）


六、数组的排序

通过元素值对数组排序
sort($arr);  由小到大的顺序排序（第二个参数为按什么方式排序）忽略键名的数组排序
rsort($arr);  由大到小的顺序排序（第二个参数为按什么方式排序）忽略键名的数组排序
usort($arr,"function");  使用用户自定义的比较函数对数组中的值进行排序（function中有两个参数，0表示相等，正数表示第一个大于第二个，负数表示第一个小于第二个）忽略键名的数组排序
asort($arr);  由小到大的顺序排序（第二个参数为按什么方式排序）保留键名的数组排序
arsort($arr);  由大到小的顺序排序（第二个参数为按什么方式排序）保留键名的数组排序
uasort($arr,"function");  使用用户自定义的比较函数对数组中的值进行排序（function中有两个参数，0表示相等，正数表示第一个大于第二个，负数表示第一个小于第二个）保留键名的数组排序


通过键名对数组排序
ksort($arr);  按照键名正序排序
krsort($arr);  按照键名逆序排序
uksort($arr,"function");  使用用户自定义的比较函数对数组中的键名进行排序（function中有两个参数，0表示相等，正数表示第一个大于第二个，负数表示第一个小于第二个）


自然排序法排序
natsort($arr);  自然排序（忽略键名）
natcasesort($arr);  自然排序（忽略大小写，忽略键名）


七、数组的计算

数组元素的求和
array_sum($arr);  对数组内部的所有元素做求和运算

数组的合并
array_merge($arr1,$arr2);  合并两个或多个数组（相同的字符串键名，后面的覆盖前面的，相同的数字键名，后面的不会做覆盖操作，而是附加到后面）
“+”$arr1+$arr2;  对于相同的键名只保留后一个
array_merge_recursive($arr1,$arr2);   递归合并操作，如果数组中有相同的字符串键名，这些值将被合并到一个数组中去。如果一个值本身是一个数组，将按照相应的键名把它合并为另一个数组。当数组 具有相同的数组键名时，后一个值将不会覆盖原来的值，而是附加到后面

数组的差集
array_diff($arr1,$arr2);  返回差集结果数组
array_diff_assoc($arr1,$arr2,$arr3);  返回差集结果数组，键名也做比较

数组的交集
array_intersect($arr1,$arr2);  返回交集结果数组
array_intersect_assoc($arr1,$arr2);  返回交集结果数组，键名也做比较

八、其他的数组函数

range(0,12);  创建一个包含指定范围单元的数组
array_unique($arr);  移除数组中重复的值，新的数组中会保留原始的键名
array_reverse($arr,TRUE);  返回一个单元顺序与原数组相反的数组，如果第二个参数为TRUE保留原来的键名
//srand((float)microtime()*10000000);   随机种子触发器
array_rand($arr,2);  从数组中随机取出一个或 多个元素
shuffle($arr);  将数组的顺序打乱


其他函数:
array_change_key_case — 返回字符串键名全为小写或大写的数组
array_chunk — 将一个数组分割成多个
array_combine — 创建一个数组，用一个数组的值作为其键名，另一个数组的值作为其值
array_count_values — 统计数组中所有的值出现的次数
array_diff_assoc — 带索引检查计算数组的差集
array_diff_key — 使用键名比较计算数组的差集
array_diff_uassoc — 用用户提供的回调函数做索引检查来计算数组的差集
array_diff_ukey — 用回调函数对键名比较计算数组的差集
array_diff — 计算数组的差集
array_fill_keys — Fill an array with values, specifying keys
array_fill — 用给定的值填充数组
array_filter — 用回调函数过滤数组中的单元
array_flip — 交换数组中的键和值
array_intersect_assoc — 带索引检查计算数组的交集
array_intersect_key — 使用键名比较计算数组的交集
array_intersect_uassoc — 带索引检查计算数组的交集，用回调函数比较索引
array_intersect_ukey — 用回调函数比较键名来计算数组的交集
array_intersect — 计算数组的交集
array_key_exists — 检查给定的键名或索引是否存在于数组中
array_keys — 返回数组中所有的键名
array_map — 将回调函数作用到给定数组的单元上
array_merge_recursive — 递归地合并一个或多个数组
array_merge — 合并一个或多个数组
array_multisort — 对多个数组或多维数组进行排序
array_pad — 用值将数组填补到指定长度
array_pop — 将数组最后一个单元弹出（出栈）
array_product — 计算数组中所有值的乘积
array_push — 将一个或多个单元压入数组的末尾（入栈）
array_rand — 从数组中随机取出一个或多个单元
array_reduce — 用回调函数迭代地将数组简化为单一的值
array_reverse — 返回一个单元顺序相反的数组
array_search — 在数组中搜索给定的值，如果成功则返回相应的键名
array_shift — 将数组开头的单元移出数组
array_slice — 从数组中取出一
array_splice — 把数组中的一部分去掉并用其它值取代
array_sum — 计算数组中所有值的和
array_udiff_assoc — 带索引检查计算数组的差集，用回调函数比较数据
array_udiff_uassoc — 带索引检查计算数组的差集，用回调函数比较数据和索引
array_udiff — 用回调函数比较数据来计算数组的差集
array_uintersect_assoc — 带索引检查计算数组的交集，用回调函数比较数据
array_uintersect_uassoc — 带索引检查计算数组的交集，用回调函数比较数据和索引
array_uintersect — 计算数组的交集，用回调函数比较数据
array_unique — 移除数组中重复的值
array_unshift — 在数组开头插入一个或多个单元
array_values — 返回数组中所有的值
array_walk_recursive — 对数组中的每个成员递归地应用用户函数
array_walk — 对数组中的每个成员应用用户函数
array — 新建一个数组
arsort — 对数组进行逆向排序并保持索引关系
asort — 对数组进行排序并保持索引关系
compact — 建立一个数组，包括变量名和它们的值
count — 计算数组中的单元数目或对象中的属性个数
current — 返回数组中的当前单元
each — 返回数组中当前的键／值对并将数组指针向前移动一步
end — 将数组的内部指针指向最后一个单元
extract — 从数组中将变量导入到当前的符号表
in_array — 检查数组中是否存在某个值
key — 从关联数组中取得键名
krsort — 对数组按照键名逆向排序
ksort — 对数组按照键名排序
list — 把数组中的值赋给一些变量
natcasesort — 用“自然排序”算法对数组进行不区分大小写字母的排序
natsort — 用“自然排序”算法对数组排序
next — 将数组中的内部指针向前移动一位
pos — current() 的别名
prev — 将数组的内部指针倒回一位
range — 建立一个包含指定范围单元的数组
reset — 将数组的内部指针指向第一个单元
rsort — 对数组逆向排序
shuffle — 将数组打乱
sizeof — count() 的别名
sort — 对数组排序
uasort — 使用用户自定义的比较函数对数组中的值进行排序并保持索引关联
uksort — 使用用户自定义的比较函数对数组中的键名进行排序
usort — 使用用户自定义的比较函数对数组中的值进行排序
 * */