<?php require_once views_path('partials/header'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Add DataTables Buttons CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Stock View</title>
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row mt-2">
            <div class="col">
                <div class="card mt-2">
                    <div class="card-header">
                        <h2 class="display-6 text-center">AVAILABLE STOCK</h2>
                    </div>

                    <div class="card-body">
                        <!-- Add DataTable class to the table -->
                        <table id="stockTable" class="table table-bordered text-center reportTable">
                            <thead>
                                <tr class="bg-dark text-white">
                                    <th>Stock Name</th>
                                    <th>Qty</th>
                                    <th>Category</th>
                                    <th>Branch Name</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $user_id = $_SESSION['USER']['user_id'];
                                $db = new Database();
                                $result = $db->query("SELECT * FROM stock WHERE created_by = '$user_id'");
                                
                                if ($result) {
                                    foreach ($result as $row):
                                ?>
                                        <tr>
                                            <td><?= $row['stock_name']; ?></td>
                                            <td><?= $row['qty']; ?></td>
                                            <td><?= $row['category']; ?></td>
                                            <td><?= $row['branch_name']; ?></td>
                                            <td>
                                                <form method="post">
                                                    <input type="hidden" name="delete_id" value="<?= $row['id']; ?>">
                                                    <button type="submit" name="delete_btn" class="btn btn-link"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    endforeach;
                                } else {
                                    echo '<tr><td colspan="5">No stock available</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once views_path('partials/footer'); ?>

    <!-- DataTables Buttons JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>

   <script>
    $(document).ready(function () {
        // Destroy existing DataTable instance 
        if ($.fn.DataTable.isDataTable('.reportTable')) {
            $('.reportTable').DataTable().destroy();
        }

        // Initialize DataTable with buttons
        $('.reportTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pdf',
                    title: 'NovelSolar Branch Available Stock Report',
                    filename: 'NovelSolar_Branch_Available_Stock_Report', 
                    exportOptions: {
                        columns: ':not(:last-child)' // Exclude the last column (Delete column)
                    }
                },
                {
                    extend: 'print',
                    title: 'NovelSolar Branch Available Stock Report', 
                    exportOptions: {
                        columns: ':not(:last-child)' // Exclude the last column (Delete column)
                    }
                }
            ]
        });

        // Handle deletion
        $('.btn.btn-link').on('click', function (e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var delete_id = $(this).siblings('input[name="delete_id"]').val();
            
            $.post('', { delete_id: delete_id, delete_btn: true }, function(response) {
                if (response.success) {
                    row.fadeOut('slow', function () {
                        location.reload();
                        $(this).remove();
                    });
                } else {
                    alert('Failed to delete row. Please try again.');
                }
            }, 'json'); // Specify response data type as JSON
        });
    });
</script>


    <?php

// Handle deletion
if (isset($_POST['delete_btn'])) {
    $delete_id = $_POST['delete_id'];
    $user_id = $_SESSION['USER']['user_id'];
    $db = new Database();
    
    // First, delete from recieve_from_central_store table based on created_by
    $result_recieve_from_central_store = $db->query("DELETE FROM recieve_from_central_store WHERE stock_name IN (SELECT stock_name FROM stock WHERE id = '$delete_id' AND created_by = '$user_id')");


    // delete from branch sales if available 

     $result_branch_sales = $db->query("DELETE FROM branch_sales WHERE stock_name IN (SELECT stock_name FROM stock WHERE id = '$delete_id' AND created_by = '$user_id')");

     // delete from recieve_from_branch

     $result_recieve_from_branch = $db->query("DELETE FROM recieve_from_branch WHERE stock_name IN(SELECT stock_name FROM stock where id = '$delete_id' AND created_by = '$user_id')");

     // delete from return_stock if availabe

      $result_return_stock = $db->query("DELETE FROM return_stock WHERE stock_name IN(SELECT stock_name FROM stock where id = '$delete_id' AND created_by = '$user_id')");

      // delete from transfer to branch

       $result_transfer_to_branch = $db->query("DELETE FROM transfer_to_branch WHERE stock_name IN(SELECT stock_name FROM stock where id = '$delete_id' AND created_by = '$user_id')");
       
       
       // delete from recieved_from_supplier

        $result_recieved_from_supplier = $db->query("DELETE FROM recieved_from_supplier WHERE stock_name IN(SELECT stock_name FROM stock where id = '$delete_id' AND created_by = '$user_id')");


// delete from central_store_transfer_to_branch


        $result_central_store_transfer_to_branch = $db->query("DELETE FROM central_store_transfer_to_branch WHERE stock_name IN(SELECT stock_name FROM stock where id = '$delete_id' AND created_by = '$user_id')");


// delete from central_store_stock

        $result_central_store_stock = $db->query("DELETE FROM central_store_stock WHERE stock_name IN(SELECT stock_name FROM stock where id = '$delete_id' AND created_by = '$user_id')");


// delete from central_store_stock

        $result_return_inward = $db->query("DELETE FROM return_inward WHERE stock_name IN(SELECT stock_name FROM stock where id = '$delete_id' AND created_by = '$user_id')");

    // Then, delete from stock table
    $result_stock = $db->query("DELETE FROM stock WHERE id = '$delete_id' AND created_by = '$user_id'");

    if ($result_stock && $result_recieve_from_central_store && $result_branch_sales && $result_recieve_from_branch && $result_return_stock && $result_transfer_to_branch && $result_recieved_from_supplier && $result_central_store_transfer_to_branch && $result_central_store_stock && $result_return_inward) {
        
        echo json_encode(['success' => true]); // Send success response
    } else {
        echo json_encode(['success' => false]); // Send failure response
    }
    exit; // Stop further execution
}
?>



    ?>
</body>
</html>
