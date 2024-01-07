<?php

require_once "../../connect.php";

$connection = getConnection();

$id = $_POST['id'];

$connection->beginTransaction();

try {
    // Check if the record exists
    $sql_check_apartament = "SELECT COUNT(*) FROM apartamente WHERE id = :id";
    $query_check_apartament = $connection->prepare($sql_check_apartament);
    $query_check_apartament->execute(['id' => $id]);
    $record_exists_apartament = $query_check_apartament->fetchColumn();

    if ($record_exists_apartament) {
        // Record exists, proceed with the deletion
        $sql_delete_apartament = "DELETE FROM apartamente WHERE id = :id";
        $query_delete_apartament = $connection->prepare($sql_delete_apartament);
        $query_delete_apartament->execute(['id' => $id]);

        $connection->commit();
        header("Location:  ../Apartamente/apartamente_page.php");
    } else {
        // Record does not exist, handle the situation (e.g., show an error message)
        echo "Error: Record not found in the database.";
    }

} catch (PDOException $e) {
    $connection->rollBack();
    echo "Error: " . $e->getMessage();
}
?>
