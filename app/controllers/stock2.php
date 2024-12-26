<?php require_once views_path('partials/header'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Add DataTables Buttons CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
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

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $user_id = $_SESSION['USER']['user_id'];
                                $db = new Database();
                                $result = $db->query("SELECT * FROM stock WHERE created_by = '$user_id'");
                                
                                // echo "<pre>";
                                // print_r($result);
                                
                                if ($result) {
                                    foreach ($result as $row):
                                ?>
                                        <tr>
                                            <td><?= $row['stock_name']; ?></td>
                                            <td><?= $row['qty']; ?></td>
                                            <td><?= $row['category']; ?></td>
                                            <td><?= $row['branch_name']; ?></td>
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
                        filename: 'NovelSolar_Branch_Available_Stock_Report' 
                    },
                    {
                        extend: 'print',
                        title: 'NovelSolar Branch Available Stock Report'
                    }
                ]
            });
        });
    </script>
</body>
</html>
