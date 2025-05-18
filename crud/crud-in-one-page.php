<?php
$conn = new mysqli("localhost", "root", "", "gnsl");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ADD MANUFACTURER
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact_no = $_POST['contact_no'];
    $conn->query("INSERT INTO manufacturer (Name, Address, Contact_no) VALUES ('$name', '$address', '$contact_no')");
}

// FETCH SINGLE MANUFACTURER FOR EDITING
$edit_product = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM manufacturer WHERE Id=$id");
    $edit_product = $result->fetch_assoc();
}

//update MANUFACTURER
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact_no = $_POST['contact_no'];
    $conn->query("UPDATE manufacturer SET Name='$name', Address='$address', Contact_no='$contact_no' WHERE Id=$id");
}
//DELETE MANUFACTURER
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM manufacturer WHERE Id=$id");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1, h2 {
            color:rgb(230, 43, 205);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color:rgb(199, 30, 30);

        }
        tr:hover {
            background-color:rgb(121, 59, 59);
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="text"]:focus {
            border-color: #4CAF50;
        }
        button[type="button"] {
            background-color:rgb(168, 61, 251);
            margin-left: 10px;
        }
        button[type="button"]:hover {
            background-color:rgb(31, 232, 165);
        }
        fieldset {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
        }
        legend {
            font-weight: bold;
            padding: 0 10px;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>
    <h1><?php echo $edit_product ? 'Edit' : 'Add'; ?> Manufacturer</h1>
    <form method="POST">
        <?php if ($edit_product): ?>
            <input type="hidden" name="id" value="<?php echo $edit_product['Id']; ?>">
        <?php endif; ?>
        
        Name: <input type="text" name="name" value="<?php echo $edit_product['Name'] ?? ''; ?>" required><br>
        Address: <input type="text" name="address" value="<?php echo $edit_product['Address'] ?? ''; ?>" required><br>
        Contact_no: <input type="text" name="contact_no" value="<?php echo $edit_product['Contact_no'] ?? ''; ?>" required><br>
        <button type="submit" name="<?php echo $edit_product ? 'update' : 'add'; ?>">
            <?php echo $edit_product ? 'Update' : 'Add'; ?>
        </button>
        <!-- clear button -->
        <button type="button" onclick="window.location.href = 'mid-exam.php'">Clear</button>
   
   
<h2>Manufacturer List</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th><th>Name</th><th>Address</th><th>Contact_no</th><th>Actions</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM manufacturer");
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?php echo $row['Id']; ?></td>
            <td><?php echo htmlspecialchars($row['Name']); ?></td>
            <td><?php echo htmlspecialchars($row['Address']); ?></td>
            <td><?php echo htmlspecialchars($row['Contact_no']); ?></td>
            <td>
                <a href="?edit=<?php echo $row['Id']; ?>">Edit</a> |
                <a href="?delete=<?php echo $row['Id']; ?>" onclick="return confirm('Delete this product?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>