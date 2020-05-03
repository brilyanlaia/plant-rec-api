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
    !empty($data->plant_desc) && !empty($data->plant_name)){
 
 
    $plants->plant_name = $data->plant_name;
    $plants->plant_desc = $data->plant_desc;
   
 
    if($plants->create()){
 
        
        $stmt = $plants->getLast();
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

        http_response_code(201);
        
        echo json_encode($plants_arr);

        //$plant->readone();
    }
 
    else{
 
        http_response_code(503);
 
        echo json_encode(array("message" => "Unable to add plant. service unavailable"));
    }
}
 
else{
  
    
    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to add plant. Data is incomplete., badrequest"));
}
?>