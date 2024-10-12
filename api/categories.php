<?php
    include "./connect.php";

    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        $query = $conn->query("SELECT * FROM categories");

        $datas = [];
        
        foreach($query as $i => $data){
            $datas[] = array(
                'name' => $data['name'],
            );
        }

        if($datas !== []){
            echo json_encode([
                'res' => '200',
                'data' => $datas,
                'status' => 'SUCCEED'
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            exit();
        }
        
        echo json_encode([
            'res' => '200',
            'message' => 'No data'
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        echo json_encode([
            'res' => '200',
            'status' => 'SUCCEED',
            'message' => 'Not finished yet'
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
?>