<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
     
    include_once '../config/database.php';
    include_once '../objects/criteria.php';
     
    $database = new Database();
    $db = $database->getConnection();
     
    $criteria = new criteria($db);
     
    $criteria->id_criteria = isset($_GET['id_criteria']) ? $_GET['id_criteria'] : die();
     
    $criteria->readOne();
     
    if($criteria->criteria_name!=null){
        $criteria_arr = array(
            "id_criteria" =>  $criteria->id_criteria,
            "criteria_name" => $criteria->criteria_name,
            "criteria_desc" => $criteria->criteria_desc
        );
     
        http_response_code(200);
        echo json_encode($criteria_arr);
    }
     
    else{
        http_response_code(201);
        echo json_encode(array("message" => "criteria does not exist."));
    }
?>