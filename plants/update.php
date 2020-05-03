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
$plants->plant_name = $data->plant_name;
$plants->plant_desc = $data->plant_desc;

if($plants->update()){

    http_response_code(200);

    echo json_encode(array("message" => "plants was updated."));
}

else{

    http_response_code(503);

    echo json_encode(array("message" => "Unable to update plants."));
}
?>