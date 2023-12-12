<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $heroIri = "#" .  $_POST['heroIri'];
    $xml = simplexml_load_file($_SESSION['xmlFileName']);
    if($_POST['action']=='update'){
    updateHeroData($xml, $heroIri);
    header("Location: /hero.php?name=" . $_POST['heroIri']);
    }
    if($_POST['action']=='delete'){
        deleteHeroData($xml, $heroIri);
        header("Location: /updater.php");
    }

    exit;
}

function updateHeroData($xml, $heroIri) {
    foreach ($xml->DataPropertyAssertion as $dataPropertyAssertion) {
        if ((string)$dataPropertyAssertion->NamedIndividual['IRI'] === $heroIri) {
            // Получаем DataProperty IRI
            $dataPropertyIri = (string)$dataPropertyAssertion->DataProperty['IRI'];

            // Проверяем, что DataProperty IRI соответствует заданному
            if (isset($_POST[$dataPropertyIri]) && $_POST[$dataPropertyIri] !== '') {
                // Обновляем значение DataProperty
                $dataPropertyAssertion->Literal = $_POST[$dataPropertyIri];
            }
        }
    }
    $xml->asXML($_SESSION['xmlFileName']);
}

function deleteHeroData($xml, $heroIri) {
    foreach ($xml->DataPropertyAssertion as $dataPropertyAssertion) {
        if ((string)$dataPropertyAssertion->NamedIndividual['IRI'] === $heroIri) {
            unset($dataPropertyAssertion->NamedIndividual);
        }
    }
    foreach ($xml->Declaration as $declaration) {
        if($declaration->NamedIndividual['IRI']==$heroIri){
            unset($declaration->NamedIndividual);
        }
    }
    $xml->asXML($_SESSION['xmlFileName']);
}

?>