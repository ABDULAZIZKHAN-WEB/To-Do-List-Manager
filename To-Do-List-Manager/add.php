<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $stmt = $pdo->prepare("INSERT INTO tasks (title, description, due_date) VALUES (?, ?, ?)");
    $stmt->execute([$title, $description, $due_date]);
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Task</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2">
            <h2>Add Task</h2>
            <form method="POST" class="m-3 m-md-4">
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label>Due Date</label>
                <input type="date" name="due_date" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Add Task</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>