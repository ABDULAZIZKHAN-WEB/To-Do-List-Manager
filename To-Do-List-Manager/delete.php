<?php
include 'db.php';

// Check if task ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$task_id = $_GET['id'];

// Delete task
$stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
$stmt->execute([$task_id]);

header("Location: index.php");
exit;
?>