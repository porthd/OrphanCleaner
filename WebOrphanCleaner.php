<!DOCTYPE html>
<html>
<head>
    <?php

    $output = [];
    $success = true;
    $fileDirectory = $_SERVER['REQUEST_URI'];
    $start = ((!empty($_REQUEST['start']))?
        trim($_REQUEST['start']) :
        getcwd()
    );
    $start = empty($start) ? getcwd() : $start;
    $linker = preg_replace('/\s+/', '', $_REQUEST['linker'] ?? '');
    $marker = preg_replace('/\s+/', '', $_REQUEST['marker'] ?? '');
    $archive = preg_replace('/\s+/', '', $_REQUEST['archive'] ?? '');
    $spam = (int)($_REQUEST['spam'] ?? 0);
    $fileName  = 'OrphanCleaner.php';
    $absFilePath = getcwd().DIRECTORY_SEPARATOR.$fileName;
    if (($spam === 42) &&
        (!empty($start)) &&
        (!empty($linker)) &&
        (!empty($marker)) &&
        (!empty($archive)) &&
        ($fileDirectory !== false) &&
        (file_exists($absFilePath))
    ) {
        $unusedResultCode = 0;

        $output = ['Output-Code beginn >>>'];
        $execCmd = escapeshellcmd(
            "php $absFilePath --start=$start --linker=$linker --marker=$marker --archive=$archive"
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
        remove unlinked orphan-files from a folder and its subfolders <br />
        Entferne unverlinkte, verwaiste Dateien aus Ordner und seinen Unternordner

    </title>
    <style>
        .form-block {
            margin-bottom:1rem;
        }
    </style>
</head>

<body>
<h2>
    Message from previous action<br/>
    Meldungen von vorheriger Aktion
</h2>

<div <?php if (!$success) {
    echo('style="background-color:red;}"');
} ?>>
    <?php

    if( (is_array($output)) &&( !empty($output))) {
            echo implode('<br />', $output);
    } else {
        echo 'I don`t know any action<br /><em>Welche Aktion? Mein Name ist Hase. Ich weiß von Nix.</em>';
    }
    ?>
</div>
<h1>
    remove unlinked orphan-files from a folder and its subfolders <br/>
    Entferne unverlinkte, verwaiste Dateien aus Ordner und seinen Unternordner
</h1>

<form action="" method="post">
    <div class="form-block">
        <label for="name">Path of Folder (Empty = Webroot)<br/><em>Pfad des Ordners (Leer = Web-Ordner)</em> </label><br />
        <input type="text" name="start" id="start" value=""/>
    </div>
    <br />
    <div class="form-block">
        <label for="linker">comma-separated list of extension for files with resourcve-links<br/><em>Kommaseparierte
                Liste von Extensions für Namen derDateien mit Links</em> </label><br />
        <textarea name="linker" id="linker" required rows="4"
                  cols="40"
        >css, txt, html, sass, less, php, js, md</textarea>


    </div>
    <div class="form-block">
        <label for="archive">archive-prefixe<br/><em>Teil des Namens des Archive-Ordner</em> </label><br />
        <input type="text" name="archive" id="archive" required value="archive"/>
    </div>
    <div class="form-block">
        <label for="marker">comma-separated list of extesnion of Resource-files<br/><em>Kommaseparierte Liste der
                Extensions von Ressourcen-Dateien</em> </label><br />
        <textarea name="marker" id="marker"
                  required rows="4" cols="40"
        >m4p,mp3,ogg,wav,wmv,mov,avi,png, gif, tif, tiff, jpeg, webp, bmp, svg, pdf, ppt, docx, xls, doc, txt</textarea>
    </div>
    <div class="form-block">
        <label for="spam">Spamprotect 2*3*7 =<br/><em>Spam-Schutz 2*3*7 =</em> </label><br />
        <input type="text" name="spam" id="spam" required value="0" placeholder="the answer/die Antwort" />
    </div>
    <div class="form-block"><br />
        <input type="submit" value="Remove Orphans/Entferne Waisen">
    </div>
</form>
</body>
</html>
