<?php
include 'db.php';
$stmt = $pdo->query("SELECT * FROM tasks ORDER BY created_at DESC");
$tasks = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/custom.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center text-md-start">Task List</h2>
            <a href="add.php" class="btn btn-success mb-3">Add New Task</a>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th class="d-none d-md-table-cell">Description</th>
                            <th class="d-none d-md-table-cell">Due Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tasks as $task): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($task['title']); ?></td>
                                <td class="d-none d-md-table-cell"><?php echo htmlspecialchars($task['description']); ?></td>
                                <td class="d-none d-md-table-cell"><?php echo $task['due_date']; ?></td>
                                <td><?php echo $task['status']; ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $task['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="delete.php?id=<?php echo $task['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>