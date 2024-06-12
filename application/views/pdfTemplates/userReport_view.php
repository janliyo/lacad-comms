<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/users.css"); ?>">
    <title>Users List</title>
</head>
<body>
<table class="users-table">
    <thead>
      <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Password</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user) : ?>
      <tr>
        <td><?= $user['username']; ?></td>
        <td><?= $user['email']; ?></td>
        <td><?= $user['password1']; ?></td>
        <?php if($user['isactive'] == 1): ?>
          <td><span class="status active">Active</span></td>
        <?php else: ?>
          <td><span class="status active">Inactive</span></td>
        <?php endif; ?>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>