
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
     <a href="index.php?pg=electronics_return_inward_report">
        <button class="btn btn-info float-end" style="background-color:#4CAF50; font-weight: bold; width:200px; font-size: 16px; color: white; border-style: outset; font-family: monospace; margin: 30px; padding-right: 20px; color: none; top: 20px; text-decoration: none; display: flex;"> View Report</button>
    </a>

    <form id="stock-form" name="myform" method="post">
        <center>
            <br>
            <h3 style="position: center; padding-left: 60px;"><i class="fa fa-dolly"><br></i> ELectronics Customer Return Inward</h3>
        </center>

        <div class="mb-3 mt-3">
            <label for="returnstockidControlInput1" class="form-label">Return Stock Id</label>
                <input type="text" class="form-control" name="return_stock_id" id="id" value ="RTS<?= rand(1000, 9999) ?>" readonly>

            <?php if(!empty($errors['return_stock_id'])):?> 
                <small class="text-danger"><?=$errors['return_stock_id']?></small>
            <?php endif;?>
        </div>

        <div class="mb-3 mt-3">
            <label for="branchControlInput1" class="form-label">Branch Name</label>
            <select name="branch_name" class="form-control <?=!empty($errors['branch_name']) ? 'border-danger' : ''?>" id="branchnameControlInput1" placeholder="branch name">
                <option selected>Choose...</option>
                 <option>Electronics Store</option>
            </select>
            <?php if(!empty($errors['branch_name'])):?>
                <small class="text-danger"><?=$errors['branch_name']?></small>
            <?php endif;?>
        </div>

        <div class="mb-3 mt-3">
            <label for="customernameControlInput1" class="form-label">Customer Name</label>
            <input type="name" name="customer_name" class="form-control <?=!empty($errors['customer name']) ? 'border-danger' : ''?>" id="customernameControlInput1">
            <?php if(!empty($errors['customer_name'])):?>
                <small class="text-danger"><?=$errors['customer_name']?></small>
            <?php endif;?>
        </div>

        
        <div class="mb-3 mt-3">
            <label for="dateControlInput1" class="form-label">Return Date</label>
            <input type="date" name="date" class="form-control <?=!empty($errors['date']) ? 'border-danger' : ''?>" id="dateControlInput1">
            <?php if(!empty($errors['date'])):?>
                <small class="text-danger"><?=$errors['date']?></small>
            <?php endif;?>
        </div>


 <div class="mb-3 mt-3">
            <label for="reasonsforreturnofstockControlInput1" class="form-label">Reasons For Stock Return</label>
            <select name="reasons_for_return_of_stock" class="form-control <?=!empty($errors['reasons_for_return_of_stock']) ? 'border-danger' : ''?>" id="reasonsforreturnofstockControlInput1" placeholder="Choose your reasons for the return of stock">
                <option selected>Choose...</option>
                 <option>Damaged</option>
                 <option>Replacement for new stock</option>
                  <option>Not Specified</option>
            </select>
            <?php if(!empty($errors['reasons_for_return_of_stock'])):?>
                <small class="text-danger"><?=$errors['reasons_for_return_of_stock']?></small>
            <?php endif;?>
        </div>


        <h5>Add Stock Returned</h5>
    <div id="item-container">
        <div class="input-group col-xl-6 mb-4">
        <input name="stock_name_0" class="js-search form-control <?=!empty($errors['qty']) ? 'border-danger' : ''?>" oninput="searchItem(event)" placeholder="Stock Returned" required>
         <div class="suggestions-container"></div>


        <input name="quantity_0" class="quantity form-control <?=!empty($errors['qty']) ? 'border-danger' : ''?>" type="number" placeholder="Quantity" required>
        <select name="category_0" class="form-control <?=!empty($errors['category']) ? 'border-danger' : ''?>" required>
            <option value="" hidden>Select Category...</option>
            <option value="Solar Freezer">Solar Freezer</option>
            <option value="Light">Light</option>
            <option value="Fan">Fan</option>
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
    var stockItems = ['SOLAR FREEZER'];

        function AddMore() {
        var container = document.createElement("div");
        container.classList.add("input-group", "col-xl-6", "mb-4");

        var stock_name = document.createElement("input");
        stock_name.type = "text";
        stock_name.name = "stock_name_" + FieldAmount;
        stock_name.classList.add("js-search", "form-control");
        stock_name.placeholder = "Stock Returned";
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

        var stock_category = document.createElement("select");
        stock_category.name = "category_" + FieldAmount;
        stock_category.classList.add("form-control");
        stock_category.required = true;

        var categoryOption1 = document.createElement("option");
        categoryOption1.value = "";
        categoryOption1.textContent = "Select Category...";
        stock_category.appendChild(categoryOption1);

        var categoryOption5 = document.createElement("option");
        categoryOption5.value = "Solar Freezer";
        categoryOption5.textContent = "Solar Freezer";
        stock_category.appendChild(categoryOption5);

        var categoryOption5 = document.createElement("option");
        categoryOption5.value = "Light";
        categoryOption5.textContent = "Light";
        stock_category.appendChild(categoryOption5);

        var categoryOption5 = document.createElement("option");
        categoryOption5.value = "Fan";
        categoryOption5.textContent = "Fan";
        stock_category.appendChild(categoryOption5);

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
        container.appendChild(suggestionsContainer); 
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
