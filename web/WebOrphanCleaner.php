<!DOCTYPE html>
<html lang="en">


<head>
    <!--
    /***************************************************************
    *
    *  Copyright notice
    *
    *  (c) 2021 Dr. Dieter Porth <info@mobger.de> (PHP-Programming)
    *  (c) 2021 Bartosz Skowronek (Design/Frontend)
    *
    *  All rights reserved
    *
    *  This script is free software; you can redistribute it and/or modify
    *  it under the terms of the GNU General Public License as published by
    *  the Free Software Foundation; either version 3 of the License, or
    *  (at your option) any later version.
    *
    *  The GNU General Public License can be found at
    *  http://www.gnu.org/copyleft/gpl.html.
    *
    *  This copyright notice MUST APPEAR in all copies of the script!
    ***************************************************************/
    -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php

    $output = [];
    $success = true;
    $fileDirectory = $_SERVER['REQUEST_URI'];
    $start = ((!empty($_REQUEST['start'])) ?
        trim($_REQUEST['start']) :
        getcwd()
    );
    $start = empty($start) ? getcwd() : $start;
    $linker = preg_replace('/\s+/', '', $_REQUEST['linker'] ?? '');
    $marker = preg_replace('/\s+/', '', $_REQUEST['marker'] ?? '');
    $orphans = preg_replace('/\s+/', '', $_REQUEST['orphans'] ?? '');
    $spam = (int)($_REQUEST['spam'] ?? 0);
    $fileName = 'OrphanCleaner.php';
    $absFilePath = getcwd() . DIRECTORY_SEPARATOR . $fileName;
    if (($spam === 42) &&
        (!empty($start)) &&
        (!empty($linker)) &&
        (!empty($marker)) &&
        (!empty($orphans)) &&
        ($fileDirectory !== false) &&
        (file_exists($absFilePath))
    ) {
        $unusedResultCode = 0;

        $output = ['Output-Code beginn >>>'];
        $execCmd = escapeshellcmd(
            "php $absFilePath --start=$start --linker=$linker --marker=$marker --orphans=$orphans"
        );
        $success = (exec(
                $execCmd,
                $output,
                $unusedResultCode
            ) !== false);
        $output[] = '<<< Output-Code ende';
    }
    ?>
    <link rel="icon" href="data:image/svg+xml,%3Csvg enable-background='new 0 0 368 392' viewBox='0 0 368 392' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='m196.5 196 116-65 49.1-27.5c-32.1-58.1-94-97.5-165.1-97.5-104.1 0-188.5 84.4-188.5 188.5s84.4 188.5 188.5 188.5c68.4 0 128.3-36.4 161.3-91l-47.1-28zm42.5-134c9.4 0 17 7.6 17 17s-7.6 17-17 17-17-7.6-17-17 7.6-17 17-17z' fill='%23ff0'/%3E%3C/svg%3E" type="image/svg+xml" />
    <title>
        displace unlinked orphan-files  &#10;from its folder recursively &#10;
        <em>Verschiebe unverlinkte Dateiwaisen rekursiv aus dem Ordner </em>
    </title>
    <style>
        body {
            position: relative;
            width: 100%;
            background-color: #000;
            color: yellow;
            overflow-x: hidden;
            font-size: 14px;
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
        }

        .wrapper {
            position: relative;
            max-width: 1900px;
            overflow-x: hidden;
            min-height: 45vh;
            animation: opener 3s both;
        }

        .title {
            position: absolute;
            width: 50%;
            top: 70%;
            left: 35%;
            padding: 5%;
            animation: fade  1s 5s both;
            opacity: 0;
        }

        @keyframes fade {
            to {
                opacity: 1;
                top: 50%;
            }
        }

        em {
            opacity: 0.35;
            font-size: .9em;
            display: inline-block;
            padding: 0 0 5px 0;
        }

       .pacman {
            width: clamp(3rem, 23vw, 25rem);
            height: clamp(3rem, 23vw, 25rem);
            top: 10%;
            left: 10%;
            background-color: yellow;
            border-radius: 50%;
            position: absolute;
        }

        @keyframes opener {
            from {
                transform: translateX(-100vw);
            }

            to {
                transform: translateX(0);
            }
        }

        .pacman:before {
            content: "";
            position: absolute;
            width: 9%;
            height: 9%;
            top: 15%;
            right: 30%;
            background-color: #000;
            border-radius: 50%;
            animation: eye 2s 5s ;
        }

        .pacman:after {
            content: "";
            position: absolute;
            width: clamp(3rem, 23vw, 25rem);
            height: clamp(3rem, 23vw, 25rem);
            background-color: #000;
            padding: 0 2px 0 0;
            animation: eat 2s 8s infinite ease-in both;

        }
        @keyframes eye {
            0% {
                background-color: #000;
            }
            12% {
                background-color: yellow;
            }

            25% {
                background-color: #000;
            }

            38% {
                background-color: yellow;
            }

            50% {
                background-color: #000;
            }

            75% {
                background-color: #000;
            }
            88% {
                background-color: yellow;
            }

            100% {
                background-color: #000;
            }
        }

        @keyframes eat {
            from {
                clip-path: polygon(100% 0, 55% 50%, 100% 100%);
            }

            50% {
                clip-path: polygon(100% 50%, 55% 50%, 100% 50%);
            }

            to {
              clip-path: polygon(100% 0, 55% 50%, 100% 100%);
            }
        }

        .food {
            position: absolute;
            top: 44%;
            left: 35%;
            z-index: 2;
        }

        .icon {
            position: absolute;
            fill: yellow;
            width: clamp(32px, 4vw, 80px);

        }

        .icon:nth-child(1) {
            animation: eating 14s 1s linear  both infinite;
        }

        .icon:nth-child(2) {
            animation: eating 14s 3s linear  both infinite;
        }

        .icon:nth-child(3) {
            animation: eating 14s 5s linear  both infinite;
        }

        .icon:nth-child(4) {
            animation: eatingred 14s 7s linear  both infinite;
            fill: red;
        }

        .icon:nth-child(5) {
            animation: eating 14s 9s linear  both infinite;
        }

        .icon:nth-child(6) {
            animation: eating 14s 11s linear both  infinite;
        }

        .icon:nth-child(7) {
            animation: eating 14s 13s linear both  infinite;
        }

        @keyframes eating {
            from {
                transform: translateX(150vw);
            }

            95% {
                opacity: 1;
            }

            to {
                transform: translateX(0);
                opacity: 0;
            }
        }

        @keyframes eatingred {
            from {
                transform: translateX(150vw);
            }
            93% {
                opacity: 1;
                fill: red;
            }
            94% {
                fill: yellow
            }
            97% {
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 0;
            }
        }


        .funny {
            transform-origin: 25% 33%;
            animation: rotate 3s infinite linear both;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);

            }
        }

        form {
            max-width: 1500px;
        }

        .form-block {
            margin-bottom: 1rem;
            flex-basis: 50%;
        }

        .row {
            display: flex;
            justify-content: start;
            text-align: start;
            padding: 0 5% ;
        }

        @media screen and (max-width: 1000px) {
            .row {
                flex-direction: column;
            }
        }


        .output {
            padding: 0 0 0 5%;
        }

        textarea,
        input {
            padding: .5em;
            font-size: 1rem;
            background: yellow;
            border-radius: 7px;
            border: 0;
            font-family: "Courier New", Courier, monospace;
            outline: none;
            resize: none;
        }
        input::placeholder {
            font-family:  Arial, "Helvetica Neue", Helvetica, sans-serif;
        }
        .btn {
            display: block;
            padding:  .8em;
            color: white;
            font-size: 2rem;
            background: red;
            border-radius: 7px;
            border: 0;
            font-weight: 700;
            cursor: pointer;
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
        }

        .btn:hover {
            animation: pulse 1.3s infinite ease-in alternate both;
        }

        @keyframes pulse {
            from {
                background: red;
            }
            to {
                background: #f00c;
            }
        }

        .form-block a.button {
            text-decoration: none;
        }

    </style>


</head>

<body>

<div class="wrapper">
    <h2 class="title">
        displace unlinked orphan-files from its folder recursively<br/>
        <em>Verschiebe unverlinkte Dateiwaisen rekursiv aus dem Ordner </em>

    </h2>

    <a href="https://www.youtube.com/watch?v=1k_DF_RohcM" target="_blank" rel="noopener noreferrer">
        <div class="pacman">
            <div class="food">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="funny" viewBox="0 0 16 16">
                        <path
                                d="M6.646 5.646a.5.5 0 1 1 .708.708L5.707 8l1.647 1.646a.5.5 0 0 1-.708.708l-2-2a.5.5 0 0 1 0-.708l2-2zm2.708 0a.5.5 0 1 0-.708.708L10.293 8 8.646 9.646a.5.5 0 0 0 .708.708l2-2a.5.5 0 0 0 0-.708l-2-2z"/>
                        <path
                                d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                    </svg>
                </div>
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="funny" viewBox="0 0 16 16">
                        <path
                                d="M7.5 5.5a.5.5 0 0 0-1 0v.634l-.549-.317a.5.5 0 1 0-.5.866L6 7l-.549.317a.5.5 0 1 0 .5.866l.549-.317V8.5a.5.5 0 1 0 1 0v-.634l.549.317a.5.5 0 1 0 .5-.866L8 7l.549-.317a.5.5 0 1 0-.5-.866l-.549.317V5.5zm-2 4.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                        <path
                                d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                    </svg>
                </div>
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="funny" viewBox="0 0 16 16">
                        <path
                                d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                        <path
                                d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
                    </svg>
                </div>
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="funny" viewBox="0 0 16 16">
                        <path
                                d="M5 6a.5.5 0 0 0-.496.438l-.5 4A.5.5 0 0 0 4.5 11h3v2.016c-.863.055-1.5.251-1.5.484 0 .276.895.5 2 .5s2-.224 2-.5c0-.233-.637-.429-1.5-.484V11h3a.5.5 0 0 0 .496-.562l-.5-4A.5.5 0 0 0 11 6H5zm2 3.78V7.22c0-.096.106-.156.19-.106l2.13 1.279a.125.125 0 0 1 0 .214l-2.13 1.28A.125.125 0 0 1 7 9.778z"/>
                        <path
                                d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                    </svg>
                </div>
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg"  class="funny" viewBox="0 0 16 16">
                        <path d="M8.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                        <path
                                d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v8l-2.083-2.083a.5.5 0 0 0-.76.063L8 11 5.835 9.7a.5.5 0 0 0-.611.076L3 12V2z"/>
                    </svg>
                </div>
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="funny" viewBox="0 0 16 16">
                        <path
                                d="M5.485 6.879a.5.5 0 1 0-.97.242l1.5 6a.5.5 0 0 0 .967.01L8 9.402l1.018 3.73a.5.5 0 0 0 .967-.01l1.5-6a.5.5 0 0 0-.97-.242l-1.036 4.144-.997-3.655a.5.5 0 0 0-.964 0l-.997 3.655L5.485 6.88z"/>
                        <path
                                d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                    </svg>
                </div>
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="funny" viewBox="0 0 16 16">
                        <path
                                d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                        <path
                                d="M4.5 12.5A.5.5 0 0 1 5 12h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 10h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm1.639-3.708 1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V8.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V8s1.54-1.274 1.639-1.208zM6.25 6a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5z"/>
                    </svg>
                </div>
            </div>
        </div>
    </a>
</div>

<form action="" method="post">

<h2 class="output">
    Message from previous action
    <em>Meldungen von vorheriger Aktion</em>
</h2>

<div class="row">
    <div <?php if (!$success) {
        echo 'style="background-color:red;}"';
    } ?>>

        <?php
        $whomai = exec('whoami');
        $whoami = empty($whoami)?'WhoAmIOff':$whoami;
        if ((is_array($output)) && (!empty($output))) {
            echo 'I, `' . $whomai . '`, found:<br /><em>Ich ``' . $whomai . '` fand:</em><br /><br/>';
            echo implode('<br />', $output);
            $buttonHide = 'style="display:none;"';
            $textHide = '';
        } else {
            $textHide = 'style="display:none;"';
            $buttonHide = '';
            echo 'Which Action? My name is `' . $whomai . '`. I know all of nothing.<br /><em>Welche Aktion? Mein Name ist ``' . $whomai .
                '``. Ich weiß von Nix.</em>';
        }
        ?>

    </div>
</div>


    <div class="row">
        <div class="form-block">
            <label for="start">path of folder (empty = web-root)<br/><em>Pfad des Ordners (leer = Web-Ordner)</em>
            </label><br/>
            <input type="text" name="start" id="start" value=""/>
        </div>
        <div class="form-block">
            <label for="orphans">part of name of the folder for orphan-files<br/><em>Teil des Ordnernamens für Dateiwaisen</em>
            </label><br/>
            <input type="text" name="orphans" id="orphans" required value="orphans"/>
        </div>
    </div>

    <div class="row">
        <div class="form-block">
            <label for="linker">comma-separated list of extensions of files with links to resources<br/><em>Kommaseparierte
                    Liste von Extensions der Dateien mit Links zu Ressourcen</em> </label><br/>
            <textarea name="linker" id="linker" required rows="4"
                      cols="40">css,sass,less,php,xhtml,html,htm,xml,js,ts,json,yaml,yml,txt,rst,md,typoscript,t3s,t3c</textarea>
        </div>

        <div class="form-block">
            <label for="marker">comma-separated list of extensions of resource-files<br/><em>Kommaseparierte Liste der
                    Extensions der Ressourcen-Dateien</em> </label><br/>
            <textarea name="marker" id="marker"
                      required rows="4" cols="40"
            >mp4,mp3,ogg,wav,wmv,mov,avi, csv,json, png,gif,tif,tiff,jpeg,jpg,webp,bmp,svg, pdf,ppt,docx,doc,odt,xls,xlsx,ods,txt</textarea>
        </div>
    </div>

    <div class="row">
        <div class="form-block">
            <label for="spam">Calculate correct 2*3*7 = 6*7 =<br/><em>Rechne richtig 2*3*7 = 6*7 =</em>
            </label>
            <br/>
            <input type="text" name="spam" id="spam" required value="" placeholder="the answer / die Antwort"/>
        </div>

        <div id="orphancleaner-button" class="form-block"><br/>
            <em>Remove Orphans/Entferne Waisen</em> <br>
            <input <?php echo $buttonHide ?> class="btn" type="submit" value="Don't panic!" title="If you are worried about your data, click the PAC-Man! &#10;Wenn Sie Angst um Ihre Daten haben, klicken sie auf den PAC-Man!">
            <a href="<?php echo $fileDirectory; ?>#orphancleaner-button" <?php echo $textHide ?>  class="button">
                <div class="btn" >Once again? Please reload the page!<br><em>Nochmal? Bitte Seite neu laden!</em></div>
            </a>
        </div>
    </div>
</form>

</body>
</html>
