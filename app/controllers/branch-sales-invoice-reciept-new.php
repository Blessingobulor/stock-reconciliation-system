<?php require_once views_path('partials/header');?>


    <style>

        @page{

            size: A4;
            margin: 20mm;
        }

        body{

            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #555;
            font-size: 16px;
            line-height: 24px;: 
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
            font-size: 36px;ca
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
        <p><strong>Sales Id:</strong> <?= htmlspecialchars($sales_id['sales_id']); ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars(date('Y-m-d')); ?></p>
    </div>

    <div class="invoice-details">
        <p><strong>Billed To:</strong></p>
        <p>Customer Name: <?= htmlspecialchars($report['customer_name']); ?></p>
        <p>Branch Name: <?= htmlspecialchars($report['branch_name']); ?></p>

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
                 require_once __DIR__ . '/../models/branch_sales.php';
                $db = new Database();
                $result = $db->query("SELECT * FROM branch_sales WHERE date BETWEEN :startdate AND :enddate AND created_by = :user_id");

                foreach ($result as $row):
                ?>
                <tr>
                    <td><?= htmlspecialchars($row['stock_name']); ?></td>
                    <td><?= htmlspecialchars($row['qty']); ?></td>
                    <td><?= htmlspecialchars(number_format($row['price'], 2)); ?></td>
                    <td><?= htmlspecialchars(number_format($row['amount'], 2)); ?></td>
                    <td><?= htmlspecialchars(number_format($row['total'], 2)); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="invoice-summary">
        <table>
            <tr>
                <th>Vat Amount:</th>
                <td><?= htmlspecialchars(number_format($report['vat_amount'], 2)); ?></td>
            </tr>
            <tr>
                <th>Grand Total:</th>
                <td><?= htmlspecialchars(number_format($report['grand_total'], 2)); ?></td>
            </tr>
        </table>
    </div>

    <br><br><br><br>
    
    <div class="invoice-footer">
        <p>Thank you for your Patronage!</p>
        <p>If you have any questions about this invoice, please contact @Novelsolar Integrated services</p>
    </div>
</div>

</body>
</html>