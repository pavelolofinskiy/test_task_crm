<?php
require 'rb-mysql.php';

class Database
{
    public static function connect()
    {
        R::setup('mysql:host=localhost;dbname=crm', 'root', '');
        
        if (!R::testConnection()) {
            throw new Exception('No DB connection!');
        }
    }
}