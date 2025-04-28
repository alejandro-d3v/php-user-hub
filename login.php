<?php
session_start();

if (isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}

require_once 'config/database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id FROM admins WHERE username = ? AND password = SHA2(?, 256)");
    $stmt->execute([$username, $password]);
    
    if ($user = $stmt->fetch()) {
        $_SESSION['admin_id'] = $user['id'];
        header('Location: index.php');
        exit();
    } else {
        $error = 'Usuario o contraseña incorrectos';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Usuarios</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="login-container">
        <div class="card">
            <h2 class="login-title">Iniciar Sesión</h2>
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label for="username">Usuario:</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Iniciar Sesión</button>
            </form>
        </div>
    </div>
</body>
</html>