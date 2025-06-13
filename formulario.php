<?php
include 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Sistema</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-30px) rotate(120deg); }
            66% { transform: translateY(-60px) rotate(240deg); }
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 100%;
            max-width: 450px;
            position: relative;
            z-index: 10;
            transform: translateY(0);
            transition: all 0.3s ease;
        }

        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 35px 70px rgba(0, 0, 0, 0.25);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            color: #2c3e50;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
        }

        .header h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 2px;
        }

        .header p {
            color: #7f8c8d;
            font-size: 1rem;
            margin-top: 15px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-wrapper {
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 15px 20px 15px 50px;
            border: 2px solid #e8ecf4;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fff;
            color: #2c3e50;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .form-group .icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #bdc3c7;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .form-group input:focus + .icon {
            color: #667eea;
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }

        .btn-submit:active {
            transform: translateY(-1px);
        }

        .btn-submit.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .btn-submit.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            margin: auto;
            border: 2px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 1s ease infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @media (max-width: 768px) {
            .container {
                padding: 30px 25px;
                margin: 10px;
            }

            .header h2 {
                font-size: 1.8rem;
            }

            .form-group input {
                padding: 12px 15px 12px 45px;
            }

            .btn-submit {
                padding: 14px;
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 25px 20px;
            }

            .header h2 {
                font-size: 1.6rem;
            }

            .form-group input {
                padding: 10px 12px 10px 40px;
            }

            .form-group .icon {
                left: 15px;
            }
        }

        .container {
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group input.valid {
            border-color: #27ae60;
        }

        .form-group input.invalid {
            border-color: #e74c3c;
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.8rem;
            margin-top: 5px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .error-message.show {
            opacity: 1;
        }
    </style>
</head>
<body>
    <div class="particles" id="particles"></div>

    <div class="container">
        <div class="header">
            <h2>Criar Conta</h2>
            <p>Preencha os dados para se cadastrar</p>
        </div>

        <form action="cadastrar.php" method="POST" id="signupForm">
            <div class="form-group">
                <label for="nome_usuario">Nome Completo</label>
                <div class="input-wrapper">
                    <input type="text" id="nome_usuario" name="nome_usuario" required>
                    <i class="fas fa-user icon"></i>
                </div>
                <div class="error-message" id="nome-error"></div>
            </div>

            <div class="form-group">
                <label for="contato_usuario">Contato</label>
                <div class="input-wrapper">
                    <input type="text" id="contato_usuario" name="contato_usuario" required>
                    <i class="fas fa-phone icon"></i>
                </div>
                <div class="error-message" id="contato-error"></div>
            </div>

            <div class="form-group">
                <label for="email_usuario">E-mail</label>
                <div class="input-wrapper">
                    <input type="email" id="email_usuario" name="email_usuario" required>
                    <i class="fas fa-envelope icon"></i>
                </div>
                <div class="error-message" id="email-error"></div>
            </div>

            <div class="form-group">
                <label for="senha_usuario">Senha</label>
                <div class="input-wrapper">
                    <input type="password" id="senha_usuario" name="senha_usuario" required>
                    <i class="fas fa-lock icon"></i>
                </div>
                <div class="error-message" id="senha-error"></div>
            </div>

            <button type="submit" class="btn-submit" id="submitBtn">
                Cadastrar
            </button>
        </form>
    </div>

    <script>
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = window.innerWidth < 768 ? 15 : 25;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                const size = Math.random() * 4 + 2;
                const x = Math.random() * window.innerWidth;
                const y = Math.random() * window.innerHeight;
                const delay = Math.random() * 6;
                
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                particle.style.left = x + 'px';
                particle.style.top = y + 'px';
                particle.style.animationDelay = delay + 's';
                
                particlesContainer.appendChild(particle);
            }
        }

        function validateForm() {
            const nome = document.getElementById('nome_usuario');
            const contato = document.getElementById('contato_usuario');
            const email = document.getElementById('email_usuario');
            const senha = document.getElementById('senha_usuario');

            let isValid = true;

            if (nome.value.trim().length < 2) {
                showError('nome-error', 'Nome deve ter pelo menos 2 caracteres');
                nome.classList.add('invalid');
                isValid = false;
            } else {
                hideError('nome-error');
                nome.classList.remove('invalid');
                nome.classList.add('valid');
            }

            const phoneRegex = /^[\d\s\-\(\)\+]{10,}$/;
            if (!phoneRegex.test(contato.value.trim())) {
                showError('contato-error', 'Formato de contato inválido');
                contato.classList.add('invalid');
                isValid = false;
            } else {
                hideError('contato-error');
                contato.classList.remove('invalid');
                contato.classList.add('valid');
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value.trim())) {
                showError('email-error', 'E-mail inválido');
                email.classList.add('invalid');
                isValid = false;
            } else {
                hideError('email-error');
                email.classList.remove('invalid');
                email.classList.add('valid');
            }

            if (senha.value.length < 6) {
                showError('senha-error', 'Senha deve ter pelo menos 6 caracteres');
                senha.classList.add('invalid');
                isValid = false;
            } else {
                hideError('senha-error');
                senha.classList.remove('invalid');
                senha.classList.add('valid');
            }

            return isValid;
        }

        function showError(elementId, message) {
            const errorElement = document.getElementById(elementId);
            errorElement.textContent = message;
            errorElement.classList.add('show');
        }

        function hideError(elementId) {
            const errorElement = document.getElementById(elementId);
            errorElement.classList.remove('show');
        }

        document.getElementById('signupForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (validateForm()) {
                const submitBtn = document.getElementById('submitBtn');
                submitBtn.classList.add('loading');
                submitBtn.textContent = 'Cadastrando...';
                
                setTimeout(() => {
                    this.submit();
                }, 1000);
            }
        });

        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('blur', validateForm);
            input.addEventListener('input', function() {
                if (this.classList.contains('invalid') || this.classList.contains('valid')) {
                    validateForm();
                }
            });
        });

        document.getElementById('contato_usuario').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 11) {
                value = value.replace(/^(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            } else if (value.length >= 7) {
                value = value.replace(/^(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
            } else if (value.length >= 3) {
                value = value.replace(/^(\d{2})(\d{0,5})/, '($1) $2');
            }
            e.target.value = value;
        });

        window.addEventListener('load', createParticles);

        window.addEventListener('resize', () => {
            document.getElementById('particles').innerHTML = '';
            createParticles();
        });

        document.documentElement.style.scrollBehavior = 'smooth';
    </script>
</body>
</html>