<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $xml = simplexml_load_file($_SESSION['xmlFileName']);
    print_r($_POST);
    createParamData($xml);
    header("Location: /updater.php");
    exit;
}

function createParamData($xml) {
    $paramName = preg_replace( '/\s+/' , '' , $_POST['paramName'] );
    $declParam= $xml->addChild('Declaration');
    $declParam->addChild("DataProperty");
    $paramName = '#' . trim($paramName);
    $declParam->DataProperty['IRI'] = $paramName;
    $xml->asXML($_SESSION['xmlFileName']);
}
?>