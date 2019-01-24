<?php

/*
 * Name: Simple API
 * Description: Simple API by Winzmcman
 * Author: github.com/winzmcman
 * link: https://gihub.com/winzmcman/simple_api
 */

// Start of code

// Default route
if(!isset($_GET['url'])) $_GET['url'] = 'home';

// $url now equals the route
$url = $_GET['url'];

// Connecting to database
$pdo = new PDO('mysql:host=localhost;dbname=api;charset=utf8', 'root', 'root');

// Handling GET requests
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $url_arr = explode('/', $url);

    // Getting all the users
    if($url == 'users'){
        header('Content-type: application/json');

        $stmt = $pdo->prepare('SELECT * FROM users');
        $result = $stmt->execute();
        if(!$result) exit('{"message": "error"}');

        $result = $data = $stmt->fetchall(PDO::FETCH_ASSOC);
        if(!$result) exit('{"message": "error"}');

        echo json_encode($data);
    }

    // Getting the new user page
    else if($url == 'users/new'){
        require('templates/new.php');
    }

    else if($url_arr[0] == 'users' && is_numeric($url_arr[1]) && !isset($url_arr[2])){
        $id = trim($url_arr[1]);

        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $result = $stmt->execute([$id]);
        if(!$result) exit('{"message": "error"}');

        $result = $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$result) exit('{"message": "error"}');

        echo json_encode($data);
    }

    else if($url_arr[0] == 'users' && is_numeric($url_arr[1]) && $url_arr[2] == 'edit' && !isset($url_arr[3])){
        $id = trim($url_arr[1]);
        require('templates/edit.php');
    }
}

// Handling POST requests
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // Creating a new user
    if($url == 'users'){
        $name = $_POST['name'];
        $phone = $_POST['phone'];

        $stmt = $pdo->prepare('INSERT INTO users(name, phone) VALUES(?, ?)');
        $result = $stmt->execute([$name, $phone]);

        if(!$result) echo '{"message": "error"}';
        else echo '{"message": "user is added"}';
    }


}
