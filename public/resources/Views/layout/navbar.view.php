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

      <img src="<?= $GLOBALS['img']->image(strtolower($house) !== 'hogwarts' ? strtolower($house) : 'auth') ?>.png"
        alt="Magical Hogwarts">

      <a href="/home" class="logo"><?= $house ?></a>
    </div>

    <!-- Navigation Links -->
    <ul class="nav-links">
      <li><a href="/home" class="<?= isActive('/home') . isActive('/') ?>">Home</a></li>
      <li><a href="/about" class="<?= isActive('/about') ?>">About</a></li>

      <?php if ($isLoggedIn): ?>
        <!-- Show Ollivander's Store ONLY for newly registered users -->
        <?php if (isset($_SESSION['new_user']) && $_SESSION['new_user'] === true): ?>
          <li><a href="/ollivander" class="<?= isActive('/ollivander') ?>">Ollivander's Store</a></li>
        <?php endif; ?>
        <!-- Visible only if user is logged in -->
        <li><a href="/dashboard" class="<?= isActive('/dashboard') ?>">Dashboard</a></li>
        <li><a href="/enrolls" classclass="<?= isActive('/courses') ?>">Courses</a></li>
        <li><a href="/leaderboard" class="<?= isActive('/leaderboard') ?>">Leaderboard</a></li>
        <li><a href="/items" class="<?= isActive('/items') ?>">Items</a></li>
      <?php endif; ?>
      <li><a href="/contact" class="class=" <?= isActive('/contact') ?>>Contact Us</a></li>
    </ul>
    <div class="buttons">
      <?php if ($isLoggedIn): ?>
        <div class="profile-logout-container">
          <a href="/profile">
            <img src="<?= $GLOBALS['img']->image($_SESSION['img'], 'users') ?>" alt="Profile" class="profile-circle">
          </a>
          <form action="/logout" method="POST">
            <button type="submit">Logout</button>
          </form>
        </div>
      <?php else: ?>
        <!-- Visible only if user is NOT logged in -->
        <button><a href="/login">Login</a></button></li>
        <button><a href="/register">Register</a></li>
        <?php endif; ?>
    </div>
  </div>
</nav>