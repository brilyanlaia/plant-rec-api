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

$criterias->id_criteria = $data->id_criteria;

$criterias->weight = $data->weight;
$criterias->attribute = $data->attribute;

if($criterias->update()){

    http_response_code(200);

    echo json_encode(array("message" => "criterias was updated."));
}

else{

    http_response_code(503);

    echo json_encode(array("message" => "Unable to update criterias."));
}
?>