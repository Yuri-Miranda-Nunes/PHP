<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_usuario = $_POST['nome_usuario'];
    $contato_usuario = $_POST['contato_usuario'];
    $email_usuario = $_POST['email_usuario'];
    $senha_usuario = $_POST['senha_usuario'];

    // Verify if connection was successful
    if (!$mysqli) {
        die("<script>alert('Erro na conexão com o banco de dados!'); window.location.href = 'formulario.php';</script>");
    }

    $senha_hash = password_hash($senha_usuario, PASSWORD_DEFAULT);

    $sql = "INSERT INTO cadastro (nome_usuario, contato_usuario, email_usuario, senha_usuario) 
            VALUES (?, ?, ?, ?)";

    // Prepare the statement
    if ($stmt = $mysqli->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("ssss", $nome_usuario, $contato_usuario, $email_usuario, $senha_hash);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href = 'formulario.php';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar: " . $stmt->error . "'); window.location.href = 'formulario.php';</script>";
        }

        // Close statement
        $stmt->close();
    } else {
        echo "<script>alert('Erro na preparação da consulta: " . $mysqli->error . "'); window.location.href = 'formulario.php';</script>";
    }
    
    // Close connection
    $mysqli->close();
} else {
    header("Location: formulario.php");
    exit();
}
