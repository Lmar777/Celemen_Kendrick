<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Student Management System</title>
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/register.css">
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <h1 class="register-title">Create Account</h1>
                <p class="register-subtitle">Join our student management system</p>
            </div>

            <?php if (isset($errors['registration'])): ?>
                <div class="alert alert-error">
                    <?= htmlspecialchars($errors['registration']) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?= base_url() ?>register">
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name" class="form-label">First Name</label>
                        <input 
                            type="text" 
                            id="first_name" 
                            name="first_name" 
                            class="form-input <?= isset($errors['first_name']) ? 'error' : '' ?>"
                            value="<?= isset($old_data['first_name']) ? htmlspecialchars($old_data['first_name']) : '' ?>"
                            placeholder="Enter your first name"
                            required
                        >
                        <?php if (isset($errors['first_name'])): ?>
                            <span class="error-message"><?= htmlspecialchars($errors['first_name']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input 
                            type="text" 
                            id="last_name" 
                            name="last_name" 
                            class="form-input <?= isset($errors['last_name']) ? 'error' : '' ?>"
                            value="<?= isset($old_data['last_name']) ? htmlspecialchars($old_data['last_name']) : '' ?>"
                            placeholder="Enter your last name"
                            required
                        >
                        <?php if (isset($errors['last_name'])): ?>
                            <span class="error-message"><?= htmlspecialchars($errors['last_name']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input <?= isset($errors['email']) ? 'error' : '' ?>"
                        value="<?= isset($old_data['email']) ? htmlspecialchars($old_data['email']) : '' ?>"
                        placeholder="Enter your email"
                        required
                    >
                    <?php if (isset($errors['email'])): ?>
                        <span class="error-message"><?= htmlspecialchars($errors['email']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-row">
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

                    <div class="form-group">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input 
                            type="password" 
                            id="confirm_password" 
                            name="confirm_password" 
                            class="form-input <?= isset($errors['confirm_password']) ? 'error' : '' ?>"
                            placeholder="Confirm your password"
                            required
                        >
                        <?php if (isset($errors['confirm_password'])): ?>
                            <span class="error-message"><?= htmlspecialchars($errors['confirm_password']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <button type="submit" class="register-btn">Create Account</button>
            </form>

            <div class="login-link">
                <a href="login">Already have an account? Sign in here</a>
            </div>
        </div>
    </div>
</body>
</html>