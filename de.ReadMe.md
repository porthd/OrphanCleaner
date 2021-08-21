# Prozess `OrphanCleaner` (deutsch)
#!!!!!!! WARNUNG: Nie auf öffentlich verfügbaren Seiten verwenden! WARNUNG !!!!!!!

## Allgemeines
### Abstract
Das Script verschiebt alle `Waisen`-Dateien mit bestimmten `Marker`-Extensions unterhalb eines `Start`-Ordners in einen `Oprhans`-Ordner,
wenn diese Marker-Dateien keinmal in Dateien mit `Linker`-Extension genannt wurden.
Die Dateien inklusiver der Ordnerstrukturen gehen nicht verloren nach ihrer Verschiebung.

### Was tut die php-Datei `OrphanCleaner.php`
Das php-Programm erfasst alle Dateien, die eine der bei `--marker=` angegebenen Extensionen in ihrem Dateinamen haben.
Die Dateien müssen dabei im Ordner liegen, dessen absoluter oder relativer Dateipfad bei `--start=` angegeben wurde.
Ein absoluter Dateipfad beginnt mit `/`. Der relative Dateipfad beginnt mit einem Buchstaben oder `../` und meint einen Ordner relativ zur aktuell vorliegenden Datei.
Das Programm prüft, ob die Namen der erfassten Dateien inklusive ihrer Extension als Text in mindestens einer Linker-Datei vorkommen.
Zu den Linker-Dateien zählt jede Datei, die eine Extension aus der Liste `--linker=` hat.
Alle Dateien mit Marker-Extension, deren Namen nicht in den Linker-Dateien gefunden wurden, werden in den `Orphans`-Ordner verschoben.

### Was tut die php-Datei `WebOrphanCleaner.php`
Die Datei `WebOrphanCleaner.php` erzeugt eine Webseite mit einem Eingabe-Formular,
dass die Parameter für das Konsolenprogramm `OrphanCleaner.php` abfragt.
Nach Eingabe des Ergebnisses der Kopfrechenaufgabe und Abschicken des Formulars
wird `OrphanCleaner.php` aufgerufen und ausgeführt.
`WebOrphanCleaner.php` ist die GUI (Geniale Unbedarften Inspektion) durch `OrphanCleaner.php`

## Technisches
### Ordner `.ddev`
Ich nutze als lokale Entwicklungsumgebung [DDEV](https://ddev.readthedocs.io/en/stable/), die auf [Docker](https://www.docker.com/products/docker-desktop) aufbaut.
Der Ordner enthält die genutzte Konfiguration.

### Vorbereitung
1. Hinweis wegen Alter Version: Die Umbenennung ist nicht länger erforderlich, weil sie keinen wirklichen zusätzlichen Schutz bietet.
2. Die Webseite `WebOrphanCleaner.php` setzt voraus, dass das php-Hauptprogramm `OrphanCleaner.php` im gleichen Ordner wie sie selbst liegt.
3. Man kann das Hauptprogramm auch über das Betriebssystem auch in einer Konsole/Terminal/Bash/KommandozeilenEingabe aufrufen werden.

### Parameter
Das Hauptprogramm wie das Webformular kennt 4 Parameter.
* --start
  * Default: Verzeichnis des Aufrufs
  * Funktion: relativen oder absoluten Pfad für die Dateibearbeitung angeben.
* --linker
    * Default:
    * Funktion: Comma-separierte Liste mit Dateien, die den Dateinamen als Text bzw. in einem Linktext enthalten könnten.
* --marker
    * Default:
    * Funktion: Comma-separierte Liste mit Dateien, die den Dateinamen als Text bzw. in einem Linktext enthalten könnten.
* --orphans
    * Default: orphans
    * Funktion: Teil des Namen des Ordners, in welches ungenutzte Dateien verschoben werden.
      Der vollständige Ordnername besteht aus einem Datum-Zeit-Code, dem hier erwähnten Namen und einer Nummer.
      Er hätte z.B. am 15. Aug. 2021 un 15:53:21 das folgende Aussehen: `20210815-155324-orphans_0/`.

Im Webformular muss man noch das Feld mit der ultimativen Berechnung für die Frage aller Fragen ausfüllen, damit das Hauptprogramm gestartet wird. (Schutz dagegen, dass der Finger mal wieder schneller klickt als der Developer denken kann.)

### Die verschobenen Dateien
Bei jedem Aufruf wird im Startordner ein Ordner für die verwaisten Dateien angelegt, der eine Datumsangabe im Namen trägt.
In diesen Ordner werden die verwaisten Dateien unter Beibehaltung ihrer relativen Ordnerstruktur verschoben.
Beim zweiten Aufruf wird natürlich auch der alte Ordner der verwaisten Dateien nach verwaisten Dateien durchsucht.


## Aufruf als Webseite
Einfach den gesamten Ordner irgendwo in ein Webverzeichnis packen und die Datei `WebOrphanCleaner.php` im Browser aufrufen.

Beispiel:
`https://dueddelei.ddev.site/typo3conf/ext/webhelp/Cleaner/WebOrphanCleaner.php`
bzw. `https://<Domain-Adresse>/<Ordner-ab-webroot-Verzeichnis>/WebOrphanCleaner.php`

Geben sie den aufzuräumenden Ordner mit seiner absoluten Ordneradresse an oder mit `../` als Pfad relativ zum Ordner von `WebOrphanCleaner.php`.

Die Bedeutung der Eingabe-Felder ist analog wie oben bzw. auf der Webseite beschrieben.

## Test
## Tests von `OrphanCleaner.php` in Konsole starten
1. Öffnen sie die Konsole ((Bash, PowerShell, ...)
2. Nutzen Sie den `cd`-Befehl, um in den Ordner dieser `ReadMe.md`-Datei zu kommen.
3. Die Verfügbarkeit von php7.3+ in der Kommandozeile wird vorausgesetzt.
4. Rufen sie folgenden Befehl auf, um den Test zu starten
```
$> php --start=
```

### Checkliste zu Test prüfen
1. Es muss ein neuer Ordner existieren. Dessen Name sollte aus einer Datumsangabe (`JahrMonatTag-StundeMinuteSekunde-`),
aus dem Wort `orphan` und aus einer Nummer bestehen.
2. In dem Ordner sollten nur Dateien zu finden sein, die das Wort 'Test' enthalten.
   (Da die Groß- und kleinschreibung von einzelnen Betriebssystemen unterschiedlich behandelt wird, bleibt der Aspekt groß-Kleinschreibung hier unberücksichtigt.)
3. In dem anderen Ordnern diese Verzeichnisse, sollten keine Dateien mit dem Namen `Test` zu finden sein.

### Wiederholung / Rückbau der Testumgebung
1. Kopieren Sie den in den vorliegen Ordner.
   Jetzt sollte die vorherige Struktur wieder vorliegen.
2. Löschen Sie den Ordner der verwaisten Dateien.
3. Starten Sie den Test-Prozess erneut. Die Eingabe der verschiedenen Parameter erfolgt auf eigenen Gefahr.
   (Sichern sie ihre wichtigen Daten regelmäßig und insbesondere vor Einführung eines Updates oder einer neuen ~~Saftware~~ Software.)

## Hinweis für die Clean-Code-Bullies und Test-Driven-Polizei
Der Author hat nur den Test mit ``$> php --start=`` ausgeführt.
Das Programm kann auf bestimmten Betriebssystemen scheitern, wenn zum Beispiel das php unzureichende Rechts hat oder wenn es Abweichungen bei der Großkleinschreibung gibt oder ...
### Grundsatz: Mein Name ist Hase und ich weiß von Nix.
Jeder muss selber wissen, was er macht.
Für Hinweise auf Programm- und/oder Rechtschreibfehler bin ich dankbar.

##copyright
(c) 2021 Dr. Dieter Porth <info@mobger.de> (PHP-Programming)
(c) 2021 Bartosz Skowronek (Design/Frontend)
