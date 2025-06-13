<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$nomeUsuario = $_SESSION['usuario_nome'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 80px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1 {
            color: #21897E;
            margin-bottom: 10px;
        }
        p {
            font-size: 1.1em;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #9BC53D;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background 0.3s;
        }
        .btn:hover {
            background: #7AAE2F;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Parabéns<?= $nomeUsuario ? ', ' . htmlspecialchars($nomeUsuario) : '' ?>!</h1>
        <p>Você conseguiu logar com sucesso.</p>
        <p>Seja bem-vindo<?= $nomeUsuario ? ', ' . htmlspecialchars($nomeUsuario) : '' ?> ao seu painel.</p>
        <a class="btn" href="login.php">Sair (Logout)</a>
    </div>
</body>
</html>
