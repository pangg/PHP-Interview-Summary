<?php
/*
 * 1. 打开文件
 * fopen() : 用来打开一个文件， 打开时需要指定打开模式；
 * 打开模式： r/r+, w/w+, a/a+, x/x+, b, t
 *
 * 2. 写入函数
 * fwirte()
 * fputs()
 *
 * 3. 读取函数
 * fread(): 用于读取文件（可安全用于二进制文件）
 * fgets(): 用于从文件中读取 一行 数据，并将文件指针指向下一行
 * fgetc(): 用于 逐字 读取文件数据，直到文件结束
 *
 * 4. 关闭文件
 * fclose()
 *
 * 5. 不需要fopen()打开的函数
 * file_get_contents()
 * file_put_contents()
 *
 * 6. 其他读取函数
 * file(): 把整个文件读入一个数组中
 * readfile(): 读取文件并写入到输出缓冲
 *
 * 7. 访问远程文件
 * 开启allow_url_fopen, http协议连接只能使用只读， FTP协议可使用只读或者只写
 *
 * 8. 目录操作函数
 *  （1）名称相关：
 *      basename(): 返回路径中的文件名部分
 *      dirname(): 返回路径中的目录部分
 *      pathinfo(): 返回文件路径的信息
 *  (2) 目录读取：
 *      opendir()：打开一个目录句柄，可用于之后的 closedir()，readdir() 和 rewinddir() 调用中。
 *      readdir()： 从目录句柄中读取条目
 *      closedir()： 关闭目录句柄
 *      rewinddir()：将 dir_handle 指定的目录流重置到目录的开头
 *  （3） 目录删除
 *      rmdir()：  删除目录(目录必须是空的，而且要有相应的权限)
 *  （4）目录创建
 *      mkdir()
 *
 * 9. (1)文件大小
 *      filesize()
 *    (2)目录大小
 *      disk_free_space(): 返回目录中的可用空间
 *      disk_total_space():  返回一个目录的磁盘总大小
 *    (3)文件拷贝 copy()
 *    (4)删除文件 unlink()
 *    (5)文件类型： filetype()
 *      (6)重命名或者目录： rename()
 *      (7)文件截取： ftruncate()
 *      (8)文件属性：
 *          file_exists()
 *          is_readable()
 *          is_writeable()
 *          is_executable()
 *          filectime()
 *          fileatime()
 *          filemtime()
 *      (9)文件锁： flock()
 *      (10)文件指针:
 *          ftell(): 返回文件指针读/写的位置
 *          fseek(): 在文件指针中定位
 *          rewind(): 倒回文件指针的位置
 *
 *
 * */

$dir = './test';

/**
 * 删除文件夹
 * @param $path
 * @return bool
 */
function rmdirs($path)
{
    $handle = opendir($path);
    while (($item = readdir($handle)) !== false) {
        if ($item == '.' || $item == '..') continue;
        $_path = $path . '/' . $item;
        if (is_file($_path)) unlink($_path);
        if (is_dir($_path)) rmdirs($_path);
    }
    closedir($handle);
    return rmdir($path);
}


/*
 * 四、 复制文件
 * @param $source
 * @param $dest
 * */
function copydir($source, $dest){
    if(!file_exists($dest)) mkdir($dest);
    $handle = opendir($source);
    while(($item = readdir($handle)) !== false){
        if($item == '.' || $item == '..') continue;
        $_source = $source.'/'.$item;
        $_dest = $dest.'/'.$item;
        if(is_file($_source)) copy($_source, $_dest);
        if(is_dir($_source)) copydir($_source, $_dest);
    }
    closedir($handle);
}
//copydir($dir, './ttt');


/*
 * 三、 文件夹大小
 * @param $path
 * @return int
 * */
function dirsize($path){
    $size = 0;
    $handle = opendir($path);
    while(($item = readdir($handle)) !== false){
        if($item == '.' || $item == '..') continue;
        $_path = $path . '/' . $item;
        if(is_file($_path)) $size += filesize($_path);
        if(is_dir($_path)) $size += dirsize($_path);
    }
    closedir($handle);
    return $size;
}
//echo dirsize($dir);


/*
 * 二、 遍历目录
 * 1. 打开目录
 * 2. 读取目录中文件
 * 3. 如果文件类型是目录， 继续打开目录
 * 4. 读取子目录文件
 * 5. 如果文件类型是文件， 输出文件名称
 * 6. 关闭目录
 * */
function loopDir($dir){
    $handle = opendir($dir);
    while (false !== ($file = readdir($handle))){
        if($file != '.' && $file != '..'){
            echo $file . "\n";
            if(filetype($dir. '/'. $file) == 'dir'){
                loopDir($dir . '/' .$file);
            }
        }
    }
}
//loopDir($dir);


/*
 * 一、
 * 在文件开头不停的插入hello world:
 * 1. 打开文件
 * 2. 读取文件中类容， 并在开头加入hello world
 * 3. 将拼接好的字符串写入文件中
 * */
/*$file = './test/hello.txt';
$handle = fopen($file, 'r');
$content = fread($handle, filesize($file));
$content = 'Hello World' . $content;
fclose($handle);

$handle = fopen($file, 'w');
fwrite($handle, $content);
fclose($handle);*/