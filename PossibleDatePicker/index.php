<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Inserimento giorni scolastici</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div align="center"><h1>Tool calendario scolastico</h1></div>
        <div align="center"><h2>ITT Buonarroti-Pozzo</h2></div>
        <div align="center"><a href="generazioneTabella.php"><button margin-right="30px"> <i class="fas fa-database fa-7x"></i><br><br>Genera calendario scolastico</button></a>   <a href="eventi.php"><button> <i class="fas fa-calendar-plus fa-7x"></i><br><br>Visualizza e inserisci eventi</button></a></div>
        <br>
        <div align="center"><h3>Database di connessione:<br></h3><h4>(modificare il file config/dbConnection.php)</h4>
            <?php 
            include_once './config/dbConnection.php';
            echo "database: $database<br> host: $host<br> user: $user<br> password: $psw<br><br> tabella calendario: $tabellaCalendario<br> tabella eventi: $tabellaEventi" ?>
        </div>
    </body>
</html>
