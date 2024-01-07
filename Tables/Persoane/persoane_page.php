<?php

require_once "../../connect.php";

$connection = getConnection();
$persoane = $connection
    ->query("SELECT id, nume, prenume, sex, email, telefon FROM persoane")
    ->fetchAll();

foreach ($persoane as &$persoana) {
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

}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Persoane</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/admin.js"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
<div class="container">
    <h1>Administreaza persoanele</h1>
    <div class="mt-3 mb-3 d-flex">
        <a href="add_persoana_page.php" class="btn btn-primary me-3"><i class="bi bi-plus"></i></a>
        <a href="../../../index.php" class="btn btn-primary"><i class="bi bi-house-fill"></i></a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Nume</th>
            <th scope="col">Prenume</th>
            <th scope="col">Sex</th>
            <th scope="col">Email</th>
            <th scope="col">Telefon</th>
            <th scope="col">Locuinta</th>
            <th scope="col">Actiuni</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($persoane as &$persoana): ?>
            <tr>
                <td scope="row"><?php echo $persoana['nume'] ?></td>
                <td scope="row"><?php echo $persoana['prenume'] ?></td>
                <td scope="row"><?php echo $persoana['sex'] ?></td>
                <td scope="row"><?php echo $persoana['email'] ?></td>
                <td scope="row"><?php echo $persoana['telefon'] ?></td>
                <td scope="row"><?php echo ($persoana['id_imobil']  !== '' ? $persoana['imobil']. ', '  : '')  .
                        ($persoana['id_scara']  !== '' ? $persoana['scara']. ', '  : '')  .
                        ($persoana['id_apartament']  !== '' ? ' Apartamentul ' . $persoana['numar_apartament']  : '') ?></td>
                <td>
                    <a href="edit_persoana_page.php?id= <?php echo $persoana['id'] ?>" type="button"
                       class="btn btn-primary"><i class="bi bi-pencil"></i> </a>
                    <form action="delete_persoana_in_database.php" method="POST" class="pt-2 pb-2">
                        <input type="hidden" name="id" value="<?php echo $persoana['id'] ?>">
                        <button class="btn btn-primary" type="submit"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>
</body>
</html>
