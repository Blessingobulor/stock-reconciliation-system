
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
     <a href="index.php?pg=cctv_return_inward_report">
        <button class="btn btn-info float-end" style="background-color:#4CAF50; font-weight: bold; width:200px; font-size: 16px; color: white; border-style: outset; font-family: monospace; margin: 30px; padding-right: 20px; color: none; top: 20px; text-decoration: none; display: flex;"> View Report</button>
    </a>

    <form id="stock-form" name="myform" method="post">
        <center>
            <br>
            <h3 style="position: center; padding-left: 60px;"><i class="fa fa-dolly"><br></i> CCTV Customer Return Inward</h3>
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
                 <option>CCTV Store</option>
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
            <option value="wired camera">Wired Camera</option>
            <option value="solar camera">Solar Camera</option>
            <option value="cable">Cable</option>
            <option value="Dvr">DVR</option>
            <option value="HDMI Cable">HDMI Cable</option>
            <option value="Wifi Router">Wifi Router</option>
            <option value="Hard Drive">Hard Drive</option>
            <option value="Hard Drive">Hard Drive</option>
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
    var stockItems = ['CCTV STOCK STOCKNAME', 'RG59 POWER COAXIAL CABLE', '8 CHANNEL DVR 2MP', '4 CHANNEL DVR 4MP', '8 CHANNEL DVR 4MP', '16 CHANNEL DVR 4MP', 
    '8 CHANNEL DVR 5MP', '16 WAYS POWER BOX', '8 WAYS POWER BOX', 'POWER ADPTOR', '10M HDTV CABLE(HDMI)', '5M HDTV CABLE(HDMI)', 'OLAX 4G WIFI ROUTER', '3K SMART HYBRID DOME INDOOR CAMERA (AUDIO AND COLOR) ', 
    '3K SMART HYBRID BULLET CAMERA(OUTDOOR)', 'ESEECLOUD DUAL LENS SOLAR CAMERA', 'ESEECLOUD SINGLE LENS SOLAR CAMERA', 'V380PRO DUAL LENS SOLAR CAMERA', 'UBOX SINGLE LENS SOLAR CAMERA', 
    'UBOX DUAL LENS SOLAR CAMERA', '128GB SD CARD', '64GB SD CARD ', '32GB SD CARD', 'V380 SPY BULB WIFI CAMERA', 'SPY BULB CAMERA', '4-WAYS POWER SUPPLY BOX', 'SONYVISION 5MP CAMERA', 
    'SONYVISION 2MP CAMERA', '1TRB HARDDRIVE', '2 TRB HARDDRIVE', '4TRB HARDDRIVE', 'CAT 6 CABLE', '3K SMART DUAL LIGHT CAMERA(INDOOR)', '16 CHANNEL DVR 2MP', 'HD KIT 1080P CAMERA', 'SONY HD RECORDER', 
    '3K SMART HYBRID INDOOR WITHOUT AUDIO', '1080P COLOURVU INDOOR CAMERA', '1080P HIKVISON CAMERA', '2MP HIKVISION CAMERA INDOOR', '4-CHANNEL 5MP DVR', '2MP HIKVISION OUTDOOR CAMERA', '5MP HIKVISION INDOOR CAMERA', 
    '5MP HIKVISION OUTDOOR CAMERA', 'WARNING LAMP', 'SMOKE ALARM', 'NOVEL HD INFARRED WATERPROOF INDOOR CAMERA', 'NOVEL HD INFARRED WATERPROOF OUTDOOR CAMERA', 'HD CCTV INFARRED WATERPROOF OUTDOOR', 
    'HD CCTV INFARRED WATERPROOF INDOOR', 'HD CCTV IP CAMERA', 'ELCO VISION CAMERA OUTDOOR', 'ELCO VISION CAMERA INDOOR', 'AHD CAMERA OUTDOOR CAMERA', 'IR WEATHERPROOF OUTDOOR CAMERA', 'D-LINK NVR', 
    'VR PANORAMIC CAMERA', 'D-LINK WIFI ROUTER 3G', 'D-LINK CLOUD CAMERA', 'SIREN HORN', 'MINI CAMERA', 'SMOKE DETECTOR', 'CCD CCTV CAMERA', 'HIGH SENSITIVITY CCD CAMERA', 'EMERGENCY BREAK GLASS', 
    'SAFETY SECURITY CAMERA (BROWN CARTON)'];

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
        categoryOption5.value = "Wired Camera";
        categoryOption5.textContent = "Wired Camera";
        stock_category.appendChild(categoryOption5);

        var categoryOption5 = document.createElement("option");
        categoryOption5.value = "Solar Camera";
        categoryOption5.textContent = "Solar Camera";
        stock_category.appendChild(categoryOption5);


        var categoryOption5 = document.createElement("option");
        categoryOption5.value = "Cable";
        categoryOption5.textContent = "Cable";
        stock_category.appendChild(categoryOption5);

        var categoryOption5 = document.createElement("option");
        categoryOption5.value = "DVR";
        categoryOption5.textContent = "DVR";
        stock_category.appendChild(categoryOption5);

        var categoryOption5 = document.createElement("option");
        categoryOption5.value = "Power Box";
        categoryOption5.textContent = "Power Box";
        stock_category.appendChild(categoryOption5);

        var categoryOption5 = document.createElement("option");
        categoryOption5.value = "HDMI Cable";
        categoryOption5.textContent = "HDMI Cable";
        stock_category.appendChild(categoryOption5);

        var categoryOption5 = document.createElement("option");
        categoryOption5.value = "Wifi Router";
        categoryOption5.textContent = "Wifi Router";
        stock_category.appendChild(categoryOption5);

        var categoryOption5 = document.createElement("option");
        categoryOption5.value = "Hard Drive";
        categoryOption5.textContent = "Hard Drive";
        stock_category.appendChild(categoryOption5);

        var categoryOption5 = document.createElement("option");
        categoryOption5.value = "Lamp";
        categoryOption5.textContent = "Lamp";
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
