<?php
function isActive($routes)
{
  return $_SERVER['REQUEST_URI'] === $routes ? "active" : "";
}
?>
<nav class="navbar <?php echo $newUser ? 'hidden' : ''; ?>" style="background-color:var(--<?= strtolower($house) ?>);">
  <div class="container">
    <!-- Logo / Brand -->
    <div class="logos">
      <img src="resources/assets/img/<?php echo strtolower($house) !== 'hogwarts' ? strtolower($house) : 'auth'; ?>.png"
        alt="Magical Hogwarts">
      <a href="/" class="logo"><?= $house ?></a>
    </div>

    <!-- Navigation Links -->
    <ul class="nav-links">
      <li><a href="/" class="<?= isActive('/') ?>">Home</a></li>
      <li><a href="/about" class="<?= isActive('/about') ?>">About</a></li>

      <?php if ($isLoggedIn): ?>
        <!-- Show Ollivander’s Store ONLY for newly registered users -->
        <?php if (isset($_SESSION['new_user']) && $_SESSION['new_user'] === true): ?>
          <li><a href="/ollivander" class="<?= isActive('/ollivander') ?>">Ollivander's Store</a></li>
          <?php unset($_SESSION['new_user']); ?>
        <?php endif; ?>
        <!-- Visible only if user is logged in -->
        <li><a href="/dashboard" class="<?= isActive('/dashboard') ?>">Dashboard</a></li>
        <li><a href="/courses" classclass="<?= isActive('/courses') ?>">Courses</a></li>
        <li><a href="/quizzes" class="<?= isActive('/quizzes') ?>">Quizzes</a></li>
      <?php endif; ?>
      <li><a href="/contact" class="class="<?= isActive('/contact') ?>"">Contact Us</a></li>
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