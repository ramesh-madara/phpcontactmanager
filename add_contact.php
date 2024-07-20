<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("INSERT INTO contacts (user_id, name, phone, email) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$_SESSION['user_id'], $name, $phone, $email])) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Failed to add contact.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Add Contact</title>
</head>

<body>
    <div class="container">
        <h2>Add Contact</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Name" required>
            <input type="tel" name="phone" placeholder="Phone" required>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit">Add Contact</button>
        </form>
        <?php if (isset($error)) {
            echo "<p>$error</p>";
        } ?>
    </div>
</body>

</html>