<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Inserimento Evento</title>

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
        
    }



    ?>

    <div class="container">

        <h2>Inserimento Evento</h2><br>
        <br>
        <form name="FormEvento" method="post">
            <a>nome evento: </a> 
            <input type="text" name="nomeEvento" ><br><br>

            <input type="text" name="giornEvento" class="form-control date" placeholder="Seleziona Date Evento..." readonly>
            <script type="text/javascript">
                $('.date').datepicker({
                    language: "it",
                    multidate: true,
                    format: 'dd-mm-yyyy'
                });
            </script> <br>


            <input name="submit" type="submit" value="Invia" />
        </form>
    </div>
</body>

</html>