<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event explorer</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

        .container{
            height:40em;
            width:90%;
            padding:1em;
            background-color:#EDEDED;
            border-radius: 16px;
            display: block;
            position: relative;
            margin-left: auto;
            margin-right: auto;
            margin-top: 1em;
        }
        .container:hover{
            background-color:#A6A7A8;
        }

        img{
            width:100%;
            height:40%;
            border-radius: 16px;
            object-fit: cover;
            padding: 0;
            position: relative;
            top: 2em;
        }

        .title{
            font-size: 2em;
            font-weight: bold;
            text-align: center;
            position: relative;
            top: 0.4em;
        }

        .textcontainer{
            position: relative;
            top: 3em;
        }

        .text{
            text-align: center;
            padding-bottom: 1.5em;
            font-weight: normal;
        }

        .presshere{
            font-weight: bold;
        }

        a{
            text-decoration: none;
            color: black;

            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: bold;
            font-style: normal;
        }
        td{
            width: 50%;
        }
    </style>
</head>
<body>
    <table>
        <tbody>
        <?php
            $urlEvents = "https://sklj.se/Ny%20hemsida/Res%20med%20oss/Kalender/events.json"; //URL:en i en variabel
            $contentEvents = file_get_contents($urlEvents); //Hämtar innehållet från URL:en
            $eventsAll = json_decode($contentEvents); //Dekodar innehållet från JSON till array
            
            if($_GET["lang"] == "ENGLISH")
            {
                $events = $eventsAll->ENGLISH;
            }
            elseif ($_GET["lang"] == "SVENSKA")
            {
                $events = $eventsAll->SVENSKA;
            }
                
            if($_GET["event"] > count($events) - 1)
            {
                die();
            }

            $event = $events[$_GET["event"]];

            echo("<a class='container' href='" . $event->eventURL . "' target='_parent'>"); // Container + sidans URL
            echo("<div class='title'>" . $event->title . "</div>"); //Titeln
            echo("<img src='" . $event->pictureUrl . "'>"); //Bilden
            echo("<div class='textcontainer'>"); //Textstycken i beskrivningen
                echo("<div class='text' class='presshere'>" . $event->undertitle . "</div>"); //Undertiteln
                    foreach($event->descriptions as $stycke)
                    {
                        echo("<div class='text'>" . $stycke . "</div>"); //Styckenas text
                    }
            echo("</div>");
            echo("</a>");
        ?>
        </tbody>
    </table>
</body>
</html>