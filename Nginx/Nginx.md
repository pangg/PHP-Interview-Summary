Nginx相关内容

1. 正向代理
    正向代理也就是代理，他的工作原理就像一个跳板，简单的说，我访问不了google.com，
    但是我能访问一个代理服务器A，A能访问 google.com，于是我先连上代理服务器A，
    告诉他我需要google.com的内容，A就去取回来，然后返回给我。从网站的角度，只在代理
    服务器来取内容的时候有一次记录，有时候并不知道是用户的请求，也隐藏了用户的资料，
    这取决于代理告不告诉网站。

    结论就是，正向代理是一个位于客户端和原始服务器(origin server)之间的服务器。
    为了从原始服务器取得内容，客户端向代理发送一个 请求并指定目标(原始服务器)，
    然后代理向原始服务器转交请求并将获得的内容返回给客户端。

2. 反向代理
    举个例子，比如我想访问 http://www.test.com/readme，但www.test.com上并不存在readme
    页面，于是他是偷偷从另外一台服务器上 取回来，然后作为自己的内容返回用户，但用户并不知情。
    这里所提到的 www.test.com 这个域名对应的服务器就设置了反向代理功能。

    结论就是，反向代理正好相反，对于客户端而言它就像是原始服务器，并且客户端不需要进行任何特别
    的设置。客户端向反向代理的命名 空间(name-space)中的内容发送普通请求，接着反向代理将判断向
    何处(原始服务器)转交请求，并将获得的内容返回给客户端，就像这些 内容原本就是它自己的一样。

    nginx 使用反向代理，主要是使用location模块下的proxy_pass选项。
    在vhost目录中新建一个conf server
        #centos.iyangyi.conf
        server {
            listen 80;
            server_name centos.iyangyi.com;
            access_log /usr/local/var/log/nginx/centos.iyangyi.access.log main;
            error_log /usr/local/var/log/nginx/centos.iyangyi.error.log error;
            location / {
                proxy_pass http://192.168.33.10;
            }
        }

    反向代理服务器可以隐藏源服务器的存在和特征。它充当互联网云和web服务器之间的中间层。
    这对于安全方面来说是很好的，特别是当您使用web托管服务时。

3. Nginx 负载均衡搭建
    Nginx Upstream的几种方式：轮询, weight, ip_hash, fair, url_hash

4. 为什么要用Nginx？
   优点：
   跨平台、配置简单
   非阻塞、高并发连接：处理2-3万并发连接数，官方监测能支持5万并发
   内存消耗小：开启10个nginx才占150M内存，Nginx采取了分阶段资源分配技术
   nginx处理静态文件好,耗费内存少
   内置的健康检查功能：如果有一个服务器宕机，会做一个健康检查，再发送的请求就不会发送到宕机的服务器了。重新将请求提交到其他的节点上。
   节省宽带：支持GZIP压缩，可以添加浏览器本地缓存
   稳定性高：宕机的概率非常小
   master/worker结构：一个master进程，生成一个或者多个worker进程
   接收用户请求是异步的：浏览器将请求发送到nginx服务器，它先将用户请求全部接收下来，再一次性发送给后端web服务器，极大减轻了web服务器的压力
   一边接收web服务器的返回数据，一边发送给浏览器客户端
   网络依赖性比较低，只要ping通就可以负载均衡
   可以有多台nginx服务器
   事件驱动：通信机制采用epoll模型

5. 为什么不使用多线程？
   Apache: 创建多个进程或线程，而每个进程或线程都会为其分配cpu和内存（线程要比进程小的多，
   所以worker支持比perfork高的并发），并发过大会榨干服务器资源。

   Nginx: 采用单线程来异步非阻塞处理请求（管理员可以配置Nginx主进程的工作进程的数量）(epoll)，
   不会为每个请求分配cpu和内存资源，节省了大量资源，同时也减少了大量的CPU的上下文切换。
   所以才使得Nginx支持更高的并发。

6. 为什么Nginx性能这么高？
   得益于它的事件处理机制：
   异步非阻塞事件处理机制：运用了epoll模型，提供了一个队列，排队解决

7. Nginx是如何处理一个请求的呢？
   首先，nginx在启动时，会解析配置文件，得到需要监听的端口与ip地址，然后在nginx的master进程里面
   先初始化好这个监控的socket，再进行listen
   然后再fork出多个子进程出来, 子进程会竞争accept新的连接。
   此时，客户端就可以向nginx发起连接了。当客户端与nginx进行三次握手，与nginx建立好一个连接后
   此时，某一个子进程会accept成功，然后创建nginx对连接的封装，即ngx_connection_t结构体
   接着，根据事件调用相应的事件处理模块，如http模块与客户端进行数据的交换。
   最后，nginx或客户端来主动关掉连接，到此，一个连接就寿终正寝了

8. 安装的 nginx + php-fpm 环境，假设用户浏览一个耗时的网页，但是却在服务端渲染页面的中途关闭
    了浏览器，那么请问服务端的 php 脚本是继续执行还是退出执行？

    正常情况下，如果客户端client异常退出了，服务端的程序还是会继续执行，直到与IO进行了两次
    交互操作。服务端发现客户端已经断开连接，这个时候会触发一个user_abort，如果这个没有设置
    ignore_user_abort，那么这个php-fpm的程序才会被中断。

9、请解释Nginx服务器上的Master和Worker进程分别是什么?
    Master进程：读取及评估配置和维持
    Worker进程：处理请求

10. nginx和apache的区别？
    1）轻量级，同样起web 服务，比apache 占用更少的内存及资源
    2）抗并发，nginx 处理请求是异步非阻塞的，而apache 则是阻塞型的，在高并发下nginx 能保持低资源低消耗高性能
    3）高度模块化的设计，编写模块相对简单
    4）最核心的区别在于apache是同步多进程模型，一个连接对应一个进程；nginx是异步的，多个连接（万级别）可以对应一个进程

11. 请解释是否有可能将Nginx的错误替换为502错误、503?
    502 =错误网关
    503 =服务器超载
    有可能，但是您可以确保fastcgi_intercept_errors被设置为ON，并使用错误页面指令。

    Location / {
        fastcgi_pass 127.0.01:9001;
                  fastcgi_intercept_errors on;
                  error_page 502 =503/error_page.html;
                  #…
    }
