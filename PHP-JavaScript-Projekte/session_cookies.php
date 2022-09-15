<!--
Autor: Shayan Aziz
Datum: 15.09.2022
Projektname: PHP: Session und Cookies
-->

<?php
//Wenn ein Cookie "Besuch" nicht vorhanden ist, wird eines erstellt, dass nach zwei Minuten abläuft.
if(isset($_COOKIE["Besuch"])) {
  $neu = 0;
} else {
  setcookie("Besuch", "1", time() + 120);
  $neu = 1;
}

// Überprüft, ob der Benutzer zum ersten Mal den Webseite besucht hat.
  if($neu == 1) {
    echo "<p>Willkommen, neue Benutzer!</p>";
} else {
    echo "<p>Willkommen zurück, Benutzer!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Session und Cookies</title>
  <script type="text/javascript">

/* Funktion keyPressed() gibt die Tasteneingabe zurück.
   Wird benötigt, damit HTML eine negativen Wahrheitswert beim Leerschlag zurückgibt,
   sodass die Leertaste nicht an der Session-Name angewendet werden kann.
   Ansonsten erzeugt es Fehler! */

function keyPressed(){
var key = event.keyCode || event.charCode || event.which ;
return key;
}

</script>

</head>
<body>

<p>Bitte füllen Sie die nachfolgenden Eingabefelder
aus: </p>
<form action="session_cookies.php" method="POST">
<p>Vorname: <input type="text" name="vorname" required="true"></p>
<p>Nachname: <input type="text" name="nachname" required="true"></p>
<p>Wohnort: <input type="text" name="ort" required="true"></p>

<?php
  // Wenn der Löschknnopf betätigt wurde, wird die Sitzung gelöscht.
  // Ansonsten wird es gestartet und es folgt eine neue Session-ID, dass Benutzerinformationen speichert.
if (isset($_POST['löschen'])) {
  $_SESSION = array();
} else {
  if(isset($_POST["name"])) {
    session_name($_POST["name"]);
  
  session_start();
  $id = session_id();
  echo "<p>Die Session wurde gestartet.</p>";
  echo "<p>Session-ID: " . $id . " </p>";
  echo "<p>Der Name der Session lautet: " . session_name() . " </p>";
  
  $_SESSION["vorname"] = $_POST["vorname"];
  $_SESSION["nachname"] = $_POST["nachname"];
  $_SESSION["ort"] = $_POST["ort"];
  $_SESSION["zeit"] = date("Y-m-d, h:i:sa");
  
  //Alles, was in der Sitzung gespeichert wurde, wird mit print_r ausgegeben.
  echo "<p>Folgende Daten sind nun in der Session
  gespeichert: </p>";
  echo "<pre>";
  print_r($_SESSION);
  echo "</pre>";
  
  } else {
    echo "<p>Bitte geben Sie hier den Session-Name ein, um die Sitzung zu starten:</p>";
  }
}

?>

Session-Name: 
<input type="text" name = "name" required="true" onKeyDown="javascript: var keycode = keyPressed(event); if(keycode==32){ return false; }"></input> <br><br>
<input type="submit" value="Absenden">
<input type="submit" value="Session löschen" name="löschen">
</form>
</body>
</html>