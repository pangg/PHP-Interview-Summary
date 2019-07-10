* 1.  goroutine 原理： 拥有强大的并发是通过GPM调度模型实现的；
    * Go的调度器内部有四个重要的结构：M，P，M，Sched
    * M:M代表内核级线程，一个M就是一个线程，goroutine就是跑在M之上的；M是一个很大的结构，
        里面维护小对象内存cache（mcache）、当前执行的goroutine、随机数发生器等等非常多的信息
    * G:代表一个goroutine，它有自己的栈，instruction pointer和其他信息（正在等待的channel等等），用于调度。
    * P:P全称是Processor，处理器，它的主要用途就是用来执行goroutine的，所以它也维护了一个goroutine队列，
        里面存储了所有需要它来执行的goroutine
    * Sched：代表调度器，它维护有存储M和G的队列以及调度器的一些状态信息等。

* 写代码实现两个 goroutine，其中一个产生随机数并写入到 go channel 中，另外一个从 channel 中读取数字并打印到标准输出。最终输出五个随机数。
    ```
    func main() {
        ch := make(chan int)
        done := make(chan bool)
        go func() {
            for {
                select {
                    case ch <- rand.Intn(5): // Create and send random number into channel
                    case <-done: // If receive signal on done channel - Return
                    return
                    default:
                }
            }
        }()

        go func() {
            for i := 0; i < 5; i++ {
                fmt.Println("Rand Number = ", <-ch) // Print number received on standard output
            }
            done <- true // Send Terminate Signal and return
            return
        }()
        <-done // Exit Main when Terminate Signal received
    }
    ```
    
* 3. channel：俗称管道，用于数据传递或数据共享，其本质是一个先进先出的队列，使用goroutine+channel进行数据通
    讯简单高效，同时也线程安全，多个goroutine可同时修改一个channel，不需要加锁。
    * channel可分为三种类型：
        * 只读channel：只能读channel里面数据，不可写入
       *  只写channel：只能写数据，不可读
        * 一般channel：可读可写
     * 带缓冲区channe和不带缓冲区channel
         * 带缓冲区channel：定义声明时候制定了缓冲区大小(长度)，可以保存多个数据。
         * 不带缓冲区channel：只能存一个数据，并且只有当该数据被取出时候才能存下一个数据。
         
         * select-case实现非阻塞channel：
         * 原理通过select+case加入一组管道，当满足（这里说的满足意思是有数据可读或者可写)select中的某个
            case时候，那么该case返回，若都不满足case，则走default分支。

* 4. Golang GC原理：
    * 三色标记：
        * 灰色：对象已被标记，但这个对象包含的子对象未标记
        * 黑色：对象已被标记，且这个对象包含的子对象也已标记，gcmarkBits对应的位为1
        （该对象不会在本次GC中被清理）
        * 白色：对象未被标记，gcmarkBits对应的位为0（该对象将会在本次GC中被清理）
        * 例如，当前内存中有A~F一共6个对象，根对象a,b本身为栈上分配的局部变量，根对象a、b分别引用了对象A、B, 而B对象又引用了对象D，则GC开始前各对象的状态如下图所示:
        
        1. 初始状态下所有对象都是白色的。
        2. 接着开始扫描根对象a、b; 由于根对象引用了对象A、B,那么A、B变为灰色对象，接下来就开始分析灰色对象，分析A时，A没有引用其他对象很快就转入黑色，B引用了D，则B转入黑色的同时还需要将D转为灰色，进行接下来的分析。
        3. 灰色对象只有D，由于D没有引用其他对象，所以D转入黑色。标记过程结束
        4. 最终，黑色的对象会被保留下来，白色对象会被回收掉。
    
* 5. GO性能优化小结
    * 内存优化
        * 1.1 小对象合并成结构体一次分配，减少内存分配次数
        ```
        for k, v := range m {
            k, v := k, v // copy for capturing by the goroutine
            go func() {
            // using k & v
            }()
        }
        替换为：
        for k, v := range m {
            x := struct {k , v string} {k, v} // copy for capturing by the goroutine
            go func() {
            // using x.k & x.v
            }()
        }
        ```
        * 1.2 缓存区内容一次分配足够大小空间，并适当复用: bytes.Buffert等通过预先分配足够大的内存，避免当Grow时动态申请内存，
            这样可以减少内存分配次数。同时对于byte缓存区对象考虑适当地复用。
        * 1.3 slice和map采make创建时，预估大小指定容量:
        * 1.4 长调用栈避免申请较多的临时对象: 
            * 控制调用栈和函数的复杂度，不要在一个goroutine做完所有逻辑；
            * 如查的确需要长调用栈，而考虑goroutine池化，避免频繁创建goroutine带来栈空间的变化。
        * 1.5 避免频繁创建临时对象:
            * GC优化方式是尽可能地减少临时对象的个数：
                * 尽量使用局部变量
                * 所多个局部变量合并一个大的结构体或数组，减少扫描对象的次数，一次回尽可能多的内存。
                
    * 并发优化
        * 2.1 高并发的任务处理使用goroutine池:
            * 过多的goroutine创建，会影响go runtime对goroutine调度，以及GC消耗；
            * 高并时若出现调用异常阻塞积压，大量的goroutine短时间积压可能导致程序崩溃。
        * 2.2 避免高并发调用同步系统接口:
            把涉及到同步调用的goroutine，隔离到可控的goroutine中，而不是直接高并的goroutine调用。
            
        * 2.3 高并发时避免共享对象互斥
        
    * 其它优化
        * 3.1 避免使用CGO或者减少CGO调用次数
        * 3.2 减少[]byte与string之间转换，尽量采用[]byte来字符串处理
        * 3.3 字符串的拼接优先考虑bytes.Buffer
            * 由于string类型是一个不可变类型，但拼接会创建新的string。GO中字符串拼接常见有如下几种方式：
                * string + 操作 ：导致多次对象的分配与值拷贝
                * fmt.Sprintf ：会动态解析参数，效率好不哪去
                * strings.Join ：内部是[]byte的append
                * bytes.Buffer ：可以预先分配大小，减少对象分配与拷贝
                * 建议：对于高性能要求，优先考虑bytes.Buffer，预先分配大小。非关键路径，视简洁使用。
                    fmt.Sprintf可以简化不同类型转换与拼接。
                
            





