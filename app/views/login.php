<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Student Management System</title>
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1 class="login-title">Welcome Back</h1>
                <p class="login-subtitle">Sign in to your student account</p>
            </div>

            <?php if (isset($errors['login'])): ?>
                <div class="alert alert-error">
                    <?= htmlspecialchars($errors['login']) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?= base_url() ?>login">
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input <?= isset($errors['email']) ? 'error' : '' ?>"
                        value="<?= isset($old_email) ? htmlspecialchars($old_email) : '' ?>"
                        placeholder="Enter your email"
                        required
                    >
                    <?php if (isset($errors['email'])): ?>
                        <span class="error-message"><?= htmlspecialchars($errors['email']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-input <?= isset($errors['password']) ? 'error' : '' ?>"
                        placeholder="Enter your password"
                        required
                    >
                    <?php if (isset($errors['password'])): ?>
                        <span class="error-message"><?= htmlspecialchars($errors['password']) ?></span>
                    <?php endif; ?>
                </div>

                <button type="submit" class="login-btn">Sign In</button>
            </form>

            <div class="forgot-password">
                <a href="register">Don't have an account? Register here</a>
            </div>
        </div>
    </div>
</body>
</html>