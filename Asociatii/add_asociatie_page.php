<?php
require_once "../connect.php";

$connection = getConnection();
$nume_persoane = $connection
    ->query("SELECT CONCAT(nume, ' ', prenume) AS Nume FROM persoane " )
    ->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Adauga asociatie</title>
    <!-- CSS only -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Adauga o noua asociatie</h1>
  <div class="alert alert-danger" style="display:none" role="alert">

  </div>
    <form method="post" action="add_asociatie_in_database.php">
        <div class="mb-3">
            <label for="denumire" class="form-label">Denumire</label>
            <input required type="text" name="denumire" class="form-control" id="denumire">
        </div>
        <div class="mb-3">
            <label for="administrator" class="form-label">Nume administrator</label>
            <select required name="administrator" class="form-select" id="administrator">
                <?php foreach ($nume_persoane as &$nume_persoana): ?>
                    <option value=<?php echo $nume_persoana['Nume']?>><?php echo $nume_persoana['Nume']?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="presedinte" class="form-label">Nume presedinte</label>
            <select required name="presedinte" class="form-select" id="presedinte">
                <?php foreach ($nume_persoane as &$nume_persoana): ?>
                    <option value=<?php echo $nume_persoana['Nume']?>><?php echo $nume_persoana['Nume']?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="contabil" class="form-label">Nume contabil</label>
            <select required name="contabil" class="form-select" id="contabil">
                <?php foreach ($nume_persoane as &$nume_persoana): ?>
                    <option value=<?php echo $nume_persoana['Nume']?>><?php echo $nume_persoana['Nume']?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="cod_fiscal" class="form-label">Cod fiscal</label>
            <input required type="text" name="cod_fiscal" class="form-control" id="cod_fiscal">
        </div>
        <div class="mb-3">
            <label for="data_infiintare" class="form-label">Data infiintare ( exemplu format: 2023-03-01 )</label>
            <input required type="text" name="data_infiintare" class="form-control" id="data_infiintare">
        </div>
        <div class="mb-3">
            <label for="cont_bancar" class="form-label">Cont bancar</label>
            <input  type="text" name="cont_bancar" class="form-control" id="cont_bancar">
        </div>
        <div class="mb-3">
            <label for="banca" class="form-label">Banca</label>
            <input  type="text" name="banca" class="form-control" id="banca">
        </div>
        <button type="submit" class="btn btn-primary">Trimite</button>
    </form>
</div>
</body>
</html>