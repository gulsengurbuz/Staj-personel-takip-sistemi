<?php

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../../config/config.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);  

    $stmt = $conn->prepare("CALL personeldetayi(?)");
    $stmt->bind_param("i", $id);
    $stmt->execute();  

    $result = $stmt->get_result();  

    if ($result) {
        $personel = $result->fetch_assoc(); 
        if ($personel) {
            
            if (isset($personel['fotograf']) && !empty($personel['fotograf'])) {
                $personel['fotograf'] = base64_encode($personel['fotograf']) ; 
            } else {
                $personel['fotograf'] = '';  
            }
            //var_dump($personel);
            if(json_encode($personel))
            {
            echo json_encode($personel) ;
            }
            else 
            {
               echo "olmadıııı";     

            } 
        } else {
            echo json_encode(["hata" => "Veri bulunamadı"]);
        }
    } else {
        echo json_encode(["hata" => "Veri çekme hatası"]);
    }

    $stmt->close();  
    $conn->close();  
} else {
    echo json_encode(["hata" => "Geçersiz istek"]);  
}
?>