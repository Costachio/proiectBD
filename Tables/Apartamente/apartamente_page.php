<?php

require_once "../../connect.php";

$connection = getConnection();
$apartamente = $connection
    ->query("SELECT id, numar, etaj, numar_persoane, suprafata, id_scara FROM apartamente")
    ->fetchAll();
foreach ($apartamente as &$apartament) {
    $scara = $connection
        ->query("SELECT denumire FROM scari WHERE id = " . $apartament['id_scara'])
        ->fetchColumn();

    $apartament['scara'] = $scara;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Apartamente</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/admin.js"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
<div class="container">
    <h1>Administreaza apartamentele</h1>
    <div class="mt-3 mb-3 d-flex">
        <a href="add_apartament_page.php" class="btn btn-primary me-3"><i class="bi bi-plus"></i></a>
        <a href="../../../index.php" class="btn btn-primary"><i class="bi bi-house-fill"></i></a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Numar apartament</th>
            <th scope="col">Etaj</th>
            <th scope="col">Numar persoane</th>
            <th scope="col">Suprafata</th>
            <th scope="col">Scara</th>
            <th scope="col">Actiuni</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($apartamente as &$apartament): ?>
            <tr>
                <td scope="row"><?php echo $apartament['numar'] ?></td>
                <td scope="row"><?php echo $apartament['etaj'] ?></td>
                <td scope="row"><?php echo $apartament['numar_persoane'] ?></td>
                <td scope="row"><?php echo $apartament['suprafata'] ?> metri pătrati</td>
                <td scope="row"><?php echo $apartament['scara'] ?></td>
                <td>
                    <a href="edit_apartament_page.php?id= <?php echo $apartament['id'] ?>" type="button"
                       class="btn btn-primary"><i class="bi bi-pencil"></i> </a>
                    <form action="delete_apartament_in_database.php" method="POST" class="pt-2 pb-2">
                        <input type="hidden" name="id" value="<?php echo $apartament['id'] ?>">
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
