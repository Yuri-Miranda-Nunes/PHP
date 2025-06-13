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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Bem-vindo</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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

        /* Efeito de partículas flutuantes */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 1px, transparent 1px),
                radial-gradient(circle at 40% 20%, rgba(255, 255, 255, 0.1) 1px, transparent 1px),
                radial-gradient(circle at 60% 80%, rgba(255, 255, 255, 0.1) 1px, transparent 1px),
                radial-gradient(circle at 80% 40%, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 100px 100px, 150px 150px, 120px 120px, 180px 180px;
            animation: float 20s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .dashboard-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.1),
                0 0 60px rgba(255, 255, 255, 0.1) inset;
            text-align: center;
            max-width: 500px;
            width: 100%;
            position: relative;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #4CAF50, #45a049);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            animation: pulse 2s ease-in-out infinite;
            box-shadow: 0 10px 30px rgba(76, 175, 80, 0.3);
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .success-icon i {
            color: white;
            font-size: 36px;
            animation: checkmark 0.6s ease-in-out 0.3s both;
        }

        @keyframes checkmark {
            from {
                opacity: 0;
                transform: scale(0.3);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .title {
            font-size: 2.2em;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 15px;
            animation: fadeIn 0.8s ease-out 0.2s both;
        }

        .subtitle {
            font-size: 1.3em;
            color: #666;
            margin-bottom: 10px;
            animation: fadeIn 0.8s ease-out 0.4s both;
        }

        .welcome-message {
            font-size: 1.1em;
            color: #777;
            margin-bottom: 35px;
            line-height: 1.6;
            animation: fadeIn 0.8s ease-out 0.6s both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .user-badge {
            display: inline-block;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 8px 16px;
            border-radius: 25px;
            font-weight: 600;
            margin: 10px 0 20px;
            font-size: 0.95em;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            animation: fadeIn 0.8s ease-out 0.5s both;
        }

        .logout-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 30px;
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1em;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(255, 107, 107, 0.3);
            animation: fadeIn 0.8s ease-out 0.8s both;
            position: relative;
            overflow: hidden;
        }

        .logout-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .logout-btn:hover::before {
            left: 100%;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(255, 107, 107, 0.4);
        }

        .logout-btn:active {
            transform: translateY(0);
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 15px;
            margin: 25px 0;
            animation: fadeIn 0.8s ease-out 0.7s both;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            border: 1px solid rgba(102, 126, 234, 0.2);
            border-radius: 15px;
            padding: 20px 15px;
            text-align: center;
        }

        .stat-icon {
            font-size: 24px;
            color: #667eea;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 0.85em;
            color: #666;
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 1.1em;
            font-weight: 700;
            color: #333;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .dashboard-container {
                margin: 20px;
                padding: 30px 25px;
                border-radius: 15px;
            }

            .title {
                font-size: 1.8em;
            }

            .subtitle {
                font-size: 1.1em;
            }

            .welcome-message {
                font-size: 1em;
            }

            .success-icon {
                width: 60px;
                height: 60px;
                margin-bottom: 20px;
            }

            .success-icon i {
                font-size: 28px;
            }

            .stats-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .stat-card {
                padding: 15px 10px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 15px;
            }

            .dashboard-container {
                padding: 25px 20px;
            }

            .title {
                font-size: 1.6em;
            }

            .logout-btn {
                padding: 10px 25px;
                font-size: 0.95em;
            }

            .stats-container {
                grid-template-columns: 1fr;
            }
        }

        /* Animação de entrada suave */
        .fade-in {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        
        <h1 class="title">Parabéns!</h1>
        <p class="subtitle">Login realizado com sucesso</p>
        
        <?php if ($nomeUsuario): ?>
            <div class="user-badge">
                <i class="fas fa-user"></i> <?= htmlspecialchars($nomeUsuario) ?>
            </div>
        <?php endif; ?>
        
        <p class="welcome-message">
            Seja bem-vindo<?= $nomeUsuario ? ', <strong>' . htmlspecialchars($nomeUsuario) . '</strong>' : '' ?> ao seu painel administrativo. 
            Você agora tem acesso completo ao sistema.
        </p>

        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div class="stat-label">Segurança</div>
                <div class="stat-value">Ativa</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-label">Sessão</div>
                <div class="stat-value">Ativa</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stat-label">Status</div>
                <div class="stat-value">Online</div>
            </div>
        </div>
        
        <a class="logout-btn" href="login.php">
            <i class="fas fa-sign-out-alt"></i>
            Sair do Sistema
        </a>
    </div>

    <script>
        // Adiciona efeito de entrada aos elementos
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.stat-card');
            elements.forEach((el, index) => {
                el.style.animationDelay = `${0.9 + (index * 0.1)}s`;
                el.classList.add('fade-in');
            });
        });

        // Efeito de partículas no clique
        document.addEventListener('click', function(e) {
            createRipple(e.pageX, e.pageY);
        });

        function createRipple(x, y) {
            const ripple = document.createElement('div');
            ripple.style.cssText = `
                position: absolute;
                width: 20px;
                height: 20px;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(255,255,255,0.6) 0%, rgba(255,255,255,0) 70%);
                pointer-events: none;
                left: ${x - 10}px;
                top: ${y - 10}px;
                z-index: 1000;
                animation: rippleEffect 0.6s ease-out forwards;
            `;
            
            document.body.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        }

        // CSS para animação do ripple
        const style = document.createElement('style');
        style.textContent = `
            @keyframes rippleEffect {
                from {
                    transform: scale(0);
                    opacity: 1;
                }
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>