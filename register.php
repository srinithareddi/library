<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn = new mysqli('localhost', 'root', '', 'library_management');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form method="POST" action="">
            Username: <input type="text" name="username" required><br>
            Password: <input type="password" name="password" required><br>
            <button type="submit">Register</button>
            <a href="login.php" class="button">Back</a>
        </form>
    </div>
</body>
</html>
