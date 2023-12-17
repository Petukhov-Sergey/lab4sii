<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $xml = simplexml_load_file("output.owx");
    //print_r($_SESSION);
    createHeroData($xml);
    print_r($xml);
    //header("Location: /updater.php");
    exit;
}

function createHeroData($xml) {
    $heroName = preg_replace( '/\s+/' , '' , $_POST['heroName'] );
    $declHero = $xml->addChild('Declaration');
    $declHero->addChild("NamedIndividual");
    $heroName = '#' . trim($heroName);
    $declHero->NamedIndividual['IRI'] = $heroName;
    foreach ($_POST as $key=>$value) {
        if($key=="heroName")
            continue;
        $newHero = $xml->addChild('DataPropertyAssertion');
        $newHero->addChild('DataProperty');
        $newHero->DataProperty['IRI']='#' . $key;
        $newHero->addChild('NamedIndividual');
        $newHero->NamedIndividual['IRI'] = $heroName;
        $newHero->addChild('Literal');
        $newHero->Literal = (string)$value;
    }
    $xml->asXML("output.owx");
    //echo '<pre>' . htmlspecialchars(file_get_contents($_SESSION['xmlFileName'])) . '</pre>';
}
?>