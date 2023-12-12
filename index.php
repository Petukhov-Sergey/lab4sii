<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>pepega project</title>
</head>
<body>
<div class="container">
    <form enctype="multipart/form-data" action="/updater.php" method="POST" class="form-group">
        <label class="form-label"> Прикрепите XML файл вашей онтологии</label>
        <input type="file" class="form-control" name="xml">
        <input type="submit" class="btn btn-primary mb-3" value="Отправить">
    </form>
</div>

</body>
</html>