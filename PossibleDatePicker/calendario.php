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

  </style>
  
  
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
          locale: 'it',
          events: {
            url: 'json-events-feed.php',
            type: 'POST' // Send post data
          },
          eventClick: function() {
              
          }
        });

        calendar.render();
      });

    </script>
  </head>
  <body>

    <div id='calendar'></div>
    <div align="center"><a href="index.php"><button>Home</button></a></div>
  </body>
</html>