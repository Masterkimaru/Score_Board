document.addEventListener('DOMContentLoaded', function() {
  // close-button handlers for admin alerts
  document.querySelectorAll('.close-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
      this.parentElement.style.display = 'none';
    });
  });

  // auto-reload for scoreboard.php every 10 seconds
  if (window.location.pathname.endsWith('scoreboard.php')) {
    setTimeout(function() {
      window.location.reload();
    }, 10_000);
  }
});