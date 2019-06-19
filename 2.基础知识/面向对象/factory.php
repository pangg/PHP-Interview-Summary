<?php
/*
 * 工厂模式分为三种：简单工厂、工厂方法、抽象工厂
 * */

/*
 * 场景：一台电脑的产生一定需要主板，CPU，内存条，显示器。
 *
 * 1. 如果有一个工厂专门生产各种型号的主板，那么这个工厂可以说是简单工厂也可以说是工厂方法，怎样区分是简单工厂还是工厂方法呢？
 *      如果客户是通过一个主板型号单来购买主板，这时此厂需要按清单生产相应的主板给客户，这就是简单工厂；
 *      如果客户不想写单，而是自己按照这个厂规范自己造厂来生产这种型号的主板，这就是工厂方法。
 * 2. 如果有一个工厂可以同时生产不同型号的主板，CPU，内存条，显示器，那么可以说成是抽象工厂，
 *      它和工厂方法一样也是自己根据建厂规范自己造厂子，只是这个厂子可以同时生产各种类型的产品（主板，CPU，内存条，显示器）。
 * 3. ps:可以说简单工厂和工厂方法近似相同，都是一次给客户生产一类型产品，只是实现方式稍微不同而已，一个通过传参，一个通过不同子类。
 *      而抽象工厂的建厂规范就不同了，厂子具有同时生产各种产品的能力，一次给客户生产多个类型的产品。
 *
 *
 *  三种工厂的区别是，抽象工厂由多条产品线，而工厂方法只有一条产品线，是抽象工厂的简化。
 *  而工厂方法和简单工厂相对，大家初看起来好像工厂方法增加了许多代码但是实现的功能和简单工厂一样。
 *  但本质是，简单工厂并未严格遵循设计模式的开闭原则，当需要增加新产品时也需要修改工厂代码。
 *  但是工厂方法则严格遵守开闭原则，模式只负责抽象工厂接口，具体工厂交给客户去扩展。
 *  在分工时，核心工程师负责抽象工厂和抽象产品的定义，业务工程师负责具体工厂和具体产品的实现。
 *  只要抽象层设计的好，框架就是非常稳定的。
 *
 * */

//抽象产品
interface Person {
    public function getName();
}

//具体产品的实现
class Teacher implements Person {
    function getName(){
        return "Treacher \n";
    }
}
class Student implements Person {
    function getName() {
        return "Student \n";
    }
}

//简单工厂
class SimpleFactory {
    public static function getPerson($type) {
        $person = null;
        if($type == 'teacher') {
            $person = new Teacher();
        } elseif ($type == 'student') {
            $person =  new Student();
        }
        return $person;
    }
}

//简单工厂调用
class SimpleClient {
    function main() {
        // 如果不用工厂模式，则需要提前指定具体类
        // $person = new Teacher();
        // echo $person->getName();
        // $person = new Student();
        // echo $person->getName();
        // 用工厂模式，则不需要知道对象由什么类产生，交给工厂去决定
        $person = SimpleFactory::getPerson('teacher');
        echo $person->getName();
        $person = SimpleFactory::getPerson('student');
        echo $person->getName();
    }
}

//工厂方法
interface CommFactory {
    public function getPerson();
}

//具体工厂实现
class StudentFactory implements CommFactory {
    function getPerson(){
        return new Student();
    }
}
class TeacherFactory implements CommFactory {
    function getPerson(){
        return new Teacher();
    }
}

//工厂方法调用
class CommClient {
    static function main() {
        $factory = new TeacherFactory();
        echo $factory->getPerson()->getName();
        $factory = new StudentFactory();
        echo $factory->getPerson()->getName();
    }
}


//抽象工厂模式另一条产品线
interface Grade {
    function getYear();
}
//另一条产品线的具体产品
class Grade1 implements Grade {
    public function getYear() {
        return '2003 Class';
    }
}
class Grade2 implements Grade {
    public function getYear() {
        return '2004 Class';
    }
}
//抽象工厂
interface AbstractFactory {
    function getPerson();
    function getGrade();
}
//具体工厂可以生产每个商品线的产品
class Grade1TeacherFactory implements AbstractFactory {
    public function getPerson(){
        return new Teacher();
    }
    public function getGrade(){
        return new Grade1();
    }
}
class Grade1StudentFactory implements AbstractFactory {
    public function getPerson(){
        return new Student();
    }
    public function getGrade(){
        return new Grade1();
    }
}
class Grade2TeacherFactory implements AbstractFactory {
    public function getPerson(){
        return new Teacher();
    }
    public function getGrade() {
        return new Grade2();
    }
}
//抽象工厂调用
class FactoryClient {
    function printInfo($factory) {
        echo $factory->getGrade()->getYear() .
            $factory->getPerson()->getName();
    }
    function main(){
        $client = new FactoryClient();
        $factory = new Grade1TeacherFactory();
        $client->printInfo($factory);

        $factory = new Grade1StudentFactory();
        $client->printInfo($factory);

        $factory = new Grade2TeacherFactory();
        $client->printInfo($factory);
    }
}

//简单工厂
//SimpleClient::main();
//工厂方法
//CommClient::main();

//抽象工厂
FactoryClient::main();