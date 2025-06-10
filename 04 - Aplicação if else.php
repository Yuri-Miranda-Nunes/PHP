<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>04 - Aplicação if else</h1>
    <?php
       date_default_timezone_set("America/Sao_Paulo");
       $hoje = date("d/m/Y");
       $agora = date("H:i");
       $hora = date("H");
       if ($hora >= 4 and $hora < 13) {
           echo "<img src='img/sol.png' alt='Lua'>";
           echo "<p>Bom Dia!</p>";
        } elseif ($hora >= 13 and $hora < 18) {
            echo "<img src='img/sol.png' alt='Sol'>";
            echo "<p>Boa Tarde!</p>";
        } else {
            echo "<img src='img/sol.png' alt='Sol'>";
            echo "<p>Boa noite!</p>";
        } 
        echo "Hoje é dia " . $hoje . " e agora são " . $agora . " horas.";
    ?>
</body>
</html>