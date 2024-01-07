<?php

require_once "../../connect.php";

$id = $_POST['id'];
$nume = $_POST['nume'];
$prenume = $_POST['prenume'];
$sex = $_POST['sex'];
$email = $_POST['email'];
$telefon = $_POST['telefon'];
$id_apartament = $_POST['apartament'];
$flag_proprietar = $_POST['flag_proprietar'];

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

        // Update the corresponding entry in persoane_apartamente
        $sql_persoane_apartamente = "UPDATE persoane_apartamente 
                                     SET flag_proprietar = :flag_proprietar
                                     WHERE persoana_id = :id AND apartament_id = :id_apartament";

        $query_persoane_apartamente = $connection->prepare($sql_persoane_apartamente);
        $query_persoane_apartamente->execute([
            'id' => $id,
            'id_apartament' => $id_apartament,
            'flag_proprietar' => $flag_proprietar,
        ]);

        $connection->commit();
        header("Location: ../Persoane/persoane_page.php");
    } else {

        echo "Error: Record not found in the database.";
    }

} catch (PDOException $e) {
    $connection->rollBack();
    echo "Error: " . $e->getMessage();
}
?>
