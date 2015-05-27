<?php
/*
 * @Author: HungPD
 * @Description: File chứa các biến toàn cục có thể thường xuyên thay đổi khi chuyển host, server
 * @Date: 27/05/2015
 * */
//link gốc của website
$config['base_url'] = 'http://localhost/angularjs/';
// gọi ra controller mặc định(trường hợp thường là truy cập domain, file index.php
$config['default_controller'] = 'main'; // Default controller to load
// controller điều khiển lỗi
$config['error_controller'] = 'error'; // Controller used for errors (e.g. 404, 500 etc)
//config các biến để model xử lý DB, hiện tại đã hỗ trợ MySQL
//TODO: build PostGreSql
$config['db_type'] = 'pg';
$config['db_host'] = 'localhost'; // Database host (e.g. localhost)
$config['db_name'] = 'mvc'; // Database name
$config['db_username'] = 'postgres'; // Database username
$config['db_password'] = 'phamhung'; // Database password
//config hình thức website
//mục tiêu xây dựng site client-server với frond-end là AngularJS-Html5 và Back-end là PHP sau đó là NodeJS
//Code hỗ trợ sẵn MVC PHP
$config['site_type'] = 'Angular';
?>