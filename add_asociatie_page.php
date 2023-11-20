<!DOCTYPE html>
<html>
<head>
    <title>Adauga asociatie</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Adauga o noua asociatie</h1>
    <form method="post" action="add_asociatie_in_database.php">
        <div class="mb-3">
            <label for="denumire" class="form-label">Denumire</label>
            <input required type="text" name="denumire" class="form-control" id="denumire">
        </div>
        <div class="mb-3">
            <label for="nume_administrator" class="form-label">Nume administrator</label>
            <input required type="text" name="nume_administrator" class="form-control" id="nume_administrator">
        </div>
        <div class="mb-3">
            <label for="nume_presedinte" class="form-label">Nume presedinte</label>
            <input required type="text" name="nume_presedinte" class="form-control" id="nume_presedinte">
        </div>
        <div class="mb-3">
            <label for="nume_contabil" class="form-label">Nume contabil</label>
            <input required type="text" name="nume_contabil" class="form-control" id="nume_contabil">
        </div>
        <div class="mb-3">
            <label for="cod_fiscal" class="form-label">Cod fiscal</label>
            <input required type="text" name="cod_fiscal" class="form-control" id="cod_fiscal">
        </div>
        <div class="mb-3">
            <label for="data_infiintare" class="form-label">Data infiintare ( exemplu format: 20/12/2023 )</label>
            <input required type="text" name="data_infiintare" class="form-control" id="data_infiintare">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>