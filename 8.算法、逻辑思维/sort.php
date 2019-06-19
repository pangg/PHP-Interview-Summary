<?php
$arr=array(1,43,54,62,21,66,32,78,36,76,39);
/*
 * 冒泡排序：
 * 步骤：
 * 1. 比较相邻的元素。如果第一个比第二个大，就交换他们两个。
 * 2. 对每一对相邻元素作同样的工作，从开始第一对到结尾的最后一对。
 *      在这一点，最后的元素应该会是最大的数。
 * 3. 针对所有的元素重复以上的步骤，除了最后一个。
 * 4. 持续每次对越来越少的元素重复上面的步骤，直到没有任何一对数字需要比较
 * */
//print_r(shell_sort($arr));

function bubbleSort($arr){
    $len = count($arr);
    //该层循环控制 需要冒泡的轮数
    for ($i = 1; $i < $len; $i++){
        //该层循环用来控制每轮 冒出一个数 需要比较的次数
        for ($k = 0; $k < $len-$i; $k++){
            if($arr[$k] > $arr[$k+1]){
                $tmp = $arr[$k+1];
                $arr[$k+1] = $arr[$k];
                $arr[$k] = $tmp;
            }
        }
    }
    return $arr;
}


/*
 * 选择排序(Selection sort)
 * 是一种简单直观的排序算法。它的工作原理如下。
 * 首先在未排序序列中找到最小元素，存放到排序序列的起始位置，
 * 然后，再从剩余未排序元素中继续寻找最小元素，然后放到排序序列末尾。
 * 以此类推，直到所有元素均排序完毕。
 * */
function select_sort($arr){
    $len = count($arr);
    for($i = 0; $i < $len - 1; $i++){
        $p = $i;
        for ($j = $i+1; $j < $len; $j++) {
            if($arr[$p] > $arr[$j]){
                $p = $j;
            }
        }

        if($p != $i){
            $tmp = $arr[$p];
            $arr[$p] = $arr[$i];
            $arr[$i] = $tmp;
        }
    }
    return $arr;
}

/*
 * 插入排序（Insertion Sort）的算法描述是一种简单直观的排序算法。
 * 它的工作原理是通过构建有序序列，对于未排序数据，在已排序序列中从后向前扫描，
 * 找到相应位置并插入。插入排序在实现上，通常采用in-place排序（即只需用到O(1)的额外空间的排序），
 * 因而在从后向前扫描过程中，需要反复把已排序元素逐步向后挪位，为最新元素提供插入空间。
 * */
function insert_sort($arr) {
    $len = count($arr);
    for ($i = 1; $i < $len; $i++) {
        $tmp = $arr[$i];
        for ($j = $i-1; $j >= 0; $j--){
            if($tmp < $arr[$j]){
                $arr[$j+1] = $arr[$j];
                $arr[$j] = $tmp;
            } else {
                break;
            }
        }
    }
    return $arr;
}

/*
 * 快速排序:
 * 1. 从数列中挑出一个元素，称为 “基准”（pivot），
 * 2. 重新排序数列，所有元素比基准值小的摆放在基准前面，所有元素比基准值大的摆在基准的后面（相同的数可以到任一边）。
 *      在这个分区退出之后，该基准就处于数列的中间位置。这个称为分区（partition）操作。
 * 3. 递归地（recursive）把小于基准值元素的子数列和大于基准值元素的子数列排序。
 * */
function quick_sort($arr){
    if(!is_array($arr)) {
        return false;
    }
    $len = count($arr);
    if($len <= 1) {
        return $arr;
    }
    $left = $right = array();
    for($i = 1; $i < $len; $i++){
        if($arr[$i] < $arr[0]){
            $left[] = $arr[$i];
        } else {
            $right[] = $arr[$i];
        }
    }
    $left = quick_sort($left);
    $right = quick_sort($right);
    return array_merge($left, array($arr[0]), $right);
}

/*
 * 希尔排序：
 * 希尔排序是基于插入排序的，区别在于插入排序是相邻的一个个比较（类似于希尔中h=1的情形），而希尔排序是距离h的比较和替换。
 * 希尔排序中一个常数因子n，原数组被分成各个小组，每个小组由h个元素组成，很可能会有多余的元素。当然每次循环的时候，h也是递减的（h=h/n）。
 * 第一次循环就是从下标为h开始。希尔排序的一个思想就是，分成小组去排序。
 * */
function shell_sort($arr) {
    //将$arr按照升序排序
    $len = count($arr);
    $f = 3; //定义因子
    $h = 1; //最小为1
    while ($h < $len/$f) {
        $h = $f * $h + 1;
    }
    while ($h >= 1) {
        for($i = $h; $i < $len; $i++) {
            for($j = $i; $j >= $h; $j -= $h) {
                if($arr[$j] < $arr[$j - $h]){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j - $h];
                    $arr[$j-$h] = $temp;
                }
            }
        }
        $h = intval($h/$f);
    }
    return $arr;
}

//堆排序----------------------------------------------------------------------
/*
 * 堆排序
 * 二叉堆一般都通过"数组"来实现。数组实现的二叉堆，父节点和子节点的位置存在一定的关系。有时候，我们将"二叉堆的第一个元素"放在数组索引0的位置，有时候放在1的位置。当然，它们的本质一样(都是二叉堆)，只是实现上稍微有一丁点区别。
 * 假设"第一个元素"在数组中的索引为 0 的话，则父节点和子节点的位置关系如下：
 * (01) 索引为i的左孩子的索引是 (2*i+1);
 * (02) 索引为i的左孩子的索引是 (2*i+2);
 * (03) 索引为i的父结点的索引是 floor((i-1)/2);
 * */

//$arr=array(49,38,65,97,76,13,27,50);
/*$arrSize=count($arr);
buildHeap($arr, $arrSize);

for($i = $arrSize-1; $i > 0; $i--){
    swap($arr, $i, 0);
    $arrSize--;
    buildHeap($arr, $arrSize);
}

print_r($arr);*/

//用数组建立最小堆
function buildHeap(&$arr, $arrSize) {
    //比较每一个子树的父结点和子结点,将最小值存入父结点中
    //从$index处对一个树进行循环比较,形成最小堆
    for($index = intval($arrSize/2)-1; $index >= 0; $index--) {
        //如果有左节点，将其下标存进最小值$min
        if($index*2+1 < $arrSize){
            $min = $index*2 + 1;
            if($index*2 + 2 < $arrSize) {
                if($arr[$index*2+2] < $arr[$min]){
                    $min = $index*2 + 2;
                }
            }
            //将子节点中较小的和父节点比较，若子节点较小，与父节点交换位置，
            if($arr[$min] < $arr[$index]) {
                swap($arr, $min, $index);
            }
        }
    }
}

function swap(array &$arr, $a, $b){
    $temp = $arr[$a];
    $arr[$a] = $arr[$b];
    $arr[$b] = $temp;
}

//堆排序----------------------------------------------------------------------


//归并排序--------------------------------------------------------------
/*
 *归并操作(merge)，也叫归并算法，指的是将两个顺序序列合并成一个顺序序列的方法。
如　设有数列{6，202，100，301，38，8，1}
初始状态：6,202,100,301,38,8,1
第一次归并后：{6,202},{100,301},{8,38},{1}，比较次数：3；
第二次归并后：{6,100,202,301}，{1,8,38}，比较次数：4；
第三次归并后：{1,6,8,38,100,202,301},比较次数：4；
总的比较次数为：3+4+4=11；
逆序数为14；
归并排序是稳定的排序，速度仅次于快速排序
 * */

function all_merge_sort($array=[]){
    $count = count($array);
    //递归结束条件,到达这步的时候,数组就只剩下一个元素了,也就是分离了数组
    if($count <= 1) {
        return $array;
    }
    $mid = intval($count/2);

    //拆分数组0-mid这部分给左边left_array
    $left_array = array_slice($array, 0, $mid);
    //拆分数组mid-末尾这部分给右边right_array
    $right_array = array_slice($array, $mid);

    $left_array = all_merge_sort($left_array);
    $right_array = all_merge_sort($right_array);

    //合并两个数组,继续递归
    $return_array = merge_sort($left_array,$right_array);
    return $return_array;
}

function merge_sort($lefr_array, $right_array){
    $return_array = [];
    while (count($lefr_array) && count($right_array)) {
        //这里不断的判断哪个值小,就将小的值给到arrC,但是到最后肯定要剩下几个值,
        //不是剩下arrA里面的就是剩下arrB里面的而且这几个有序的值,肯定比arrC里面所有的值都大所以使用
        $return_array[] = $lefr_array[0] < $right_array[0] ? array_shift($lefr_array) : array_shift($right_array);

    }
    return array_merge($return_array, $lefr_array, $right_array);
}

$array=[12,5,4,32,56,87,4,11,2,0];
print_r(all_merge_sort($array));


//归并排序--------------------------------------------------------------
