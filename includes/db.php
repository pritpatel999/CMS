<?php
//connection with database
//to make connection more secure we convert the variable in constant. and to convert variable into constant we have to use define() function.

$db = ['db_host' => 'localhost','db_user'=>'root','db_pass'=>'','db_name'=>'cms'];
foreach ($db as $key => $value) {
    define(strtoupper($key),$value);       //this will convert our string variable into constant.
 }

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);           //now here we have to use directly uppercase constant variable. so we dont need to put it in comma. 
// $connection = mysqli_connect('localhost','root','','cms');        //we can use directly this and we dont need to write anything else. but this is not secure so we convert this variable into constant. 
if(!$connection){
    die('QUERY FAILED'.mysqli_error($connection));
}
?>