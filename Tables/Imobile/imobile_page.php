<?php

require_once "../../connect.php";

$connection = getConnection();
$imobile = $connection
    ->query("SELECT id, denumire, adresa, latitudine, longitudine, id_asociatie FROM imobile")
    ->fetchAll();
foreach ($imobile as &$imobil) {
    $asociatie = $connection
        ->query("SELECT denumire FROM asociatii WHERE id = " . $imobil['id_asociatie'])
        ->fetchColumn();

    $imobil['asociatie'] = $asociatie;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Imobile</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/admin.js"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
<div class="container">
    <h1>Administreaza imobilele</h1>
    <div class="mt-3 mb-3 d-flex">
        <a href="add_imobil_page.php" class="btn btn-primary me-3"><i class="bi bi-plus"></i></a>
        <a href="../../../index.php" class="btn btn-primary"><i class="bi bi-house-fill"></i></a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Denumire</th>
            <th scope="col">Adresa</th>
            <th scope="col">Latitudine</th>
            <th scope="col">Longitudine</th>
            <th scope="col">Asociatie</th>
            <th scope="col">Actiuni</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($imobile as &$imobil): ?>
            <tr>
                <td scope="row"><?php echo $imobil['denumire'] ?></td>
                <td scope="row"><?php echo $imobil['adresa'] ?></td>
                <td scope="row"><?php echo $imobil['latitudine'] ?></td>
                <td scope="row"><?php echo $imobil['longitudine'] ?></td>
                <td scope="row"><?php echo $imobil['asociatie'] ?></td>
                <td>
                    <a href="edit_imobil_page.php?id= <?php echo $imobil['id'] ?>" type="button"
                       class="btn btn-primary"><i class="bi bi-pencil"></i> </a>
                    <form action="delete_imobil_in_database.php" method="POST" class="pt-2 pb-2">
                        <input type="hidden" name="id" value="<?php echo $imobil['id'] ?>">
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
