<?php

require_once "connect.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Asociatii</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/admin.js"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
<div class="container">
    <h1>Administreaza asociatia</h1>
    <div class="mt-3 mb-3">
        <a href="add_asociatie_page.php" class="btn btn-primary"><i class="bi bi-plus"></i></a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Denumire</th>
            <th scope="col">Administrator</th>
            <th scope="col">Presedinte</th>
            <th scope="col">Contabil</th>
            <th scope="col">Cod fiscal</th>
            <th scope="col">Data infiintare</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
</body>
</html>
