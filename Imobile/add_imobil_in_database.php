<?php

require_once "../connect.php";

$denumire = $_POST['denumire'];
$adresa = $_POST['adresa'];
$latitudine = $_POST['latitudine'];
$longitudine = $_POST['longitudine'];
$id_asociatie = $_POST['asociatie'];

$connection = getConnection();
$connection->beginTransaction();

try {
    $sql_imobile = "INSERT INTO imobile (denumire, adresa, latitudine, longitudine, id_asociatie) 
                    VALUES (:denumire, :adresa, :latitudine, :longitudine, :id_asociatie)";

    $query_imobile = $connection->prepare($sql_imobile);
    $query_imobile->execute([
        'denumire' => $denumire,
        'adresa' => $adresa,
        'latitudine' => $latitudine,
        'longitudine' => $longitudine,
        'id_asociatie' => $id_asociatie
    ]);

    $connection->commit();
    header("Location: /Imobile/imobile_page.php");

} catch (PDOException $e) {

    $connection->rollBack();
    echo "Error: " . $e->getMessage();
}
?>
