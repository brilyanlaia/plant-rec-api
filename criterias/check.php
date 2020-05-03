<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../config/database.php';
include_once '../objects/criterias.php';
include_once '../objects/rekomendasi.php';
include_once '../objects/plants.php';
 
$database = new Database();
$db = $database->getConnection();
 
$criterias = new Criterias($db);
$rekomendasi = new Rekomendasi($db);
$plants = new Plants($db);
 

$stmt1 = $criterias->readCriteria();

//$num = $stmt1->rowCount();


$W=array();
$attribute=array();

while($row = $stmt1->fetchObject()){
   // extract($row);
   $W[$row->id_criteria]=$row->weight;
   $attribute[$row->id_criteria]=$row->attribute;
   
}

//normalisasi bobot
$i=0;
    $sigma_w=array_sum($W);
    foreach($W as $j=>$w){
      $W[$j]=$w/$sigma_w;
}

//hitung vektor S
$stmt2 = $rekomendasi->read();
$X=array();
$alternative='';
    while($row=$stmt2->fetchObject()){
      if($row->id_plant!=$alternative){
        $X[$row->id_plant]=array();
        $alternative=$row->id_plant;
      }
      $X[$row->id_plant][$row->id_criteria]=$row->weight;
    }
    $S=array();
    foreach($X as $alternative=>$x){
      $S[$alternative]=1;
      
      foreach($x as $criteria=>$weight){
         $S[$alternative]*=pow($weight,($attribute[$criteria]=='cost'?-$W[$criteria]:$W[$criteria]));
         
      };
      
    }

//hitung vektor V
$V=array();
$sigma_s=array_sum($S);
$devider=implode(' + ',$S);
foreach($S as $alternative=>$s){
  
  $V[$alternative]=$s/$sigma_s;
 
}

//rank vektor V
arsort($V);
$no=0;
$wp_res=array();
$wp_res["records"]=array();

foreach($V as $alternative=>$result){
    $stmt3 = $plants->readName($alternative);
   
    $alt_name = "";

    while($row=$stmt3->fetchObject()){
        $alt_name=$row->plant_name;
    }
    
   // echo $alt_name;
    $result_rank=array(
        
        "nama"=> $alt_name,
        "result"=> $result
    );
    array_push($wp_res["records"],$result_rank);

  }
  echo json_encode($wp_res);

