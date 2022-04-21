<!DOCTYPE html>
<html>
<head>
    <title>Afterimage</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@300&display=swap" rel="stylesheet">
    <style>
        body {
            border: 0;
            margin: 0;
            font-family: 'Source Code Pro', monospace;
        }

        button {
            transition: 0.5s;
            width: 256px;
            height: 48px;
            background-color: #FF7070;
            border: 0px;
            color: #FFF;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #333;
            color: #FF7070;
        }

        label {
            font-size: 18px;
        }

        span {
            color: #FF7070;
        }

        input { 
            text-align: center; 
        }

        .topnav {
            display: flex;
            align-items: top;
            justify-content: top;
            background-color: #333;
            overflow: hidden;
        }

        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-weight: 500;
            font-size: 18px;
            transition: 0.5s;
        }

        /* Change the color of links on hover */
        .topnav a:hover {
            transition: 0.5s;
            color: #FF7070;
        }

        .topnav a.inactive {
            color: grey;
            pointer-events: none;
        }
        .topnav a.active {
            background-color: #FF7070;
            color: white;
        }

        .flex-box {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 120px !important;
        }

        .container-box {
            height: 300px;
        }

        .content-box {
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: #FF7070;
            text-align: center;
            width: 600px;
        }

        .content-box-small {
            color: #333;
            font-weight: 600;
            font-size: 24px;
            margin-top: 48px;
        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #333;
            color: #FFF;
            text-align: center;
        }

        #send-message {
            background-color: #333;
        }

        #input-pretty {
            transition: 0.5s;
            height: 24px;
            width: 512px;
            border: none;
            border-bottom: 2px solid #FF7070;
        }

        #input-pretty:hover {
            border-bottom: 2px solid #333;
        }

        #input-pretty:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <div class="topnav">
        <a class="active" href="<?php route('/'); ?>">Home</a>
        <a href="https://github.com/WeslleyRAraujo">Github</a>
    </div>
    <div class="flex-box container-box">
        <div class="content-box">
            SIMPLE ROUTES WITH PHP
            <div class="content-box-small"><span>/simple</span>/and<span>/pretty</span>/routes</div>
            <br>
            <input type="text" id="input-pretty" placeholder="Your Name Here" />
            <br>
            <button id="send-message">Message</button>
            <button onclick="window.location.href='https://github.com/WeslleyRAraujo'">Github</button>
        </div>
    </div>
    <div class="footer">
        <p>Afterimage-PHP</p>
    </div>
    <script src="<?php asset('/assets/js/script.js'); ?>"></script>
</body>
</html>