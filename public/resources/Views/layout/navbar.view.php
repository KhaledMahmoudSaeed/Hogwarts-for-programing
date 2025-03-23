<nav class="navbar" style="background-color:var(--<?= strtolower($house) ?>);">
  <div class="container">
    <!-- Logo / Brand -->
    <div class="logos">
      <img src="resources/assets/img/<?php echo strtolower($house) !== 'hogwarts' ? strtolower($house) : 'auth'; ?>.png"
        alt="Magical Hogwarts">
      <a href="/" class="logo"><?= $house ?></a>
    </div>

    <!-- Navigation Links -->
    <ul class="nav-links">
      <li><a href="/">Home</a></li>
      <li><a href="about.php">About</a></li>

      <?php if ($isLoggedIn): ?>
        <!-- Visible only if user is logged in -->
        <li><a href="dashboard.php" class="active">Dashboard</a></li>
        <li><a href="courses.php">Courses</a></li>
        <li><a href="quizzes.php">Quizzes</a></li>
      <?php endif; ?>
      <li><a href="contact.php">Contact Us</a></li>
    </ul>
    <div class="buttons">
      <?php if ($isLoggedIn): ?>

        <form action="/logout" method="POST">
          <button type="submit">Logout</button>
        </form>
        </li>
      <?php else: ?>
        <!-- Visible only if user is NOT logged in -->
        <button><a href="/login">Login</a></button></li>
          <button><a href="/register">Register</a></li>
          <?php endif; ?>
    </div>
  </div>
</nav>