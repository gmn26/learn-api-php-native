<?php
    include "./connect.php";

    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = $conn->query("SELECT * FROM users WHERE username='$username' AND password='$password'");

    $datas = [];
    
    foreach($query as $i => $data){
        $datas[] = array(
            'username' => $data['username'],
            'password' => $data['password'],
            'role' => $data['role']
        );
    }

    echo json_encode([
        'res' => '200',
        'data' => $datas,
        'message' => 'Login success',
        'status' => 'SUCCEED'
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>