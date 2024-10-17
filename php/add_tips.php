<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $createddate = date('Y-m-d H:i:s');

    try {
        $stmt = $pdo->prepare("INSERT INTO tips (title, content, category, createddate, isactive) VALUES (:title, :content, :category, :createddate, 1)");
        $stmt->execute([
            ':title' => $title,
            ':content' => $content,
            ':category' => $category,
            ':createddate' => $createddate,
        ]);
        echo json_encode(['success' => 'Tip ajouté avec succès']);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Méthode non autorisée']);
}
?>
