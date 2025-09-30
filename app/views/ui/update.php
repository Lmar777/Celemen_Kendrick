<!DOCTYPE html>
<html>

<head>
  <title>Update Student</title>
  <?php load_css(['css/style']); ?>
    <?php load_css(['css/update']); ?>
</head>

<body>
  <!-- User Header with Logout -->
  <div class="user-header">
    <div class="user-info">
      <span>Welcome, <?= htmlspecialchars($current_user['name']) ?></span>
      <span class="user-email">(<?= htmlspecialchars($current_user['email']) ?>)</span>
    </div>
    <a href="<?= base_url() ?>logout" class="btn btn-logout" onclick="return confirm('Are you sure you want to logout?')">
      Logout
    </a>
  </div>

  <h1>Update Student</h1>
  <form method="post" action="/users/update/<?= $user['id'] ?>">
    <label>First Name:</label>
    <input type="text" name="first_name" value="<?= $user['first_name'] ?>"><br>
    <label>Last Name:</label>
    <input type="text" name="last_name" value="<?= $user['last_name'] ?>"><br>
    <label>Email:</label>
    <input type="email" name="email" value="<?= $user['email'] ?>"><br>
    <button type="submit">Update</button>
  </form>
  <a href="/users">⬅ Back</a>
</body>

</html>