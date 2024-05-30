<?php
@session_start();

require_once './inc/functions.php';

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

$equipmentController = $controllers->equipment();

$cartDetails = [];

foreach ($cart as $equipmentId => $quantity) {
    $equipmentDetails = $equipmentController->get_equipment_by_id($equipmentId);
    if ($equipmentDetails) {
        $equipmentDetails['quantity'] = $quantity;
        $cartDetails[] = $equipmentDetails;
    }
}

$title = 'Cart';
require_once './inc/header.php';
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Shopping Cart</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartDetails as $item): ?>
            <tr>
                <td><img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>"
                        style="max-width: 100px;"></td>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td><?= htmlspecialchars($item['description']) ?></td>
                <td>£<?= number_format($item['price'], 2) ?></td>
                <td><?= $item['quantity'] ?></td>
                <td>£<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="text-center">
        <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
    </div>
</div>

<?php require_once './inc/footer.php'; ?>