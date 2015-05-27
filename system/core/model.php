<?php
/**
* Created by PhpStorm.
* Project: angularJS
* User: HungPD9
* Date: 05/27/15 : 9:38 AM
* File: /system/core/model.php
* Description: Model mặc định của mô hình MVC, nó cũng khởi tạo để chạy app,
*              dù có dùng config['site_type']='Angular' hay không!
* TODO: 1- hoàn thiện PostgreSQL
*       2- xây dựng thêm các thư viện SQL khác như SqlLite, MongoSQL,...
*/
class Model {

    private $connection;

    public function __construct()
    {
        global $config;
        $db_type = $config['db_type'];
        if($db_type == 'pg'){
            $this->connection = pg_connect("host=" . $config['db_host'] . " port=5432 dbname=" . $config['db_name'] . " user=" . $config['db_username'] . " password=" . $config['db_password']);
        }
        elseif($db_type == 'mysql'){
            $this->connection = mysql_pconnect($config['db_host'], $config['db_username'], $config['db_password']) or die('MySQL Error: '. mysql_error());
            mysql_select_db($config['db_name'], $this->connection);
        }
    }
// chống lỗi cú pháp khi insert db
    public function escapeString($string)
    {
        return mysql_real_escape_string($string);
    }
// đang lỗi ở đây
    public function escapeArray($array)
    {
        array_walk_recursive($array, create_function('&$v', '$v = mysql_real_escape_string($v);'));
        return $array;
    }
//quick execute sql từ array
    public function insert_db_from_array($tb_name,$val){
        /*Array format như sau:
        $type1 = array(
           array(
              'title' => 'My title' ,
              'name' => 'My Name' ,
              'date' => 'My date'
           ),
           array(
              'title' => 'Another title' ,
              'name' => 'Another Name' ,
              'date' => 'Another date'
           )
        );
        $type2 = array(
            array("name column1","name column2","name column4"),
            array("value column1","value column2","value column4"),
            array("value column1","value column2","value column4"),
            ...
        );
         * */
        $type = true;
        if(!is_null($val) && is_array($val))
            if(is_numeric(current(array_keys($val[0]))))$type = false;
        else return;
        $sql = 'Insert Into '.$tb_name.' ';
        $query = '';
        // Để tránh trường hợp array quá lớn dẫn đến sql bị lỗi,cứ insert 50 phần tử sẽ reset query 1 lần
        foreach($val as $row => $value){
            if($row == 0){
                $column = $type ? array_keys($value) : array_values($value);
                $sql = 'Insert Into '.$tb_name.' ('.implode(',',$column).') Values ';
                $query = $sql;
            }

            $column = array_values($value);
            $query .= "('" . implode("','",$column)."')";
            if(($row+1)%50 == 0){
                execute($sql);
                $query = $sql;
            }elseif($row<count($val)-1) $query .= ',';
        }
        execute($sql);
    }
    //quick execute sql từ array
    public function update_db_from_array($tb_name,$val){
        /*Array format như sau:
        $tb_name = array("table_name","key","value")
        $type1 = array(
              'title' => 'My title' ,
              'name' => 'My Name' ,
              'date' => 'My date'
           );

         * */

        $sql = "UPDATE $tb_name[0] WHERE $tb_name[1] = '$tb_name[2]' SET ";
        $update = array();

        foreach($val as $key => $value)
                $update[] = "$key = '$value'";

        execute($sql.implode(',',$update));
    }

    public function to_bool($val)
    {
        return !!$val;
    }
// date format trong database nói chung là Y-m-d
    public function to_date($val)
    {
        return date('Y-m-d', $val);
    }
// time format trong database nói chung là H:i:s
    public function to_time($val)
    {
        return date('H:i:s', $val);
    }
// datetime format trong database nói chung là Y-m-d H:i:s
    public function to_datetime($val)
    {
        return date('Y-m-d H:i:s', $val);
    }
// định nghĩa lại hàm query, hay hàm execute query, kết quả trả về là 1 mảng
// hàm query chủ yêu để thực hiện các câu lệnh select
// TODO: dự tính chuyển mảng array trả về thành JSON để cung cấp API cho Angular
//
    public function query($qry)
    {
        $result = mysql_query($qry) or die('MySQL Error: '. mysql_error());
        $resultObjects = array();

        while($row = mysql_fetch_object($result)) $resultObjects[] = $row;

        return $resultObjects;
    }
// tách hàm, sử dụng execute khi update,insert hoặc delete
    public function execute($qry)
    {
        $exec = mysql_query($qry) or die('MySQL Error: '. mysql_error());
        return $exec;
    }

}