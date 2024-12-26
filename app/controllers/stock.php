<?php
$errors = [];
$user_id = $_SESSION['USER']['user_id'];

// Function to validate an ID
function validateId($id) {
    // Check if 'id' index is set in $id array
    if (!isset($id) || !is_numeric($id) || $id <= 0) {
        return "Invalid ID. Please provide a positive integer.";
    }

    // If validation passes, return an empty string or null
    return '';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stock = new stock();

    // Validate ID
    $errors['id'] = validateId(isset($_POST['id']) ? $_POST['id'] : ''); 

    // Perform similar validation for other fields

    if (empty(array_filter($errors))) {
        // Set created_by when inserting new stock items
        $_POST['created_by'] = $user_id;
        
        // If there are no validation errors, proceed with insertion
        $stock->insert($_POST);

    }

} 

// Include the view file for displaying stock items
require_once views_path('stocks/stock');
?>
