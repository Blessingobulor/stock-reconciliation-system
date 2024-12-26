
    <style>
        .input-group {
            position: relative;
        }

        .suggestions-container {
            position: absolute;
            top: 100%;
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
            z-index: 1000;
        }

        .suggestion-item {
            padding: 8px;
            cursor: pointer;
        }

        .suggestion-item:hover {
            background-color: #f5f5f5;
        }

    </style>
</head>
<body>
    <?php require_once views_path('partials/header');?>

    <div class="container-fluid border col-lg-7 col-md-6 mt-4 p-3 shadow-lg rounded">
    <a href="index.php?pg=branch_sales_report">
            <button class="btn btn-info float-end" style="background-color:#4CAF50; font-weight: bold; width:200px; font-size: 16px; color: white; border-style: outset; font-family: monospace; margin: 30px; padding-right: 30px; color: none; top: 90px; text-decoration: none; display: flex;"> View Report</button>


        <a href="index.php?pg=branch_sales_invoice_report">
        <button class="btn btn-info float-end" style="background-color:#4CAF50; font-weight: bold; width:200px; font-size: 16px; color: white; border-style: outset; font-family: monospace; margin: 30px; padding-left: 30px; color: none; top: 90px; text-decoration: none; display: flex; position: absolute;">Sales Invoice</button>
    </a>


        <form id="stock-form" name="myform" method="post">
            <center>
                <br>
                <h3 style="position: center; padding-left: 60px;"><i class="fa fa-dolly"><br></i> Sales</h3>
            </center>

            <div class="mb-3 mt-3">
                <label for="salesidControlInput1" class="form-label">Sales Id</label>
                <input type="text" class="form-control" name="sales_id" id="sales_id" value ="S<?= rand(1000, 9999) ?>" readonly>
                <?php if(!empty($errors['sales_id'])):?>
                    <small class="text-danger"><?=$errors['sales_id']?></small>
                <?php endif;?>
            </div>

            <div class="mb-3 mt-3">
                <label for="customernameControlInput1" class="form-label">Customer Name</label>
                <input type="text" name="customer_name" class="form-control <?= !empty($errors['customer_name']) ? 'border-danger' : '' ?>" id="customer_name">
                <?php if(!empty($errors['customer_name'])):?>
                    <small class="text-danger"><?=$errors['customer_name']?></small>
                <?php endif;?>
            </div>

            <div class="mb-3 mt-3">
                <label for="branchnameControlInput1" class="form-label">Branch Name</label>
                <select name="branch_name" class="form-control <?= !empty($errors['branch_name']) ? 'border-danger' : '' ?>" id="branch_name">
                    <option value="" selected>Choose...</option>
                    <option>Sangotedo Branch</option>
                    <option>Sagamu Branch</option>
                    <option>Central Branch Ibadan</option>  
                    <option>Ore Branch</option>
                    <option>Elegushi Branch</option>
                    <option>Ikota Branch</option>
                    <option>Ikeja Branch</option>
                    <option>Ondo Branch</option>
                    <option>Ado Ekiti Branch</option>
                    <option>Ile ife</option>
                    <option>Ilesa Branch</option>
                    <option>Benin 1 Branch</option>
                    <option>Benin 2 Branch</option>
                    <option>Osogbo Branch</option>
                    <option>Oyo Branch</option>
                    <option>Ogbomoso Branch</option>
                    <option>Oke ilewo Branch</option>
                    <option>Obantoko Branch</option>
                    <option>Ijebu ode Branch</option>
                    <option>Abuja maraba Branch</option>
                    <option>Abuja kubwa Branch</option>
                    <option>Kaduna Branch</option>
                    <option>Kano Branch</option>
                    <option>Iwo road Branch</option>
                    <option>Bodija Ibadan</option>
                    <option>Gw ilorin Branch</option>
                    <option>Tipper Garage Branch</option>
                    <option>Gw Akure</option>
                    <option>Asaba Branch</option>    
                </select>
                <?php if(!empty($errors['branch_name'])):?>
                    <small class="text-danger"><?=$errors['branch_name']?></small>
                <?php endif;?>
            </div>

            <div class="mb-3 mt-3">
                <label for="dateControlInput1" class="form-label">Date</label>
                <input type="date" name="date" class="form-control <?= !empty($errors['date']) ? 'border-danger' : '' ?>" id="date">
                <?php if(!empty($errors['date'])):?>
                    <small class="text-danger"><?=$errors['date']?></small>
                <?php endif;?>
            </div>

            <h5>Add Stock Sold</h5>
            <div id="item-container">
            <div class="input-group col-xl-6 mb-4">
             <input name="stock_name_0" class="js-search form-control <?= !empty($errors['stock_name_0']) ? 'border-danger' : '' ?>" oninput="searchItem(event)" placeholder="Stock Sold" required>
            <div class="suggestions-container"></div>

            <input name="quantity_0" class="quantity form-control <?= !empty($errors['quantity_0']) ? 'border-danger' : '' ?>" type="number" placeholder="Quantity" required>

             <input name="price_0" class="price form-control <?= !empty($errors['price_0']) ? 'border-danger' : '' ?>" type="number" placeholder="Price" oninput="calculateAmountAndTotal(this)">

             <input name="amount_0" class="amount form-control" type="number" placeholder="Amount" readonly>

            <input name="total_0" id="total_0" value="0.00" step="0.01" type="number" class="total form-control" placeholder="Total" readonly>

        <button class="remove-item btn btn-danger" type="button" onclick="removeItem(this)">Remove</button>
    </div>
</div>


            <div id="addMoreContainer" class="col-md-3 mb-3">
                <button type="button" class="btn btn-success add_item_btn" onclick="AddMore()">Add More</button>
            </div>

            <div class="mb-3 mt-3">
                <label for="sub_total" class="form-label" style="font-weight: bold;">Sub Total</label>
                <input name="sub_total" id="sub_total" value="0.00" step="0.01" type="number" class="form-control" placeholder="Total" readonly>
            </div>

            <div class="mb-3 mt-3">
                <label for="vat_amount" class="form-label" style="font-weight: bold;">VAT Amount</label>
                <input name="vat_amount" id="vat_amount" value="0.00" step="0.01" type="number" class="form-control" placeholder="VAT Amount" readonly>
            </div>


             <div class="mb-3 mt-3">
                <label for="grand_total" class="form-label" style="font-weight: bold;">Grand Total</label>
                <input name="grand_total" id="grand_total" value="0.00" step="0.01" type="number" class="form-control" placeholder="Grand Total" readonly>
            </div>


            <div>
                <button type="reset" class="btn btn-primary">Cancel</button>
                <button type="button" class="btn btn-success float-end" onclick="submitForm()">Submit</button>
            </div>
        </form>
    </div>

    <?php require_once views_path('partials/footer');?>

    <script>
        var FieldAmount = 1;
        var stockItems = ['NOVEL TUBULAR BATTERY']; 

        function AddMore() {
            var container = document.createElement("div");
            container.classList.add("input-group", "col-xl-6", "mb-4");

            var stock_name = document.createElement("input");
            stock_name.type = "text";
            stock_name.name = "stock_name_" + FieldAmount;
            stock_name.classList.add("js-search", "form-control");
            stock_name.placeholder = "Stock Sold";
            stock_name.setAttribute("oninput", "searchItem(event)");
            stock_name.required = true;

            var suggestionsContainer = document.createElement("div");
            suggestionsContainer.classList.add("suggestions-container");

            var quantity = document.createElement("input");
            quantity.type = "number";
            quantity.name = "quantity_" + FieldAmount;
            quantity.classList.add("quantity", "form-control");
            quantity.placeholder = "Quantity";
            quantity.required = true;

            var price = document.createElement("input");
            price.type = "number";
            price.name = "price_" + FieldAmount;
            price.classList.add("price", "form-control");
            price.placeholder = "Price";
            price.addEventListener("input", function() {
                calculateAmountAndTotal(this);
            });

            var amount = document.createElement("input");
            amount.type = "number";
            amount.name = "amount_" + FieldAmount;
            amount.classList.add("amount", "form-control");
            amount.placeholder = "Amount";
            amount.readOnly = true;

            var total = document.createElement("input");
            total.type = "number";
            total.name = "total_" + FieldAmount;
            total.classList.add("total", "form-control");
            total.placeholder = "Total";
            total.readOnly = true;

            var removeButton = document.createElement("button");
            removeButton.classList.add("remove-item", "btn", "btn-danger");
            removeButton.type = "button";
            removeButton.textContent = "Remove";
            removeButton.addEventListener("click", function() {
                removeItem(this);
            });

            container.appendChild(stock_name);
            container.appendChild(suggestionsContainer);
            container.appendChild(quantity);
            container.appendChild(price);
            container.appendChild(amount);
            container.appendChild(total);
            container.appendChild(removeButton);

            document.getElementById("item-container").appendChild(container);
            FieldAmount++;
        }

        function removeItem(button) {
            var itemContainer = document.getElementById('item-container')
            if (itemContainer.children.length > 1) {
                var container = button.parentElement;
                container.remove();
                updateSubTotal();
            }
        }

        function searchItem(event) {
            var input = event.target;
            var suggestionsContainer = input.nextElementSibling;
            var searchTerm = input.value.toLowerCase();

            suggestionsContainer.innerHTML = "";

            if (searchTerm) {
                var filteredItems = stockItems.filter(function(item) {
                    return item.toLowerCase().includes(searchTerm);
                });

                filteredItems.forEach(function(item) {
                    var suggestionItem = document.createElement("div");
                    suggestionItem.classList.add("suggestion-item");
                    suggestionItem.textContent = item;
                    suggestionItem.addEventListener("click", function() {
                        input.value = item;
                        suggestionsContainer.innerHTML = "";
                    });

                    suggestionsContainer.appendChild(suggestionItem);
                });
            }
        }

        function calculateAmountAndTotal(priceInput) {
            var container = priceInput.parentElement;
            var quantityInput = container.querySelector(".quantity");
            var amountInput = container.querySelector(".amount");
            var totalInput = container.querySelector(".total");

            var price = parseFloat(priceInput.value);
            var quantity = parseFloat(quantityInput.value);

            if (!isNaN(price) && !isNaN(quantity)) {
                var amount = price * quantity;
                amountInput.value = amount.toFixed(2);
                totalInput.value = amount.toFixed(2);
            } else {
                amountInput.value = "0.00";
                totalInput.value = "0.00";
            }

            updateSubTotal();
        }

        function updateSubTotal() {
            var totalInputs = document.querySelectorAll(".total");
            var subTotalInput = document.getElementById("sub_total");

            var subTotal = 0;

            totalInputs.forEach(function(input) {
                var total = parseFloat(input.value);
                if (!isNaN(total)) {
                    subTotal += total;
                }
            });

            subTotalInput.value = subTotal.toFixed(2);
            updateVatAndGrandTotal();
        }

        function updateVatAndGrandTotal() {
            var subTotal = parseFloat(document.getElementById("sub_total").value);
            var vatAmountInput = document.getElementById("vat_amount");
            var grandTotalInput = document.getElementById("grand_total");

            var vatAmount = subTotal * 0.075; 
            var grandTotal = subTotal + vatAmount;

            vatAmountInput.value = vatAmount.toFixed(2);
            grandTotalInput.value = grandTotal.toFixed(2);
        }

        function submitForm() {
            document.getElementById("stock-form").submit();
        }
    </script>
</body>
</html>
