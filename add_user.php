<?php
require 'classes/Database.php';
require 'classes/User.php';
require 'classes/ApiResponse.php';

Database::connect();

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['username']) && isset($data['email']) && isset($data['password'])) {
    $user = new User($data['username'], $data['email'], $data['password']);
    
    if ($user->save()) {
        ApiResponse::success('User added successfully');
    } else {
        ApiResponse::error('Error adding user');
    }
} else {
    ApiResponse::error('Invalid input data');
}