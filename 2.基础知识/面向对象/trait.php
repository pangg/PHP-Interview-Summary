<?php
/*
 * trait 优势：
 *      开发人员能够自由地在不同层次结构内独立的类中复用 method，在一定程度上弥补了单继承语言在某些情况下代码不能复用的问题。
 *
 * 与普通类的异同：
 *      相同：
 *          trait 能够像普通的类一样定义属性，方法（包含抽象的、静态的、抽象的）；
 *          trait 引入到基类里面，其子类里面也能访问trait里面的属性和方法。
 *      不同：
 *          trait不用实例化就能访问定义的普通方法以及属性。
 *          trait里面不能定义构造函数。
 *
 *
 * 使用方法：
 *      引入方法很简单，使用也很简单 ，laravel里面使用了大量的trait,可以参考参考，例如：软删除、用户权限验证等等，废话不多说，贴代码：
 * */

Trait TraitOne {

    public $propertyOne = 'argumentOne';

    public function sayHello()
    {
        return "My trait one \n";
    }
}

class MyClass {
    use TraitOne;
}

$myClass = new MyClass();
echo $myClass->sayHello();


/*
 * 由于一个类里面可以引入多个trait,很可能会出现多个trait里面命名冲突的问题，
 * 这个时候就需要使用 insteadof 操作符来明确指定使用冲突方法中的哪一个，
 * 但是这种方式只能排除掉其他trait里面的同名方法，as 操作符可以 为某个方法引入别名。
 * */
Trait TraitTwo {
    public function sayHello(){
        return "My Trait Two \n";
    }
}
class MyClassTwo {

    use TraitOne, TraitTwo {
        TraitTwo::sayHello insteadof TraitOne;  //指定要使用的trait
        Traittwo::sayHello as twoSayHello; //同方法名的trait设置别名
    }


    public function traitMethodValue()
    {
        return $this->twoSayHello();   //调用trait别名方法
    }

}

$myClass = new MyClassTwo();
echo $myClass->twoSayHello();


/*
 * 子类继承了使用trait的基类，在子类里面使用trait的方法
 * */
class MyClassSon extends MyClassTwo {

}

$myClass = new MyClassSon();
echo $myClass->twoSayHello();


