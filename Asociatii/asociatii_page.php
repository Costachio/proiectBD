<?php

require_once "../connect.php";

$connection = getConnection();
$asociatii = $connection
    ->query("SELECT id, denumire, cod_fiscal, data_infiintare, id_administrator, id_presedinte, id_contabil FROM asociatii")
    ->fetchAll();

foreach ($asociatii as &$asociatie) {

    $administrator = $connection
        ->query("SELECT CONCAT(nume, ' ', prenume) FROM persoane WHERE id = " . $asociatie['id_administrator'])
        ->fetchColumn();
    $presedinte = $connection
        ->query("SELECT CONCAT(nume, ' ', prenume) FROM persoane WHERE id = " . $asociatie['id_presedinte'])
        ->fetchColumn();
    $contabil = $connection
        ->query("SELECT CONCAT(nume, ' ', prenume) FROM persoane WHERE id = " . $asociatie['id_contabil'])
        ->fetchColumn();

    $asociatie['administrator'] = $administrator;
    $asociatie['presedinte'] = $presedinte;
    $asociatie['contabil'] = $contabil;
    $cont_bancar_informatii = $connection
        ->query("SELECT cont, banca FROM conturi_bancare WHERE id = " . $asociatie['id'])
        ->fetch();
    $asociatie['cont_bancar'] = $cont_bancar_informatii['cont'];
    $asociatie['banca'] = $cont_bancar_informatii['banca'];


}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Asociatii</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/admin.js"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
<div class="container">
    <h1>Administreaza asociatiile</h1>
    <div class="mt-3 mb-3">
        <a href="add_asociatie_page.php" class="btn btn-primary"><i class="bi bi-plus"></i></a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Denumire</th>
            <th scope="col">Administrator</th>
            <th scope="col">Presedinte</th>
            <th scope="col">Contabil</th>
            <th scope="col">Cod fiscal</th>
            <th scope="col">Data infiintare</th>
            <th scope="col">Cont bancar</th>
            <th scope="col">Banca</th>
            <th scope="col">Actiuni</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($asociatii as &$asociatie): ?>
            <tr>
                <td scope="row"><?php echo $asociatie['denumire'] ?></td>
                <td scope="row"><?php echo $asociatie['administrator'] ?></td>
                <td scope="row"><?php echo $asociatie['presedinte'] ?></td>
                <td scope="row"><?php echo $asociatie['contabil'] ?></td>
                <td scope="row"><?php echo $asociatie['cod_fiscal'] ?></td>
                <td scope="row"><?php echo $asociatie['data_infiintare'] ?></td>
                <td scope="row"><?php echo $asociatie['cont_bancar'] ?></td>
                <td scope="row"><?php echo $asociatie['banca'] ?></td>
                <td>
                    <a href="edit_asociatie_page.php?id= <?php echo $asociatie['id'] ?>" type="button"
                       class="btn btn-primary"><i class="bi bi-pencil"></i> </a>
                    <form action="delete_asociatie_in_database.php" method="POST" class="pt-2 pb-2">
                        <input type="hidden" name="id" value="<?php echo $asociatie['id'] ?>">
                        <button class="btn btn-primary" type="submit"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>
</body>
</html>
