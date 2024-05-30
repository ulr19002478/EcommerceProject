<?php
require_once './inc/functions.php';

$equipment = $controllers->equipment()->get_all_equipments();
?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Equipment Inventory</h2>
    <div class="mb-3">
        <a href="addEquipment.php" class="btn btn-primary">Add Equipment</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($equipment as $equip): ?>
            <tr>
                <td>
                    <img src="<?= htmlspecialchars($equip['image'] ?? '') ?>"
                        alt="Image of <?= htmlspecialchars($equip['description'] ?? '') ?>"
                        style="width: 100px; height: auto;">
                </td>
                <td class="text-center"><?= htmlspecialchars($equip['name'] ?? '') ?></td>
                <td><?= htmlspecialchars($equip['description'] ?? '') ?></td>
                <td class="text-center">
                    £<?= number_format(htmlspecialchars($equip['price'] ?? '0'), 2) ?>
                </td>
                <td>
                    <div class="btn-group-vertical" role="group" aria-label="Equipment Actions">
                        <a href="equipmentUpdate.php?id=<?= htmlspecialchars($equip['id'] ?? '') ?>"
                            class="btn btn-primary mb-2">Edit</a>
                        <a href="deleteInventory.php?id=<?= htmlspecialchars($equip['id'] ?? '') ?>"
                            class="btn btn-danger">Delete</a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>