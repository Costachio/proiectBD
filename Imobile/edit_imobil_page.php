<?php
require_once "../connect.php";
$id = $_GET['id'];
$connection = getConnection();

$sql = "SELECT id, denumire, adresa, latitudine, longitudine, id_asociatie FROM imobile WHERE id = :id";
$query =  $connection->prepare($sql);
$query->execute(['id' => $id]);
$imobil = $query->fetch();
$asociatie = $connection
    ->query("SELECT denumire FROM asociatii WHERE id = " . $imobil['id_asociatie'])
    ->fetchColumn();

$imobil['asociatie'] = $asociatie;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editeaza imobilul</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Editeaza imobilul</h1>
    <form method="post" action="edit_imobil_in_database.php">
        <div class="mb-3">
            <label for="denumire" class="form-label">Denumire</label>
            <input required type="text" name="denumire" class="form-control" value="<?php echo $imobil['denumire']?>" id="denumire">
        </div>
        <div class="mb-3">
            <label for="adresa" class="form-label">Adresa</label>
            <input required type="text" name="adresa" class="form-control" value="<?php echo $imobil['adresa']?>" id="adresa">
        </div>
        <div class="mb-3">
            <label for="latitudine" class="form-label">Latitudine</label>
            <input required type="text" name="latitudine" class="form-control" value="<?php echo $imobil['latitudine']?>" id="latitudine">
        </div>
        <div class="mb-3">
            <label for="longitudine" class="form-label">Longitudine</label>
            <input required type="text" name="longitudine" class="form-control" value="<?php echo $imobil['longitudine']?>" id="longitudine">
        </div>
        <div class="mb-3">
            <label for="asociatie" class="form-label">Asociatie</label>
            <input required type="text" name="asociatie" class="form-control" value="<?php echo $imobil['asociatie']?>" id="asociatie">
        </div>

        <input type="hidden" name="id" value="<?php echo $id ?>">
        <button type="submit" class="btn btn-primary">Trimite</button>
    </form>
</div>
</body>
</html>