```
1. linux常用命令
    （1）系统安全
        sudo, su, chmod, setfacl(设定文件访问控制列表)
    （2）进程管理
        w(显示目前登入系统的用户信息),
        top, ps, kill, pkill(是ps命令和kill命令的结合,用来杀死指定进程),
        pstree(以树状图显示程序),
        killall(以名字方式来杀死进程)
    （3）文件管理
        id(显示指定用户或当前用户),
        usermod(修 改 使 用 者 帐 号),
         useradd, groupadd, userdel
    （4）文件系统
        mount(加载指定的文件系统), umount,
        fsck(检查并修复Linux文件系统),
        df(报告文件系统磁盘空间的使用情况 ),
        du(报告磁盘空间使用情况)
    (5) 系统关机或者重启
        shutdown， reboot
    (6) 网络应用
        curl, telnet(远端登入),
        mail(发送和接收邮件),
        elinks(实现一个纯文本界面的WWW浏览器)
    (7)网络测试
        ping, netstat(显示网络连接，路由表，接口状态等信息),
        host(查询DNS的工具)
    (8) 网络配置
        hostname(显示或者设置当前系统的主机名),
        ifconfig(用来查看、配置、启用或禁用网络接口的工具)

    (9)常用工具
        ssh, screen, clear, who(显示当前已登录的用户信息),
        whois, date
    (10) 软件包管理
        yum, rpm, apt-get
    (11) 文件查找和比较
        locate, find, grep
    (12) 文件内容查看
        head, tail, less, more
    (13)文件处理
        touch, unlink(删除指定的文件),
        rename, ln, cat
    (14) 目录操作
        cd, mv, rm, pwd, tree, cp, ls

    (15) 文件权限属性
        setfacl, chmod, chown, chgrp
    (16) 压缩/解压
        bzip2/bunzip2, gzip/gunzip, zip/unzip, tar

    (17) 文件传输
        ftp, scp

2. linux定时任务
    (1) crontab
        * * * * * (分 时 日 月 周)
    (2) at
            at 2:00 tomorrow
            at>/home/Jason/do_job
            at>Ctrl+D

3. vi/vim 编辑器
    （1）模式： 一般模式，编辑模式和命令行模式
        一般模式：删除，复制和粘贴
        切换编辑模式：i, I, o, O, a, A, r, R
        切换命令行模式 :, /, ?

    （2） 查找和替换
        /word
        ?word
        :n1,n2s/word1/word2/g
        :1,$s/word1/word2/g
        :1,$s/word1/word2/gc

    （3）删除，复制和粘贴
        x, X, dd, ndd, yy, nyy, p, P, ctrl+r

    （4）视图模式
        v, V,  ctrl+v, y, d

4. shell脚本执行
    赋予权限， 直接执行。 例：chomd +x test.sh; ./test.sh
    调用解释器执行脚本： bash, csh, ash, bsh, ksh

    shell编写：
        开头用#!指定脚本解释器， 例如 #!/bin/sh


5. 如何实现每天0点重新启动服务器
    0 0 * * * reboot


    ```