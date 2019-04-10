<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inserimento giorni scolastici</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

        <link rel="stylesheet" href="css/stileDatePicker.css">
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

        <!--Bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <!--Bootstrap Datepicker-->
        <link id="bsdp-css" href="css/bootstrap-datepicker3.min.css" rel="stylesheet">
        <script src="js/bootstrap-datepicker.min.js"></script>
        <script src="js/locales/bootstrap-datepicker.it.min.js" charset="UTF-8"></script>


    </head>
    <body>
        <?php
        include_once './config/dbConnection.php';

        $conn = @new mysqli($host, $user, $psw, $database);
        if ($conn->connect_error) {
            header("location: error.php?error=" . $conn->connect_error);
        }
        //echo "Connessione al database riuscita.<br>";

        if (isset($_POST["submit"])) {

            if ($_POST["dataInizio"] != "" && $_POST["dataFine"] != "") {

                $txtDataInizio = $_POST["dataInizio"];
                $txtDataFine = $_POST["dataFine"];
                $txtDateEscluse = $_POST["giorniEsclusi"];

                $dataInizio = date_create_from_format("d-m-Y", $txtDataInizio);
                $dataFine = date_create_from_format("d-m-Y", $txtDataFine);

                insertDate($dataInizio, $dataFine, $conn);

                if ($txtDateEscluse != "") {
                    $datesToDelete = explode(",", $txtDateEscluse);
                    deleteDates($datesToDelete, $conn);
                }

                $conn->close();
                header("location: success.html");
            }
        }

        function insertDate($dataInizio, $dataFine, $conn) {
            $nGiorni = (date_diff($dataInizio, $dataFine)->format("%a")) + 1;
            $sql = "";
            $tabellaCalendario = $GLOBALS["tabellaCalendario"];

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

                $sql .= "INSERT INTO `$tabellaCalendario` (`data`, `giorno`) VALUES ('" . date_format($dataInizio, "Y-m-d") . "', '$giorno');";

                date_add($dataInizio, date_interval_create_from_date_string("1 day"));
            }

            $conn->multi_query($sql);

            //echo "Date inserite correttamente nella tabella<br>";
        }

        function deleteDates($datesToDelete, $conn) {
            $sql = "";
            $tabellaCalendario = $GLOBALS["tabellaCalendario"];

            foreach ($datesToDelete as $value) {
                $dataFormattata = date_create_from_format("d-m-Y", $value);

                $sql .= "DELETE FROM `$tabellaCalendario` WHERE `$tabellaCalendario`.`data` = '" . date_format($dataFormattata, "Y-m-d") . "'";
            }

            $conn->multi_query($sql);

            //echo "Date da escludere eliminate correttamente dalla tabella<br>";
        }
        ?>
        <div class="w3-container w3-teal">
            <h2>Selezione giorni scolastici per generazione tabella SQL</h2>
        </div>
        <div class="container w3-container">
            <form name="dateInterval" method="post">
                <br><label>Data inizio</label>
                <input type="text" name="dataInizio" class="form-control date" placeholder="Seleziona la data d'inizio..." readonly>
                <script type="text/javascript">
                    $('.date').datepicker({
                        autoclose: true,
                        language: "it",
                        multidate: false,
                        format: 'dd-mm-yyyy'
                    });
                </script>
                <br>

                <label>Data fine</label>
                <input type="text" name="dataFine" class="form-control date" placeholder="Seleziona la data di fine..." readonly>
                <script type="text/javascript">
                    $('.date').datepicker({
                        autoclose: true,
                        language: "it",
                        multidate: false,
                        format: 'dd-mm-yyyy'
                    });
                </script>
                <br>

                <label>Seleziona le date da escludere (non è necessario selezionare le domeniche)</label>
                <input type="text" name="giorniEsclusi" class="form-control date" placeholder="Seleziona le date da escludere..." readonly>
                <script type="text/javascript">
                    $('.date').datepicker({
                        language: "it",
                        multidate: true,
                        format: 'dd-mm-yyyy'
                    });
                </script>
                <br>	
                <input class="w3-btn w3-teal" name="submit" type="submit" value="Genera tabella" />
            </form>
        </div>
        <div align="center"><a href="index.php"><button>Home</button></a></div>
    </body>
</html>
