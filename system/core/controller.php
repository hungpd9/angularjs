<?php
/**
 * Created by PhpStorm.
 * Project: angularJS
 * User: HungPD9
 * Date: 05/27/15 : 9:24 AM
 * File: /system/core/controller.php
 * Description: Controller mặc định của mô hình MVC, nó cũng khởi tạo để chạy app,
 *              dù có dùng config['site_type']='Angular' hay không!
 */
class Controller {

    public function loadModel($name)
    {
        require(APP_DIR .'model/'. strtolower($name) .'.php');
        $model = new $name;
        return $model;
    }

    public function loadView($name)
    {
        $view = new View($name);
        return $view;
    }
/*
 * TODO: dự tính sẽ thực hiện plugin, libaries và helper
    public function loadPlugin($name)
    {
        require(APP_DIR .'plugins/'. strtolower($name) .'.php');
    }

    public function loadHelper($name)
    {
        require(APP_DIR .'helpers/'. strtolower($name) .'.php');
        $helper = new $name;
        return $helper;
    }
*/
    public function redirect($loc)
    {
        global $config;
        header('Location: '. $config['base_url'] . $loc);
    }

}

?>