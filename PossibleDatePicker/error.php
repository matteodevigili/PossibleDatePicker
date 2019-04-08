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
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    </head>
    <body>
        <div align="center"> <i class="fas fa-exclamation-circle fa-7x" style="color: red"></i><h1>Errore</h1></div>
        <div align="center"> <?php if(isset($_GET["error"])){ echo "<h3>".$_GET["error"]."</h3>"; } ?></div>
        <div align="center"><a href="index.php"><button>Torna alla home</button></a></div>
    </body>
</html>