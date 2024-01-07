<?php
require_once "../connect.php";
$id = $_GET['id'];
$connection = getConnection();

$sql = "SELECT id, denumire, numar_etaje, numar_apartamente, id_imobil FROM scari WHERE id = :id";
$query =  $connection->prepare($sql);
$query->execute(['id' => $id]);
$scara = $query->fetch();


$imobile = $connection
    ->query("SELECT id, denumire FROM imobile ")
    ->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editeaza scara</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Editeaza scara</h1>
    <form method="post" action="edit_scara_in_database.php">
        <div class="mb-3">
            <label for="denumire" class="form-label">Denumire</label>
            <input required type="text" name="denumire" class="form-control" value="<?php echo $scara['denumire']?>" id="denumire">
        </div>
        <div class="mb-3">
            <label for="numar_etaje" class="form-label">Numar etaje</label>
            <input required type="text" name="numar_etaje" class="form-control" value="<?php echo $scara['numar_etaje']?>" id="numar_etaje">
        </div>
        <div class="mb-3">
            <label for="numar_apartamente" class="form-label">Numar apartamente</label>
            <input required type="text" name="numar_apartamente" class="form-control" value="<?php echo $scara['numar_apartamente']?>" id="numar_apartamente">
        </div>
        <div class="mb-3">
            <label for="scara" class="form-label">Imobil</label>
            <select required name="imobil" class="form-select" id="imobil">
                <?php foreach ($imobile as &$imobil): ?>
                    <option value=<?php echo $imobil['id']?> <?php echo ($imobil['id'] === $scara['id_imobil']) ? 'selected' : ''; ?>>
                        <?php echo $imobil['denumire']?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <input type="hidden" name="id" value="<?php echo $id ?>">
        <button type="submit" class="btn btn-primary">Trimite</button>
    </form>
</div>
</body>
</html>