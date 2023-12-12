<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_GET['property']; ?></title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1><?php echo $_GET['property']; ?></h1>
    <?php
    $xml = simplexml_load_file($_SESSION['xmlFileName']);
    ?>
    <form action="/update_property.php" method="post">
        <div class="form-group">
            <label for="rename-delete-form">Введите новое имя свойства:</label>
            <input type="hidden" name="name" value="<?php echo $_GET['property']; ?>">
            <input type="text" class="form-control" value="<?php echo $_GET["property"];?>" id="rename-delete-form" name="newProperty">
        </div>
        <div class="form-group">
            <button type="submit" name="action" value="rename" class="btn btn-primary">Rename</button>
            <button type="submit" name="action" value="delete" class="btn btn-secondary">Delete</button>
        </div>
    </form>
</div>
<!-- Include Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>