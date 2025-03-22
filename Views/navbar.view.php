<nav class="navbar" style="background-color:var(--<?= strtolower($house) ?>);">
  <div class="container">
    <!-- Logo / Brand -->
     <div class="logos">
        <img src="assets/img/<?php echo strtolower($house)!== 'hogwarts'?strtolower($house):'auth';  ?>.png" alt="Magical Hogwarts">
         <a href="index.php" class="logo"><?= $house ?></a>
     </div>
    
    <!-- Navigation Links -->
    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
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
            <button><a href="logout.php">Logout</a></li>
          <?php else: ?>
            <!-- Visible only if user is NOT logged in -->
            <button><a href="login.php">Login</a></li>
            <button><a href="register.php">Register</a></li>
          <?php endif; ?>
    </div>
  </div>
</nav>
