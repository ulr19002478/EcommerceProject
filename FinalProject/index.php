<?php 
    $title = 'Home'; 
    require __DIR__ . "/inc/header.php"; 
    
    require_once './inc/functions.php';

    $equipment = $controllers->equipment()->get_all_equipments();
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Welcome to Ecommerce Website,
        <?= htmlspecialchars($_SESSION['user']['firstname'] ?? 'Member') ?>!</h1>
    <h2 class="text-center mb-4">View our current trending items!</h2>

    <div class="row justify-content-center">
        <?php foreach ($equipment as $equip): ?>
        <div class="col-md-4">
            <div class="card text-center mb-4">
                <img src="<?= htmlspecialchars($equip['image']) ?>" class="card-img-top"
                    alt="<?= htmlspecialchars($equip['name']) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($equip['name']) ?></h5>
                    <p class="card-text">£<?= number_format(htmlspecialchars($equip['price'] ?? '0'), 2) ?></p>
                </div>
                <div class="card-footer">
                    <a href="<?= 'item_details.php?id=' . htmlspecialchars($equip['id']) ?>"
                        class="btn btn-primary btn-block">View Details</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require __DIR__ . "/inc/footer.php"; ?>