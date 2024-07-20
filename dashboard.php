<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM contacts WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$contacts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>

<body>
    <div class="container">
        <h2>Contact Manager</h2>
        <a href="add_contact.php">Add Contact</a> | <a href="logout.php">Logout</a>
        <ul class="contact-list">
            <?php foreach ($contacts as $contact) : ?>
                <li class="contact-item">
                    <p><?php echo htmlspecialchars($contact['name']); ?></p>
                    <p><?php echo htmlspecialchars($contact['phone']); ?></p>
                    <p><?php echo htmlspecialchars($contact['email']); ?></p>
                    <div class="actions">
                        <a href="edit_contact.php?id=<?php echo $contact['id']; ?>">Edit</a>
                        <a href="delete_contact.php?id=<?php echo $contact['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>

</html>