<?php
function isActive($routes)
{
  return $_SERVER['REQUEST_URI'] === $routes ? "active" : "";
}
?>
<style>
  .inline-form {
    display: inline;
  }

  .inline-form button {
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    font: inherit;
    padding: 0;
    margin: 0;
    text-decoration: none;
  }
</style>
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
        <?php if (strtolower($data['role']) == "professor"): ?>
          <li><a href="/dashboard" class="<?= isActive('/dashboard') ?>">Dashboard</a></li>
        <?php else: ?>
          <li><a href="/enrolls" classclass="<?= isActive('/courses') ?>">Courses</a></li>
        <?php endif; ?>
        <li><a href="/leaderboard" class="<?= isActive('/leaderboard') ?>">Leaderboard</a></li>
        <li>
          <form action="/owl" method="POST" class="inline-form">
            <input type="hidden" name="user_id" value="<?= $data['id'] ?>">
            <button type="submit" class="<?= isActive('/owl') ?>">Owl Post</button>
          </form>
        </li> <?php endif; ?>
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