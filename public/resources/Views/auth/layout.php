<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Hogwarts</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="resources/assets/CSS/auth.css" />
</head>

<body>
  <div class="auth-container">
    <!-- Register Slider Panel -->
    <?php require('register.view.php') ?>

    <!-- Login Slider Panel -->
    <?php require('login.view.php') ?>
  </div>

  <script>
    const loginPanel = document.getElementById('loginPanel');
    const registerPanel = document.getElementById('registerPanel');

    loginPanel.style.transform = 'translateX(0)';
    registerPanel.style.transform = 'translateX(100%)';

    document.getElementById('toRegister').addEventListener('click', function (e) {
      e.preventDefault();
      loginPanel.style.transform = 'translateX(-100%)';
      registerPanel.style.transform = 'translateX(0)';
    });

    document.getElementById('toLogin').addEventListener('click', function (e) {
      e.preventDefault();
      loginPanel.style.transform = 'translateX(0)';
      registerPanel.style.transform = 'translateX(100%)';
    });
  </script>
</body>

</html>