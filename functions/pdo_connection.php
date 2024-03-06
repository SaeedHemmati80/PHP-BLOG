<?php

global $conn;

try {

    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ);
    $conn = new PDO('mysql:host=localhost;dbname:php_blog', 'root', '', $options);
    return $conn;

}catch (PDOException $e){
    echo 'error' . $e ->getMessage();
}