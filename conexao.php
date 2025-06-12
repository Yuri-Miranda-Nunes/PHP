
<?php

$hostname = "localhost";
$bancodedados = "BANCO_PHP";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

if ($mysqli->connect_errno) {
    echo "falha ao xambrar:(" . $mysqli->connect_errno . ") " . $mysqli->connect_errno;
}
else
echo "conectado ao banco de deidos"
        
?>