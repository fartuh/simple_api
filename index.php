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

    // Getting all the users
    if($url == 'users'){
        header('Content-type: application/json');

        $q = $pdo->prepare('SELECT * FROM users');
        $q->execute();
        $data = $q->fetchall(PDO::FETCH_ASSOC);

        echo json_encode($data);
    }

    // Getting the new user page
    else if($url == 'users/new'){
        require('templates/new.php');
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
