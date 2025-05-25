<?php
require 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $judge_id       = (int)$_POST['judge_id'];
  $participant_id = (int)$_POST['participant_id'];
  $points         = (int)$_POST['points'];

  if ($points < 1 || $points > 100) {
    $message = 'Points must be 1–100.';
  } else {
    $ins = $pdo->prepare(
      'INSERT INTO scores (judge_id, participant_id, points) VALUES (?,?,?)'
    );
    $ins->execute([$judge_id, $participant_id, $points]);
    $message = 'Score submitted.';
  }
}

$judges       = $pdo->query('SELECT * FROM judges')->fetchAll();
$participants = $pdo->query('SELECT * FROM participants')->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
  <title>Judge Portal</title>
</head>
<body>
  <h1>Judge Portal</h1>

  <?php if ($message): ?>
    <p class="message"><?= htmlspecialchars($message) ?></p>
  <?php endif; ?>

  <form method="post">
    <label>Judge:
      <select name="judge_id">
        <?php foreach($judges as $j): ?>
          <option value="<?= $j['id'] ?>"><?= htmlspecialchars($j['display_name']) ?></option>
        <?php endforeach; ?>
      </select>
    </label>
    <label>Participant:
      <select name="participant_id">
        <?php foreach($participants as $p): ?>
          <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?></option>
        <?php endforeach; ?>
      </select>
    </label>
    <label>Points (1–100):
      <input type="number" name="points" min="1" max="100" required>
    </label>
    <button type="submit">Submit Score</button>
  </form>

  <div class="nav-links">
    <a href="admin.php">Admin Panel</a>
    <a href="judge.php">Judge Portal</a>
    <a href="scoreboard.php">View Scoreboard</a>
  </div>

  <script src="index.js"></script>
</body>
</html>