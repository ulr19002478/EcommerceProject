<?php
require_once './inc/functions.php';

$equipmentId = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($equipmentId !== null) {
    $equipmentDetails = $controllers->equipment()->get_equipment_by_id($equipmentId);

    $reviews = $controllers->reviews()->get_reviews_by_equipment_id($equipmentId);

    if ($equipmentDetails) {
        $title = "You are currently viewing " . htmlspecialchars($equipmentDetails['name']);
        require __DIR__ . "/inc/header.php";
?>

<div class="container mt-5">
    <h3><?= htmlspecialchars($title) ?></h3>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <img src="<?= htmlspecialchars($equipmentDetails['image']) ?>" class="img-fluid"
                        alt="<?= htmlspecialchars($equipmentDetails['name']) ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($equipmentDetails['name']) ?></h5>
                    <p class="card-text"><?= htmlspecialchars($equipmentDetails['description']) ?></p>
                    <p class="card-text">Price:
                        £<?= number_format(htmlspecialchars($equipmentDetails['price'] ?? '0'), 2) ?></p>
                    <!-- Form for adding to cart -->
                    <form action="add_to_cart.php" method="post">
                        <input type="hidden" name="equipment_id"
                            value="<?= htmlspecialchars($equipmentDetails['id']) ?>">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Display reviews -->
<div class="container mt-5">
    <h4>Reviews:</h4>
    <?php if (!empty($reviews)): ?>
    <ul class="list-group">
        <?php foreach ($reviews as $review): ?>
        <li class="list-group-item"><?= htmlspecialchars($review['review_text']) ?> (Rating:
            <?= htmlspecialchars($review['rating']) ?>/5)</li>
        <?php endforeach; ?>
    </ul>
    <?php else: ?>
    <p>No reviews yet.</p>
    <?php endif; ?>
</div>

<!-- Write a review form -->
<div class="container mt-5">
    <h4>Write a Review:</h4>
    <form action="submit_review.php" method="post">
        <input type="hidden" name="equipment_id" value="<?= htmlspecialchars($equipmentId) ?>">
        <div class="form-group">
            <label for="rating">Rating:</label>
            <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" required>
        </div>
        <div class="form-group">
            <label for="review_text">Review:</label>
            <textarea class="form-control" id="review_text" name="review_text" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit Review</button>
    </form>
</div>

<?php
        require __DIR__ . "/inc/footer.php";
    } else {
        redirect('index.php?error=Equipment not found');
    }
} else {
    redirect('index.php?error=Invalid equipment ID');
}
?>