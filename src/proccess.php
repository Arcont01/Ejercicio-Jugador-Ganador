<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba 2</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
    <section class="container">
        <div class="row">
            <div class="col-12">
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (!isset($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
                ?>
                        <div class="alert alert-danger" role="alert">
                            Error al subir archivo
                        </div>
                        <a class="btn btn-primary rounded-pill" href="../index.php">Volver a intentar</button>
                        <?php
                    } else {
                        $fileTempPath = $_FILES['file']['tmp_name'];
                        $fileName = $_FILES['file']['name'];
                        $fileNameCmps = explode(".", $fileName);
                        $fileExtension = strtolower(end($fileNameCmps));
                        $allowedfileExtensions = ['txt'];
                        $winnerPlayers = [];
                        $differences = [];
                        if (in_array($fileExtension, $allowedfileExtensions)) {
                            $content = file($fileTempPath);
                            $rounds = (int)array_shift($content);

                        ?>
                            <table class="table table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Jugador 1</th>
                                        <th scope="col">Jugador 2</th>
                                        <th scope="col">Lider</th>
                                        <th scope="col">Ventaja</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < $rounds; $i++) {
                                        $temp = explode(" ", $content[$i]);
                                        $firstPlayer = (int) $temp[0];
                                        $secondPlayer = (int) $temp[1];

                                    ?> <tr>
                                            <td><?php echo $firstPlayer ?></td>
                                            <td><?php echo $secondPlayer ?></td>
                                            <?php

                                            if ($firstPlayer > $secondPlayer) {
                                                $winnerPlayers[] = 1;

                                                ?><td> Jugador 1</td><?php
                                            } else {
                                                $winnerPlayers[] = 2;
                                                ?><td> Jugador 2</td><?php
                                            }
                                            $tempDifference = $firstPlayer - $secondPlayer;
                                            $differences[] = $tempDifference =  abs($tempDifference);

                                            ?>      
                                            <td><?php echo $tempDifference ?></td>
                                        </tr>
                                    <?php
                                    }

                                    $max_point = max($differences);
                                    $indexPoint = array_search($max_point, $differences);
                                    $winnerPlayer = $winnerPlayers[$indexPoint];

                                    ?>
                                </tbody>
                            </table>
                            <div class="alert alert-success" role="alert">
                                Jugador ganador: <?php echo $winnerPlayer; ?> <br>
                                Diferencia de puntuacion: <?php echo $max_point; ?>
                            </div>

                            <a class="btn btn-primary" href="../index.php">Volver a probar</button>
                        <?php


                        } else {
                        ?>
                            <div class="alert alert-danger" role="alert">
                                El archivo debe ser tipo .txt
                            </div>
                            <a class="btn btn-primary rounded-pill" href="../index.php">Volver a intentar</button>
                <?php
                        }
                    }
                }else{
                    ?>
                    <a class="btn btn-primary rounded-pill" href="../index.php">Volver a intentar</button>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>
</body>
</html>