<!DOCTYPE html>
<html lang="en">

<head>
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
    <title>
        displace unlinked orphan-files  &#10;from its folder recursively &#10;
        <em>Verschiebe unverlinkte Dateiwaisen rekursiv aus dem Ordner </em>
    </title>
    <style>
        body {
            position: relative;

            width: 100%;
            /* height: 100vh; */
            background-color: #000;
            color: yellow;
            font-size: 14px;
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
        }

        .wrapper {
            position: relative;
            max-width: 1900px;
            min-height: 45vh;
            overflow-x: hidden;
            animation: opener 3s both;
        }

        .title {
            position: absolute;
            width: 50%;
            top: 50%;
            left: 35%;
            padding: 5%;
        }

        em {
            opacity: 0.35;
            font-size: .9em;
            display: inline-block;
            padding: 0 0 5px 0;
        }

        .title > em {
            display: inline;
        }

        .pacman {
            width: clamp(3rem, 23vw, 25rem);
            height: clamp(3rem, 23vw, 25rem);
            top: 10%;
            left: 5%;
            background-color: yellow;
            border-radius: 50%;
            position: absolute;
        }

        @keyframes opener {
            from {
                transform: translateX(-100vw);
            }

            to {
                /* clip-path: polygon(100% 50%, 46% 50%, 100% 50%); */
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

        }

        .pacman:after {
            content: "";
            position: absolute;
            width: clamp(3rem, 23vw, 25rem);
            height: clamp(3rem, 23vw, 25rem);
            background-color: #000;

            animation: eat 1s 7s infinite ease-in both;

        }

        @keyframes eat {
            from {
                clip-path: polygon(100% 0, 55% 50%, 100% 100%);
            }

            50% {
                clip-path: polygon(100% 50%, 55% 50%, 100% 50%);
            }

            to {
                /* clip-path: polygon(100% 50%, 46% 50%, 100% 50%); */
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
            animation: eating 7s 1s linear infinite;
        }

        .icon:nth-child(2) {
            animation: eating 7s 2s linear infinite;
        }

        .icon:nth-child(3) {
            animation: eating 7s 3s linear infinite;
        }

        .icon:nth-child(4) {
            animation: eating 7s 4s linear infinite;
        }

        .icon:nth-child(5) {
            animation: eating 7s 5s linear infinite;
        }

        .icon:nth-child(6) {
            animation: eating 7s 6s linear infinite;
        }

        .icon:nth-child(7) {
            animation: eatingred 7s 7s linear infinite;
            fill: red;
        }

        .icon:nth-child(8) {
            animation: eating 7s 8s linear infinite;
        }

        .icon:nth-child(9) {
            animation: eating 7s 9s linear infinite;
        }

        .icon:nth-child(10) {
            animation: eating 7s 10s linear infinite;
        }

        .icon:nth-child(11) {
            animation: eating 7s 11s linear infinite;
        }

        .icon:nth-child(12) {
            animation: eating 7s 12s linear infinite;
        }

        .icon:nth-child(13) {
            animation: eating 7s 13s linear infinite;
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
            85% {
                fill: red;
            }
            90% {
                opacity: 1;

            }

            to {
                transform: translateX(0);
                opacity: 0;
                fill: yellow;
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
            padding: 0 5%;
            flex-basis: 50%;
        }

        .whoami {
            padding-block: 5%;
            display: inline-block;
        }

        .row {
            display: flex;
            justify-content: start;
            text-align: start;

        }

        @media screen and (max-width: 1000px) {
            .row {
                flex-direction: column;
            }
        }

        .row > * {
            padding: 0 5%;
            flex-basis: 50%;
        }

        .output {

            padding: 0 0 0 5%;
        }

        textarea,
        input {
            padding: .5em;
            font-size: 0.8rem;
            background: yellow;
            border-radius: 7px;
            border: 0;
            font-family: "Courier New", Courier, monospace;
        }
        input::placeholder {
            font-family:  Arial, "Helvetica Neue", Helvetica, sans-serif;
        }
        .btn {
            display: block;
            padding: 5%;
            color: white;
            font-size: 2rem;
            background: red;
            border-radius: 7px;
            border: 0;
            font-weight: 700;
            cursor: pointer;
            width: 100%;
        }

        .form-block a.button {
            text-decoration: none;
        }

        iframe {
            position: absolute;
            z-index: -1;
        }

        audio {
            position: absolute;
            top: 2%;
            right: 2%;
            margin-left: auto;
            width: 5%;
        }
    </style>


</head>

<body>

<div class="wrapper">
    <h2 class="title">
        displace unlinked orphan-files from its folder recursively<br/>
        <em>Verschiebe unverlinkte Dateiwaisen rekursiv aus dem Ordner </em>

    </h2>

    <a href="https://www.youtube.com/watch?v=1k_DF_RohcM">
        <div class="pacman">
        <div class="food">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width=" " height=" " fill=""
                     class="funny bi bi-file-code" viewBox="0 0 16 16"
                >
                    <path
                        d="M6.646 5.646a.5.5 0 1 1 .708.708L5.707 8l1.647 1.646a.5.5 0 0 1-.708.708l-2-2a.5.5 0 0 1 0-.708l2-2zm2.708 0a.5.5 0 1 0-.708.708L10.293 8 8.646 9.646a.5.5 0 0 0 .708.708l2-2a.5.5 0 0 0 0-.708l-2-2z"/>
                    <path
                        d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                </svg>
            </div>
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width=" " height=" " fill=""
                     class="funny bi bi-file-earmark-image" viewBox="0 0 16 16"
                >
                    <path d="M6.502 7a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                    <path
                        d="M14 14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5V14zM4 1a1 1 0 0 0-1 1v10l2.224-2.224a.5.5 0 0 1 .61-.075L8 11l2.157-3.02a.5.5 0 0 1 .76-.063L13 10V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4z"/>
                </svg>
            </div>
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width=" " height=" " fill=""
                     class="funny bi bi-file-earmark-medical" viewBox="0 0 16 16"
                >
                    <path
                        d="M7.5 5.5a.5.5 0 0 0-1 0v.634l-.549-.317a.5.5 0 1 0-.5.866L6 7l-.549.317a.5.5 0 1 0 .5.866l.549-.317V8.5a.5.5 0 1 0 1 0v-.634l.549.317a.5.5 0 1 0 .5-.866L8 7l.549-.317a.5.5 0 1 0-.5-.866l-.549.317V5.5zm-2 4.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                    <path
                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                </svg>
            </div>
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width=" " height=" " fill=""
                     class="funny bi bi-file-earmark-music" viewBox="0 0 16 16"
                >
                    <path
                        d="M11 6.64a1 1 0 0 0-1.243-.97l-1 .25A1 1 0 0 0 8 6.89v4.306A2.572 2.572 0 0 0 7 11c-.5 0-.974.134-1.338.377-.36.24-.662.628-.662 1.123s.301.883.662 1.123c.364.243.839.377 1.338.377.5 0 .974-.134 1.338-.377.36-.24.662-.628.662-1.123V8.89l2-.5V6.64z"/>
                    <path
                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                </svg>
            </div>
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width=" " height=" " fill=""
                     class="funny bi bi-file-earmark-pdf" viewBox="0 0 16 16"
                >
                    <path
                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                    <path
                        d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
                </svg>
            </div>
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width=" " height=" " fill=""
                     class="funny bi bi-file-earmark-play" viewBox="0 0 16 16">
                    <path
                        d="M6 6.883v4.234a.5.5 0 0 0 .757.429l3.528-2.117a.5.5 0 0 0 0-.858L6.757 6.454a.5.5 0 0 0-.757.43z"/>
                    <path
                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                </svg>
            </div>
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width=" " height=" " fill=""
                     class="funny bi bi-file-earmark-slides" viewBox="0 0 16 16"
                >
                    <path
                        d="M5 6a.5.5 0 0 0-.496.438l-.5 4A.5.5 0 0 0 4.5 11h3v2.016c-.863.055-1.5.251-1.5.484 0 .276.895.5 2 .5s2-.224 2-.5c0-.233-.637-.429-1.5-.484V11h3a.5.5 0 0 0 .496-.562l-.5-4A.5.5 0 0 0 11 6H5zm2 3.78V7.22c0-.096.106-.156.19-.106l2.13 1.279a.125.125 0 0 1 0 .214l-2.13 1.28A.125.125 0 0 1 7 9.778z"/>
                    <path
                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                </svg>
            </div>
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width=" " height=" " fill=""
                     class="funny bi bi-file-earmark-zip" viewBox="0 0 16 16"
                >
                    <path
                        d="M5 7.5a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v.938l.4 1.599a1 1 0 0 1-.416 1.074l-.93.62a1 1 0 0 1-1.11 0l-.929-.62a1 1 0 0 1-.415-1.074L5 8.438V7.5zm2 0H6v.938a1 1 0 0 1-.03.243l-.4 1.598.93.62.929-.62-.4-1.598A1 1 0 0 1 7 8.438V7.5z"/>
                    <path
                        d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1h-2v1h-1v1h1v1h-1v1h1v1H6V5H5V4h1V3H5V2h1V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                </svg>
            </div>
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width=" " height=" " fill=""
                     class="funny bi bi-file-image" viewBox="0 0 16 16"
                >
                    <path d="M8.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                    <path
                        d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v8l-2.083-2.083a.5.5 0 0 0-.76.063L8 11 5.835 9.7a.5.5 0 0 0-.611.076L3 12V2z"/>
                </svg>
            </div>
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width=" " height=" " fill=""
                     class="funny bi bi-file-font-fill" viewBox="0 0 16 16"
                >
                    <path
                        d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM5.057 4h5.886L11 6h-.5c-.18-1.096-.356-1.192-1.694-1.235l-.298-.01v6.09c0 .47.1.582.903.655v.5H6.59v-.5c.799-.073.898-.184.898-.654V4.755l-.293.01C5.856 4.808 5.68 4.905 5.5 6H5l.057-2z"/>
                </svg>
            </div>
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width=" " height=" " fill=""
                     class="funny bi bi-file-earmark-word" viewBox="0 0 16 16"
                >
                    <path
                        d="M5.485 6.879a.5.5 0 1 0-.97.242l1.5 6a.5.5 0 0 0 .967.01L8 9.402l1.018 3.73a.5.5 0 0 0 .967-.01l1.5-6a.5.5 0 0 0-.97-.242l-1.036 4.144-.997-3.655a.5.5 0 0 0-.964 0l-.997 3.655L5.485 6.88z"/>
                    <path
                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                </svg>
            </div>
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width=" " height=" " fill=""
                     class="funny bi bi-file-earmark-text" viewBox="0 0 16 16"
                >
                    <path
                        d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
                    <path
                        d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                </svg>
            </div>

            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width=" " height=" " fill=""
                     class="funny bi bi-file-earmark-richtext" viewBox="0 0 16 16"
                >
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

<form action="" method="post">
    <div class="row">
        <div class="form-block">
            <label for="name">path of folder (empty = web-root)<br/><em>Pfad des Ordners (leer = Web-Ordner)</em>
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
                      cols="40"
            >css,sass,less, php,html,htm,xml,  js,ts,json,yaml,yml,  txt,rst,md</textarea>
        </div>

        <div class="form-block">
            <label for="marker">comma-separated list of extensions of resource-files<br/><em>Kommaseparierte Liste der
                    Extensions der Ressourcen-Dateien</em> </label><br/>
            <textarea name="marker" id="marker"
                      required rows="4" cols="40"
            >m4p,mp3,ogg,wav,wmv,mov,avi, csv,json, png,gif,tif,tiff,jpeg,jpg,webp,bmp,svg, pdf,ppt,docx,doc,odt,xls,xlsx,ods,txt</textarea>
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
