<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/stile.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
            $('.date').datepicker({
                multidate: true,
                format: 'dd-mm-yyyy'
            });
        </script>
    </head>
    <body>
        <?php
        $database = "test";
        $host = "localhost";
        $user = "root";
        $psw = "";

        $conn = new mysqli($host, $user, $psw, $database);
        if ($conn->connect_error) {
            die("Errore di connessione al database: " . $conn->connect_error);
        }
        echo "Connessione al database riuscita.<br>";

        if (isset($_POST["submit"])) {

            $dataInizio = date_create("2019-01-01");
            $dataFine = date_create("2020-01-01");
            insertDate($dataInizio, $dataFine, $conn);

            function insertDate($dataInizio, $dataFine, $conn) {
                $nGiorni = (date_diff($dataInizio, $dataFine)->format("%a")) + 1;

                for ($index = 0; $index < $nGiorni; $index++) {

                    switch (date_format($dataInizio, "N")) {
                        case 1:
                            $giorno = "lunedi";
                            break;
                        case 2:
                            $giorno = "martedi";
                            break;
                        case 3:
                            $giorno = "mercoledi";
                            break;
                        case 4:
                            $giorno = "giovedi";
                            break;
                        case 5:
                            $giorno = "venerdi";
                            break;
                        case 6:
                            $giorno = "sabato";
                            break;
                        case 7:
                            date_add($dataInizio, date_interval_create_from_date_string("1 day"));
                            $giorno = "lunedi";
                            $index++;
                            break;
                    }

                    $sql = "INSERT INTO `giorniscolastici` (`data`, `giorno`) VALUES ('" . date_format($dataInizio, "Y-m-d") . "', '$giorno');";
                    $conn->query($sql);

                    date_add($dataInizio, date_interval_create_from_date_string("1 day"));
                }

                echo "Date inserite correttamente.";
            }

            function deleteDates($datesToDelete, $conn) {
                foreach ($datesToDelete as $value) {
                    $sql = "DELETE FROM `giorniscolastici` WHERE `giorniscolastici`.`data` = '" . date_format($value, "Y-m-d") . "'";
                    $conn->query($sql);
                }
            }

            function daleteDateRange($startDate, $endDate, $conn) {
                $sql = "DELETE FROM `giorniscolastici` WHERE `giorniscolastici`.`data` BETWEEN " . date_format($startDate, "Y-m-d") . " AND " . date_format($endDate, "Y-m-d") . " ;";
                $conn->query($sql);
            }

        }
        ?>

        <form name="dateInterval" method="post">
            <br>
            Data inizio <input type="date" name="dataInizio"><br>
            Data fine <input type="date" name="dataFine"><br>
            <div class="container">
                Seleziona le date da escludere (non è necessario selezionare le domeniche)<br>
                <input type="text" class="form-control date" placeholder="Pick the multiple dates">
            </div>	
            <input name="submit" type="submit" value="Invia" />
        </form>
    </body>
</html>
