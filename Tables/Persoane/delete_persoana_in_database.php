<?php

require_once "../../connect.php";

$id = $_POST['id'];

$connection = getConnection();
$connection->beginTransaction();

try {

    $sql_check_persoane = "SELECT COUNT(*) FROM persoane WHERE id = :id";
    $query_check_persoane = $connection->prepare($sql_check_persoane);
    $query_check_persoane->execute(['id' => $id]);
    $record_exists_persoane = $query_check_persoane->fetchColumn();

    if ($record_exists_persoane) {

        $sql_delete_persoane = "DELETE FROM persoane WHERE id = :id";
        $query_delete_persoane = $connection->prepare($sql_delete_persoane);
        $query_delete_persoane->execute(['id' => $id]);

        $connection->commit();
        header("Location:  ../Persoane/persoane_page.php");
    } else {

        echo "Error: Record not found in the database.";
    }

} catch (PDOException $e) {
    $connection->rollBack();
    echo "Error: " . $e->getMessage();
}
?>
