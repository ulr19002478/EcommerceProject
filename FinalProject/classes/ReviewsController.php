<?php
class ReviewsController {
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Method to get reviews by equipment ID
    public function get_reviews_by_equipment_id($equipment_id) {
        // Query the database to fetch reviews for the given equipment ID
        $stmt = $this->db->prepare("SELECT * FROM reviews WHERE product_id = ?");
        $stmt->execute([$equipment_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to insert review into the database
    public function insert_review($equipment_id, $rating, $review_text) {
        // Prepare and execute the SQL statement to insert the review
        $stmt = $this->db->prepare("INSERT INTO reviews (product_id, rating, review_text) VALUES (?, ?, ?)");
        return $stmt->execute([$equipment_id, $rating, $review_text]);
    }

    // Other methods for managing reviews can be added here
}
?>
