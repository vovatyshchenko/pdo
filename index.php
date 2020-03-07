<?php

    use Academy\Db;
    use Academy\Request;

    require_once __DIR__ . '/vendor/autoload.php';

    $db = new Db();

    $requestClass = new Request();
    if( $requestClass->isPost() ){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Books</title>
</head>
<body>
    <form action="/">
        <input type="text">
        <input type="submit">
    </form>
    <ul>
        <?php
           // echo '<li>'..'</li>'
        ?>
    </ul>
</body>
</html>