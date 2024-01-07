<?php

require_once "../../connect.php";

$denumire = $_POST['denumire'];
$id_administrator = $_POST['administrator'];
$id_presedinte = $_POST['presedinte'];
$id_contabil = $_POST['contabil'];
$cod_fiscal = $_POST['cod_fiscal'];
$data_infiintare = $_POST['data_infiintare'];
$cont_bancar = $_POST['cont_bancar'];
$banca = $_POST['banca'];

$connection = getConnection();
$connection->beginTransaction();
try {
    $sql_asociatii = "INSERT into asociatii (denumire, cod_fiscal, data_infiintare, id_administrator, id_presedinte, id_contabil) 
                      VALUES (:denumire, :cod_fiscal, :data_infiintare, :id_administrator, :id_presedinte, :id_contabil)";
    $query = $connection->prepare($sql_asociatii);
    $query->execute([
        'denumire' => $denumire,
        'cod_fiscal' => $cod_fiscal,
        'data_infiintare' => $data_infiintare,
        'id_administrator' => $id_administrator,
        'id_presedinte' => $id_presedinte,
        'id_contabil' => $id_contabil
    ]);

    $lastInsertId = $connection->lastInsertId();
    $sql_conturi_bancare = "INSERT INTO conturi_bancare (id, cont, banca) VALUES (:id, :cont, :banca)";

    $query_conturi_bancare = $connection->prepare($sql_conturi_bancare);
    $query_conturi_bancare->execute([
        'id' => $lastInsertId,
        'cont' => $cont_bancar,
        'banca' => $banca,
    ]);


    $connection->commit();

    header("Location:  ../Asociatii/asociatii_page.php");

} catch (PDOException $e) {

    $connection->rollBack();

    echo "Error: " . $e->getMessage();


}
?>

