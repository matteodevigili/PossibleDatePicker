<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='utf-8' />
        <title>Calendario eventi</title>

        <link href="css/style.css" rel="stylesheet">

        <link href='fullcalendar/core/main.css' rel='stylesheet' />
        <link href='fullcalendar/daygrid/main.css' rel='stylesheet' />
        <link href='fullcalendar/list/main.css' rel='stylesheet' />
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

        <script src='fullcalendar/core/main.js'></script>
        <script src='fullcalendar/daygrid/main.js'></script>
        <script src='fullcalendar/core/locales/it.js'></script>
        <script src='fullcalendar/list/main.js'></script>

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

            .fc-time  {
                display: none !important;
            }



        </style>


        <script>

            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
                    locale: 'it',
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,listMonth'
                    },
                    events: {
                        url: 'json-events-feed.php',
                        type: 'POST'
                    },
                    dateClick: function (info) {
                        document.getElementById('id01').style.display = 'block';
                        var arrData = (info.dateStr).split("-");

                        var mydate = arrData[2] + "-" + arrData[1] + "-" + arrData[0];

                        document.getElementById('dataInizio').value = mydate;
                        document.getElementById('dataFine').value = mydate;
                    },
                    eventClick: function (info) {
                        document.getElementById('id02').style.display = 'block';
                        document.getElementById('idEventoHIDDEN').value = info.event.id;
                    },
                    eventRender: function (event, element) {
                        if (event.color) {
                            element.css('background-color', event.color);
                        }
                    }
                });

                calendar.render();
            });

        </script>
    </head>
    <body>
        <div id="id01" class="w3-modal">
            <div class="w3-modal-content w3-animate-top w3-card-4">
                <header class="w3-container w3-teal"> 
                    <span onclick="document.getElementById('id01').style.display = 'none'" 
                          class="w3-button w3-display-topright">&times;</span>
                    <h2>Inserisci evento..</h2>
                </header>
                <div class="w3-container">
                    <form class="w3-container" name="inserimentoEvento" method="POST">
                        <br>
                        <label>Nome evento</label>
                        <input class="w3-input w3-border" name="nomeEvento" type="text" required>
                        <br>
                        <label>Data inizio</label>
                        <input class="w3-input w3-border" id="dataInizio" name="dataInizio" type="text" required>
                        <br>
                        <label>Data fine</label>
                        <input class="w3-input w3-border" id="dataFine" name="dataFine" type="text" required>
                        <br>

                        <input class="w3-btn w3-teal" type="submit" name="submitInserimento" value="Inserisci" /><br>
                        <br>
                    </form>
                </div>
            </div>
        </div>
        <div id="id02" class="w3-modal">
            <div class="w3-modal-content w3-animate-top w3-card-4">
                <header class="w3-container w3-teal"> 
                    <span onclick="document.getElementById('id02').style.display = 'none'" 
                          class="w3-button w3-display-topright">&times;</span>
                    <h2>Cancella evento</h2>
                </header>
                <div class="w3-container">
                    <form class="w3-container" name="eliminaEvento" method="POST">
                        <br>
                        <label>Vuoi eliminare l'evento?</label>
                        <input type="hidden" name="idEventoHIDDEN" id="idEventoHIDDEN"/>
                        <br><br>
                        <input class="w3-btn w3-teal" type="submit" name="submitEliminazione" value="Si" /> <button class="w3-btn w3-teal" onclick="document.getElementById('id02').style.display = 'none'">No</button> <br>
                        <br>
                    </form>
                </div>
            </div>
        </div>
        <div id='calendar'></div>
        <div align="center"><a href="index.php"><button>Home</button></a></div><br>
    </body>
</html>