<div class="content-container">
  <div class="content-area1">
    <div class="users-header">
      <h2>Users</h2>
      <div class="users-info">
        <span class="user-count" id="userCount">Showing <?= count($users) ?> out of <?= count($users) ?> existing users</span>
        <div class="input-group mb-3 float-right">
          <input type="text" name="search" id="search" class="form-control" placeholder="Search users by name or email address" aria-label="Search users by name or email address" aria-describedby="search" value="<?= set_value('search'); ?>">
          <button class="btn btn-outline-secondary float-right" type="submit" id="searchButton">Search</button>
        </div>
      </div>
    </div>
    <table class="users-table" id="userTable" class="table table-striped" style="width:100%">
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
          <tr class="userRow" data-id="<?= $user['id'] ?>" data-username="<?= $user['username'] ?>" data-email="<?= $user['email'] ?>" data-status="<?= $user['isactive'] ?>"  data-image="<?= $user['image'] ?>">
            <td class="userName">
                <?php if (is_null($user["image"])) : ?>
                  <img src="<?= base_url("assets/images/default-profile.png") ?>" alt="default-profile" class="profile-image">
                <?php else : ?>
                  <img src="<?= base_url("uploads/employees/") . $user['image'] ?>" alt="user-profile" class="profile-image">
                <?php endif; ?>
                <?= $user['username']; ?>
            </td>
            <td class="userEmail"><?= $user['email']; ?></td>
            <td><?= $user['password1']; ?></td>
            <td>
              <span class="status <?= $user['isactive'] == 1 ? 'active' : 'inactive'; ?>">
                <?= $user['isactive'] == 1 ? 'Active' : 'Inactive'; ?>
              </span>
            </td>
            <td>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton<?= $user['id']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton<?= $user['id']; ?>">
                    <li><a class="dropdown-item deactivate-user" href="<?= base_url("UserManagementController/deactivate/").$user['id']; ?>" data-id="<?= $user['id']; ?>">Deactivate</a></li>
                </ul>
            </div>
        </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <a href="<?= base_url("UserManagementController/register"); ?>" class="btn btn-primary" role="button" aria-disabled="true">Add User</a>
    <nav aria-label="Page navigation" id="pagination">
      <ul class="pagination justify-content-center">
        <!-- Pagination items will be dynamically added here -->
      </ul>
    </nav>
  </div>

  <div class="content-area2">
    <div class="user-details" data-id="">
        <h3>User Details</h3>
        <img id="userAvatar" src="<?= base_url("assets/images/default-profile.png"); ?>" alt="User Avatar" class="profile-image">
        <p id="userName">Select a user to view details</p>
        <p id="userStatus"></p>
        <p id="userEmail"></p>
        <p id="userUsername"></p>
        <a href="#" id="updateButton" class="btn btn-success d-none">Update</a>
    </div>
  </div>
</div>
