<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    try {
        $stmt = $pdo->prepare("UPDATE tips SET title = :title, content = :content, category = :category WHERE id = :id");
        $stmt->execute([
            ':title' => $title,
            ':content' => $content,
            ':category' => $category,
            ':id' => $id,
        ]);
        echo json_encode(['success' => 'Tip mis à jour avec succès']);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Méthode non autorisée']);
}
?>
