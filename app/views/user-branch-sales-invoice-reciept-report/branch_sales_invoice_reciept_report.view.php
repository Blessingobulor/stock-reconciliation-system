<style>

@page{
    size: A4;
    margin: 20mm;
}

body{
    font-family: 'Helvetica', 'Arial', sans-serif;
    color: #555;
    font-size: 16px;
    line-height: 24px;
}

.invoice-container {
    max-width: 800px;
    margin: auto;
    padding: 20px;
    border: 1px solid #eee;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    font-size: 16px;
    line-height: 24px;
    font-family: 'Helvetica', 'Arial', sans-serif;
    color: #555;
}

.invoice-header {
    margin-bottom: 20px;
    text-align: center;
}

.invoice-header h1 {
    margin: 0;
    font-size: 36px;
    color: #333;
}

.invoice-details, .invoice-footer {
    margin-top: 20px;
}

.invoice-details table {
    width: 100%;
    border-collapse: collapse;
}

.invoice-details th, .invoice-details td {
    padding: 10px;
    border: 1px solid #eee;
}

.invoice-details th {
    background-color: #f5f5f5;
    font-weight: bold;
    text-align: left;
}

.invoice-summary {
    float: right;
    margin-top: 20px;
    text-align: right;
}

.invoice-summary table {
    width: 100%;
    border-collapse: collapse;
}

.invoice-summary th, .invoice-summary td {
    padding: 10px;
    border: 1px solid #eee;
}

.invoice-summary th {
    background-color: #f5f5f5;
    font-weight: bold;
    text-align: left;
}

.invoice-summary td {
    text-align: right;
}

.invoice-footer {
    text-align: center;
    margin-top: 30px;
}

.invoice-footer p {
    margin: 0; 
    color: #777;
    font-size: 14px;
}

</style>
</head>
<body>

<div class="invoice-container">
    <div class="invoice-header">
        <h1>NovelSolar Sales Invoice</h1>
        <p><strong>Sales Id:</strong></p>
        <p><strong>Date:</strong> <?= (date('Y-m-d')); ?></p>

        
    </div>

    <div class="invoice-details">
        <p><strong>Billed To:</strong></p>
        <p>Customer Name:</p>
        <p>Branch Name:</p>   

        <table>
            <thead>
                <tr>
                    <th>Stock Name</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Amount</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $user_id = $_SESSION['USER']['user_id'];
                $db = new Database();
                $result = $db->query("SELECT * FROM branch_sales WHERE created_by = '$user_id'");

                if ($result) {
                    foreach ($result as $row):
                ?>
                        <tr>
                            <td><?= $row['stock_name']; ?></td>
                            <td><?= $row['qty']; ?></td>
                            <td><?= $row['price']; ?></td>
                            <td><?= $row['amount']; ?></td>
                            <td><?= $row['total']; ?></td>
                        </tr>
                <?php
                    endforeach;
                } else {
                    echo '<tr><td colspan="5">No data available</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="invoice-summary">
        <table>

        <tr>
                <th>Sub Total:</th>
                <td>
                    <?php 
                    if (isset($row['sub_total']) && !empty($row['sub_total'])) {
                        echo htmlspecialchars(number_format($row['sub_total'], 2));
                    } else {
                        echo "No data";
                    }
                    ?>
                </td>
            </tr>

            <tr>
                <th>Vat Amount:</th>
                <td>
                    <?php 
                    if (isset($row['vat_amount']) && !empty($row['vat_amount'])) {
                        echo htmlspecialchars(number_format($row['vat_amount'], 2));
                    } else {
                        echo "No data";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th>Grand Total:</th>
                <td>
                    <?php 
                    if (isset($row['grand_total']) && !empty($row['grand_total'])) {
                        echo htmlspecialchars(number_format($row['grand_total'], 2));
                    } else {
                        echo "No data";
                    }
                    ?>
                </td>
            </tr>
        </table>
    </div>

    <br><br><br><br><br><br>

    <div class="invoice-footer">
        <p>Thank you for your Patronage!</p>
        <p>If you have any questions about this invoice, please contact @Novelsolar Integrated services</p>
    </div>
</div>

</body>
</html>
