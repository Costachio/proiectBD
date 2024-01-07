<?php

require_once "../../connect.php";

$numar = $_POST['numar'];
$etaj = $_POST['etaj'];
$numar_persoane = $_POST['numar_persoane'];
$suprafata = $_POST['suprafata'];
$id_scara = $_POST['scara'];

$connection = getConnection();
$connection->beginTransaction();

try {
    $sql_apartamente = "INSERT INTO apartamente (numar, etaj, numar_persoane, suprafata, id_scara) 
                        VALUES (:numar, :etaj, :numar_persoane, :suprafata, :id_scara)";

    $query_apartamente = $connection->prepare($sql_apartamente);
    $query_apartamente->execute([
        'numar' => $numar,
        'etaj' => $etaj,
        'numar_persoane' => $numar_persoane,
        'suprafata' => $suprafata,
        'id_scara' => $id_scara
    ]);

    $connection->commit();
    header("Location:  ../Apartamente/apartamente_page.php");

} catch (PDOException $e) {

    $connection->rollBack();
    echo "Error: " . $e->getMessage();
}
?>
