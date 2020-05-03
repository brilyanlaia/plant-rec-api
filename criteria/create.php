<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../objects/criteria.php';
 
$database = new Database();
$db = $database->getConnection();
 
$criteria = new criteria($db);


$data = json_decode(file_get_contents("php://input"));



if(
    !empty($data->criteria_desc) && !empty($data->criteria_name)){
 
 
    $criteria->criteria_name = $data->criteria_name;
    $criteria->criteria_desc = $data->criteria_desc;
   
 
    if($criteria->create()){
 
        http_response_code(201);
        
        echo json_encode(array("message" => "criteria was created"));

        //$plant->readone();
    }
 
    else{
 
        http_response_code(503);
 
        echo json_encode(array("message" => "Unable to add criteria. service unavailable"));
    }
}
 
else{
  
    
    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to add criteria. Data is incomplete., badrequest"));
}
?>