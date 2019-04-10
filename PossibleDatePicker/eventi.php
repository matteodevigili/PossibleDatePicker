<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Inserimento Evento</title>
        <link rel="stylesheet" href="css/style.css">

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
        <div class="w3-container w3-teal">
            <h2>Calendario eventi</h2>
        </div>

        <?php
        include_once './config/dbConnection.php';

        $conn = @new mysqli($host, $user, $psw, $database);
        if ($conn->connect_error) {
            header("location: error.php?error=" . $conn->connect_error);
        }
        //echo "Connessione al database riuscita.<br>";

        if (isset($_POST["submitInserimento"])) {
            if ($_POST["nomeEvento"] != "" && $_POST["dataInizio"] != "" && $_POST["dataFine"] != "") {
                $dataInizio = date_create_from_format("d-m-Y", $_POST["dataInizio"]);
                $dataFine = date_create_from_format("d-m-Y", $_POST["dataFine"]);

                $sql = "INSERT INTO `$tabellaEventi` (`id`, `title`, `start`, `end`) VALUES (NULL, '" . $_POST["nomeEvento"] . "', '" . date_format($dataInizio, "Y-m-d") . "', '" . date_format($dataFine, "Y-m-d") . "');";

                $conn->query($sql);
                $conn->close();
            }
        }

        if (isset($_POST["submitEliminazione"])) {
            $sql = "DELETE FROM `$tabellaEventi` WHERE `eventi`.`id` = '" . $_POST["idEventoHIDDEN"] . "'";

            $conn->query($sql);
            $conn->close();
        }

        include_once 'calendario.php';
        ?>
    </body>
</html>