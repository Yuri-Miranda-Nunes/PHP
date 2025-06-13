<?php
include 'conexao.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="verifica_login.php">
        <label>Email:</label><input type="text" name="email" id="email"><br>
        <label>Senha:</label><input type="password" name="senha" id="senha"><br>
        <input type="submit" value="entrar" id="entrar" name="entrar"><br>
        <a href="cadastro.html">Cadastre-se</a>
    </form>
</body>

</html>