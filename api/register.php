<?php
    include "./connect.php";

    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    $check = $conn->query("SELECT * FROM users WHERE username='$username'");

    if($check){
        echo json_encode(
            [
                'res' => '400',
                'message' => 'Failed to register',
                'status' => 'FAILED'
            ]
        );
        exit();
    }

    $query = $conn->query("INSERT INTO users(username, password, role) VALUES('$username','$password','$role')");

    if($query){
        echo json_encode(
            [
                'res' => '200',
                'message' => 'Registered successfully',
                'status' => 'SUCCEED'
            ]
        );
    }
?>