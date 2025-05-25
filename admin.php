<?php
require 'config.php';

$message = '';
$error = '';
$username = '';
$display_name = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $display_name = trim($_POST['display_name']);

    if (empty($username) || empty($display_name)) {
        $error = "All fields are required.";
    } elseif (!preg_match('/^[a-zA-Z0-9_\-]+$/', $username)) {
        $error = "Username can only contain letters, numbers, underscores and hyphens.";
    } elseif (strlen($username) > 30 || strlen($display_name) > 50) {
        $error = "Username must be ≤30 chars and Display Name ≤50 chars.";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT id FROM judges WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->fetch()) {
                $error = "Username already exists. Please choose a different one.";
            } else {
                $stmt = $pdo->prepare("INSERT INTO judges (username, display_name) VALUES (?, ?)");
                $stmt->execute([$username, $display_name]);
                $message = "Judge added successfully!";
                $username = '';
                $display_name = '';
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}

$judges = $pdo->query('SELECT * FROM judges ORDER BY id DESC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel - Judge Management</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <h1>Admin: Manage Judges</h1>

    <?php if ($message): ?>
      <div class="alert success">
        <?= htmlspecialchars($message) ?>
        <span class="close-btn">&times;</span>
      </div>
    <?php endif; ?>

    <?php if ($error): ?>
      <div class="alert error">
        <?= htmlspecialchars($error) ?>
        <span class="close-btn">&times;</span>
      </div>
    <?php endif; ?>

    <div class="card">
      <h2>Add New Judge</h2>
      <form method="post">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username"
                 value="<?= htmlspecialchars($username) ?>"
                 required maxlength="30"
                 pattern="[a-zA-Z0-9_\-]+"
                 title="Letters, numbers, underscores and hyphens only">
        </div>

        <div class="form-group">
          <label for="display_name">Display Name:</label>
          <input type="text" id="display_name" name="display_name"
                 value="<?= htmlspecialchars($display_name) ?>"
                 required maxlength="50">
        </div>

        <button type="submit" class="btn-primary">Add Judge</button>
      </form>
    </div>

    <div class="card">
      <h2>Existing Judges</h2>
      <?php if (empty($judges)): ?>
        <p>No judges have been added yet.</p>
      <?php else: ?>
        <div class="table-responsive">
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Display Name</th>
                <th>Username</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($judges as $judge): ?>
                <tr>
                  <td><?= htmlspecialchars($judge['id']) ?></td>
                  <td><?= htmlspecialchars($judge['display_name']) ?></td>
                  <td><?= htmlspecialchars($judge['username']) ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>

    <div class="nav-links">
      <a href="admin.php" class="active">Admin Panel</a>
      <a href="judge.php">Judge Portal</a>
      <a href="scoreboard.php">View Scoreboard</a>
    </div>
  </div>

  <script src="index.js"></script>
</body>
</html>