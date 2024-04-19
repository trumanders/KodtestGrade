<header>
  <h2>The diary</h2>  
  <?php if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"]): ?>
    <h4>Logged in as <?php echo htmlspecialchars($_SESSION["username"]) . "  " . '<a href="logout.php">Logout</a>'; ?></h4>
    
  <?php endif; ?>
  <br />
</header>