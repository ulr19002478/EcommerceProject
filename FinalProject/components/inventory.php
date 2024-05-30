<?php
require_once './inc/functions.php';

$equipment = $controllers->equipment()->get_all_equipments();
?>

<div class="container mt-4">
    <h2>Equipment Inventory</h2>
    <table class="table table-striped">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($equipment as $equip): ?>
            <tr>
                <td>
                    <img src="<?= htmlspecialchars($equip['image']) ?>"
                        alt="Image of <?= htmlspecialchars($equip['description']) ?>"
                        style="width: 100px; height: auto;">
                </td>
                <td><?= htmlspecialchars($equip['name']) ?></td>
                <td><?= htmlspecialchars($equip['description']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>