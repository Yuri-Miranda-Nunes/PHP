<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        color: #333;
    }
    img {
        width: 100px;
        height: 100px;
        margin-top: 20px;
    }
</style>
<body>
    <?php
       date_default_timezone_set("America/Sao_Paulo");
       $hoje = date("d/m/Y");
       $agora = date("H:i");
       $hora = date("H");
       if ($hora < 6 or $hora >= 18) {
           echo "<img src='img/lua.png'>";
        } else {
            echo "<img src='img/sol.png'>";
        } 
        echo "Hoje é dia " . $hoje . " e agora são " . $agora . "horas.";
    ?>
</body>
</html>