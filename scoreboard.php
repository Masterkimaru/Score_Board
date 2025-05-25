<?php
require 'config.php';

$stmt = $pdo->query(
  'SELECT p.name,
          SUM(s.points) AS total_points
   FROM participants p
   LEFT JOIN scores s ON p.id = s.participant_id
   GROUP BY p.id
   ORDER BY total_points DESC'
);
$scores = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
  <title>Scoreboard</title>
</head>
<body>
  <h1>Public Scoreboard</h1>
  <table>
    <tr><th>Participant</th><th>Total Points</th></tr>
    <?php foreach($scores as $row): ?>
      <tr class="highlight-<?=($row['total_points']>=200?'top':($row['total_points']>=100?'mid':'low'))?>">
        <td><?=htmlspecialchars($row['name'])?></td>
        <td><?=$row['total_points']?:0?></td>
      </tr>
    <?php endforeach; ?>
  </table>
  <p>Auto-reloads every 10 seconds.</p>
  <div class="nav-links">
    <a href="admin.php">Admin Panel</a>
    <a href="judge.php">Judge Portal</a>
    <a href="scoreboard.php">View Scoreboard</a>
  </div>

  <script src="index.js"></script>
</body>
</html>