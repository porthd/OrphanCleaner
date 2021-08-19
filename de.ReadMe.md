# Prozess `OrphanCleaner` (deutsch)
#!!!!!!!!!!!!!! WARNUNG: Nie Auf Öffentlich Verfügbaren Seiten Verwenden WARNUNG !!!!!!!!!!!!!!!

## Allgemeines
### Abstract
Das Script verschiebt alle `Waisen`-Dateien mit bestimmten `Marker`-Extensions unterhalb eines `Start`-Ordners in einen `Archive`-Ordner, wenn diese Marker-Dateien keinmal in Dateien mit `Linker`-Extrension genannt wurden.

### Was tut die PHP-Datei
Das Programm erfasst alle Dateien, die einer der bei `--marker=` angegebenen Extensionen haben.
Die Dateien müssen dabei in dem Ordner liegen, der bei `--start=` angegeben wurde. Es ist entweder ein absoluter Dateipfad (beginnent mit `/`) oder ein relativer Dateipfad anzugeben.
Das Programm prüft, ob die Namen der erfassten Dateien inklusive ihrer Extension als Text in mindestens einer Linkdatei vorkommen. Zu den Linkdateien zählt jede Datei, die eine Extension aus der Liste `--linker=` hat.
Alle Dateien, die in in den Linker-Dateien gefunden werden, werden in einen Archiv-Ordner verschoben.

## Technisches
### Vorbereitung
1. Die Umbenennung ist nicht länger erforderlich, weil sie keinen wirklichen zusätzlichen Schutz bietet.  
### Parameter
Die Datei kennt 4 Parameter.
* --start
  * Default: Verzeichnis des Aufrufs
  * Funktion: relativen oder absoluten Pfad für die Dateibearbeitung angeben.
* --linker
    * Default:
    * Funktion: Comma-separierte Liste mit Dateien, die den Dateinamen als Text bzw. in einem Linktext enthalten könnten.
* --marker
    * Default:
    * Funktion: Comma-separierte Liste mit Dateien, die den Dateinamen als Text bzw. in einem Linktext enthalten könnten.
* --archive
    * Default: archive
    * Funktion: Teilname des Ordners, in welches ungenutzte Dateien verschoben werden.
      Der vollständige Ordnername besteht aus einem Datum-Zeit-Code, dem hier erwähnten Namen und einer Nummer.
      Er hätte z.B. am 15. Aug. 2021 un 15:53:21 das folgende Aussehen: `20210815-155324-archive_0/`.

## Aufruf als Webseite
Die Seite kann auch über den Browser aufgerufen werden.
Einfache den gesamten Ordner irgendwo in ein Webverzeichnis packen und die Datei `WebOrphanCleaner.php` mit dem Browser aufrufen.

`https://dueddelei.ddev.site/typo3conf/ext/webhelp/Cleaner/WebOrphanCleaner.php`
bzw. `https://<Domain-Adresse>/<Ordner-ab-webroot-Verzeichnis>/WebOrphanCleaner.php`
Geben sie den aufzuräumenden Ordner mit seiner absoluten Ordneradresse an oder mit `../` als Ordner-Adresse relativ zum Ordner von ``WebOrphanCleaner.php``.  

Die Bedeutung der Eingabe-Felder ist analog wie oben beschrieben.    

## Test in Konsole starten
1. Öffnen sie die Konsole ((Bash, PowerShell, ...)
2. Nutzen Sie den `cd`-Befehl, um in den Ordner dieser `ReadMe.md`-Datei zu kommen.
3. Die Verfügbarkeit von php7.3+ in der Kommandozeile wird vorausgesetzt.
4. Rufen sie folgenden Befehl auf, um den Test zu staten
```
$> php --start=
```
## Checkliste zu Test prüfen
1. Es muss ein neuer Order existieren. Dessen Name sollte aus ein Datumsprefix(Jahr,Monat,Dat-Stunde,Minute,Sekunde-), aus dem  Wort `archive` und aus einer Nummer bestehen.
2. In dem Ordner sollten nur Dateien zu finden sein, die das Wort 'Test' enthalten.
   (Da die Groß- und kleinschreibung von einzelnen Betriebssystemen unterschiedlich behandelt wird, belibt der Aspekt groß-Kleinschreibung hier unberücksichtigt. )
3. In dem anderen Ordnern diese Verzeichnisse, sollten keine Dateein mit dem Namen Test zu finden sein.

### Wiederholung / Rückbau der Testumgebung
1. Kopieren Sie den in den vorliegen Ordner.
   Jetzt sollte die vorherige Struktur wieder vorliegen.
2. Löschen sie den Archiv-Ordner.
3. Starten sie den Test-Prozess erneut. Die Eingabe der verschiedenen Parameter erfolgt auf eigenen Gefahr.
   (Sichern sie ihre wichtigen Daten regelmäßig und insbesondere vor Einführung eines Updates oder einer neuen ~~Saftware~~ Software.)

## Hinweis für die Clean-Code-Bullies und Test-Driven-Polizei
Der Author hat nur den Test mit ``$> php --start=`` ausgeführt.
Jeder muss selber wissen, was er macht.
Für Hinweise auf Programm- und/oder Rechtschreibfehler bin ich dankbar.
