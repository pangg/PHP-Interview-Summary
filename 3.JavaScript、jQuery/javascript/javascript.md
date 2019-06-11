JavaScript
1. 变量定义：
    （1）变量必须以字母开头， 也可以$和_符号开头
    （2）变量名称对大小写敏感
    （3）使用var关键词声明变量， 可以一条语句中声明很多变量
    （4）未使用值来声明的变量， 值为undefined
    （5）如果重新声明JavaScript变量，该变量值不会丢失：var a=1;var a; 此时a值依旧为1

2. 数据类型：
    字符串、数字、布尔、数组、对象、Null、Undefined
    js变量均为对象， 声明一个变量时就创建一个新的对象；

3. 创建对象
    （1）new Object()
    （2）使用构造器函数
        function Her(name){
            this.name = name;
            this.child = 'Jon;
            this.whoAreYou = function(){
                return 'I am' + this.name + 'My child is' + this.child;
            }
        }
        var her1 = new Her('A');
        var her2 = new Her('B');
     （3）JSON对象

4. 函数： 无默认值
    函数内部声明的变量（使用var）是局部变量
    在函数外声明的变量是全局变量， 所有脚本和函数都能访问它

5. 运算符：+（字符串拼接和加运算）

6. Number
    var pi=3.14;
    var myNum=new Number(value);
    var myNum=Number(value);
    方法：
        toString： 把数字转换为字符串
        toFixed：把数字转换为字符串，结果的小数点后有指定位数的数字

7. String
    var str = new String(s);
    var str = String(s);
    var str = 'this is string';
    方法：
        concat(): 连接字符串
        match()：找到一个或多个正则表达式的匹配
        replace()：替换与正则表达式匹配的子串
        search()：检索与正则表达式相匹配的值
        slice()：提取字符串的片断，并在新的字符串中返回被提取的部分
        split()：把字符串分割为字符串数组
        substr()：从起始索引号提取字符串中指定数目的字符
        toLowerCase()：把字符串转换为小写
        toUpperCase()：把字符串转换为大写。

8. Boolean
    var bool = true;
    var bool = new Boolean(value);	//构造函数
    var bool = Boolean(value);//转换函数
    方法：
        toString()： 把逻辑值转换为字符串，并返回结果
        valueOf()： 返回 Boolean 对象的原始值

9. Array
    new Array();
    new Array(size);
    new Array(element0, element1, ..., elementn);
    方法：
        concat()：连接两个或更多的数组，并返回结果
        join()：把数组的所有元素放入一个字符串，元素通过指定的分隔符进行分隔
        pop()：删除并返回数组的最后一个元素
        push()：向数组的末尾添加一个或更多元素，并返回新的长度
        reverse()：颠倒数组中元素的顺序
        shift()：删除并返回数组的第一个元素
        slice()：从某个已有的数组返回选定的元素 arrayObject.slice(start,end)
        sort()：对数组的元素进行排序
        splice()：删除元素，并向数组添加新元素
        unshift()：向数组的开头添加一个或更多元素，并返回新的长度

10. Date
    var myDate=new Date()
    方法：
        Date()：返回当日的日期和时间
        getDate()：从 Date 对象返回一个月中的某一天 (1 ~ 31)
        getDay()：从 Date 对象返回一周中的某一天 (0 ~ 6)
        getMonth(): 从 Date 对象返回月份 (0 ~ 11)
        getFullYear(): 从 Date 对象以四位数字返回年份
        getHours(): 返回 Date 对象的小时 (0 ~ 23)
        getMinutes(): 返回 Date 对象的分钟 (0 ~ 59)
        getSeconds(): 返回 Date 对象的秒数 (0 ~ 59)
        getTime(): 返回 1970 年 1 月 1 日至今的毫秒数

11. Math
    var pi_value=Math.PI;
    var sqrt_value=Math.sqrt(15);
    方法：
        abs(x)：返回数的绝对值
        ceil(x)：对数进行上舍入
        floor(x)：对数进行下舍入
        pow(x,y)：返回 x 的 y 次幂
        random()：返回 0 ~ 1 之间的随机数
        round(x)： 把数四舍五入为最接近的整数
        sqrt(x)：返回数的平方根

12. RegExp
    /pattern/attributes
    new RegExp(pattern, attributes);
    修饰符：
        i 执行对大小写不敏感的匹配
        g 执行全局匹配（查找所有匹配而非在找到第一个匹配后停止）
        m 执行多行匹配
    量词:
        n$ 匹配任何结尾为 n 的字符串
        ^n 匹配任何开头为 n 的字符串
        ?=n 匹配任何其后紧接指定字符串 n 的字符串
        ?!n 匹配任何其后没有紧接指定字符串 n 的字符串

    方法：
        search 检索与正则表达式相匹配的值
        match 找到一个或多个正则表达式的匹配
        replace 替换与正则表达式匹配的子串
        split 把字符串分割为字符串数组

13. window对象
    window, navigator, screen, history, location

14. DOM对象
    Document, Element, Attr, Event
    （1）Document 对象方法:
        getElementById()：返回对拥有指定 id 的第一个对象的引用
        getElementsByName()：返回带有指定名称的对象集合
        getElementsByTagName()：返回带有指定标签名的对象集合
        getElementsByClassName()

15. jquery基础知识
    jQuery选择器
    （1）基本选择器：
        #id
        element
        .class
        *
        selector1,selector2,selectorN
    （2）层次选择器：
        ancestor descendant
        parent > child
        prev + next
        prev ~ siblings
    （3）过滤选择器
        :first
        :not(selector)
        :even
        :odd
        :last
    （4）可见性过滤选择器
        :hidden
        :visible
    （5）属性过滤选择器
        [attribute]
        [attribute=value]
        [attribute!=value]
        [attribute^=value]
        [attribute$=value]
        [attribute*=value]
    （6）子元素过滤选择器
        :first-child
        :last-child
    （7）表单对象属性过滤选择器
        :enabled
        :disabled
        :checked
        :selected

16. JavaScript中为id是test的元素设置样式为good
    document.getElementById('test').className = 'good'

