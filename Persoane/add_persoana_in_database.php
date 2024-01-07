<?php

require_once "../connect.php";

$nume = $_POST['nume'];
$prenume = $_POST['prenume'];
$sex = $_POST['sex'];
$email = $_POST['email'];
$telefon = $_POST['telefon'];

$connection = getConnection();
$connection->beginTransaction();

try {
    $sql_persoane = "INSERT INTO persoane (nume, prenume, sex, email, telefon) 
                     VALUES (:nume, :prenume, :sex, :email, :telefon)";

    $query_persoane = $connection->prepare($sql_persoane);
    $query_persoane->execute([
        'nume' => $nume,
        'prenume' => $prenume,
        'sex' => $sex,
        'email' => $email,
        'telefon' => $telefon
    ]);
    $connection->commit();
    header("Location: /Persoane/persoane_page.php");

} catch (PDOException $e) {

    $connection->rollBack();
    echo "Error: " . $e->getMessage();
}
