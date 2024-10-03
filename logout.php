<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_destroy();
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Logout</h2>
        <p>Are you sure you want to logout?</p>
        <form method="POST" action="">
            <button type="submit">Yes, Logout</button>
            <a href="dashboard.php" class="button">No, Go Back</a>
        </form>
    </div>
</body>
</html>
