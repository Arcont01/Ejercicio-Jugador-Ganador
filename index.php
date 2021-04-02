<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 2</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

</head>

<body>
    <header>
        <nav class="navbar navbar-dark bg-info">
            <span class="navbar-brand mb-0 h1">Practica 2</span>
        </nav>
    </header>

    <section class="container my-5">
        <div class="row">
            <div class="col-12 mb-5">
                <form action="./src/proccess.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="file">Subir archivo</label>
                        <input type="file" name="file" id="file" class="form-control rounded-pill">
                    </div>
                    <button type="submit" class="btn btn-primary rounded-pill">Enviar</button>
                </form>
            </div>
        </div>
    </section>
</body>

</html>