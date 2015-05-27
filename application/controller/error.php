<?php
/**
 * Created by PhpStorm.
 * Project: angularJS
 * User: HungPD9
 * Date: 05/27/15 : 2:17 PM
 * File: error.php
 * Description: Controller chuyên xử lý lỗi
 * Done: - ko tìm thấy file
 * TODO: bắt exception và ghi file Log
 */

class Error extends Controller {

    function index()
    {
        $this->error404();
    }

    function error404()
    {
        echo '<h1>404 Error</h1>';
        echo '<p>Trang web không tồn tại</p>';
        echo '<p><a href="'.BASE_URL.'">Về lại trang chủ!</a></p>';
    }

}

?>