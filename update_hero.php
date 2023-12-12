<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $heroIri = $_POST['heroIri'];
    $xml = simplexml_load_file($_SESSION['xmlFileName']);
    $heroData = getHeroData($xml, $heroIri);
    $updatedHeroData = updateHeroData($_POST, $heroData);
    saveHeroData($updatedHeroData, $xml);
    header("Location: hero.php");
    exit;
}

function getHeroData($xml, $heroIri) {
    $heroData = array();
    // Поиск героя по IRI
    $hero = $xml->xpath("//owl:NamedIndividual[@IRI='$heroIri']")[0];
    // Получение признаков героя
    foreach ($hero->DataPropertyAssertion as $dataPropertyAssertion) {
        $dataPropertyIri = (string) $dataPropertyAssertion->DataProperty['IRI'];
        $dataPropertyValue = (string) $dataPropertyAssertion->Literal;

        // Добавление признака в массив данных героя
        $heroData[$dataPropertyIri] = $dataPropertyValue;
    }

    return $heroData;
}
function updateHeroData($postData, $heroData) {
    foreach ($postData as $key => $value) {
        if (array_key_exists($key, $heroData)) {
            $heroData[$key] = $value;
        }
    }
    return $heroData;
}


function saveHeroData($heroData, $filePath) {
    $xml = simplexml_load_file($filePath);
    $heroIri = $heroData['IRI'];

    // Находим героя в XML
    $hero = $xml->xpath("//owl:NamedIndividual[@IRI='$heroIri']")[0];

    // Обновляем признаки героя
    foreach ($heroData as $key => $value) {
        if ($key != 'IRI') {
            $dataProperty = $hero->xpath("./owl:DataPropertyAssertion[./rdf:Description/@rdf:about='#$key']")[0];
            if ($dataProperty) {
                $dataProperty->Literal = $value;
            } else {
                $newDataProperty = $hero->addChild('DataPropertyAssertion');
                $newDataProperty->addChild('DataProperty', '', 'http://www.w3.org/2002/07/owl#')->addAttribute('IRI', "#$key");
                $newDataProperty->addChild('NamedIndividual', '', 'http://www.w3.org/2002/07/owl#')->addAttribute('IRI', $heroIri);
                $newDataProperty->addChild('Literal', $value);
            }
        }
    }

// Save the XML content to a file named data.owx
    $hero->asXML('data.owx');
}
?>