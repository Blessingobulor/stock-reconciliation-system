<?php  


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        
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
        <h1>NovelSolar Branch Sales Invoice</h1>
        <p><strong>Invoice No:</strong></p>
        <p><strong>Date:</strong></p>
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
                    <th>Vat Amount</th>
                </tr>
            </thead>
           

        </table>


       <tbody>
           
            




       </tbody>

    </div>

    <div class="invoice-summary">
        <table>
            <tr>
                <th>Grand Total:</th>
                <th>[Grand Total]</th>
            </tr>
            
        </table>
    </div>

    <br><br>
    <div class="invoice-footer">
        <p>Thank you for your Patronage!</p>
        <p>If you have any questions about this invoice, please contact NovelSolar Integrated Services</p>
    </div>
</div>

</body>
</html>


<script>
    





</script>
