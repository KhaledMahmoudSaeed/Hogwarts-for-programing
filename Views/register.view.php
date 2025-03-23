<div class="slider-panel register-panel" id="registerPanel">
    <div class="form-container">
        <h1>Register</h1>
        <?php
        $errors = $_SESSION['errors'] ?? [];
        $old = $_SESSION['old'] ?? [];
        unset($_SESSION['errors'], $_SESSION['old']);
        ?>
        <form action="register.php" method="post">
            <input type="text" name="name" placeholder="Enter Name" value="<?= htmlspecialchars($old['name'] ?? '') ?>">
            <div class="error">
                <?php if (isset($errors['name'])): ?>
                    <p><?= $errors['name'] ?></p>
                <?php endif; ?>
            </div>

            <input type="email" name="email" placeholder="Enter Email"
                value="<?php echo $old['email'] ?? '' ?>">
            <div class="error">
                <?php if (isset($errors['email'])): ?>
                    <p><?= $errors['email'] ?></p>
                <?php endif; ?>
            </div>

            <input type="password" name="password" placeholder="Enter Password" required>
            <div class="error">
                <?php if (isset($errors['password'])): ?>
                    <p><?= $errors['password'] ?></p>
                <?php endif; ?>
            </div>

            <input type="password" name="confirm-password" placeholder="Confirm Password" required>
            <div class="error">
                <?php if (isset($errors['confirm-password'])): ?>
                    <p><?= $errors['confirm-password'] ?></p>
                <?php endif; ?>
            </div>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="#" id="toLogin">Login here</a>.</p>
    </div>
    <div class="image-container">
        <img src="assets/img/auth.png" alt="Magical Hogwarts">
        <div class="text-overlay">
            <h2>Welcome to Hogwarts!</h2>
            <p>Embark on your magical journey and unlock the secrets of magic.</p>
        </div>
    </div>
</div>