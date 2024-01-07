<?php

require_once "../../connect.php";

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
    // Check if the record exists
    $sql_check_apartament = "SELECT COUNT(*) FROM apartamente WHERE id = :id";
    $query_check_apartament = $connection->prepare($sql_check_apartament);
    $query_check_apartament->execute(['id' => $id_apartament]);
    $record_exists_apartament = $query_check_apartament->fetchColumn();

    if ($record_exists_apartament) {

        // Insert into persoane table
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

        // Insert into persoane_apartamente table
        $id_persoana = $connection->lastInsertId();

        $sql_persoane_apartamente = "INSERT INTO persoane_apartamente (persoana_id, apartament_id, flag_proprietar) 
                     VALUES (:persoana_id, :apartament_id, :flag_proprietar)";

        $query_persoane_apartamente = $connection->prepare($sql_persoane_apartamente);
        $query_persoane_apartamente->execute([
            'persoana_id' => $id_persoana,
            'apartament_id' => $id_apartament,
            'flag_proprietar' => $flag_proprietar,
        ]);

        $connection->commit();
        header("Location: ../Persoane/persoane_page.php");
    } else {
        echo "Error: Apartament does not exist.";
    }

} catch (PDOException $e) {
    $connection->rollBack();
    echo "Error: " . $e->getMessage();
}
?>
