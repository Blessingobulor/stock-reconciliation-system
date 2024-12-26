
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



<?php require_once views_path('partials/header');?>

<div class="container-fluid border col-lg-7 col-md-6 mt-4 p-3 shadow-lg rounded">
    <a href="index.php?pg=electrical_store_transfer_to_branch_report">
        <button class="btn btn-info float-end" style="background-color:#4CAF50; font-weight: bold; width:200px; font-size: 16px; color: white; border-style: outset; font-family: monospace; margin: 30px; padding-right: 20px; color: none; top: 20px; text-decoration: none; display: flex;"> View Report</button>
    </a>

    <form id="stock-form" name="myform" method="post">
        <center>
            <br>
            <h3><i class="fa fa-dolly"><br></i>Electrical Store Transfer To Branches</h3>
        </center>

        <div class="mb-3 mt-3">
            <label for="transferstockidControlInput1" class="form-label">Transfer Stock Id</label>
                <input type="text" class="form-control" name="transfer_stock_id" id="id" value ="TS<?= rand(1000, 9999) ?>" readonly>

            <?php if(!empty($errors['transfer_stock_id'])):?> 
                <small class="text-danger"><?=$errors['transfer_stock_id']?></small>
            <?php endif;?>
        </div>


        <div class="mb-3 mt-3">
            <label for="branchControlInput1" class="form-label">Branch Name</label>
            <select name="branch_name" class="form-control <?=!empty($errors['branch_name']) ? 'border-danger' : ''?>" id="branchnameControlInput1" placeholder="branch name">
                <option selected>Choose...</option>
                 <option>Eletrical Store</option>
            </select>
            <?php if(!empty($errors['branch_name'])):?>
                <small class="text-danger"><?=$errors['branch_name']?></small>
            <?php endif;?>
        </div>

        <div class="mb-3 mt-3">
            <label for="destinationControlInput1" class="form-label">Destination</label>
            <select name="destination" class="form-control <?=!empty($errors['destination']) ? 'border-danger' : ''?>" id="destinationControlInput1" required>
                <option value="" hidden>Select Source...</option>
                <option value="Akinjide Central Store">Akinjide Central Store</option>
                <option value="Sangotedo Branch">Sangotedo Branch</option>
                <option value="Sagamu branch">Sagamu Branch</option>
                <option value="Akinjide Central Branch Ibadan">Akinjide Central Branch Ibadan</option>
                <option value="Ore Branch">Ore Branch</option>
                <option value="Elegushi Branch">Elegushi Branch</option>
                <option value="Ikota Branch">Ikota Branch</option>
                <option value="Ikeja Branch">Ikeja Branch</option>
                <option value="Ondo Branch">Ondo Branch</option>
                <option value="Ado Ekiti Branch">Ado Ekiti Branch</option>
                <option value="Ile ife branch">Ile ife Branch</option>
                <option value="Ilesa Branch">Ilesa Branch</option>
                <option value="Benin 1 branch">Benin 1 Branch</option>
                <option value="Benin 2 Branch">Benin 2 Branch</option>
                <option value="Osogbo Branch">Osogbo Branch</option>
                <option value="Oyo branch">Oyo Branch</option>
                <option value="Ogbomoso Branch">Ogbomoso Branch</option>
                <option value="Oke ilewo branch">Oke ilewo Branch</option>
                <option value="Obantoko Branch">Obantoko Branch</option>
                <option value="Ijebu ode Branch">Ijebu ode Branch</option>
                <option value="Abuja maraba Branch">Abuja maraba Branch</option>
                <option value="Abuja kubwa Branch">Abuja kubwa Branch</option>
                <option value="Kaduna Kaduna Branch">Kaduna Kaduna Branch</option>
                <option value="Kano Branch">Kano Kano Branch</option>
                <option value="Iwo road Branch">Iwo road Branch</option>
                <option value="Bodija Branch">Bodija branch</option>
                <option value="Gw ilorin Branch">Gw ilorin branch</option>
                <option value="Tipper Garage Branch">Tipper Garage Branch</option>
                <option value="Gw Akure">Gw Akure</option>
                <option value="Asaba Branch">Asaba Branch</option>   
                <option value="Others">Others</option>
            </select>
            <?php if(!empty($errors['destination'])):?>
                <small class="text-danger"><?=$errors['destination']?></small>
            <?php endif;?>
        </div>

        <div class="mb-3 mt-3">
            <label for="dateControlInput1" class="form-label">Transer Date</label>
            <input type="date" name="date" class="form-control <?=!empty($errors['date']) ? 'border-danger' : ''?>" id="dateControlInput1">
            <?php if(!empty($errors['date'])):?>
                <small class="text-danger"><?=$errors['date']?></small>
            <?php endif;?>
        </div>

        <h5>Add Stock Transfered</h5>
        <div id="item-container">
        <div class="input-group col-xl-6 mb-4">
        <input name="stock_name_0" class="js-search form-control <?=!empty($errors['qty']) ? 'border-danger' : ''?>" oninput="searchItem(event)" placeholder="Stock Transfered" required>
         <div class="suggestions-container"></div>

        <input name="quantity_0" step="0.01" class="quantity form-control <?= !empty($errors['qty']) ? 'border-danger' : '' ?>" 
        type="number"  placeholder="Quantity" required >
        <select name="category_0" class="form-control <?=!empty($errors['category']) ? 'border-danger' : ''?>" required>
            <option value="" hidden>Select Category...</option>
            <option value="Cables">Cables</option>
            <option value="Distilled Water">Distilled Water</option>
            <option value="Panel Rack">Panel Rack</option>
            <option value="Pattress">Pattress</option>
            <option value="Plug">Plug</option>
            <option value="Socket">Socket</option>
            <option value="Spiral Tube">Spiral Tube</option> 
            <option value="others">Others</option>
        </select>

        <button class="remove-item btn btn-danger" onclick="removeItem(this)">Remove</button>
    </div>
</div>

<div id="addMoreContainer" class="col-md-3 mb-3">
    <button type="button" class="btn btn-success add_item_btn" onclick="AddMore()">Add More</button>
</div>

<br>

<div>
    <button type="button" class="btn btn-primary">Cancel</button>
    <button class="btn btn-success float-end" onclick="submitForm()">Submit</button>
</div>

<?php require_once views_path('partials/footer');?>

<script>
    var FieldAmount = 1;
    var stockItems = ['ARRESTOR', 'COPPER TAPE', 'CLAP', 'EARTH ROD', 'INDUSTRIAL SALT', 'WATER HEATER', 'SINGLE PATTRESS', 'DOUBLE PATTRESS', '13AH PLUG', '13AH SOCKET', '15AH PLUG', '15AH SOCKET', '13AH DOUBLE SOCKET', '1 GANG SWITCH', '2 GANG SWITCH', '3 GANG SWITCH', '100AH KNIFE SWITCH NO INDICATOR', '100AH KNIFE SWITCH', '200AH KNIFE SWITCH', '4 LITER RALLY DISTILLED WATER', '5 LITER DISTILLED WATER', '12V SOLAR MOUNTING RACK', '24V SOLAR MOUNTING RACK', '25X40 TRUNKING PIPE', '50X50 TRUNKING PIPE', '0.5MM CABLE FLEX', '1.5MM 2CORE DC CABLE', '2.5MM 2CORE DC CABLE', '2.5MM 4CORE AC CABLE', '4MM 4CORE AC CABLE', '4MM 2CORE DC CABLE', '6MM 2CORE DC CABLE', '6MM 4CORE AC CABLE', '10MM 2CORE DC CABLE', '16MM SINGLE CORE DC CABLE', '16MM 2CORE DC CABLE', '25MM SINGLE CORE DC CABLE', '2.5MM 3CORE AC CABLE', '1.5MM 3CORE AC CABLE', '25x16 TRUNKING PIPE', '16x16 TRUNKING PIPE', '20MM CONDUCT PIPE', '25MM CONDUCT PIPE', '20A WATER HEATER SWITCH', '45A WATER HEATER SWITCH', 'SAFETY ROPE KIT', 'ADAPTABLE BOX', 'SCOTCHAST GUM', '4 GANG SWITCH'];


    function AddMore() {
        var container = document.createElement("div");
        container.classList.add("input-group", "col-xl-6", "mb-4");

        var stock_name = document.createElement("input");
        stock_name.type = "text";
        stock_name.name = "stock_name_" + FieldAmount;
        stock_name.classList.add("js-search", "form-control");
        stock_name.placeholder = "Stock Transfered";
        stock_name.setAttribute("oninput", "searchItem(event)"); // Corrected function name
        stock_name.required = true;

        var suggestionsContainer = document.createElement("div");
        suggestionsContainer.classList.add("suggestions-container"); // Moved this line to create suggestions container

        var quantity = document.createElement("input");
        quantity.type = "number";
        quantity.name = "quantity_" + FieldAmount;
        quantity.step = "0.01";
        quantity.classList.add("quantity", "form-control");
        quantity.placeholder = "Quantity";
        quantity.required = true;

        var stock_category = document.createElement("select");
        stock_category.name = "category_" + FieldAmount;
        stock_category.classList.add("form-control");
        stock_category.required = true;

        var categoryOption1 = document.createElement("option");
        categoryOption1.value = "";
        categoryOption1.textContent = "Select Category...";
        stock_category.appendChild(categoryOption1);

        var categoryOption2 = document.createElement("option");
        categoryOption2.value = "Cables";
        categoryOption2.textContent = "Cables";
        stock_category.appendChild(categoryOption2);

        var categoryOption3 = document.createElement("option");
        categoryOption3.value = "Distilled Water";
        categoryOption3.textContent = "Distilled Water";
        stock_category.appendChild(categoryOption3);

        var categoryOption4 = document.createElement("option");
        categoryOption4.value = "Panel Rack";
        categoryOption4.textContent = "Panel Rack";
        stock_category.appendChild(categoryOption4);


        var categoryOption4 = document.createElement("option");
        categoryOption4.value = "bulb";
        categoryOption4.textContent = "Bulb";
        stock_category.appendChild(categoryOption4);

        var categoryOption4 = document.createElement("option");
        categoryOption4.value = "Pattress";
        categoryOption4.textContent = "Pattress";
        stock_category.appendChild(categoryOption4);

        var categoryOption4 = document.createElement("option");
        categoryOption4.value = "Plug";
        categoryOption4.textContent = "Plug";
        stock_category.appendChild(categoryOption4);

        var categoryOption4 = document.createElement("option");
        categoryOption4.value = "Socket";
        categoryOption4.textContent = "Socket";
        stock_category.appendChild(categoryOption4);

        var categoryOption4 = document.createElement("option");
        categoryOption4.value = "Spiral Tube";
        categoryOption4.textContent = "Spiral Tube";
        stock_category.appendChild(categoryOption4);
        
        var categoryOption4 = document.createElement("option");
        categoryOption4.value = "Accessories";
        categoryOption4.textContent = "Accessories";
        stock_category.appendChild(categoryOption4);

        var categoryOption5 = document.createElement("option");
        categoryOption5.value = "others";
        categoryOption5.textContent = "Others";
        stock_category.appendChild(categoryOption5);


        var removeButton = document.createElement("button");
        removeButton.classList.add("remove-item", "btn", "btn-danger");
        removeButton.type = "button";
        removeButton.textContent = "Remove";
        removeButton.addEventListener("click", function() {
            removeItem(this);
        });

        container.appendChild(stock_name);
        container.appendChild(suggestionsContainer); // Append suggestions container
        container.appendChild(quantity);
        container.appendChild(stock_category);
        container.appendChild(removeButton);

        document.getElementById("item-container").appendChild(container);

        FieldAmount++;
    }

        
    function submitForm() {
        // Add your form submission logic here
    }

    function searchItem(event) {
            const inputElement = event.target;
            const inputValue = inputElement.value.trim().toLowerCase();
            const suggestionsContainer = inputElement.parentNode.querySelector('.suggestions-container');

            // Clear previous suggestions
            suggestionsContainer.innerHTML = '';

            // Filter and display matching suggestions
            const matchingItems = stockItems.filter(item => item.toLowerCase().includes(inputValue));
            matchingItems.forEach(item => {
                const suggestionItem = document.createElement('div');
                suggestionItem.classList.add('suggestion-item');
                suggestionItem.textContent = item;
                suggestionItem.addEventListener('click', () => selectSuggestion(item, inputElement));
                suggestionsContainer.appendChild(suggestionItem);
            });
        }

        function selectSuggestion(item, inputElement) {
            inputElement.value = item;
            // You can perform additional actions when a suggestion is selected
            // For example, close the suggestions dropdown, fetch more details, etc.
            inputElement.parentNode.querySelector('.suggestions-container').innerHTML = '';
        }


        function removeItem(button) {
        var itemContainer = button.parentNode;
        itemContainer.parentNode.removeChild(itemContainer);
    }

</script>
