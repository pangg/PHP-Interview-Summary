<?php
/*
 * PHP 支持一个错误控制运算符：@。当将其放置在一个 PHP 表达式之前，该表达式可能产生的任何错误信息都被忽略掉。
 * */
/*$my_file = @file ('non_existent_file') or
die ("Failed opening file: error was '$php_errormsg'");

$value = @$cache[$key];*/


/*
 * 运算符优先级 ：
 * 递增/递减 > ！ > 算术运算符 > 大小比较 > (不)相等比较 > 引用
 *  > 位运算(^) > 位运算（|） > 逻辑与 > 逻辑或 > 三目 > 赋值 > and > xor > or
 * */

// == 和 ===（类型和值）

/*
 * 递增/递减：
 *   不影响布尔值
 *  递减NULL值没有效果
 *  递增NULL值为1
 *  递增递减在前就先运算符后返回， 反之就先返回， 后运算
 * */

/*
 * 逻辑运算：
 * 1. 短路作用
 * 2. 优先级 && > || > =(赋值) > and > or
 *      $a = false || true; --> true
 *      $b = false or true; --> false
 * */

$a = 0;
$b = 0;

if($a = 3 > 0 || $b = 3 > 0) {
    $a ++;   //true++ = true
    $b ++;
    echo $a . "\n";
    echo $b . "\n";
}