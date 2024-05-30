<?php
session_start();

if(isset($_POST['equipment_id'])) {
    $equipmentId = intval($_POST['equipment_id']);

    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

    if(!isset($cart[$equipmentId])) {
        $cart[$equipmentId] = 1;
    } else {
        $cart[$equipmentId]++;
    }

    $_SESSION['cart'] = $cart;

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    header("Location: index.php?error=Equipment ID not provided");
    exit;
}
?>