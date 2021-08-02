<?php
include 'config.php';
include "fetchall.php";
//include "addusers.php";
// header('Content-Type : application/json');
header('Acess-Control-Allow-Origin: *');
header('Access-Control-Request-Method: POST');
header('Access-Control-Request-Header:
 Access-Control-Request-Method,
 Content-Type,Authorization');


if(isset($_GET['token'])){
    $data = json_decode(file_get_contents("php://input"), true);
    $token = mysqli_real_escape_string($conn ,$_GET['token']);
    $checktoken = "SELECT * FROM tokens WHERE token = '$token'";
    $checkingtoken = mysqli_query($conn,$checktoken ) or die("SQL query failed");
    $output = mysqli_fetch_all($checkingtoken, MYSQLI_ASSOC);
    $result   =  json_encode($output);
    $out   =  $output[0]["status"];
    if(mysqli_num_rows($checkingtoken) > 0){

    if ($out == "1" ){
        redirect($conn,$data);
    }else{
        echo "Your api is blocked.";
    }

    }else{
        echo "Your Api is Not valid";
    }

}else{
    echo "Please provide your api token.";
}



function redirect($conn,$data){
    $fun = $data["Function"];
    if ($fun == "gettalldata"){

        fetchall($conn);
    }else{
        echo "undefined data";
    }
}
?>

