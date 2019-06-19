<?php

/*
 * 二分查找
 * 从上面的定义我们可以知道，满足该算法的要求必须如下两点：
 *      必须采用顺序存储结构。
 *      必须按关键字大小有序排列。
 *
 * 二分查找也还是比较容易理解的，大概就是一分为二，然后两边比较，保留有效区间，继续一分为二查找，直到找到或者超出区间则结束
 * */
$arr = [1, 3, 7, 9, 11, 57, 63, 99];
$find_key = binary_search($arr, 57);
$find_key_r = binary_search_recursion($arr, 57, 0, count($arr));
print_r($find_key);
print_r($find_key_r);

function binary_search($arr, $number) {
    if(!is_array($arr) || empty($arr)){
        return -1;
    }
    $len = count($arr);
    $lower = 0;
    $high = $len - 1;
    while ($lower <= $high) {
        $middle = intval(($lower + $high) / 2);
        if($arr[$middle] > $number) {
            $high = $middle - 1;
        }elseif ($arr[$middle] < $number) {
            $lower = $middle + 1;
        }else{
            return $middle;
        }
    }
    return -1;
}

//递归 二分查找
function binary_search_recursion(&$arr, $number, $lower, $high) {
    $middle = intval(($lower+$high)/2);
    if($lower > $high){
        return -1;
    }
    if($number > $arr[$middle]) {
        return binary_search_recursion($arr, $number, $middle+1, $high);
    }elseif ($number < $arr[$middle]){
        return binary_search_recursion($arr, $number, $lower, $middle-1);
    }else{
        return $middle;
    }
}

