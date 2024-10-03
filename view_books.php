<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'library_management');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM books");

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Books</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>View Books</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Available</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['author']; ?></td>
                    <td><?php echo $row['available'] ? 'Yes' : 'No'; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <a href="dashboard.php"class="button">back</a>
</body>
</html>

<?php
$conn->close();
?>
