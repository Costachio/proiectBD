<?php

require_once "../connect.php";

$id = $_POST['id'];
$numar = $_POST['numar'];
$etaj = $_POST['etaj'];
$numar_persoane = $_POST['numar_persoane'];
$suprafata = $_POST['suprafata'];
$id_scara = $_POST['scara'];

$connection = getConnection();
$connection->beginTransaction();

try {
    $sql_apartamente = "UPDATE apartamente 
                        SET numar = :numar, etaj = :etaj, numar_persoane = :numar_persoane, suprafata = :suprafata, id_scara = :id_scara
                        WHERE id = :id";

    $query_apartamente = $connection->prepare($sql_apartamente);
    $query_apartamente->execute([
        'id' => $id,
        'numar' => $numar,
        'etaj' => $etaj,
        'numar_persoane' => $numar_persoane,
        'suprafata' => $suprafata,
        'id_scara' => $id_scara
    ]);

    $connection->commit();
    header("Location: /index.php");

} catch (PDOException $e) {

    $connection->rollBack();
    echo "Error: " . $e->getMessage();
}
?>
