<?php

require_once "../connect.php";

$id = $_POST['id'];
$denumire = $_POST['denumire'];
$numar_etaje = $_POST['numar_etaje'];
$numar_apartamente = $_POST['numar_apartamente'];
$id_imobil = $_POST['imobil'];

$connection = getConnection();
$connection->beginTransaction();

try {
    $sql_scari = "UPDATE scari 
                    SET denumire = :denumire, numar_etaje = :numar_etaje, numar_apartamente = :numar_apartamente, id_imobil = :id_imobil
                    WHERE id = :id";

    $query_scari = $connection->prepare($sql_scari);
    $query_scari->execute([
        'id' => $id,
        'denumire' => $denumire,
        'numar_etaje' => $numar_etaje,
        'numar_apartamente' => $numar_apartamente,
        'id_imobil' => $id_imobil
    ]);

    $connection->commit();
    header("Location: /Scari/scari_page.php");

} catch (PDOException $e) {

    $connection->rollBack();
    echo "Error: " . $e->getMessage();
}
?>
