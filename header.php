<header>
  <a href="index.php"><h2>The Diary</h2></a>
  
  <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']): ?>
    <h4>Logged in as <?php echo htmlspecialchars($_SESSION['user']['username']) . "  " . '<a href="logout.php">Logout</a>'; ?></h4>
  <?php endif; ?>
  <br />
  
</header>