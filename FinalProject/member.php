<?php 
    $title = 'Home'; 
    require __DIR__ . "/inc/header.php"; 
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Welcome <?= $_SESSION['user']['firstname'] ?? 'Member' ?>!</h1>

    <div class="row justify-content-center">

        <div class="col-md-4">
            <div class="card text-center mb-4">
                <img src="https://cdn-prod.medicalnewstoday.com/content/images/articles/325/325253/assortment-of-fruits.jpg"
                    class="card-img-top" alt="Image 2" style="height: 300px;">
                <div class="card-body">
                    <h5 class="card-title">Logout</h5>
                    <p class="card-text">Click here to logout.</p>
                </div>
                <div class="card-footer">
                    <a href="login.php" class="btn btn-danger btn-block">Logout</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center mb-4">
                <img src="https://cdn-prod.medicalnewstoday.com/content/images/articles/325/325253/assortment-of-fruits.jpg"
                    class="card-img-top" alt="Image 3" style="height: 300px;">
                <div class="card-body">
                    <h5 class="card-title">Explore the Storefront!</h5>
                    <p class="card-text">Browse through the items on the storefront!.</p>
                </div>
                <div class="card-footer">
                    <a href="inventory.php" class="btn btn-primary btn-block">View the Storefront</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . "/inc/footer.php"; ?> 
