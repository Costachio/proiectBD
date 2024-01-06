
<!DOCTYPE html>
<html>
<head>
    <title>Adauga scara</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Adauga o noua scara</h1>
    <form method="post" action="add_scara_in_database.php">
        <div class="mb-3">
            <label for="denumire" class="form-label">Denumire</label>
            <input required type="text" name="denumire" class="form-control" id="denumire">
        </div>
        <div class="mb-3">
            <label for="numar_etaje" class="form-label">Numar etaje</label>
            <input required type="text" name="numar_etaje" class="form-control" id="numar_etaje">
        </div>
        <div class="mb-3">
            <label for="numar_apartamente" class="form-label">Numar apartamente</label>
            <input required type="text" name="numar_apartamente" class="form-control" id="numar_apartamente">
        </div>
        <div class="mb-3">
            <label for="imobil" class="form-label">Imobil</label>
            <input required type="text" name="imobil" class="form-control" id="imobil">
        </div>
        <button type="submit" class="btn btn-primary">Trimite</button>
    </form>
</div>
</body>
</html>