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
    <div class="row">
        <div class="col">
            <form action="update_hero.php" method="post">
                <div class="form-group">
                    <label for="atkType">Atk Type</label>
                    <select class="form-control" id="atkType" name="atkType">
                        <option value="melee">Melee</option>
                        <option value="range">Range</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="attribute">Attribute</label>
                    <select class="form-control" id="attribute" name="attribute">
                        <option value="str">Str</option>
                        <option value="agil">Agil</option>
                        <option value="int">Int</option>
                        <option value="univ">Univ</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="beer">Beer</label>
                    <select class="form-control" id="beer" name="beer">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="position">Position</label>
                    <input type="text" class="form-control" id="position" name="position">
                </div>
                <input type="hidden" name="heroIri" value="<?php echo $_GET['name']; ?>">
                <button type="submit" class="btn btn-primary">Save</button>
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