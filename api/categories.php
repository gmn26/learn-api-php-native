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
            'data' => null,
            'message' => 'No data'
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $json_input = file_get_contents('php://input');
        $decoded_input = json_decode($json_input, true);
        if($decoded_input["name"] == null){
            echo json_encode(
                [
                    'res' => '401',
                    'message' => 'Wrong input',
                    'status' => 'FAILED'
                ]
            );
            exit();
        }

        $name = $decoded_input["name"];


        $check = $conn->query("SELECT * FROM categories WHERE name='$name'");

        if($check->num_rows > 0){
            echo json_encode(
                [
                    'res' => '400',
                    'message' => 'Category already exist',
                    'status' => 'FAILED'
                ]
            );
            exit();
        }

        $query = $conn->query("INSERT INTO categories(name) VALUES('$name')");

        if($query){
            echo json_encode([
                'res' => '200',
                'status' => 'SUCCEED',
                'message' => 'Category saved'
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }
    }
?>