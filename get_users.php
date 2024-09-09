<?php
require 'classes/Database.php';
require 'classes/User.php';
require 'classes/ApiResponse.php';

Database::connect();

$users = User::all();

$usersArray = [];
foreach ($users as $user) {
    $usersArray[] = [
        'id' => $user->id,
        'username' => $user->username,
        'email' => $user->email
    ];
}

ApiResponse::success('Users fetched successfully', $usersArray);