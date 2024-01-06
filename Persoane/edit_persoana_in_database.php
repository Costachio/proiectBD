<?php

require_once "../connect.php";

$id = $_POST['id'];
$nume = $_POST['nume'];
$prenume = $_POST['prenume'];
$sex = $_POST['sex'];
$email = $_POST['email'];
$telefon = $_POST['telefon'];

$connection = getConnection();
$connection->beginTransaction();

try {

    $sql_check_persoane = "SELECT COUNT(*) FROM persoane WHERE id = :id";
    $query_check_persoane = $connection->prepare($sql_check_persoane);
    $query_check_persoane->execute(['id' => $id]);
    $record_exists_persoane = $query_check_persoane->fetchColumn();

    if ($record_exists_persoane) {

        $sql_persoane = "UPDATE persoane 
                         SET nume = :nume, prenume = :prenume, sex = :sex, email = :email, telefon = :telefon
                         WHERE id = :id";

        $query_persoane = $connection->prepare($sql_persoane);
        $query_persoane->execute([
            'id' => $id,
            'nume' => $nume,
            'prenume' => $prenume,
            'sex' => $sex,
            'email' => $email,
            'telefon' => $telefon
        ]);

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
