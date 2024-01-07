<?php

require_once "../../connect.php";

$connection = getConnection();
$sql = "SELECT id, numar, id_scara FROM apartamente";
$query = $connection->prepare($sql);
$query->execute();
$apartamente = $query->fetchAll();

foreach ($apartamente as &$apartament) {
    $apartament['scara'] = '';
    $apartament['id_imobil'] = '';
    $apartament['imobil'] = '';
    $sql = "SELECT id, denumire, id_imobil FROM scari WHERE id = :id";
    $query = $connection->prepare($sql);
    $query->execute(['id' => $apartament['id_scara']]);
    $scara = $query->fetch();
    if (!empty($scara)) {
        $apartament['scara'] = $scara['denumire'];
        $sql = "SELECT id, denumire FROM imobile WHERE id = :id";
        $query = $connection->prepare($sql);
        $query->execute(['id' => $scara['id_imobil']]);
        $imobil = $query->fetch();
        if (!empty($imobil)) {
            $apartament['id_imobil'] = $scara['id_imobil'];
            $apartament['imobil'] = $imobil['denumire'];
        }
    }


}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Adauga persoana</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Adauga o noua persoana</h1>
    <form method="post" action="add_persoana_in_database.php">
        <div class="mb-3">
            <label for="nume" class="form-label">Nume</label>
            <input required type="text" name="nume" class="form-control" id="nume">
        </div>
        <div class="mb-3">
            <label for="prenume" class="form-label">Prenume</label>
            <input required type="text" name="prenume" class="form-control" id="prenume">
        </div>
        <div class="mb-3">
            <label for="sex" class="form-label">Sex</label>
            <select required name="sex" class="form-select" id="sex">
                <option value="M">M</option>
                <option value="F">F</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input required type="email" name="email" class="form-control" id="email">
        </div>
        <div class="mb-3">
            <label for="telefon" class="form-label">Telefon</label>
            <input required type="text" name="telefon" class="form-control" id="telefon">
        </div>
        <div class="mb-3">
            <label for="apartament" class="form-label">Locuinta</label>
            <select required name="apartament" class="form-select" id="apartament">
                <?php foreach ($apartamente as &$apartament): ?>
                    <option value="<?php echo($apartament['id'] !== '' ? $apartament['id'] : '') ?>">
                        <?php echo
                            ($apartament['id_imobil'] !== '' ? $apartament['imobil'] . ', ' : '') .
                            ($apartament['id_scara'] !== '' ? $apartament['scara'] . ', ' : '') .
                            ($apartament['id'] !== '' ? ' Apartamentul ' . $apartament['numar'] : '')
                        ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="flag_proprietar" class="form-label">Proprietar</label>
            <select required name="flag_proprietar" class="form-select" id="flag_proprietar">
                <option value="F">Nu este proprietar</option>
                <option value="T">Proprietar</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Trimite</button>
    </form>
</div>
</body>
</html>