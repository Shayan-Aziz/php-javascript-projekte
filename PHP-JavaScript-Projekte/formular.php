<!--
Autor: Shayan Aziz
Datum: 15.09.2022
Projektname: PHP: Formular
-->

<!DOCTYPE HTML>  
<html>
<title>PHP-Formular</title>
<head>
<style>
.fehler {color: #FF0000;}
</style>
</head>
<body>  

<?php
// Erstellt Variablen mit leeren Werte.
$nameErr = $emailErr = $geschlechtErr = $webseiteErr = "";
$name = $email = $geschlecht = $kommentar = $webseite = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name ist benötigt.";
  } else {
    $name = test_input($_POST["name"]);
    // Überprüft, dass der Name nur Buchstaben und Leerzeichen erhält.
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Nur Buchstaben und Leerzeichen erlaubt.";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email ist benötigt.";
  } else {
    $email = test_input($_POST["email"]);
    // Überprüft, ob E-Mail dem typischen Format entspricht.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Ungültiges E-Mail-Format.";
    }
  }
    
  if (empty($_POST["webseite"])) {
    $webseite = "";
  } else {
    $webseite = test_input($_POST["webseite"]);
    // Überprüft, ob Syntax vom Link gültig ist (erlaubt auch Bindesstriche).
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$webseite)) {
      $webseiteErr = "Ungültiges Link.";
    }
  }

  if (empty($_POST["kommentar"])) {
    $kommentar = "";
  } else {
    $kommentar = test_input($_POST["kommentar"]);
  }

  if (empty($_POST["geschlecht"])) {
    $geschlechtErr = "Geschlecht ist benötigt.";
  } else {
    $geschlecht = test_input($_POST["geschlecht"]);
  }
}

//Testeingabe-Funktion verwaltet die Ausgabe, dass es klar und verständlich in HTML umformatiert werden kann.
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP-Formular</h2>
<p><span class="fehler">* Pflichtfeld</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="fehler">* <?php echo $nameErr;?></span>
  <br><br>
  E-Mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="fehler">* <?php echo $emailErr;?></span>
  <br><br>
  Webseite: <input type="text" name="webseite" value="<?php echo $webseite;?>">
  <span class="fehler"><?php echo $webseiteErr;?></span>
  <br><br>
  Kommentar: <textarea name="kommentar" rows="5" cols="40"><?php echo $kommentar;?></textarea>
  <br><br>
  Geschlecht:
  <input type="radio" name="geschlecht" <?php if (isset($geschlecht) && $geschlecht=="weiblich") { echo "checked"; } ?> value="weiblich">Weiblich
  <input type="radio" name="geschlecht" <?php if (isset($geschlecht) && $geschlecht=="männlich") { echo "checked"; } ?> value="männlich">Männlich
  <input type="radio" name="geschlecht" <?php if (isset($geschlecht) && $geschlecht=="sonstiges") { echo "checked"; } ?> value="sonstiges">Sonstiges  
  <span class="fehler">* <?php echo $geschlechtErr;?></span>
  <br><br>
  <input type="submit" name="einreichen" value="Einreichen">  
</form>

<?php
echo "<h2>Ihre Eingaben:</h2>";
echo "Name: " . $name;
echo "<br>";
echo "E-Mail: " . $email;
echo "<br>";
echo "Webseite: " . $webseite;
echo "<br>";
echo "Kommentar: " . $kommentar;
echo "<br>";
echo "Geschlecht: " . $geschlecht;
?>

</body>
</html>