<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Students List</title>
    <link rel="stylesheet" href="../../../public/css/get_all.css">
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

    <h2><?= $show_deleted ? 'Deleted Students' : 'Active Students' ?></h2>
    
    <div class= "student-count">
        <a class="btn btn-primary" href="<?= base_url() . 'users/create' ?>">
        <span>Add New Student</span>
        </a>
    </div>

    <a href="/users/get-all" class="btn">Show Active</a>
    <a href="/users/get-all?show=deleted" class="btn">Show Deleted</a>

    <form method="get" action="/users/get-all">
        <?php if ($show_deleted): ?>
            <input type="hidden" name="show" value="deleted">
        <?php endif; ?>
        <input type="text" name="search" value="<?= $search ?? '' ?>" placeholder="Search...">
        <button type="submit">Search</button>
    </form>

    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records as $r): ?>
                <tr>
                    <td><?= $r['id'] ?></td>
                    <td><?= $r['first_name'] . ' ' . $r['last_name'] ?></td>
                    <td><?= $r['email'] ?></td>
                    <td>
                        <?php if ($show_deleted): ?>
                            <a href="/users/restore/<?= $r['id'] ?>">Restore</a>
                        <?php else: ?>
                            <a href="/users/update/<?= $r['id'] ?>">Edit</a> |
                            <a href="/users/delete/<?= $r['id'] ?>"
                                onclick="return confirm('Soft delete this student?')">Delete</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div>
        <?= $pagination_links ?>
    </div>

</body>

</html>