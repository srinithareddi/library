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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_id = $_POST['book_id'];

    $stmt = $conn->prepare("INSERT INTO borrow (user_id, book_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $_SESSION['user_id'], $book_id);

    if ($stmt->execute()) {
        $conn->query("UPDATE books SET available = 0 WHERE id = $book_id");
        echo "Book borrowed successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$result = $conn->query("SELECT * FROM books WHERE available = 1");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Borrow Book</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Borrow Book</h2>
        <form method="POST" action="">
            <label for="book_id">Select Book:</label>
            <select name="book_id" required>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?> by <?php echo $row['author']; ?></option>
                <?php endwhile; ?>
            </select>
            <button type="submit">Borrow</button>
            <a href="dashboard.php"class="button">back</a>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
