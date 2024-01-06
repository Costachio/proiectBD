<?php
require_once "../connect.php";
$id = $_GET['id'];
$connection = getConnection();

$sql = "SELECT id, nume, prenume, sex, email, telefon FROM persoane WHERE id = :id";
$query =  $connection->prepare($sql);
$query->execute(['id' => $id]);
$persoana = $query->fetch();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Editeaza persoana</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Editeaza persoana</h1>
    <form method="post" action="edit_persoana_in_database.php">
        <div class="mb-3">
            <label for="nume" class="form-label">Nume</label>
            <input required type="text" name="nume" class="form-control" value="<?php echo $persoana['nume']?>"  id="nume">
        </div>
        <div class="mb-3">
            <label for="prenume" class="form-label">Prenume</label>
            <input required type="text" name="prenume" class="form-control" value="<?php echo $persoana['prenume']?>" id="administrator">
        </div>
        <div class="mb-3">
            <label for="sex" class="form-label">Sex</label>
            <input required type="text" name="sex" class="form-control" value="<?php echo $persoana['sex']?>" id="sex">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input required type="text" name="email" class="form-control" value="<?php echo $persoana['email']?>" id="email">
        </div>
        <div class="mb-3">
            <label for="telefon" class="form-label">Telefon</label>
            <input required type="text" name="telefon" class="form-control" value="<?php echo $persoana['telefon']?>" id="telefon">
        </div>
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <button type="submit" class="btn btn-primary">Trimite</button>
    </form>
</div>
</body>
</html>