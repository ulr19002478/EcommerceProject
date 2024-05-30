<?php
session_start();

require_once './inc/functions.php';

$controllers = new Controllers();

$cart = $_SESSION['cart'] ?? [];

$equipmentController = $controllers->equipment();

$cartDetails = [];

foreach ($cart as $equipmentId => $quantity) {
    $equipmentDetails = $equipmentController->get_equipment_by_id($equipmentId);
    if ($equipmentDetails) {
        $equipmentDetails['quantity'] = $quantity;
        $cartDetails[] = $equipmentDetails;
    }
}

$title = 'Checkout';
require_once './inc/header.php';
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Checkout</h2>
    <div id="customerDetails">
        <form id="customerForm">
            <h3>Customer Details</h3>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="postcode">Postcode:</label>
                <input type="text" class="form-control" id="postcode" name="postcode" required>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" class="form-control" id="country" name="country" required>
            </div>
            <button type="button" class="btn btn-primary" id="continueToPayment">Continue to Payment</button>
        </form>
    </div>

    <div id="paymentDetails" style="display: none;">
        <form id="paymentForm">
            <h3>Payment Details</h3>
            <div class="form-group">
                <label for="account_number">Account Number:</label>
                <input type="text" class="form-control" id="account_number" name="account_number" required>
            </div>
            <div class="form-group">
                <label for="expiry_date">Expiry Date:</label>
                <input type="text" class="form-control" id="expiry_date" name="expiry_date" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV:</label>
                <input type="text" class="form-control" id="cvv" name="cvv" required>
            </div>
            <div class="form-group">
                <label for="card_name">Name on Card:</label>
                <input type="text" class="form-control" id="card_name" name="card_name" required>
            </div>
            <button type="button" class="btn btn-primary" id="purchaseButton">Purchase</button>
        </form>
    </div>


    <div class="modal fade" id="purchaseModal" tabindex="-1" role="dialog" aria-labelledby="purchaseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="purchaseModalLabel">Purchase Summary</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmPurchase">Purchase</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="purchaseConfirmationModal" tabindex="-1" role="dialog"
        aria-labelledby="purchaseConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="purchaseConfirmationModalLabel">Thank You for Your Purchase</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Items Ordered:</h4>
                    <?php foreach ($cartDetails as $item): ?>
                    <p><?= htmlspecialchars($item['name']) ?> x <?= $item['quantity'] ?></p>
                    <?php endforeach; ?>
                    <p><strong>Total Price:</strong>
                        £<?= number_format(array_reduce($cartDetails, function($carry, $item) { return $carry + ($item['price'] * $item['quantity']); }, 0), 2) ?>
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="index.php" class="btn btn-primary">Back to Homepage</a>
                </div>
            </div>
        </div>
    </div>

    <?php
unset($_SESSION['cart']);
?>

    <script>
    document.getElementById('continueToPayment').addEventListener('click', function() {
        document.getElementById('customerDetails').style.display = 'none';
        document.getElementById('paymentDetails').style.display = 'block';
    });

    document.getElementById('purchaseButton').addEventListener('click', function() {

        var name = document.getElementById('name').value;
        var address = document.getElementById('address').value;


        document.getElementById('purchaseModalLabel').innerHTML = "Purchase Summary for " + name;
        var modalBody = "<p><strong>Name:</strong> " + name + "</p>" +
            "<p><strong>Address:</strong> " + address + "</p>" +
            "<p><strong>Items Ordered:</strong></p>";

        <?php foreach ($cartDetails as $item): ?>
        modalBody += "<p><?= htmlspecialchars($item['name']) ?> x <?= $item['quantity'] ?></p>";
        <?php endforeach; ?>

        modalBody +=
            "<p><strong>Total Price:</strong> £<?= number_format(array_reduce($cartDetails, function($carry, $item) { return $carry + ($item['price'] * $item['quantity']); }, 0), 2) ?></p>";

        document.querySelector('#purchaseModal .modal-body').innerHTML = modalBody;

        $('#purchaseModal').modal('show');
    });


    document.getElementById('confirmPurchase').addEventListener('click', function() {

        $('#purchaseModal').modal('hide');

        $('#purchaseConfirmationModal').modal('show');
    });
    </script>


    <?php require __DIR__ . "/inc/footer.php"; ?>