<?php
/*
 *self是指向类本身，也就是self是不指向任何已经实例化的对象，一般self使用来指向类中的静态变量。
 * 假如我们使用类里面静态（一般用关键字static）的成员，我们也必须使用self来调用。
 * 还要注意使用self来调用静态变量必须使用:: (域运算符号)
 * */
class counter     //定义一个counter的类
    {
        //定义属性，包括一个静态变量$firstCount，并赋初值0 语句①
        private static $firstCount = 0;
        private $lastCount;

        //构造函数
        function __construct()
        {
            $this->lastCount =++self::$firstCount;      //使用self来调用静态变量 语句②
        }

        //打印lastCount数值
        function printLastCount()
        {
            print( $this->lastCount );
        }
    }

 //实例化对象
 $obj = new Counter();
 $obj->printLastCount();    //执行到这里的时候，程序输出1

//实例化对象
$obj2 = new Counter();
$obj2->printLastCount();   //2


/*
 * 这里要注意两个地方语句①和语句②。我们在语句①定义了一个静态变量$firstCount，那么在语句②的时候使用了self调用这个值，
 * 那么这时候我们调用的就是类自己定义的静态变量$frestCount。
 * 我们的静态变量与下面对象的实例无关，它只是跟类有关，
 * 那么我调用类本身的的，那么我们就无法使用this来引用，因为self是指向类本身，与任何对象实例无关。
 * 然后前面使用的this调用的是实例化的对象$obj
 * */