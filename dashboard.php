<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Dashboard</h2>
        <a href="add_book.php" class="button">Add Book</a>
        <a href="view_books.php" class="button">View Books</a>
        <a href="borrow_book.php" class="button">Borrow Book</a>
        
        <a href="logout.php" class="button">Logout</a>
    </div>
</body>
</html>
