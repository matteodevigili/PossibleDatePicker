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

        <link rel="stylesheet" href="css/stile.css">
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
        $database = "test";
        $host = "localhost";
        $user = "root";
        $psw = "";

        $conn = new mysqli($host, $user, $psw, $database);
        if ($conn->connect_error) {
            die("Errore di connessione al database: " . $conn->connect_error);
        }
        //echo "Connessione al database riuscita.<br>";

        if (isset($_POST["submit"])) {
            
            if($_POST["dataInizio"] != "" && $_POST["dataFine"] != ""){
                
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

                header("location: success.html");
                }
        }

        function insertDate($dataInizio, $dataFine, $conn) {
            $nGiorni = (date_diff($dataInizio, $dataFine)->format("%a")) + 1;
            $sql = "";

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

                $sql .= "INSERT INTO `giorniscolastici` (`data`, `giorno`) VALUES ('" . date_format($dataInizio, "Y-m-d") . "', '$giorno');";

                date_add($dataInizio, date_interval_create_from_date_string("1 day"));
            }

            $conn->multi_query($sql);

            //echo "Date inserite correttamente nella tabella<br>";
        }

        function deleteDates($datesToDelete, $conn) {
            foreach ($datesToDelete as $value) {
                $dataFormattata = date_create_from_format("d-m-Y", $value);
                $sql = "";
                
                $sql .= "DELETE FROM `giorniscolastici` WHERE `giorniscolastici`.`data` = '" . date_format($dataFormattata, "Y-m-d") . "'";
            }
            
            $conn->multi_query($sql);
            
            //echo "Date da escludere eliminate correttamente dalla tabella<br>";
        }

        /* NOT WORKING
        function daleteDateRange($startDate, $endDate, $conn) {
            $sql = "DELETE FROM `giorniscolastici` WHERE `giorniscolastici`.`data` BETWEEN " . date_format($startDate, "Y-m-d") . " AND " . date_format($endDate, "Y-m-d") . " ;";
            $conn->query($sql);
        }*/
        ?>

        <div class="container">

            <h2>Selezione giorni scolastici per generazione tabella SQL</h2><br>

            <form name="dateInterval" method="post">
                Data inizio<br>
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

                Data fine<br>
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

                Seleziona le date da escludere (non è necessario selezionare le domeniche)<br>
                <input type="text" name="giorniEsclusi" class="form-control date" placeholder="Seleziona le date da escludere..." readonly>
                <script type="text/javascript">
                    $('.date').datepicker({
                        language: "it",
                        multidate: true,
                        format: 'dd-mm-yyyy'
                    });
                </script>
                <br>	
                <input name="submit" type="submit" value="Invia" />
            </form>
        </div>
    </body>
</html>
