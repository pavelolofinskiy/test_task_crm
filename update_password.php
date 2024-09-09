<?php
require 'classes/Database.php';
require 'classes/User.php';
require 'classes/ApiResponse.php';

Database::connect();

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id']) && isset($data['password'])) {
    if (User::updatePassword($data['id'], $data['password'])) {
        ApiResponse::success('Password updated successfully');
    } else {
        ApiResponse::error('Failed to update password');
    }
} else {
    ApiResponse::error('Invalid input data');
}