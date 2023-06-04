<?php

require('sql_api_config.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod){
    case 'POST':
        set_user();
        break;

    default:
        header("HTTP/1.0 400 Bad Request");
}

function set_user(){
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    $name = $_POST['name'];
    $email = $_POST['email'];
    $gander = $_POST['gander'];

    $valid = validate($name, $email, $gander);

    if($valid == ''){

        $conn = mysqli_connect($GLOBALS['host'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['db']) or die("Error " . mysqli_error($conn));
        $sqlstr = "INSERT INTO `users` (`full_name`, `email`, `gander`) 
        VALUES ('$name', '$email', '$gander');";
        
        $conn->query($sqlstr);

        header('location:index.php');
    }else{
        echo $valid;
    }
}

function validate($name, $email, $gander){
    $ret = '';

    if (!preg_match("/^[a-zA-Z ]*$/", $name) ){  
        $ret .= '\nName must be only letters';
    }
    if ($gander != 'Male' and $gander !='Female'){  
        $ret .= '\nGander must be only Male or Female';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $ret .= '\nInvalid email format';
      }
    if (strlen($name) < 1){  
        $ret .= '\nPlease enter the name';
    }
    if (strlen($name) < 1){  
        $ret .= '\nPlease enter the email';
    }

    return substr($ret, 2);
}