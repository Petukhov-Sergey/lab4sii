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
                    if($_FILES){
                    $xml = simplexml_load_file($_FILES['xml']['tmp_name']);
                    $xml->asXML('output.owx');
                    $_SESSION['xml'] = $xml->asXML();
                    $_SESSION['xmlFileName'] = "output.owx";
                    }
                    else{
                        $xml = simplexml_load_file($_SESSION['xmlFileName']);
                    }
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
                    foreach ($xml->Declaration as $declaration) {
                        if ($declaration->DataProperty) {
                            $dataProperty = (string) $declaration->DataProperty['IRI'];
                            if (!empty($dataProperty) && !in_array($dataProperty, $dataProperties)) {
                                $dataProperties[] = $dataProperty;
                                $property=substr($dataProperty, 1);
                                echo "<li class='list-group-item'><a href='property.php?property=$property'>$property</a></li>";
                            }
                        }
                    }
                    ?>
                </ul>
                <h2>Герои</h2>
                <ul class="list-group">
                    <?php
                    foreach ($xml->Declaration as $declaration) {
                        if ($declaration->NamedIndividual) {
                            $namedIndividual = (string) $declaration->NamedIndividual['IRI'];
                            if (!empty($namedIndividual) && !in_array($namedIndividual, $namedIndividuals)) {
                                $namedIndividuals[] = $namedIndividual;
                                $heroName = substr($namedIndividual, 1);
                                echo "<li class='list-group-item'><a href='hero.php?name=$heroName'>$heroName</a></li>";
                            }
                        }
                    }
                    ?>
                </ul>
                <h2>Создать нового героя</h2>
                <form action="hero_create.php" method="post">
                    <div class="form-group">
                        <label for="heroName">Имя героя</label>
                        <input type="text" class="form-control" id="heroName" name="heroName">
                    </div>
                    <div class="form-group">
                        <label for="heroProperties">Параметры героя</label>
                        <?php foreach ($xml->Declaration as $declaration) {
                            if ($declaration->DataProperty) {
                                $dataProperty = (string) $declaration->DataProperty['IRI'];
                                if (!empty($dataProperty)) {
                                    $property=substr($dataProperty, 1);
                                    echo "<input type='text' class='form-control' name='$property' placeholder='$property'>";
                                }
                            }
                        } ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Создать героя</button>
                </form>
                <h2>Создать новый параметр </h2>
                <form action="param_create.php" method="post">
                    <div class="form-group">
                        <label for="paramName">Название параметра</label>
                        <input type="text" class="form-control" id="paramName" name="paramName">
                    </div>
                    <button type="submit" class="btn btn-primary">Создать параметр</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>