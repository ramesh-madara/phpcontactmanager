<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ? AND user_id = ?");
if ($stmt->execute([$id, $_SESSION['user_id']])) {
    header("Location: dashboard.php");
    exit();
} else {
    $error = "Failed to delete contact.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Delete Contact</title>
</head>

<body>
    <div class="container">
        <h2>Delete Contact</h2>
        <?php if (isset($error)) {
            echo "<p>$error</p>";
        } ?>
    </div>
</body>

</html>