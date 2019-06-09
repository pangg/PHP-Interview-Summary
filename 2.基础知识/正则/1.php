<?php
/*1. 正则表达式的作用： 分割、查找、匹配、替换字符串
 *
 * 正则函数： preg_match(), preg_match_all(), preg_replace(), preg_split()
 *  */

/*//139开头的11位手机号码
$str = '13988888888';
$pattern = '/^139\d{8}$/';
preg_match($pattern, $str, $match);
var_dump($match);*/


//请匹配所有img标签中的src的值：
$str = '<img alt="高清图片" src="av.jpg" />';
$pattern = '/<img.*?src="(.*?)".*?\/?>/i';
preg_match($pattern, $str, $match);
var_dump($match);

/*
 *  常用正则表达式：
  匹配网址URL的正则表达式：http://([\w-]+\.)+[\w-]+(/[\w- ./?%&=]*)?
  提取信息中的网络链接：(h|H)(r|R)(e|E)(f|F) *= *('|")?(\w|\\|\/|\.)+('|"| *|>)?
  匹配Email地址的正则表达式：\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*
  提取信息中的图片链接：(s|S)(r|R)(c|C) *= *('|")?(\w|\\|\/|\.)+('|"| *|>)?
  匹配IP地址的正则表达式：/(\d+)\.(\d+)\.(\d+)\.(\d+)/g
  提取信息中的中国手机号码：(86)*0*13\d{9}
 * */