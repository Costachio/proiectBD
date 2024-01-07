<?php
require_once "../../connect.php";
$id = $_GET['id'];
$connection = getConnection();

$sql = "SELECT id, nume, prenume, sex, email, telefon FROM persoane WHERE id = :id";
$query = $connection->prepare($sql);
$query->execute(['id' => $id]);
$persoana = $query->fetch();

$sql_id_apartament = "SELECT apartament_id FROM persoane_apartamente WHERE persoana_id = :id";
$prepare_sql_id_apartament = $connection->prepare($sql_id_apartament);
$prepare_sql_id_apartament->execute(['id' => $persoana['id']]);
$id_apartament = $prepare_sql_id_apartament->fetchColumn();

$persoana['id_apartament'] = '';
$persoana['numar_apartament'] = '';
$persoana['id_scara'] = '';
$persoana['scara'] = '';
$persoana['id_imobil'] = '';
$persoana['imobil'] = '';
if (isset($id_apartament)) {
    $sql = "SELECT id, numar, id_scara FROM apartamente WHERE id = :id";
    $query = $connection->prepare($sql);
    $query->execute(['id' => $id_apartament]);
    $apartament = $query->fetch();
    if (!empty($apartament)) {
        $sql_select_flag = "SELECT flag_proprietar FROM persoane_apartamente WHERE persoana_id = :id AND apartament_id = :id_apartament";
        $query_select_flag = $connection->prepare($sql_select_flag);
        $query_select_flag->execute(['id' => $id, 'id_apartament' => $id_apartament]);
        $flag_proprietar = $query_select_flag->fetchColumn();
        $persoana['proprietar'] = $flag_proprietar;
        $persoana['id_apartament'] = $id_apartament;
        $persoana['numar_apartament'] = $apartament['numar'];
        $sql = "SELECT id, denumire, id_imobil FROM scari WHERE id = :id";
        $query = $connection->prepare($sql);
        $query->execute(['id' => $apartament['id_scara']]);
        $scara = $query->fetch();
        if (!empty($scara)) {
            $persoana['id_scara'] = $apartament['id_scara'];
            $persoana['scara'] = $scara['denumire'];
            $sql = "SELECT id, denumire FROM imobile WHERE id = :id";
            $query = $connection->prepare($sql);
            $query->execute(['id' => $scara['id_imobil']]);
            $imobil = $query->fetch();
            if (!empty($imobil)) {
                $persoana['id_imobil'] = $scara['id_imobil'];
                $persoana['imobil'] = $imobil['denumire'];
            }
        }
    }
}

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
    <title>Editeaza persoana</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Editeaza persoana</h1>
    <form method="post" action="edit_persoana_in_database.php">
        <div class="mb-3">
            <label for="nume" class="form-label">Nume</label>
            <input required type="text" name="nume" class="form-control" value="<?php echo $persoana['nume'] ?>"
                   id="nume">
        </div>
        <div class="mb-3">
            <label for="prenume" class="form-label">Prenume</label>
            <input required type="text" name="prenume" class="form-control" value="<?php echo $persoana['prenume'] ?>"
                   id="administrator">
        </div>
        <div class="mb-3">
            <label for="sex" class="form-label">Sex</label>
            <input required type="text" name="sex" class="form-control" value="<?php echo $persoana['sex'] ?>" id="sex">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input required type="text" name="email" class="form-control" value="<?php echo $persoana['email'] ?>"
                   id="email">
        </div>
        <div class="mb-3">
            <label for="telefon" class="form-label">Telefon</label>
            <input required type="text" name="telefon" class="form-control" value="<?php echo $persoana['telefon'] ?>"
                   id="telefon">
        </div>
        <div class="mb-3">
            <label for="apartament" class="form-label">Locuinta</label>
            <select required name="apartament" class="form-select" id="apartament">
                <?php foreach ($apartamente as &$apartament): ?>
                    <option value="<?php echo ($apartament['id'] !== '' ? $apartament['id'] : '') ?>"
                        <?php echo
                        (
                        $apartament['id_imobil'] === $persoana['id_imobil'] &&
                        $apartament['id_scara'] == $persoana['id_scara'] &&
                        $apartament['id'] == $persoana['id_apartament']
                            ? 'selected' : ''
                        )
                        ?>
                    >
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
                <option value="F" <?php echo isset($persoana['proprietar']) && $persoana['proprietar'] =='F'? 'selected' : '' ?>>Nu este proprietar</option>
                <option value="T" <?php echo isset($persoana['proprietar']) && $persoana['proprietar'] =='T'? 'selected' : '' ?>>Proprietar</option>
            </select>
        </div>
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <button type="submit" class="btn btn-primary">Trimite</button>
    </form>
</div>
</body>
</html>