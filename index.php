<?php
    use Academy\Db;
    require_once __DIR__ . '/vendor/autoload.php';
    $db = new Db();
?>
<!DOCTYPE html>
<html lang="en,ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <link rel="stylesheet" href="src/css/style.css">
    <title>Books</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <form action="request.php" onsubmit="sendData();return false;" id="form" class="col-xl-6">
                <div class="form-group row">
                    <label for="name">Название книги</label>
                    <input type="text" class="form-control" name="name" id="name">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group row">
                    <label for="author">Автор книги</label>
                    <input type="text" class="form-control" name="author" id="author">
                    <div class="invalid-feedback"></div>
                <div class="form-group row">
                    <div class="col-md-9">
                        <button type="submit" class="btn btn-primary my-4">Отправить</button>
                    </div>
                </div>
            </form>
        </div>     
    </div>
    <div class="row">
        <?php $db->getAll(); ?>
    </div>
    <script src="src/js/main.js"></script>
</body>
</html>