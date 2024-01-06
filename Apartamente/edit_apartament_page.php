<?php

require_once "../connect.php";

$id = $_GET['id'];
$connection = getConnection();
$sql = "SELECT id, numar, etaj, numar_persoane, suprafata, id_scara FROM apartamente WHERE id = :id";
$query = $connection->prepare($sql);
$query->execute(['id' => $id]);
$apartament = $query->fetch();
$scara = $connection
    ->query("SELECT denumire FROM scari WHERE id = " . $apartament['id_scara'])
    ->fetchColumn();

$apartament['scara'] = $scara;

?>
<!DOCTYPE html>
<html>
<head>
    <title>Editeaza apartament</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Editeaza apartament</h1>
    <form method="post" action="edit_apartament_in_database.php">
        <div class="mb-3">
            <label for="numar" class="form-label">Numar</label>
            <input required type="text" name="numar" class="form-control" value="<?php echo $apartament['numar']?>" id="numar">
        </div>
        <div class="mb-3">
            <label for="etaj" class="form-label">Etaj</label>
            <input required type="text" name="etaj" class="form-control" value="<?php echo $apartament['etaj']?>" id="etaj">
        </div>
        <div class="mb-3">
            <label for="numar_persoane" class="form-label">Numar persoane</label>
            <input required type="text" name="numar_persoane" class="form-control" value="<?php echo $apartament['numar_persoane']?>"id="numar_persoane">
        </div>
        <div class="mb-3">
            <label for="suprafata" class="form-label">Suprafata</label>
            <input required type="text" name="suprafata" class="form-control" value="<?php echo $apartament['suprafata']?>" id="suprafata">
        </div>
        <div class="mb-3">
            <label for="apartament" class="form-label">Scara</label>
            <input required type="text" name="scara" class="form-control" value="<?php echo $apartament['scara']?>" id="scara">
        </div>
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <button type="submit" class="btn btn-primary">Trimite</button>
    </form>
</div>
</body>
</html>