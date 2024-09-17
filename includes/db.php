<?php 
session_start();

$db = [
    'DB_SERVER'=>'localhost',
    'DB_USERNAME'=>'root',
    'DB_PASSWORD'=>'',
    'DB_NAME'=>'personel_records',
];

$conn = mysqli_connect($db['DB_SERVER'], $db['DB_USERNAME'], $db['DB_PASSWORD'], $db['DB_NAME']);

if(!$conn){
    echo 'we are not connected';
}