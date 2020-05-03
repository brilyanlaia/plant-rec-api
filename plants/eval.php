<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../objects/plants.php';
 
$database = new Database();
$db = $database->getConnection();
 
$plants = new Plants($db);


$data = json_decode(file_get_contents("php://input"));



if(
    !empty($data->id_plant) && !empty($data->id_criteria)){
 
 
    $plants->id_criteria = $data->id_criteria;
    $plants->id_plant = $data->id_plant;
   
 
    if($plants->createEval()){
 
     
        http_response_code(201);
        
        echo json_encode(array("message" => "eval was created"));


        //$plant->readone();
    }
 
    else{
 
        http_response_code(503);
 
        echo json_encode(array("message" => "Unable to add eval. service unavailable"));
    }
}
 
else{
  
    
    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to add eval. Data is incomplete., badrequest"));
}
?>