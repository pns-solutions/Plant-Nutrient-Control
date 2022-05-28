# <u>Die Webanwendung</u>
Das Repo für die Webanwendung von PNS (Frontend, Backend und Tests)

## <b><u>Vorgaben für die IDE und Codestyle</u></b>

<b><u>Für die Nutzung als IDE würde ich PHP-Storm vorgeben.</u></b>
Die neuste Version von PHP-Storm bietet die direkte Einbindung von PHP-Unit Tests und die Möglichkeit für Pair-Programming.

#### <b>Grobe Vorgaben für den Code-Style</b>

1. Englische Variablennamen 
2. Englische Kommentare
3. Deutsche Commits für schnelleres Verständnis im Git
4. Camel-Case bei Variablen, Funktionen und Klassen (Bsp.: $customerData)
5. Die öffnende Klammer bei If-Anweisungen etc... sind immer in derselben Zeile, wie die Anweisung selbst

Bsp.:
```
if(customer['NAME'] == 'Niclas') {
   code....
}
```

## <b><u>Installation Composer und der PHP Unit Tests</u></b>

### Installation Composer

1. Die Composer.exe ausführen. 
2. Haken für Developer-Mode setzen und ein Verzeichnis festlegen. (Bspw. ....\xampp\composer)
3. Installationsverzeichnis merken!
4. Ggf. Computer neu starten

### Einrichtung von Composer und PHP-Unit in PHP-Storm

<b><u>INFO</u></b>: Die composer.json und die phpunit.phar brauch nicht heruntergeladen werden. Diese sind standardmäßig im Repo und müssten beim Kolonen mit heruntergeladen werden.

#### <u>Konfiguration Composer</u>
1. Projekt öffnen
2. Einstellungen öffnen
   1. File - Settings (Strg + Alt + S) - PHP - Composer 
   2. Pfad zur composer.json angeben ("Pfad\zum\Projekt\assets\composer\composer.json)
   3. Im unteren Teil 'composer' executable auswählen und Pfad zur composer.bat festlegen (Die Composer.bat liegt im vorher ausgewählten Installationsverzeichnis)
3. composer. json öffnen und in der oberen rechten Ecke auf Install drücken

Sollte in der Console kein Error auftreten wurde alles erfolgreich installiert <br>
<b><u>INFO</u></b>: Die erfolgreiche Installation wird in roter Schrift ausgegeben. D.h. es ist kein ERROR! Also nicht verwirren lassen! 

#### <u>Konfiguration PHP-Unit</u>

1. Projekt öffnen
2. Einstellungen öffnen
   1. File - Settings (Strg + Alt + S) - PHP - Test Frameworks
3. Auf das "+" in der linken Spalte drücken und PHP Unit Local auswählen
4. Unter PHPUnit library "Path to phpunit.phar" auswählen und Pfad festlegen ("Pfad\zum\Projekt\assets\composer\phpunit.phar)
5. Default bootstrap file Pfad angeben zur autoload.php ("Pfad\zum\Projekt\assets\composer\vendor\autoload.php")
6. Nochmals die composer.json öffnen und erneut installieren

Nun sollte PHP Unit nutzbar sein

#### <u>PHP Unit Klasse erstellen</u>

1. Test werden nur in dem 1_tests Ordner angelegt!
2. Die 1_ vor dem Ordner hat den Zweck, dass dieser Ordner immer ganz oben steht und nicht mitten in der Projektstruktur zu finden ist
3. Rechtsklick auf den Testordner (ggf. Unterordner erstellen) - New - PHP Test - PHPUnit Test