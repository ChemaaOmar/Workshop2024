<?php
include 'config.php';

try {
    // Sélectionner tous les tips actifs
    $stmt = $pdo->query("SELECT * FROM tips WHERE isactive = 1");
    $tips = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($tips);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
