<?php

require_once "../connect.php";

$connection = getConnection();
$scari = $connection
    ->query("SELECT id, denumire, numar_etaje, numar_apartamente, id_imobil FROM scari")
    ->fetchAll();
foreach ($scari as &$scara) {
    $imobil = $connection
        ->query("SELECT denumire FROM imobile WHERE id = " . $scara['id_imobil'])
        ->fetchColumn();

    $scara['imobil'] = $imobil;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>scari</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/admin.js"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
<div class="container">
    <h1>Administreaza scarile</h1>
    <div class="mt-3 mb-3">
        <a href="add_scara_page.php" class="btn btn-primary"><i class="bi bi-plus"></i></a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Denumire</th>
            <th scope="col">Numar etaje</th>
            <th scope="col">Numar apartamente</th>
            <th scope="col">Imobil</th>
            <th scope="col">Actiuni</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($scari as &$scara): ?>
            <tr>
                <td scope="row"><?php echo $scara['denumire'] ?></td>
                <td scope="row"><?php echo $scara['numar_etaje'] ?></td>
                <td scope="row"><?php echo $scara['numar_apartamente'] ?></td>
                <td scope="row"><?php echo $scara['imobil'] ?></td>
                <td>
                    <a href="edit_scara_page.php?id= <?php echo $scara['id'] ?>" type="button"
                       class="btn btn-primary"><i class="bi bi-pencil"></i> </a>
                    <form action="delete_scara_in_database.php" method="POST" class="pt-2 pb-2">
                        <input type="hidden" name="id" value="<?php echo $scara['id'] ?>">
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
