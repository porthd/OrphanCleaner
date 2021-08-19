<!DOCTYPE html>
<html>
<head>
    <?php

    $options = '';
    $success = true;
    $fileDirectory = __DIR__;
    $start = $_REQUEST['start'] ?? getcwd();
    $start = empty($start) ? getcwd() : $start;
    $linker = trim($_REQUEST['linker'] ?? '');
    $marker = trim($_REQUEST['marker'] ?? '');
    $archive = trim($_REQUEST['archive'] ?? '');
    $spam = (int)($_REQUEST['spam'] ?? 0);
    if (($spam === 42) &&
        (!empty($start)) &&
        (!empty($linker)) &&
        (!empty($marker)) &&
        (!empty($archive)) &&
        ($fileDirectory !== false)
    ) {
        $unusedResultCode = 0;
        $output = ['Output-Code beginn >>>'];
        $execCmd = escapeshellcmd(
            "php $fileDirectory/OrphanCleaner.php --start=$start --linker=$linker --marker=$marker --archive=$archive"
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
</head>

<body>

<h1>
    remove unlinked orphan-files from a folder and its subfolders <br/>
    Entferne unverlinkte, verwaiste Dateien aus Ordner und seinen Unternordner
</h1>
<div <?php if (!$success) {
    echo('style="background-color:red;}"');
} ?>>
    <?php
    echo implode('<br />', $options);
    ?>
</div>
<form action="" method="post">
    <div>
        <label for="name">Path of Folder (Empty = Webroot)<br/><em>Pfad des Ordners (Leer = Web-Ordner)</em> </label>
        <input type="text" name="start" id="start" value=""/>
    </div>
    <div>
        <label for="linker">comma-separated list of extension for files with resourcve-links<br/><em>Kommaseparierte
                Liste von Extensions für Namen derDateien mit Links</em> </label>
        <textarea type="text" name="linker" id="linker" required rows="4" cols="40">
            css, txt, html, sass, less, php, js, md
            </textarea>


    </div>
    <div>
        <label for="archive">archive-prefixe<br/><em>Teil des Namens des Archive-Ordner</em> </label>
        <input type="text" name="archive" id="archive" required value="archive"/>
    </div>
    <div>
        <label for="linker">comma-separated list of extesnion of Resource-files<br/><em>Kommaseparierte Liste der
                Extensions von Ressourcen-Dateien</em> </label>
        <textarea type="text" name="linker" id="linker" required rows="4" cols="40">
            m4p,mp3,ogg,wav,wmv,mov,avi,png, gif, tif, tiff, jpeg, webp, bmp, svg, pdf, ppt, docx, xls, doc, txt
            </textarea>
    </div>
    <div>
        <label for="spamprotect">Spamprotect 2*3*7 =<br/><em>Spam-Schutz 2*3*7</em> </label>
        <input type="text" name="spam" id="spam" required value="" placeholder="the answer/die Antwort"/>
    </div>
    <div>
        <input type="submit" value="Remove Orphans/Entferne Waisen">
    </div>
</form>
</body>
</html>