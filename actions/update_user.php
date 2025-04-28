<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    die('Acceso denegado');
}

require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);

    try {
        $stmt = $pdo->prepare("UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?");
        $stmt->execute([$nombre, $email, $id]);
        echo json_encode(['success' => true]);
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
?>