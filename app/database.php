<?php

$database_name = 'barangay_agusi';
$message = '';
$server_host = 'localhost';
$server_password = '';
$server_username = 'root';

date_default_timezone_set('Asia/Manila');
session_start();

try {
    $pdo = 'mysql:host=' . $server_host . ';dbname=' . $database_name . ';charset=utf8';
    $connect = new PDO($pdo, $server_username, $server_password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_SESSION['id'])) {
        $id = trim(filter_var($_SESSION['id'], FILTER_SANITIZE_NUMBER_INT));

        try {
            $select_users = $connect->prepare('SELECT * FROM users WHERE id = :id');
            $select_users->bindParam(':id', $id);
            $select_users->execute();
            $user = $select_users->fetch();
        } catch (PDOException $select_users_message) {
            echo '<p class="app-message fail"><i class="fa-solid fa-circle-xmark"></i> <b>select_users</b>: ' . $select_users_message->getMessage() . '.</p>';
        }
    }
} catch (PDOException $connect_message) {
    echo $connect_message->getMessage();
}
