<?php
/**
 * Created by PhpStorm.
 * Project: angularJS
 * User: HungPD9
 * Date: 05/27/15 : 8:44 AM
 * File: index.php
 * Description: Chạy website, chứa một số thông tin config mặc định ko đổi
 */
//0- Khởi tạo session cho web app
session_start();
//1- Định nghĩa các thư mục gốc
define('ROOT_DIR',realpath(dirname(__FILE__)) .'/');
define('APP_DIR',ROOT_DIR.'application/');
define('FRONT_DIR',ROOT_DIR.'front_end/');
define('IMG_DIR',ROOT_DIR.'images/');
define('SYS_DIR',ROOT_DIR.'system/');
define('LIB_DIR',SYS_DIR.'libraries/');
//2- Định nghĩa các function, module chạy mặc định
//3- Định nghĩa 1 số hằng toàn cục
//4- Chạy chương trình (web app)
?>