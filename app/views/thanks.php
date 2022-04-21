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
            width: 80vw;
        }

        .content-box-small {
            text-align: left;
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

        #name {
            color: #333;
        }

        svg {
            position: absolute;
            z-index: -1;
        }

        path {
            transition: 1s;
        }
    </style>
</head>
<body>
    <div class="topnav">
        <a href="<?php route('/'); ?>">Home</a>
        <a href="https://github.com/WeslleyRAraujo">Github</a>
    </div>
    <div class="flex-box container-box">
        <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25%" id="blobSvg">
            <path id="blob" d="M323,305.5Q314,361,238,382Q162,403,96.5,326.5Q31,250,99.5,179Q168,108,230.5,141.5Q293,175,312.5,212.5Q332,250,323,305.5Z" fill="#ccc"></path>
        </svg>
        <div class="content-box">
            <strong>Hi, <span id="name"><?php echo ucwords($arg)?></span> Thanks for testing!!!</strong>
        </div>
    </div>
    <div class="footer">
        <p>Afterimage-PHP</p>
    </div>

    <script src="<?php asset('/assets/js/blob.js'); ?>"></script>
</body> 
</html>