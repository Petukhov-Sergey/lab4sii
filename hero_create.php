<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $xml = simplexml_load_file($_SESSION['xmlFileName']);
    print_r($_POST);
    createHeroData($xml);

    header("Location: /updater.php");
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
    $xml->asXML($_SESSION['xmlFileName']);
    //echo '<pre>' . htmlspecialchars(file_get_contents($_SESSION['xmlFileName'])) . '</pre>';
}
?>