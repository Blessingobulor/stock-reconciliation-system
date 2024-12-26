<?php 

require_once __DIR__ . '/../models/recieve_from_central_store.php';

if (isset($_POST['delete_from']) && $_POST['delete_from'] === 'report') {

    $stock_name = $_POST['stock_name'];
    $qty = $_POST['qty'];
    $user_id = $_SESSION['USER']['user_id'];
    $db = new Database();

    // Decrement the quantity in the stock table
    $result_stock = $db->query("UPDATE stock SET qty = qty - '$qty' WHERE stock_name = '$stock_name' AND created_by = '$user_id'");

    // Delete from recieve_from_central_store table
    $result_recieved_from_central_store = $db->query("DELETE FROM recieve_from_central_store WHERE stock_name = '$stock_name' AND created_by = '$user_id'");

    if ($result_stock && $result_recieved_from_central_store) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit;
}

?>
