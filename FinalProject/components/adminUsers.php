<?php
    require_once './inc/functions.php';

    $members = $controllers->members()->get_all_members();
?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Users</h2>
    <div class="mb-3">
        <a href="addUser.php" class="btn btn-success mb-3">Add User</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th style="text-align: center; font-weight: bold;">First Name</th>
                <th style="text-align: center; font-weight: bold;">Last Name</th>
                <th>Email</th>
                <th style="text-align: center; font-weight: bold;">Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($members as $member): ?>
            <tr>
                <td><?= htmlspecialchars($member['ID']) ?></td>
                <td style="text-align: center; font-weight: bold;"><?= htmlspecialchars($member['firstname']) ?></td>
                <td style="text-align: center; font-weight: bold;"><?= htmlspecialchars($member['lastname']) ?></td>
                <td><?= htmlspecialchars($member['email']) ?></td>
                <td style="text-align: center; font-weight: bold;">
                    <?= htmlspecialchars($controllers->roles()->get_rolename_by_id($member['role_id'])['name']) ?>
                </td>
                <td>
                    <div class="btn-group-vertical" role="group" aria-label="User Actions">
                        <a href="updateUsers.php?id=<?= $member['ID'] ?>" class="btn btn-primary mb-2">Edit</a>
                        <a href="delete_users.php?id=<?= $member['ID'] ?>" class="btn btn-danger">Delete</a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>