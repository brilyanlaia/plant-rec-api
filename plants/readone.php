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
     
    $plants->readOne();
     
    if($plants->plant_name!=null){
        $plants_arr = array(
            "id_plant" =>  $plants->id_plant,
            "plant_name" => $plants->plant_name,
            "plant_desc" => $plants->plant_desc
        );
     
        http_response_code(200);
        echo json_encode($plants_arr);
    }
     
    else{
        http_response_code(201);
        echo json_encode(array("message" => "plants does not exist."));
    }
?>