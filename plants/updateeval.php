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

$plants->id_plant = $data->id_plant;
$plants->id_criteria = $data->id_criteria;
$plants->weight = $data->weight;

if($plants->updateEval()){

    http_response_code(200);

    echo json_encode(array("message" => "plants was updated."));
}

else{

    http_response_code(503);

    echo json_encode(array("message" => "Unable to update plants."));
}
?>