<?php

require_once "../../connect.php";
$id = $_POST['id'];
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

    $sql_check_asociatie = "SELECT COUNT(*) FROM asociatii WHERE id = :id";
    $query_check_asociatie = $connection->prepare($sql_check_asociatie);
    $query_check_asociatie->execute(['id' => $id]);
    $record_exists_asociatie = $query_check_asociatie->fetchColumn();


    $sql_check_conturi_bancare = "SELECT COUNT(*) FROM conturi_bancare WHERE id = :id";
    $query_check_conturi_bancare = $connection->prepare($sql_check_conturi_bancare);
    $query_check_conturi_bancare->execute(['id' => $id]);
    $record_exists_conturi_bancare = $query_check_conturi_bancare->fetchColumn();

    if ($record_exists_asociatie && $record_exists_conturi_bancare) {

        $sql_asociatii = "UPDATE asociatii 
                          SET denumire = :denumire, cod_fiscal = :cod_fiscal, data_infiintare = :data_infiintare, id_administrator = :id_administrator, id_presedinte = :id_presedinte, id_contabil = :id_contabil  
                          WHERE id = :id";

        $query_asociatii = $connection->prepare($sql_asociatii);
        $query_asociatii->execute([
            'id' => $id,
            'denumire' => $denumire,
            'cod_fiscal' => $cod_fiscal,
            'data_infiintare' => $data_infiintare,
            'id_administrator' => $id_administrator,
            'id_presedinte' => $id_presedinte,
            'id_contabil' => $id_contabil
        ]);

        $sql_conturi_bancare = "UPDATE conturi_bancare SET cont = :cont, banca = :banca WHERE id = :id";

        $query_conturi_bancare = $connection->prepare($sql_conturi_bancare);
        $query_conturi_bancare->execute([
            'id' => $id,
            'cont' => $cont_bancar,
            'banca' => $banca,
        ]);

        $connection->commit();
        header("Location:  ../Asociatii/asociatii_page.php");
    } else {

        echo "Error: One or both records not found in the database.";
    }

} catch (PDOException $e) {
    $connection->rollBack();
    echo "Error: " . $e->getMessage();
}
?>
