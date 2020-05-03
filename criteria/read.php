<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../config/database.php';
include_once '../objects/criteria.php';
 
$database = new Database();
$db = $database->getConnection();
 
$criteria = new criteria($db);
 

$stmt = $criteria->read();
$num = $stmt->rowCount();
 
if($num>0){
 
    $criteria_arr=array();
    $criteria_arr["records"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        extract($row);
 
        $criteria_item=array(
            "id_criteria" => $id_criteria,
            "criteria_name" => $criteria_name,
            "criteria_desc" => $criteria_desc
        );
 
        array_push($criteria_arr["records"], $criteria_item);
    }
 
    http_response_code(200);
 
    echo json_encode($criteria_arr);
}
 
else{
 
    http_response_code(201);
 
    echo json_encode(
        array("message" => "No events found.")
    );
}