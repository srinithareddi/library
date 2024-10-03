<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];

    $conn = new mysqli('localhost', 'root', '', 'library_management');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO books (title, author) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $author);

    if ($stmt->execute()) {
        echo "Book added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Add Book</h2>
        <form method="POST" action="">
            Title: <input type="text" name="title" required><br>
            Author: <input type="text" name="author" required><br>
            <button type="submit">Add Book</button>
            <a href="dashboard.php"class="button">back</a>
        </form>
    </div>
</body>
</html>
