<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../config/database.php';
include_once '../objects/plants.php';
 
$database = new Database();
$db = $database->getConnection();
 
$plants = new Plants($db);
 

$stmt = $plants->read();
$num = $stmt->rowCount();
 
if($num>0){
 
    $plants_arr=array();
    $plants_arr["records"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        extract($row);
 
        $plants_item=array(
            "id_plant" => $id_plant,
            "plant_name" => $plant_name,
            "plant_desc" => $plant_desc
        );
 
        array_push($plants_arr["records"], $plants_item);
    }
 
    http_response_code(200);
 
    echo json_encode($plants_arr);
}
 
else{
 
    http_response_code(201);
 
    echo json_encode(
        array("message" => "No plants found.")
    );
}