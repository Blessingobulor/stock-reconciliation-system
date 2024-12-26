<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <style>

        .container-flex {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .header, .footer {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 20px;
            position: relative;
            font-size: 20px;
        }

        .header img {
            float: left;
            max-width: 200px; 
            margin-right: 20px; 
            cursor: pointer;
        }

        .main-content {
            flex-grow: 1;
            padding: 50px;
        }

        .flex-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 0px;
            margin: auto;
        }

        .card {
            flex: 1 1 300px;
            padding: 20px;
            border: 1px solid #007bff;
            border-radius: 10px;
            text-align: center;
            min-height: 30vh;
            width: 45%;
            height: 30vh;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #b00ea2;
            cursor: pointer;
            color: white;
            margin: 90px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center; 
            align-items: center; 
            transition: background-color 0.3s;
        }

        .card:hover {
            background-color: #a00d91;
    }

        .card h3 {
            font-size: 24px;
            margin-top: 20px; 
    }

        .card .icon {
            font-size: 60px; 
            margin-bottom: 15px; 
            color: white;
    }


    h1 {
            font-size: 30px;
            margin-left: 30px; 
            font-family: Arial, sans-serif;
            justify-content: center;

    }

    </style>

</head>
<body>

    <div class="container-flex">
        <!-- Header -->
        <header class="header">
            <img src="../images/logo.png" alt="Logo" onclick="window.location.href='<?php echo 'index.php?pg=login'; ?>';">
            <h1>NOVELSOLAR STOCK AND SALES RECONCILIATION SYSTEM</h1>
        </header>

        <!-- Main Content -->
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                    </div>
                </div>
                <!-- Flexbox Cards -->
                <div class="flex-cards">
                    <div class="card" onclick="window.location.href='<?php echo 'index.php?pg=productpage'; ?>';">
                        <i class="fas fa-boxes icon"></i> 
                        <h3>STOCK</h3>
                    </div>
                    <div class="card">
                        <i class="fas fa-chart-line icon"></i> 
                        <h3>SALES</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
