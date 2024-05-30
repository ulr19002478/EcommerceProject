<?php
    foreach(glob('./classes/*.php') as $file)
    {
        require_once $file; 
    }

    $controllers = new Controllers(); 

    if (!function_exists('redirect')) {
        function redirect($page, array $params = [])
        {
            $qs = $params ? '?' . http_build_query($params) : '';
            header("Location: $page.php" . $qs);
            exit;
        }
        function redirect2($url) {
            header("Location: $url");
            exit();
        }
    }

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>