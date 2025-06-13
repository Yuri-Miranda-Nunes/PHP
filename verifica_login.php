<?php
session_start();
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['entrar'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = $_POST['senha'] ?? '';

    if (!$email) {
        $erro = "E-mail inválido.";
    } elseif (empty($senha)) {
        $erro = "Informe a senha.";
    } else {
        $stmt = $mysqli->prepare("
            SELECT id_usuario, nome_usuario, senha_usuario 
            FROM cadastro 
            WHERE email_usuario = ?
        ");
        if (!$stmt) {
            error_log("Erro na prepare(): " . $mysqli->error);
            $erro = "Erro interno. Tente novamente mais tarde.";
        } else {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result && $result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $hash = $row['senha_usuario'];

                if (password_verify($senha, $hash)) {
                    $_SESSION['usuario_id'] = $row['id_usuario'];
                    $_SESSION['usuario_nome'] = $row['nome_usuario'];
                    $_SESSION['usuario_email'] = $email;
                    header("Location: dashboard.php");
                    exit;
                } else {
                    $erro = "Credenciais incorretas.";
                }
            } else {
                $erro = "Credenciais incorretas.";
            }
            $stmt->close();
        }
    }
} else {
    $erro = "Requisição inválida.";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
      .erro { color: red; }
    </style>
</head>
<body>
    <?php if (!empty($erro)): ?>
        <p class="erro"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>
    <p><a href="login.php">Voltar ao formulário de login</a></p>
</body>
</html>
