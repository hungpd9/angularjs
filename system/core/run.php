<?php
/**
 * Created by PhpStorm.
 * Project: angularJS
 * User: HungPD9
 * Date: 05/27/15 : 9:38 AM
 * File: /system/core/model.php
 * Description: Run dùng để xử lý, điều hướng các URL
 * TODO: 1- kết hợp với router của angular
 *
 */
function run()
{
    global $config;

    // gọi controller mặc định trong config
    $controller = $config['default_controller'];
    $action = 'index';
    $url = '';

    // Get request url and script url
    $request_url = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
    $script_url  = (isset($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : '';

    // Get our url path and trim the / of the left and the right
    if($request_url != $script_url) $url = trim(preg_replace('/'. str_replace('/', '\/', str_replace('index.php', '', $script_url)) .'/', '', $request_url, 1), '/');

    // Split the url into segments
    $segments = explode('/', $url);

    // Do our default checks
    if(isset($segments[0]) && $segments[0] != '') $controller = $segments[0];
    if(isset($segments[1]) && $segments[1] != '') $action = $segments[1];

    // từ tên controller lấy ra tên file
    $path = APP_DIR . 'controller/' . $controller . '.php';
    if(file_exists($path)){
        require_once($path);
    } else {
        $controller = $config['error_controller'];
        require_once(APP_DIR . 'controller/' . $controller . '.php');
    }

    // Xử lý trường hợp ko tồn tại controller
    if(!method_exists($controller, $action)){
        $controller = $config['error_controller'];
        require_once(APP_DIR . 'controller/' . $controller . '.php');
        $action = 'index';
    }

    // Tạo ra các đối tượng của web app và thực thi sự kiện
    $obj = new $controller;
    die(call_user_func_array(array($obj, $action), array_slice($segments, 2)));
}

?>
