<?php
/*
 * 一、 版本控制软件
 *      1. 集中式： svn
 *      2. 分布式：git
 *
 * 二、 PHP运行原理
 *  1. CGI: 是一种为了保证web server传递过来的数据是标准格式的通用网关接口协议;
 *          每有一个用户请求，都会先要创建cgi的子进程，然后处理请求，处理完后结束这个子进程
 *  2. FastCGI: 是cgi的升级版本，FastCGI 像是一个常驻 (long-live) 型的 CGI，
 *          它可以一直执行着，只要激活后，不会每次都要花费时间去fork 一次，也是一种协议
 *      FastCGI的工作原理是：
 *      (1)、Web Server启动时载入FastCGI进程管理器
 *          【PHP的FastCGI进程管理器是PHP-FPM(php-FastCGI Process Manager)】
 *      (2)、FastCGI进程管理器自身初始化，启动多个CGI解释器进程
 *          (在任务管理器中可见多个php-cgi.exe)并等待来自Web Server的连接。
 *      (3)、当客户端请求到达Web Server时，FastCGI进程管理器选择并连接到一个CGI解释器。
 *          Web server将CGI环境变量和标准输入发送到FastCGI子进程php-cgi。
 *      (4)、FastCGI子进程完成处理后将标准输出和错误信息从同一连接返回Web Server。
 *          当FastCGI子进程关闭连接时，请求便告处理完成。
 *          FastCGI子进程接着等待并处理来自FastCGI进程管理器（运行在 WebServer中）的下一个连接。
 *          在正常的CGI模式中，php-cgi.exe在此便退出了。
 *
 *
 *          在CGI模式中，可以想象 CGI通常有多慢。每一个Web请求PHP都必须重新解析php.ini、
 *          重新载入全部dll扩展并重初始化全部数据结构。使用FastCGI，所有这些都只在进程启动时发生一次。
 *
 *  3. php-fpm：是对php-cgi的改进版，它直接管理多个php-cgi进程/线程。
 *      也就是说，php-fpm是php-cgi的进程管理器因此它也算是fastcgi协议的实现
 *
 * 三、 PHP常见配置项
 *  register_globals:注册全局变量
 * allow_url_fopen：允许远程文件打开
 * allow_url_include：允许远程文件的包含
 * date.timezone：设置时区
 * display_errors：错误调试
 * error_reporting：显示错误级别设置
 * safe_mode：是否开启安全模式
 * upload_max_filesize：上传文件最大size
 * max_file_uploads：上传的最大文件数量
 * post_max_size：post提交的数据最大大小
 * memory_limit = 8388608 ; 一个脚本最大可使用的内存总量 (这里是8MB)
 *
 * */