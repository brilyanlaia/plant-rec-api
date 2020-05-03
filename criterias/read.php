<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../config/database.php';
include_once '../objects/criterias.php';
 
$database = new Database();
$db = $database->getConnection();
 
$criterias = new Criterias($db);
 

$stmt = $criterias->read();
$num = $stmt->rowCount();
 
if($num>0){
 
    $criterias_arr=array();
    $criterias_arr["records"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        extract($row);
 
        $criterias_item=array(
            "id_criteria" => $id_criteria,
            "attribute" => $attribute
        );
 
        array_push($criterias_arr["records"], $criterias_item);
    }
 
    http_response_code(200);
 
    echo json_encode($criterias_arr);
}
 
else{
 
    http_response_code(201);
 
    echo json_encode(
        array("message" => "No criteria found.")
    );
}