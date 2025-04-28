<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

require_once 'config/database.php';

// Obtener lista de usuarios
$stmt = $pdo->query("SELECT * FROM usuarios ORDER BY id DESC");
$usuarios = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Usuarios</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">Sistema de Usuarios</div>
        <a href="logout.php" class="logout-btn">Cerrar Sesión</a>
    </nav>

    <!-- Contenido principal -->
    <div class="container">
        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2>Gestión de Usuarios</h2>
                <button class="btn btn-primary" onclick="openModal('createModal')">Nuevo Usuario</button>
            </div>

            <!-- Tabla de usuarios -->
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                        <td>
                            <button class="btn btn-secondary edit-user" 
                                    data-id="<?php echo $usuario['id']; ?>"
                                    data-nombre="<?php echo htmlspecialchars($usuario['nombre']); ?>"
                                    data-email="<?php echo htmlspecialchars($usuario['email']); ?>">
                                Editar
                            </button>
                            <button class="btn btn-danger delete-user" 
                                    data-id="<?php echo $usuario['id']; ?>">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Crear Usuario -->
    <div id="createModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Crear Nuevo Usuario</h3>
            <form id="createUserForm">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>

    <!-- Modal Editar Usuario -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Editar Usuario</h3>
            <form id="editUserForm">
                <input type="hidden" id="editId" name="id">
                <div class="form-group">
                    <label for="editNombre">Nombre:</label>
                    <input type="text" id="editNombre" name="nombre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="editEmail">Email:</label>
                    <input type="email" id="editEmail" name="email" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
</body>
</html>