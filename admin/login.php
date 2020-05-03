<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
 
include_once '../objects/admin.php';




$database = new Database();
$db = $database->getConnection();


$admin = new admin($db);
$data = json_decode(file_get_contents("php://input"));

$admin->username = $data->username;
 
if(!empty($data->username) && !empty($data->password)){
        $admin->login();
       

        if($data->password == $admin->password && $data->username == $admin->username){
                http_response_code(201);
                echo json_encode(array("message" => "OK"));
        }
        else{
                http_response_code(401);
                echo json_encode(array("message" => "FAILED"));
        }
}
else{
        http_response_code(401);
        echo json_encode(array("message" => "NOT COMPLETE"));
}




?> 
