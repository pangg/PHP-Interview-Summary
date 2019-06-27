parent是指向父类的指针，一般我们使用parent来调用父类的构造函数


//建立基类Animal
class Animal {

    public $name; //基类的属性，名字$name

    //基类的构造函数，初始化赋值
    public function __construct( $name ){
        $this->name = $name;
    }
}


class Person extends Animal {  //定义派生类Person 继承自Animal类
    public$personSex;    //对于派生类，新定义了属性$personSex性别、$personAge年龄
    public $personAge;

    //派生类的构造函数
    function __construct( $personSex, $personAge ){
        parent::__construct( "PBPHome");    //使用parent调用了父类的构造函数 语句①
        $this->personSex = $personSex;
        $this->personAge = $personAge;
    }

    //派生类的成员函数，用于打印，格式：名字 is name,age is 年龄
    function printPerson(){
        print( $this->name. " is ".$this->personSex. ",age is ".$this->personAge );
    }
}

//实例化Person对象
$personObject = new Person( "male", "21");

//执行打印
$personObject->printPerson();//输出结果：PBPHome is male,age is 21
