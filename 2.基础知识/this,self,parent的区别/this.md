
 * this是指向对象实例的一个指针，在实例化的时候来确定指向；
 * self是对类本身的一个引用，一般用来指向类中的静态变量；
 * parent是对父类的引用，一般使用parent来调用父类的构造函数
 *     

 * 语句①和语句②使用了this指针，那么当时this是指向谁呢？
 * 其实this是在实例化的时候来确定指向谁，
 * 比如第一次实例化对象的时候(语句③)，那么当时this就是指向$obj1对象，
 * 那么执行语句②的打印时就把print( $this->name ) 变成了 print($obj1t->name )，那么当然就输出了"PBPHome"。
 *
 * 所以说，this就是指向当前对象实例的指针，不指向任何其他对象或类。
```
class name {
     private $name;         //定义属性，私有

     //定义构造函数，用于初始化赋值
     function __construct( $name ){
         $this->name =$name;         //这里已经使用了this指针语句①
     }

     //析构函数
     function __destruct(){}

     //打印用户名成员函数
     function printname(){
         print( $this->name);    //再次使用了this指针语句②，也可以使用echo输出
     }
 }

 $obj1 = new name("PBPHome");   //实例化对象 语句③
 //执行打印
 $obj1->printname(); //输出:PBPHome
 echo"\n";                                    //输出：回车

 //第二次实例化对象
 $obj2 = new name( "PHP" );
 //执行打印
 $obj2->printname();                         //输出：PHP
 ```
