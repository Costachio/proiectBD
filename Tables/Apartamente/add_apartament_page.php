<?php

require_once "../../connect.php";

$connection = getConnection();
$scari = $connection
    ->query("SELECT id, denumire FROM scari ")
    ->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Adauga apartament</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Adauga un nou apartament</h1>
    <form method="post" action="add_apartament_in_database.php">
        <div class="mb-3">
            <label for="numar" class="form-label">Numar</label>
            <input required type="text" name="numar" class="form-control" id="numar">
        </div>
        <div class="mb-3">
            <label for="etaj" class="form-label">Etaj</label>
            <input required type="text" name="etaj" class="form-control" id="etaj">
        </div>
        <div class="mb-3">
            <label for="numar_persoane" class="form-label">Numar persoane</label>
            <input required type="text" name="numar_persoane" class="form-control" id="numar_persoane">
        </div>
        <div class="mb-3">
            <label for="suprafata" class="form-label">Suprafata</label>
            <input required type="text" name="suprafata" class="form-control" id="suprafata">
        </div>
        <div class="mb-3">
            <label for="scara" class="form-label">Scara</label>
            <select required name="scara" class="form-select" id="scara">
                <?php foreach ($scari as &$scara): ?>
                    <option value=<?php echo $scara['id'] ?>><?php echo $scara['denumire'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Trimite</button>
    </form>
</div>
</body>
</html>