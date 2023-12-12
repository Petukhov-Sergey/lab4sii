<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $propertyIri = "#" .  $_POST['newProperty'];
    $oldIri = "#" . $_POST['name'];
    $xml = simplexml_load_file($_SESSION['xmlFileName']);
    if($_POST['action']=='rename')
        updatePropertyData($xml, $oldIri, $propertyIri);
    if($_POST['action']=='delete')
        deletePropertyData($xml, $oldIri);
    header("Location: /updater.php");
    exit;
}

function updatePropertyData($xml, $oldIri, $newIri) {
    foreach ($xml->DataPropertyAssertion as $dataPropertyAssertion) {
            if($dataPropertyAssertion->DataProperty['IRI'] == $oldIri){
                $dataPropertyAssertion->DataProperty['IRI']=$newIri;
            }

    }
    foreach($xml->Declaration as $declaration){
        if($declaration->DataProperty['IRI'] == $oldIri)
            $declaration->DataProperty['IRI'] = $newIri;
    }
    $xml->asXML($_SESSION['xmlFileName']);
}

function deletePropertyData($xmlx, $propertyIri) {
    foreach ($xmlx->DataPropertyAssertion as $dataPropertyAssertion) {
        if ($dataPropertyAssertion->DataProperty['IRI'] == $propertyIri) {
            unset($dataPropertyAssertion->DataProperty);
            unset($dataPropertyAssertion->Literal);
        }
    }
    foreach ($xmlx->Declaration as $declaration) {
        if ($declaration->DataProperty['IRI'] == $propertyIri) {
            unset($declaration->DataProperty);
        }
    }
    foreach ($xmlx->SubDataPropertyOf as $SubDataPropertyOf) {
        if ($SubDataPropertyOf->DataProperty['IRI'] == $propertyIri) {
            unset($SubDataPropertyOf->DataProperty);
        }
    }
    $xmlx->asXML($_SESSION['xmlFileName']);
}

?>