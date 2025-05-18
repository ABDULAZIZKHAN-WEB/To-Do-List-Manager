<?php
include 'db.php';

// Check if task ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$task_id = $_GET['id'];

// Fetch task data
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ?");
$stmt->execute([$task_id]);
$task = $stmt->fetch();

if (!$task) {
    header("Location: index.php");
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];

    $status = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE tasks SET title = ?, description = ?, due_date = ?, status = ? WHERE id = ?");
    $stmt->execute([$title, $description, $due_date, $status, $task_id]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2">
            <h2>Add Task</h2>
            <form method="POST">
            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($task['title']); ?>" required>
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control"><?php echo htmlspecialchars($task['description']); ?></textarea>
            </div>
            <div class="mb-3">
                <label>Due Date</label>
                <input type="date" name="due_date" class="form-control" value="<?php echo $task['due_date']; ?>">
            </div>
            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="pending" <?php echo $task['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="completed" <?php echo $task['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Task</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    </div>
</body>
</html>