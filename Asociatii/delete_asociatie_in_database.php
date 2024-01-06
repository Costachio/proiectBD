<?php

require_once "../connect.php";
$id = $_POST['id'];

$connection = getConnection();
$connection->beginTransaction();
try {

    $sql_check_asociatie = "SELECT COUNT(*) FROM asociatii WHERE id = :id";
    $query_check_asociatie = $connection->prepare($sql_check_asociatie);
    $query_check_asociatie->execute(['id' => $id]);
    $record_exists_asociatie = $query_check_asociatie->fetchColumn();


    $sql_check_conturi_bancare = "SELECT COUNT(*) FROM conturi_bancare WHERE id = :id";
    $query_check_conturi_bancare = $connection->prepare($sql_check_conturi_bancare);
    $query_check_conturi_bancare->execute(['id' => $id]);
    $record_exists_conturi_bancare = $query_check_conturi_bancare->fetchColumn();

    if ($record_exists_asociatie && $record_exists_conturi_bancare) {

        $sql_asociatii = "DELETE FROM asociatii WHERE id = :id";
        $query_asociatii = $connection->prepare($sql_asociatii);
        $query_asociatii->execute(['id' => $id]);

        $sql_conturi_bancare = "DELETE FROM conturi_bancare WHERE id = :id";
        $query_conturi_bancare = $connection->prepare($sql_conturi_bancare);
        $query_conturi_bancare->execute(['id' => $id]);

        $connection->commit();
        header("Location: /Asociatii/asociatii_page.php");
    } else {

        echo "Error: Record not found in the database.";
    }

} catch (PDOException $e) {

    $connection->rollBack();
    echo "Error: " . $e->getMessage();


}
?>

