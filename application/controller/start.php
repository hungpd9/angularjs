<?php
/**
 * Created by PhpStorm.
 * Project: angularJS
 * User: HungPD9
 * Date: 05/27/15 : 9:38 AM
 * File: /system/core/model.php
 * Description: Controller mặc định, xử lý home page
 * TODO: 1- kết hợp với router của angular *
 */
class Start extends Controller {

    function index()
    {
        $template = $this->loadView('main');
        $template->render();
    }

}