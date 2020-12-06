<?php
@$dbcnx = new mysqli('localhost', 'f36ee', 'f36ee', 'f36ee');
if ($dbcnx->connect_error){
  echo "Database is not online";
  exit;
}
if (!$dbcnx->select_db ("f36ee"))
	exit("<p>Unable to locate the f36ee database</p>");
?>


<?php

define("DB_SERVER","localhost");
define("DB_USER","f36ee");
define("DB_PASSWORD","f36ee");
define("DB_NAME","f36ee");


function db_connect(){
    $db = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
    confirm_db_connect();
    return $db;
}

function confirm_db_connect(){
    if(mysqli_connect_errno()){
        $msg = "Database connection failed: ";
        $msg .= mysqli_connect_error();
        $msg .= " (" . mysqli_connect_errno() . ")";
        exit($msg);
    }
}

function close_connection($connection){
    if(isset($connection)){
        mysqli_close($connection);
    }   
}
function is_post_request(){
    return $_SERVER['REQUEST_METHOD']=='POST';
}
function is_get_request(){
    return $_SERVER['REQUEST_METHOD']=='GET';
}

function db_escape($db,$query){
    return mysqli_real_escape_string($db,$query);
}

function confirm_result_set($result){
    if(!isset($result)){
        echo "error";
        exit("Database query failed");
    }
}

$db = db_connect();
$errors = [];

?>