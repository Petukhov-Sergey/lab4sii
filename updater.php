<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>XML Data</title>
    <!-- Подключаем Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>XML Data</h1>
        <div class="row">
            <div class="col">
                <h2>Classes</h2>
                <ul class="list-group">
                    <?php
                    session_start();
                    $xml = simplexml_load_file($_FILES['xml']['tmp_name']);
                    $xml->asXML('temp.owx');
                    $_SESSION['xml'] = $xml->asXML();
                    $_SESSION['xmlFileName'] = "temp.owx";
                    $classes = array();
                    $dataProperties = array();
                    $namedIndividuals = array();

                    foreach ($xml->Declaration as $declaration) {
                        if ($declaration->Class) {
                            $class = (string) $declaration->Class['IRI'];
                            if (!empty($class) && !in_array($class, $classes)) {
                                $classes[] = $class;
                                echo "<li class='list-group-item'>$class</li>";
                            }
                        }
                    }
                    ?>
                </ul>
                <h2>Признаки</h2>
                <ul class="list-group">
                    <?php
                    $dataProperties = array();

                    foreach ($xml->Declaration as $declaration) {
                        if ($declaration->DataProperty) {
                            $dataProperty = (string) $declaration->DataProperty['IRI'];
                            if (!empty($dataProperty) && !in_array($dataProperty, $dataProperties)) {
                                $dataProperties[] = $dataProperty;
                                echo "<li class='list-group-item'>$dataProperty</li>";
                            }
                        }
                    }
                    ?>
                </ul>
                <h2>Герои</h2>
                <ul class="list-group">
                    <?php
                    $namedIndividuals = array();

                    foreach ($xml->Declaration as $declaration) {
                        if ($declaration->NamedIndividual) {
                            $namedIndividual = (string) $declaration->NamedIndividual['IRI'];
                            if (!empty($namedIndividual) && !in_array($namedIndividual, $namedIndividuals)) {
                                $namedIndividuals[] = $namedIndividual;
                                $heroName = substr($namedIndividual, 1);
                                echo "<li class='list-group-item'><a href='hero.php?name=$heroName'>$heroName</a></li>";;
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>