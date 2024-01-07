<?php
require_once "../../connect.php";
$id = $_GET['id'];
$connection = getConnection();

$sql = "SELECT id, denumire, cod_fiscal, data_infiintare, id_administrator, id_presedinte, id_contabil FROM asociatii WHERE id = :id";
$query = $connection->prepare($sql);
$query->execute(['id' => $id]);
$asociatie = $query->fetch();

$cont_bancar_informatii = $connection
    ->query("SELECT cont, banca FROM conturi_bancare WHERE id = " . $asociatie['id'])
    ->fetch();
$asociatie['cont_bancar'] = $cont_bancar_informatii['cont'];
$asociatie['banca'] = $cont_bancar_informatii['banca'];

$persoane = $connection
    ->query("SELECT id, nume, prenume FROM persoane " )
    ->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editeaza asociatia</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Bootstrap-datepicker CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY4NlHrkgIBhElM5S4MqE4p1ckKJg5K3S+gUt" crossorigin="anonymous"></script>

    <!-- Bootstrap-datepicker JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
</head>
<body>
<div class="container">
    <h1>Editeaza asociatia</h1>
    <form method="post" action="edit_asociatie_in_database.php">
        <div class="mb-3">
            <label for="denumire" class="form-label">Denumire</label>
            <input required type="text" name="denumire" class="form-control"
                   value="<?php echo $asociatie['denumire'] ?>" id="denumire">
        </div>
        <div class="mb-3">
            <label for="administrator" class="form-label">Nume administrator</label>
            <select required name="administrator" class="form-select" id="administrator">
                <?php foreach ($persoane as &$persoana): ?>
                    <option value=<?php echo $persoana['id']?> <?php echo ($persoana['id'] == $asociatie['id_administrator']) ? 'selected' : ''; ?>>
                        <?php echo $persoana['nume'] . ' ' . $persoana['prenume'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="presedinte" class="form-label">Nume presedinte</label>
            <select required name="presedinte" class="form-select" id="presedinte">
                <?php foreach ($persoane as &$persoana): ?>
                    <option value=<?php echo $persoana['id']?> <?php echo ($persoana['id'] == $asociatie['id_presedinte']) ? 'selected' : ''; ?>>
                        <?php echo $persoana['nume'] . ' ' . $persoana['prenume'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="contabil" class="form-label">Nume contabil</label>
            <select required name="contabil" class="form-select" id="contabil">
                <?php foreach ($persoane as &$persoana): ?>
                    <option value=<?php echo $persoana['id']?> <?php echo ($persoana['id'] == $asociatie['id_contabil']) ? 'selected' : ''; ?>>
                        <?php echo $persoana['nume'] . ' ' . $persoana['prenume'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="cod_fiscal" class="form-label">Cod fiscal</label>
            <input required type="text" name="cod_fiscal" class="form-control"
                   value="<?php echo $asociatie['cod_fiscal'] ?>" id="cod_fiscal">
        </div>
        <div class="mb-3">
            <label for="data_infiintare" class="form-label">Data infiintare </label>
            <input required type="text" name="data_infiintare" class="form-control datepicker"
                   value="<?php echo $asociatie['data_infiintare'] ?>" id="data_infiintare">
        </div>
        <div class="mb-3">
            <label for="cont_bancar" class="form-label">Cont bancar</label>
            <input required type="text" name="cont_bancar" class="form-control"
                   value="<?php echo $asociatie['cont_bancar'] ?>" id="cont_bancar">
        </div>
        <div class="mb-3">
            <label for="banca" class="form-label">Banca</label>
            <input required type="text" name="banca" class="form-control" value="<?php echo $asociatie['banca'] ?>"
                   id="banca">
        </div>
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <button type="submit" class="btn btn-primary">Trimite</button>
    </form>
</div>
<script>
    $(document).ready(function () {
        // Initialize Bootstrap-datepicker
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });
</script>
</body>
</html>
