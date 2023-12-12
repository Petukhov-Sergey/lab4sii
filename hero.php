<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_GET['name']; ?></title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1><?php echo $_GET['name']; ?></h1>
    <?php
    $xml = simplexml_load_file($_SESSION['xmlFileName']);
    $heroIri = "#" . $_GET['name'];
    $hero = [];
    foreach ($xml->DataPropertyAssertion as $dataPropertyAssertion) {
        if ((string) $dataPropertyAssertion->NamedIndividual['IRI'] === $heroIri) {
            $iri = (string) $dataPropertyAssertion->DataProperty['IRI'];
            $value = (string) $dataPropertyAssertion->Literal;
            $hero[$iri] = $value;
        }
    }
    ?>
    <div class="row">
        <div class="col">
            <form action="update_hero.php" method="post">
                <?php
                foreach ($hero as $key => $value) {
                    echo '<div class="form-group">';
                    echo '<label for="' . $key . '">' . $key . '</label>';
                    echo '<input type="text" class="form-control" id="' . $key . '" name="' . $key . '" value="' . $value . '">';
                }
                ?>
                <input type="hidden" name="heroIri" value="<?php echo $_GET['name']; ?>">
                <button type="submit" name="action" class="btn btn-primary">Save</button>
                <button type="submit" value="delete" name="action" class="btn btn-primary">Delete</button>
                <a href="/updater.php" class="btn btn-secondary">Return</a>
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