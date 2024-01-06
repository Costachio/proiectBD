<?php

require_once "../connect.php";

$id = $_POST['id'];

$connection = getConnection();
$connection->beginTransaction();

try {

    $sql_check_imobile = "SELECT COUNT(*) FROM imobile WHERE id = :id";
    $query_check_imobile = $connection->prepare($sql_check_imobile);
    $query_check_imobile->execute(['id' => $id]);
    $record_exists_imobile = $query_check_imobile->fetchColumn();

    if ($record_exists_imobile) {

        $sql_delete_imobile = "DELETE FROM imobile WHERE id = :id";
        $query_delete_imobile = $connection->prepare($sql_delete_imobile);
        $query_delete_imobile->execute(['id' => $id]);

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
