<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);
$contact = $stmt->fetch();

if (!$contact) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("UPDATE contacts SET name = ?, phone = ?, email = ? WHERE id = ? AND user_id = ?");
    if ($stmt->execute([$name, $phone, $email, $id, $_SESSION['user_id']])) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Failed to update contact.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit Contact</title>
</head>

<body>
    <div class="container">
        <h2>Edit Contact</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Name" value="<?php echo htmlspecialchars($contact['name']); ?>" required>
            <input type="tel" name="phone" placeholder="Phone" value="<?php echo htmlspecialchars($contact['phone']); ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($contact['email']); ?>" required>
            <button type="submit">Update Contact</button>
        </form>
        <button class="btnCancel" onclick=goToList()>Cancel</button>
        <?php if (isset($error)) {
            echo "<p>$error</p>";
        } ?>
    </div>
    <script>
        function goToList() {
            window.location.href = 'dashboard.php';
        }
    </script>
</body>

</html>