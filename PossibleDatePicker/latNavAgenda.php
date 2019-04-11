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
            
            .fc-scroller{
                height: auto !important;
                overflow: auto !important;
            }

        </style>


        <script>

            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
                    locale: 'it',
                    defaultView: 'listMonth',
                    events: {
                        url: 'json-events-feed.php',
                        type: 'POST' // Send post data
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
        <div id='calendar'></div>
    </body>
</html>