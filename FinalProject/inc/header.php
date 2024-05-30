<?php 
    @session_start();
    require_once './inc/functions.php';

    if(isset($_POST['signout'])) {
        session_unset();
        session_destroy();
        header("Location: ./login.php");
        exit;
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/lux/bootstrap.min.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Ecommerce Website</a>
        <?php
    $data_target = isset($_SESSION['user']) ? '#memberMenu' : '#navbarNav';
    ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="<?php echo $data_target; ?>"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php if(isset($_SESSION['user'])): ?>
                <li class="nav-item active">
                    <a class="nav-link" href="./index.php">Home</a>
                </li>
                <?php endif; ?>
            </ul>
            <form class="form-inline mx-auto" action="search.php" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="query"
                    style="width: 450px;">
                <button class="btn btn-outline-success my-2 my-sm-0 btn-sm" type="submit">Search</button>
            </form>
            <ul class="navbar-nav ml-auto">
                <?php if(isset($_SESSION['user'])): ?>
                <?php if ($_SESSION['user']['role_id'] == 2): ?>
                <li class="nav-item">
                    <a class="nav-link" href="./admin.php">Admin</a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="./member.php">Account</a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="./cart.php">Cart</a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="./login.php">Login</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>