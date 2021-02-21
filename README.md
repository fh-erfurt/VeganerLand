# VeganerLand
Webprogrammierung Project

<h6>Ein web programmierung von Jessica Eckardtsberg, Molham Al-Khodari, Mahmoud Matar</h6>

<h2>Online Shop mit Biss</h2>
Im Rahmen der Veranstaltung "GWP & DWP" haben wir uns entschlossen, ein Online Shop zu programmieren.<br>
alle info finde Sie in der HTML document unter Über uns seite, unten beim Impressum. 
<br>


## Installation Step by Step 
     
1. VeganerLand-main.zip entpacken
2. Dateien in XAMMP Ordner kopieren
3. Die erste und zweite Präsentationen und zusätzliche Dokumente sind im Verzeichnis documentation zu finde
4. XAMPP starten und Apache und MySQL starten und Admin klicken
5. In phpMyAdmin der Button Importieren Drücken: <br>

![phpMyAdmin](https://github.com/fh-erfurt/VeganerLand/blob/main/documentation/docu-images/phpMyAdmin.png) <br>

6. Datei “veganerland.sql“ auswählen (Projekt/database/)
7. Ok Klicken
8. Datei “category.sql“ auswählen (Projekt/database/)
9. Ok Klicken  (es könnte Fehler schlagen, ist aber kein Problem)
10. Datei “products.sql“ auswählen (Projekt/database/)
11. Ok Klicken (es könnte Fehler schlagen, ist aber kein Problem)

![phpMyAdmin](https://github.com/fh-erfurt/VeganerLand/blob/main/documentation/docu-images/database.sql.png) <br>

12. Verzeichnis, wo sich das „index.php“ befindet, mit Apache aufmachen.
13. Sie können als Gast das webseite besuchen oder können Sie sich Regestieren und unsere Vorteile genießen.

Sollte die Dokumentation nicht ordentlich angezeigt von dem Link im Impressum, kann man auch in /documentation/documentation.html direkt aufmachen, und die Dokumentation genießen.
<br>

## Zugangsdaten

Email: mustermann@gmail.de <br>
Password: Test321.

## Passwort zurücksetzen

1. Gehsen Sie zu Login Seite
2. Klicken Sie auf (Passwort vergessen)
3. Schreiben Sie ihre Email 
4. Klicken Sie auf (Recover your password) Sie bekommen eine Info angezeigt (Email wurde versendet)
5. gehen Sie zu -> VeganerLand-main -> data und öffnen Sie returnPassword.txt
6. Kopieren Sie das letzte link in der URL 
7. nun Dürfen Sie ihr Passwort neue schreiben.
![returnPassword](https://github.com/fh-erfurt/VeganerLand/blob/main/documentation/docu-images/returnPassword.png) <br>

## Codestyle

1. Sprache
<br>
<ul>
<li>Code und Kommentare werden in Englisch verfasst.</li>
</ul>
<br>

2. Klassen
<br>
<ul>
	<li>Klassenname sowie Dateiname werden in <strong>UpperCamelCase</strong> geschrieben</li>
     <li>Beispiel: ClassName</li>
     <li>Die Strukturierungen der Klassen sehen wie folgt:</li>
</ul>

 <br>
 
    1. Enum
    2. Konstanten und Klassenvariablen 
    3. Variablen
    4. Konstruktor
    5. abstrakte Methoden
    6. Methoden
    7. Getter & Setter
    
    
 - Die Sektionen werden jeweilig mit folgendem Kommentar initiiert:
<br>

    /*
    ===================================
    == Sektionsname
    ===================================
    */

<br>
3. Methoden<br>
<br>
<ul>
	<li>Methodennamen werden in <strong>lowerCamelCase</strong> geschrieben</li>
     <li>Beispiel: methodName</li>
</ul>

<br>
4. Variablen<br>
<br>
<ul>
	<li>Variablen werden in <strong>lowerCamelCase</strong> geschrieben</li>
     <li>Beispiel: variablenName</li>
	<li>Der Gültigkeitsbereich der Variablen wird standartgemäß als <strong>private</strong> deklariert.<br>
		Innerhalb der Klasse wird auf die Variablen mit <strong>this.</strong> zugegriffen.<br>
		Außerhalb der Klasse wird dann folglich mit <strong>Settern & Gettern</strong> auf die Variablen zugegriffen.<br>
		Anhand der <strong>Settern & Gettern</strong> erkennt man somit auch die Zugriffsrechte.<br>
          Mit einem triftigen Grund kann von der Regelung abgewichen werden.</li>
</ul>
<br>
5. Kommentar<br>
<br>
<ul>
<li>Am Anfang einer jeder Datei hinterlässt der Bearbeiter eine Signatur die wie folgt aussieht.</li>
</ul>
<br>
 
    /*
    ===================================
    == Max Mustermann
    ===================================
    */

<br>
<ul>
	<li>Methoden und Klassen werden über den Bezeichner kommentiert und wie folgt initiiert</li>
 </ul>
<br>

    Allgemeines Beispiel
    /**
     * argument explanation what the argument do
     * explanation what the method do
     */
