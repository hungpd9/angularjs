<?php
/**
 * Created by PhpStorm.
 * Project: angularJS
 * User: HungPD9
 * Date: 05/27/15 : 8:44 AM
 * File: /system/core/view.php
 * Description: View mặc định của mô hình MVC, nó cũng khởi tạo để chạy app,
 *              dù có dùng config['site_type']='Angular' hay không!
 */
class View {

    private $pageVars = array();
    private $template;

    public function __construct($template)
    {
        global $config;
        //xác định loại hình chạy của web app
        // mặc định các site php của các trang trong thư mục page
        if($config['site_type'] != 'Angular')
            $this->template = APP_DIR .'view/page/'. $template .'.php';
        elseif($config['site_type'] == 'Angular')
            $this->template = FRONT_DIR .'html/angular/'. $template .'.html';
    }

    public function set($var, $val)
    {
        $this->pageVars[$var] = $val;
    }

    public function render()
    {
        global $config;
        $header_path = '';
        $footer_path = '';

        // xác định file header và footer
        if($config['site_type'] != 'Angular'){
            $header_path = APP_DIR .'view/common/header.php';
            $footer_path = APP_DIR .'view/common/footer.php';
        }
        elseif($config['site_type'] == 'Angular') {
            $header_path = FRONT_DIR . 'html/common/header.html';
            $footer_path = FRONT_DIR . 'html/common/footer.html';
        }
        //bung các giá trị được set trong page
        extract($this->pageVars);
        //Hiển thị site
        ob_start();
        // Gọi các thành phần được hiển thị
        // Gọi common header
        require($header_path);
        require($this->template);
        require($footer_path);
        echo ob_get_clean();
    }

}

?>