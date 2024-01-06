<?php

require_once "../connect.php";

$id = $_POST['id'];

$connection = getConnection();
$connection->beginTransaction();

try {

    $sql_check_scari = "SELECT COUNT(*) FROM scari WHERE id = :id";
    $query_check_scari = $connection->prepare($sql_check_scari);
    $query_check_scari->execute(['id' => $id]);
    $record_exists_scari = $query_check_scari->fetchColumn();

    if ($record_exists_scari) {

        $sql_delete_scari = "DELETE FROM scari WHERE id = :id";
        $query_delete_scari = $connection->prepare($sql_delete_scari);
        $query_delete_scari->execute(['id' => $id]);

        $connection->commit();
        header("Location: /index.php");
    } else {

        echo "Error: Record not found in the database.";
    }

} catch (PDOException $e) {
    $connection->rollBack();
    echo "Error: " . $e->getMessage();
}
?>
