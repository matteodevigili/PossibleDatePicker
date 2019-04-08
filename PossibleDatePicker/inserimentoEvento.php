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
    <?php
    include_once './config/dbConnection.php';
    
    $conn = @new mysqli($host, $user, $psw, $database);
    if ($conn->connect_error) {
        header("location: error.php?error=".$conn->connect_error);
    }
    //echo "Connessione al database riuscita.<br>";

    if (isset($_POST["submit"])) {
        if($_POST["giorniEvento"] != ""){
            $txtGiorniEvento = $_POST["giorniEvento"];
            $giorniEvento = explode(",", $txtGiorniEvento);
            
            $sql = "";
            foreach ($giorniEvento as $value) {
                $dataFormattata = date_create_from_format("d-m-Y", $value);
                $sql .= "INSERT INTO `$tabellaEventi` (`id`, `title`, `start`, `end`) VALUES (NULL, '".$_POST["nomeEvento"]."', '".date_format($dataFormattata, "Y-m-d")."', '".date_format($dataFormattata, "Y-m-d")."');";
            }
            
            $conn->multi_query($sql);
            $conn->close();
        }
    }
    
    ?>

    <div class="container">

        <h2>Inserimento Evento</h2><br>
        <br>
        <form name="FormEvento" method="post">
            Nome evento:
            <input type="text" name="nomeEvento" ><br><br>

            <input type="text" name="giorniEvento" class="form-control date" placeholder="Seleziona Date Evento..." readonly>
            <script type="text/javascript">
                $('.date').datepicker({
                    language: "it",
                    multidate: true,
                    format: 'dd-mm-yyyy'
                });
            </script> <br>


            <input name="submit" type="submit" value="Inserisci" />
        </form>
    </div>
    <?php include_once 'calendario.php'; ?>
</body>
</html>