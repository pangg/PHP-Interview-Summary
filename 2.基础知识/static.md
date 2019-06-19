
1、函数体中的静态变量

//1 函数体中的静态变量与全局中的静态变量不冲突，只有在关键字global作用下才会使局部与全局统一
//2 函数体中的静态变量在函数调用的时候只会被初始化一次
static $a = 1;
function num1(){
    static $a = 0;
    return $a++;
}

function num2(){
    $a = 5555;
    echo $a ."\n";
    global $a;
    echo $a ."\n";
    echo $a++  ."--\n";
}

function num3(){
    static $a = 100;
    return $a++;
}

echo "num1: " . num1() ."\n"; //0

num2(); //1
echo $a ."\n";  //2


echo num3() ."\n"; //100
echo num3() ."\n"; //101
echo num3() ."\n"; //102




2.  类中的静态成员: 类中的静态成员包含静态属性和静态方法
class Foo{
    public static $my_static = 'foo';

    public function staticValue() {
        return self::$my_static;
    }
}

class Bar extends Foo
{
    public function fooStatic() {
        return parent::$my_static;
    }
}


print Foo::$my_static . "\n";

$foo = new Foo();
print $foo->staticValue() . "\n";

print $foo::$my_static . "\n";
$classname = 'Foo';
print $classname::$my_static . "\n"; // 5.3开始可以使用变量调用类

print Bar::$my_static . "\n";
$bar = new Bar();
print $bar->fooStatic() . "\n";



 *作为静态变量，还可以在多个对象之间共享数据，创建好几个对象的时候，因为每次都是new的，所以创建的对象都不同，
 * 如果想让多个对象实例共享同一个变量，就可以用到静态变量。假设要编写一个类来跟踪网页浏览的人数，
 * 肯定不希望每次实例化该类时都把访问者数量置0，只是就可以将该属性设置为static

class Visitor{
    private static $visitors = 0;

    public function __construct()
    {
        self::$visitors++;
    }

    public static function getVisitors()
    {
        return self::$visitors;
    }
}

// 实例化
$visitor1 = new Visitor();
echo Visitor::getVisitors() . "\n";        // 1

$visitor2 = new Visitor();
echo Visitor::getVisitors() . "\n";        // 2*/



 * 延迟静态绑定  参考链接：https://www.jianshu.com/p/ab5749914f7c
 *
 * 在PHP 5.3中延迟静态绑定的概念，最明显的标志就是使用static关键字，它指向的是被调用的类而不是包含类。

abstract class DomainObject{
    public static function create(){
        return new static();
    }
}

class User extends DomainObject{
}

class Document extends DomainObject{
}

print_r(Document::create());




 * static关键字不仅可以用于实例化，和self和parent一样，static还可以作为静态方法调用的标识符，甚至是从非静态上下文中调用。
 * 例如为DomainObject引入组的概念，默认组为default，可以用static为继承层次结构的某些子类重写组

 *代码中，DomainObject的构造函数使用static调用静态方法getGroup()，设置默认组为default，在Document中重写了getGroup()方法，重新设置了组

abstract class DomainObject
{
    private $group;
    public function __construct()
    {
        $this->group = static::getGroup();
    }

    public static function create()
    {
        return new static();
    }

    public static function getGroup()
    {
        return "default";
    }
}

class User extends DomainObject
{

}

class Document extends DomainObject
{
    public static function getGroup()
    {
        return "document";
    }
}

class SpreadSheet extends Document
{

}

print_r(User::create());
print_r(SpreadSheet::create());