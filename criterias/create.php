<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../objects/criterias.php';
 
$database = new Database();
$db = $database->getConnection();
 
$criterias = new Criterias($db);


$data = json_decode(file_get_contents("php://input"));



if(
    !empty($data->id_criteria) && !empty($data->attribute)){
 
    $criterias->id_criteria = $data->id_criteria;
    $criterias->attribute = $data->attribute;
   
 
    if($criterias->create()){
 
        http_response_code(201);
        
        echo json_encode(array("message" => "criterias was created"));

        //$criterias->readone();
    }
 
    else{
 
        http_response_code(503);
 
        echo json_encode(array("message" => "Unable to add criterias. service unavailable"));
    }
}
 
else{
  
    
    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to add criterias. Data is incomplete., badrequest"));
}
?>