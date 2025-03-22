<div class="slider-panel login-panel" id="loginPanel">
    <div class="form-container">
        <h1>Login</h1>
        <?php
        $error = $_SESSION['error'] ?? '';
        $old = $_SESSION['old_post'] ?? [];
        ?>
        <form action="login.php" method="post">
            <input type="email" name="email" placeholder="Enter Email" value="<?php echo $old['email'] ?? '' ?>" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <div class="error">
                <p><?php echo ($error) ? $error : ""; ?></p>
            </div>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="#" id="toRegister">Register here</a>.</p>
    </div>
    <div class="image-container">
        <img src="assets/img/auth.png" alt="Magical Hogwarts">
        <div class="text-overlay">
            <h2>Welcome Back!</h2>
            <p>Enter your credentials and rejoin the magic.</p>
        </div>
    </div>
</div>