<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
     
    include_once '../config/database.php';
    include_once '../objects/plants.php';
     
    $database = new Database();
    $db = $database->getConnection();
     
    $plants = new Plants($db);
     
    $plants->id_plant = isset($_GET['id_plant']) ? $_GET['id_plant'] : die();
     
    $stmt = $plants->readBobot();
    $num = $stmt->rowCount();
    if($num>0){
 
        $plants_arr=array();
        $plants_arr["records"]=array();
     
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            extract($row);
     
            $plants_item=array(
            "id_plant" =>  $id_plant,
            "plant_name" => $plant_name,
            "id_criteria" => $id_criteria,
            "criteria_name" => $criteria_name,
            "weight" => $weight
            );
     
            array_push($plants_arr["records"], $plants_item);
        }
     
        http_response_code(200);
     
        echo json_encode($plants_arr);
    }
     
    else{
     
        http_response_code(201);
     
        echo json_encode(
            array("message" => "No events found.")
        );
    }
?>




