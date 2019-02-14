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
        echo "Connessione al database riuscita.<br><h3>Utenti registrati</h3>";

        $dataInizio = date_create("2019-01-01");
        $dataFine = date_create("2020-01-01");
        InsertDate($dataInizio, $dataFine, $conn);

        function InsertDate($dataInizio, $dataFine, $conn) {
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
        ?>
    </body>
</html>
