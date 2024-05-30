<?php
require_once './inc/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $equipmentId = isset($_POST['equipment_id']) ? intval($_POST['equipment_id']) : null;
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : null;
    $reviewText = isset($_POST['review_text']) ? $_POST['review_text'] : null;

    if ($equipmentId !== null && $rating !== null && $reviewText !== null) {
        $success = $controllers->reviews()->insert_review($equipmentId, $rating, $reviewText);
        if ($success) {
            redirect2("item_details.php?id=$equipmentId");
            exit();
        } else {
            redirect2('item_details.php?id=' . $equipmentId . '&error=Failed to submit review');
            exit();
        }
    } else {
        redirect2('item_details.php?id=' . $equipmentId . '&error=Missing form data');
        exit();
    }
} else {
    redirect('index.php');
    exit();
}
?>