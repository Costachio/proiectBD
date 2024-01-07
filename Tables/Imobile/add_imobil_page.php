<?php

require_once "../../connect.php";

$connection = getConnection();
$asociatii = $connection
    ->query("SELECT id, denumire FROM asociatii ")
    ->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Adauga imobil</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Adauga un nou imobil</h1>
    <form method="post" action="add_imobil_in_database.php">
        <div class="mb-3">
            <label for="denumire" class="form-label">Denumire</label>
            <input required type="text" name="denumire" class="form-control" id="denumire">
        </div>
        <div class="mb-3">
            <label for="adresa" class="form-label">Adresa</label>
            <input required type="text" name="adresa" class="form-control" id="adresa">
        </div>
        <div class="mb-3">
            <label for="latitudine" class="form-label">Latitudine</label>
            <input required type="number" name="latitudine" class="form-control" id="latitudine" step="0.0000001">
        </div>
        <div class="mb-3">
            <label for="longitudine" class="form-label">Longitudine</label>
            <input required type="number" name="longitudine" class="form-control" id="longitudine" step="0.0000001">
        </div>
        <div class="mb-3">
            <label for="asociatie" class="form-label">Asociatie</label>
            <select required name="asociatie" class="form-select" id="asociatie">
                <?php foreach ($asociatii as &$asociatie): ?>
                    <option value=<?php echo $asociatie['id']?>><?php echo $asociatie['denumire']?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Trimite</button>
    </form>
</div>
</body>
</html>