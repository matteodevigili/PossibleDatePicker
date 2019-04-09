<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='utf-8' />
        <title>Calendario eventi</title>

        <link href="css/style.css" rel="stylesheet">

        <link href='fullcalendar/core/main.css' rel='stylesheet' />
        <link href='fullcalendar/daygrid/main.css' rel='stylesheet' />

        <script src='fullcalendar/core/main.js'></script>
        <script src='fullcalendar/daygrid/main.js'></script>
        <script src='fullcalendar/core/locales/it.js'></script>
        
        <script src='fullcalendar/interaction/main.js'></script>
        
        <style>

            html, body {
                margin: 0;
                padding: 0;
                font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
                font-size: 14px;
            }

            #calendar {
                max-width: 1100px;
                margin: 40px auto;
            }
            
            #navbar {
               position: fixed;
                top: 40%;
                left: 40%;
                border: 2px solid lightgray;
                width: 100%;
                background-color: white;
                width: auto;
                z-index: 10;
                margin: auto;
            }
            form {
                padding: 20px;
            }
            
        </style>


        <script>
            
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: ['interaction', 'dayGrid', 'timeGrid'],
                    locale: 'it',
                    events: {
                        url: 'json-events-feed.php',
                        type: 'POST' // Send post data
                    },
                    dateClick: function (info) {
                        
                    }
                });

                calendar.render();
            });

        </script>
    </head>
    <body>
        <div id="navbar">
            <form name="inserimentoEvento" method="POST"> 
                Nome evento: <input type="text" name="nomeEvento" value="" /><br>
                Data inizio: <input type="text" name="dataInizio" value="" /><br>
                Data fine: <input type="text" name="dataFine" value="" /><br>
                <input type="submit" value="Inserisci" /><br>
            </form>
        </div>
        <div id='calendar'></div>
        <div align="center"><a href="index.php"><button>Home</button></a></div>
    </body>
</html>