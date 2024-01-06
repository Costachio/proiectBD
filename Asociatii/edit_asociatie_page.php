<?php
require_once "../connect.php";
$id = $_GET['id'];
$connection = getConnection();

$sql = "SELECT id, denumire, cod_fiscal, data_infiintare, id_administrator, id_presedinte, id_contabil FROM asociatii WHERE id = :id";
$query =  $connection->prepare($sql);
$query->execute(['id' => $id]);
$asociatie = $query->fetch();

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

?>

<!DOCTYPE html>
<html>
<head>
    <title>Editeaza asociatia</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Editeaza asociatia</h1>
    <form method="post" action="edit_asociatie_in_database.php">
        <div class="mb-3">
            <label for="denumire" class="form-label">Denumire</label>
            <input required type="text" name="denumire" class="form-control" value="<?php echo $asociatie['denumire']?>"  id="denumire">
        </div>
        <div class="mb-3">
            <label for="administrator" class="form-label">Nume administrator</label>
            <input required type="text" name="administrator" class="form-control" value="<?php echo $asociatie['administrator']?>" id="administrator">
        </div>
        <div class="mb-3">
            <label for="presedinte" class="form-label">Nume presedinte</label>
            <input required type="text" name="presedinte" class="form-control" value="<?php echo $asociatie['presedinte']?>" id="presedinte">
        </div>
        <div class="mb-3">
            <label for="contabil" class="form-label">Nume contabil</label>
            <input required type="text" name="contabil" class="form-control" value="<?php echo $asociatie['contabil']?>" id="contabil">
        </div>
        <div class="mb-3">
            <label for="cod_fiscal" class="form-label">Cod fiscal</label>
            <input required type="text" name="cod_fiscal" class="form-control" value="<?php echo $asociatie['cod_fiscal']?>" id="cod_fiscal">
        </div>
        <div class="mb-3">
            <label for="data_infiintare" class="form-label">Data infiintare ( exemplu format: 2023-03-01 )</label>
            <input required type="text" name="data_infiintare" class="form-control" value="<?php echo $asociatie['data_infiintare']?>" id="data_infiintare">
        </div>
        <div class="mb-3">
            <label for="cont_bancar" class="form-label">Cont bancar</label>
            <input required type="text" name="cont_bancar" class="form-control" value="<?php echo $asociatie['cont_bancar']?>" id="cont_bancar">
        </div>
        <div class="mb-3">
            <label for="banca" class="form-label">Banca</label>
            <input required type="text" name="banca" class="form-control" value="<?php echo $asociatie['banca']?>" id="banca">
        </div>
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <button type="submit" class="btn btn-primary">Trimite</button>
    </form>
</div>
</body>
</html>