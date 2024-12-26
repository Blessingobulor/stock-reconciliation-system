

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
     <a href="index.php?pg=akinjide_sales_report">
        <button class="btn btn-info float-end" style="background-color:#4CAF50; font-weight: bold; width:200px; font-size: 16px; color: white; border-style: outset; font-family: monospace; margin: 30px; padding-right: 20px; color: none; top: 20px; text-decoration: none; display: flex;"> View Report</button>
    </a>
 
    <form id="stock-form" name="myform" method="post">
        <center>
            <br>
           <h3><i class="fa fa-dolly"><br></i> Akinjide Sales</h3>
        </center>

        <div class="mb-3 mt-3">
            <label for="salesidControlInput1" class="form-label">Sales Id</label>
                <input type="text" class="form-control" name="sales_id" id="id" value ="S<?= rand(1000, 9999) ?>" readonly>

            <?php if(!empty($errors['sales_id'])):?>
                <small class="text-danger"><?=$errors['sales_id']?></small>
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
            <label for="branchnameControlInput1" class="form-label">Branch Name</label>
            <select name="branch_name" class="form-control <?=!empty($errors['branch_name']) ? 'border-danger' : ''?>" id="branchnameControlInput1" placeholder="branch_name">
                <option selected>Choose...</option>
                <option>Akinjide Store</option>
            </select>
            <?php if(!empty($errors['branch_name'])):?>
                <small class="text-danger"><?=$errors['branch_name']?></small>
            <?php endif;?>
        </div>


        <div class="mb-3 mt-3">
            <label for="dateControlInput1" class="form-label">Date</label>
            <input type="date" name="date" class="form-control <?=!empty($errors['date']) ? 'border-danger' : ''?>" id="dateControlInput1" placeholder="Date">
            <?php if(!empty($errors['date'])):?>
                <small class="text-danger"><?=$errors['date']?></small>
            <?php endif;?>
        </div>

        <h5>Add Stock Sold</h5>
        <div id="item-container">
        <div class="input-group col-xl-6 mb-4">
        <input name="stock_name_0" class="js-search form-control <?=!empty($errors['qty']) ? 'border-danger' : ''?>" oninput="searchItem(event)" placeholder="Stock Sold" required>
         <div class="suggestions-container"></div>

        <input name="quantity_0" class="quantity form-control <?=!empty($errors['qty']) ? 'border-danger' : ''?>" type="number" placeholder="Quantity" required>
        <select name="category_0" class="form-control <?=!empty($errors['category']) ? 'border-danger' : ''?>" required>
            <option value="" hidden>Select Category...</option>
            <option value="panel">Panel</option>
            <option value="inverters">Inverters</option>
            <option value="kits">Kits</option>
            <option value="bulb">Bulb</option>
            <option value="floodlight">Floodlight</option>
            <option value="fan">Fan</option>
            <option value="panel rack">Panel Rack</option>
            <option value="solar freezer">Solar Freezer</option> 
            <option value="Battery">Battery</option> 
            <option value="solar camera">solar camera</option> 
            <option value="cable">cable</option>
            <option value="stabilizer">stabilizer</option>
            <option value="power inverter">power inverter</option>
            <option value="distilled water">distilled water</option>
            <option value="trunking pipe">trunking pipe</option>
            <option value="breaker">breaker</option>
            <option value="knife switch">knife switch</option>
            <option value="others">Others</option>
        </select>
        <input name="stock_serial_number_0" class="stock_serial_number form-control <?= !empty($errors['stock_serial_number']) ? 'border-danger' : '' ?>" type="text" placeholder="Stock Serial Number">

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
    var stockItems = ['120A/48V FELICITY MPPT C.C', '100A/48V  FELICITY MPPT CHARGE CONTROLLER', '100A/48V YOHAKO MPPT  CHARGE CONTROLLER', '100A/48V SUNFIELD MPPT C.C', '100A/96V SUNFIELD MPPT C.C', '100A/48V SUNLUX PWM C.C', '100A/12/24V SUNLUX PWM C.C', '100A/12-48V SUNLUX PWM C.C', '100A SUNLUX SMART  CHARGER PWM  C.C', '80A/48V YOHAKO MPPT C.C', '80A 12/48V NEXUS PWM C.C', '80A/12-48V SUNFIELD MPPT C.C', '80A/48V SUNFIELD MPPT C.C', '80AH/12V-48V SUNLUX PWM C.C', '80A/96V MPPT C.C', '80A/48V NOVEL MPPT C.C', '80A/48V FELICITY  MPPT C.C', '80A/120V YOHAKO MPPT C.C', '80AH/12/24V PWM C.C', '60A/48V C.C', '60A/48V SUNFIELD MPPT C.C', '60A FANCOOL  MPPT C.C', '60A/12/24V NOVEL PWM  C.C', '60A /12/24V SUNLUX PWM C.C ORANGE CARTON', '60A/12/24V SUNLUX PWM C.C BLUE', '60A/12-48V SUNLUX PWM C.C', '60A/12-48V HEATSINK ROHS MPPT C.C', '60A MPPT C.C BROWN CARTON', '60A 12/48V CM60487 PWM C.C', '60A/48 NOVEL MPPT C.C', '50A/48V ROY  SOLAR PWM C.C', '50A/48V NEXUS PWM C.C', '50A/12-48V SUNFIELD PWM C.C', '50A/48 SUNLUX  PWM C.C', '50A/12V/24V SUNLUX PWM C.C', '50A/12-48V SMS PWM C.C', '40A/12-48V SUNLUX PWM C.C', '40A/12/24V SUNLUX PWM C.C', '40A 12/24V HEATSINK MPPT C.C', '40A/12-24V  NOVEL MPPT C.C', '40A 12/24V PWM C.C', '40A 12/24V SUNFIELD PWM C.C', '40A/12-48V SUNLUX PWM C.C', '40A/60A PWM C.C', '40A/12-24V POWER MPPT C.C', '30A 12/24V MPPT C.C', '30A NOVEL MPPT C.C', '30A/12/24V SUNLUX PWM C.C', '30A/12/24V  COSTLIGHT PWM C.C', '30A/12-24V  ROHS MPPT C.C', '30A/12-24V FELICITY PWM C.C', '30A/12-24V BLUE CARTOON PWM C.C', '30A SUNFIELD MPPT C.C', '30A 12/24 KLS PWM C.C', '20AH/12-24V SUNSHINE/SUNLIGHT PWM C.C', '20A/12,24V SMC PWM C.C', '20A/12/24V  [BLUE&WHITE CARTON] PWM C.C', '20A/12-24V SUNLUX PWM C.C', '10A/12-24V BLUE/WHITE  PWM C.C', '10A/12-24V PWM C.C', '10A/12-24V  SUNLUX  PWM C.C', '10AH/12V-24V SUNSHINE PWM C.C', '10A/12,24V SUNLIGHT PWM C.C', '10A/12,24V RESTAR PWM C.C', '10A/12,24V SMC PWM C.C', '5AH ROHS PWM C.C', '5A/12,24V PWM C.C', '12 ALFANA 3 IN 1', '12 DURAVOLT RECHARGEABLE TABLE FAN', '12 DURAVOLT RECHARGEABLE TABLE FAN WITHOUT PANEL', '12 DURAVOLT RECHARGEABLE FAN WITH PANEL', '12 DURAVOLT RECHARGEABLE FAN WITHOUT PANEL', '12/16 TNT RECHARGEABLE FAN', '14 DURAVOLT RECHARGEABLE TABLE FAN', '14 IWIN RECHARGEABLE TABLE FAN', '16 BONA AC/DC FAN', '16 BONA DC RECHARGEABLE FAN', '16 GF RECHARGEABLE FAN', '16 DURAVOLT RECHARGEABLE STANDING FAN WITHOUT PANEL', '16 AC DURAVOLT FAN', '16 SOLAR STANDING FAN', '16 DURAVOLT STANDING RECHARGEABLE FAN WITH PANEL', '16 BOSCON RECHARGEABLE STANDING FAN', '16 DURAVOLT RECHARGEABLE TABLE FAN', '16 DURAVOLT DC STANDING FAN', '16 IWIN RECHARGEABLE FAN', '16 CLOUD DC STANDING FAN', '16 V218 RECHARGEABLE STANDING FAN', '16 INCHES POWER DELUXE WALL FAN', '18 QASA AC/DC FAN', '18 NOVEL RECHARGEABLE FAN', '18 QASA RECHARGEABLE STANDING FAN', '18 CENTURY RECHARGEABLE WALL FAN', '18 CENTURY RECHARGEABLE FAN', '18 IWIN RECHARGEABLE FAN', '18 BOSCON RECHARGEABLE  STANDING FAN', '18 FST AC/DC FAN', '18 DURAVOLT RECHARGEABLE FAN', '18 DURAVOLT DC STANDING FAN', '18 WINWIN RECHARGEABLE FAN', '18 CENTURY INDUSTRIAL STANDING FAN', '18 BOSCON INDUSTRIAL STANDING FAN', '18 INCHES MIST CENTURY RECHARGEABLE FAN', '56 ECOOL AC/DC CEILING FAN', '56 DURAVOLT AC/DC CEILING FAN', '56 AE MEM DC CEILING FAN', 'E COOL OX DC CEILING FAN', '56 AC/DC CEILING FAN', 'QASA ORBIT FAN', 'QASA DC CEILING FAN', 'QASA ORBIT MOTOR FAN', 'A&E CEILING FAN', 'SOLAR KIT', 'CAFINI 227', 'LITE 5 SILVER', 'CAFINI 226', 'LITE 5 GOLD', 'CAFINI 177', 'CAFINI 8857', 'CAFINI 7503', 'CAFINI427 SOLAR HOME LIGHTING', '3000MAH RECHARGEABLE FAN', '4000MAH RECHARGEABLE FAN', 'DC ELECTRIC COOKER', 'SOLAR LIGHTING SYSTEM (4 BULBS)', 'SOLAR LIGHTING SYSTEM (2 BULBS)', 'SUNAFRICA SOLAR LIGHTING KIT', 'SALPHA JET FAN', 'LITE 6 PRO', 'LITE 7 KIT', '1220W SUPERVISION SOLAR GENERATOR', '1230W SUPERVISION SOLAR GENERATOR', '1250W S.G', '300W SOLAR AC IRON', 'GP-2000 SUNLUX S.G', 'GP-3000 SUNLUX S.G', '0503 BOSCON SOLAR GENERATOR', 'XTREME SOLAR GENERATOR', '3AH/3.7V SARODA LAMP', '8000MAH POWER BANK', 'DC BLENDER', '1260 NOVEL SOLAR GENERATOR', '1250 NOVEL SOLAR GENERATOR', '150W DC IRON', '500W CLOUD SUNBOX SOLAR GENERATOR', '1230 BOSCON SOLAR GENERATOR', 'SALPHA BLAZE KIT', 'SALPHA SPARK KIT', 'BEEBEE JUMP S1', '1W 12V LED DC BULB WHITE CARTON IRON', '2W LED HIGH POWER LAMP DC SCREW', '3W DC BULB', '3W DC CLOUD BULB', '3W SANKI DC BULB', '3W AC CTORCH BULB', '3W 12V LED DC BULB WHITE CARTON IRON', '3W USB BULB', '3W SUNLIGHT DC BULB', '3W/12V HIGH POWER DC BULB', 'GREEN AKT 3W AC BULB', '3W SKYLIGHT DC BULB', '5W SANKI DC BULB', '5W DC BULB WHITE CARTON', '5W C-TORCH AC BULB', '5W BOSCON AC BULB', '5W CLOUD AC BULB', '5W LED DC BULB', '5W USB AC BULB', 'AKT LIGHTENING EFFICI 5W E27', '5W CLOUD DC BULB', '5W DC BULB WHITE CARTON', '5W VELLMAX AC BULB', '5W SKYLIGHT AC BULB', '5W SKYLIGHT DC BULB', '5W USB DC BULB', '5W TWILIGHTING DC BULB', '5W ECONOMIN LED AC BULB', '5W ECONOMIN LED BULB E27', '5W SUPERBRIGHT  DC BULB E27', '5W RESTAR DC BULB', '5W LED WINWIN LED BULB', '5W T8 LED TUBE FLOURESCENT BULB', '5W SUNLIGHT DC BULB', 'GREEN AKT 5W E27 BULB', '5W WINWIN LED PANEL LIGHT', '5W WAKATECH LED BULB', '5W PHILIP E14 BULB', '5W HIGH POWER LAMP DC BULB', '6W C TORCH B22 BULB AC', '7W ECONOMIN LED BULB', '7W XG-7207 AC BULB', '7W EMERGENCY RECHARGEABLE BULB', '7W RECHARGEABLE', '7W C TORCH B27', '7W USB DC BULB', '7W WINWIN AC BULB', '8W ECOMIN AC BULB', '8W ECONOMIN B22', '8W ECONOMIN B27', '8W AKT FLOURESCENT BULB', 'GREEN AKT 8W E27 LED BULB', '9W OHREASSA RECHARGEABLE BULB', '9W RECHARGEABLE BULB', '9W T8 FLOURESCENT AKT BULB', '9W AKT FLOURESCENT BULB', '9W LED DC BULB', '9W BALL BUBBLE RECHARGEABLE BULB', '9W LED AC BULB', '10W DC LED BULB  WHITE AND BLUE CARTOON', '10W OHREASSA RECHARGEABLE BULB', '10W WINWIN SMD FLOODLIGHT AC', '10W DC SUPERBRIGHT BULB B22', '10W T8 LED TUBE FLOURESCENT BULB', '12 WIN WIN AC BULB', '12W  WINWIN LED PANEL LIGHT', '12W AKT AC BULB', '12W HIGH POWER LAMP DC BULB', '15W RESTAR AC BULB', '15W WINWIN LIGHTING', 'AKT 15W LED HALF SPIRAL BULB', '16W AKT FLOURESCENT BULB', '16W WINWIN LED PANEL LIGHT', '18W PHILIP E27 BULB', '18W BALL BUBBLE RECHARGEABLE BULB', '18W AKT AC BULB', '18W WINWIN LED PANEL LIGHT', '20W PHILIP B22 BULB', '23W PHILIP AC BULB', '24W WINWIN LED PANEL LIGHT', '24W OHREASSA RECHARGEABLE BULB', 'AKT LIGHTENING 26W B22 BULB', 'AKT LIGHTENING 26W E27 BULB', '28W WIN-WIN PORTABLE LIGHT', '30W LED BULB FOR 1260', '30W LED LIGHT', '30W WINWIN SMD FLOODLIGHT AC', '30W WINWIN LED TL519-30', '30WINWIN S19', '30WINWIN S20', '50W NDC LED FLOODLIGHT', '50W AC LED FLOODLIGHT', '50W ROSY LIGHT', '50W MUNDFO RECHARGRABLE BULB', 'T8 TUBELIGHT LONG', 'T8 TUBELIGHT SHORT', 'MOTION SENSOR WALL SOLAR PANEL', 'DC FLORESCENT BULB', 'BYG SOLAR KIT WITH 3 BULBS', 'POWER INVERTER', '3000W POWER INVERTER SCL ALONE', '3000W SUOER POWER INVERTER WITH CHARGER', '300W GS POWER INVERTER WITHOUT CHARGER', '3000W POWER INVERTER WITHOUT CHARGER', '2000W SCL POWER INVERTER', '2000W SUOER POWER INVERTER', '2000W  SUOER POWER INVERTER WITH CHARGER', '2000W POWER INVERTER WITHOUT CHARGER', '1500W GS POWER INVERTER WITHOUT CHARGER', '1000W GS POWER INVERTER WITHOUT CHARGER', '1000W POWER INVERTER WITH CHARGER', '1000W SUOER POWER INVERTER WITH CHARGER', '1000W SCL POWER INVERTER WITH CHARGER', '1000W SCL POWER INVERTER WITHOUT CHARGER', '1000W SUOER POWER INVERTER ALONE', '1000W POWER INVERTER WITHOUT CHARGER', '100W EASTERN POWER INVERTER WITH CHARGER', '600W KEYE POWER INVERTER', '500W POWER INVERTER WITH CHARGER', '500W AISHANG POWER INVERTER', '500W SUOER POWER INVERTER WITH CHARGER', '500W JONGFA POWER INVERTER WITH CHARGER', '500W  POWER INVERTER ALONE', '500W GS POWER INVERTER', '300W GS POWER INVERTER', '300W POWER INVERTER WITHOUT CHARGER', '300W RESTAR POWER INVERTER', '300W SUOER POWER INVERTER WITH CHARGER', '300W VINWELL INVERTER', '200W BYGD POWER INVERTER', '150W CAR INVERTER', '5.1KW/24V LITHIUM BATTERY', '15KWH/48V YOHAKO LITHIUM BATTERY', '10KWH/48V LITHIUM BATTERY', '15KWH/48V NOVEL LITHIUM BATTERY', '10KWH/48V NOVEL LITHIUM BATTERY', '10KWH/48V SUNLUX LITHIUM BATTERY', '15KWH/48V SUNLUX LITHIUM BATTERY', '230AH/12V NOVEL TUBULAR BATTERY', '220AH/12V SUNFLASQ TUBULAR BATTERY', '220AH/12V STARPLUS TUBULAR BATTERY', '220AH/12V QUANTA TUBULAR BATTERY', '220AH/12V SUPER SPEED TUBULAR BATTERY', '220AH/12V SOCCER POWER BATTERY', '200AH/12V COSMOS BATTERY', '200AH/12V TYL DRY CELL BATTERY', '200AH/12V IWIN BATTERY', '100AH/12V COSMOS BATTERY', '100AH/12V IWIN BATTERY', '65AH/12V SUNFIT BATTERY', '40AH/12V HONSHU BATTERY', '40AH/12V SUNFIT BATTERY', '26AH/12V CROCS BATTERY', '26AH/12V HONSHU BATTERY', '18AH/12V HONSHU BATTERY', '18AH/12V CROC BATTERY', '18AH/12V SUNFIT BATTERY', '18AH/12V PRUDENT BATTERY', '12AH/12V SUNFIT BATTERY', '12AH/12V LEOCH BATTERY', '12AH/12V PRUDENT BATTERY', '8AH/4V GSL BATTERY', '8AH/4V WELSHENG BATTERY', '8.7KWH/48V NOVEL LITHIUM BATTERY', '7.2AH/12V BOSCON BATTERY', '7AH/6V QASA BATTERY', '7AH/12V QASA BATTERY', '7AH/12V RESTAR BATTERY', '7AH/6V PRUDENT BATTERY', '4.5AH/6V CENTURY BATTERY', '4.5AH/6V BOSCON BATTERY', '4.5AH/6V QASA BATTERY', '4.5AH/12V QASA BATTERY', 'PUMP', '96/1500 DC PUMP', '1.5HP DC PUMP', '370W/48V DC PUMP', '750W/48V DC PUMP', '1.1KW LEO SOLAR PUMP', 'BONA DC PUMP', 'GRUNDFOS', '1KVA BOSCON VOLTAGE REGULATOR', '5000VA DE-BULL VOLTAGE REGULATOR', '10000VA DE-BULL VOLTAGE REGULATOR', '1KVA CENTURY STABILIZER', '2KVA CENTURY STABILIZER', '5KVA CENTURY VOLTAGE STABILIZER', '6KVA STABILIZER', '8KVA CENTURY VOLTAGE STABILIZER', '10KVA CENTURY VOLTAGE STABILIZER', '15KVA/220V JORDY ELLE STABILIZER', '20KVA/220V STABILIZER', '20KVA SVC STABILIZER', '1000W UPS POWER INVERTER & CHARGER', '650VA VECTRONICS UPS', '1050VA MERCURY UPS', '650VA MERCURY UPS', '100L/55W SOLAR FRIGDE', '118L BONA FREEZER', '218L  BONA FREEZER', '318L BONA FREEZER', '168L BONA FREEZER', '158L KOOLBOKS FREEZER', '208L KOOLBOKS SOLAR FREEZER', 'BD-538 KOOLBOKS FREEZER', 'SOLAR CONDITIONER BONA', 'CLOUD CHILLER', 'DC WATER HEATER', '560W/24V ENERGY CITY MONO PANEL', '550W/24V SUNLUX MONO PANEL', '550W/24V GALAXY MONO SOLAR PANEL', '550W/24V TOKUNBO PANEL', '545W/24V JINKO MONO PANEL', '540W/24V GALARY MONO SOLAR PANEL', '480W/24V SUNLUX MONO SOLAR PANEL', '480W/24V MONO SOLAR PANEL', '460W/24V A35 HALF CUT MONOCRYSTALLINE SOLAR PANEL', '460W24V MONO PANEL', '460W/24V DOUBLE GLASS MONO PANEL', '450W/24V JINKO SOLAR PANEL', '450W/24V ENERGY CITY MONO PANEL', '450W/24V RESTAR MONO PANEL', '450W/24V NAKED PANEL', '450W/24V BONA MONO PANEL', '450W/24V DOUBLE GLASS MONO PANEL', '450W/24V YINGLI MONO SOLAR PANEL', '450W/24V MONO PANEL', '430W/24V MONO PANEL', '410W/24V SUNLUX SOLAR PANEL', '410W/24V MONO PANEL', '410W/24V SOLAR MODULE', '400W/24V ROYSOLAR MONO PANEL', '400W/24V AFRICELL MONO PANEL', '400W/24V SOLAR PANEL', '400W/24V SUNLUX  MONO PANEL', '400W/24V MORNYRAY MONO PANEL', '380W/24V NOVEL MONO PANEL', '380W/24V MONO SOLAR PANEL', '380W/24V POLY PANEL', '375W/24V MONOCRYSTALLINE SOLAR PANEL', '365W/24V NOVELSOLAR MONO PANEL', '360W/24V MONO PANEL', '350W/24V RESTAR SOLAR PANEL', '350W/24V GRID SOLAR PANEL', '350W/24V SUNFIELD MONO PANEL', '350W/24V SUNLUX MONO SOLAR PANEL', '350W/24V MONO PANEL', '340W/24V NOVEL MONO PANEL', '330W ELEGUSHI PANEL', '330W/24V AFRICELL MONO PANEL', '330W/24V MONO SOLAR PANEL', '325W/24V MONO PANEL', '300W/24V SUNSHINE MONO SOLAR PANEL', '300W/24V MONO SOLAR PANEL', '300W/24V AFRICELL NAKED PANEL', '300W/24V NOVEL MONO PANEL', '300W/24V SUNLUX MONO PANEL', '300W/24V SUNFIELD MONO SOLAR PANEL', '300W/24V RUBITEC MONO SOLAR PANEL', '300W/24V AFRICELL MONO PANEL', '280W/24V SUNGENE MONOCRYSTALLINE SOLAR PANEL', '280W/24V MONO PANEL', '265W/24V MONO PANEL', '250W/24V MONO PANEL', '235W/24V TOKUNBO MONO SOLAR PANEL', '215W/24V TOKUNBO PANEL', '210W ULTRON PANEL', '210W/24V RESTAR MONO PANEL', '210W/24V MONO PANEL', '200W/24V MONO PANEL', '200W/12V MONO SOLAR PANEL', '200W/12V SUNSHINE MONO SOLAR PANEL', '200W/24V NEPTUNE MONO SOLAR PANEL', '190W/24V TOKUNBO PANEL', '188W/24V TOKUNBO PANEL', '180W/12V SUNLUX MONO SOLAR PANEL', '180W/12V SUNSHINE MONO SOLAR PANEL', '180W/12V SUNFIELD MONO SOLAR PANEL', '180W/12V SUNGENE MONO PANEL', '180W/12V AFRICELL MONO PANEL', '180W/12V NOVEL MONO PANEL', '180W/12V MONO SOLAR PANEL', '180W/12V BONA MONO PANEL', '150W/12V MONO SOLAR PANEL', '100W/12V SUNSHINE SOLAR PANEL', '100W/12V MONO PANEL', '100W/12V POLY PANEL', '80W/12V MONO PANEL', '80W/12V SUNSHINE PANEL', '60W/12V RESTAR SOLAR PANEL', '60W/12V SUNSHINE MONO PANEL', '60W/12V MONO PANEL', '50W/12V BONA MONO PANEL', '50W/12V SUNSHINE MONO SOLAR PANEL', '50W/12V MONO PANEL', '40W/12V MONO SOLAR PANEL', '40W/12V RESTAR MONO SOLAR PANEL', '40W/12V BONA/SUNSHINE MONO SOLAR PANEL', '30W/12V MONO SOLAR PANEL', '30W/12V QASA MONO SOLAR PANEL', '25W/6V CAFINI PANEL', '20W/12V MONOCRYSTALLINE SOLAR PANEL', '20W/12V SUNSHINE MONO SOLAR PANEL', '20W/12V QASA MONO PANEL', '20W/12V DURAVOLT MONO SOLAR PANEL', '15W YINGLI PANEL', '12W/6V ROYSOLAR PANEL', '10W SOLAR PANEL', '10W/6V WIN LAMP SOLAR PANEL', '6W/6V SARODA PANEL', '5.5W/6V PANEL', '3W/6V PANEL', '200W MORNYRAY FLOODLIGHT DOUBLE PANEL', '150W MORNYRAY FLOODLIGHT SINGLE PANEL', '4KVA/48V LUMINOUS INVERTER', '1.2KVA/12V ADDO INVERTER', '900VA/12V ADDO INVERTER', '1.6KVA/24V KAN INVERTER', '5KVA/24V POWERSTAR INVERTER', '10KVA/48V POWERSTAR INVERTER', '3.5KVA/24V TUSKER ENERGY INVERTER', '1.2KVA/12V TUSKER ENERGY HYBRID INVERTER', '1.5KVA/12V TUSKER ENERGY HYBRID INVERTER', '3.5KVA/24V AFRIPOWER INVERTER', '3.5KVA/48V AFRIPOWER INVERTER', '1KVA/12V AFRIIPOWER INVERTER', '10KVA/96V NOVEL INVERTER', '1KVA NOVEL HYBRID INVERTER', '5KVA/48V NOVEL YELLOW SERIES INVERTER', '5KVA/48V NOVEL HYBRID INVERTER WHITE CARTON', '3.5KVA/48V NOVEL HYBRID INVERTER WHITE CARTON', '3.5KVA/48V NOVEL INVERTER BROWN CARTON', '1KVA/12V NOVEL INVERTER WHITE CARTON INDIA', '3.5KVA/48V N0VEL INVERTER YELLOW SERIES WALL MOUNT', '2.5KVA/24V NOVEL HYBRID INVERTER', '6.2KWH/48V NOVEL HYBRID INVERTER', '4.2KWH/24V NOVEL HYBRID INVERTER', '3KVA/500V NOVEL HYBRID INVERTER', '1KVA/12V NOVEL WALL MONTED INVERTER', '5KVA/48V NOVEL POWERSYSTEM HYBRID INVERTER OLD', '3.5KVA/24V NOVEL HYBRID INVERTER NS3500', '5.5KVA/48V 500VDC NOVEL HYBRID INVERTER NS5500', '2KVA/24V NOVELSOLAR INVERTER YELLOW SERIES', '40KVA NOVEL INVERTER', '3.5KVA/48V DEBULL INVERTER', '2.5KVA/24V DEBULL HYBRID INVERTER', '3.5KVA/48V SPECTRA INVERTER', '1500/24V HOMAYA INVERTER', '850/12V HOMAYA INVERTER', '1.2KVA/12V SOCCER POWER INVERTER', '1.5KVA/12V SOCCER POWER INVERTER', '1.8KVA/24V SOCCER POWER INVERTER', '5KVA/48V SOCCERPOWER INVERTER', '5.5KVA/48V SOCCER POWER INVERTER', '3.5KVA/24V SOCCER POWER INVERTER', '2.5KVA/24V SOCCERPOWER INVERTER', '1KVA/12V SOCCERPOWER INVERTER', '3.5KVA/24V SUNLUX INVERTER', '1.1KVA/12V LENTO INVERTER', '1.6KVA/24V LENTO INVERTER', '7.5KVA/48V SUNLUX INVERTER', '10KVA/180V SPECTRA INVERTER', '1KVA/12V MERCURY INVERTER', '1.2KVA/12V MERCURY INVERTER', '1KVA/12V SMARTEN BRAVO INVERTER', '1.7KVA/24V SMARTEN INVERTER', '2KVA/24V SMARTEN BRAVO INVERTER', '2.5KVA/24V SMARTEN BRAVO INVERTER', '3.2KVA/24V SMARTEN INVERTER', '3.5KVA/48V SMARTEN INVERTER', '3.3/3KVA/24V SRNE INVERTER', '5KVA/48V SRNE INVERTER', '1450VA/24V LENTO INVERTER', '10KVA/48V CEECEE INVERTER', '1KVA FAMICARE INVERTER', '2.5KVA/24V FAMICARE WALL MOUNT INVERTER', '7.5KVA/48V FAMICARE INVERTER', '5.5KVA/24V FAMICARE INVERTER', '3.5KVA/24V FAMICARE INVERTER', '10KVA/48V FAMICARE INVERTER', '1KVA/12V NORMAL CLEAN INVERTER', '3.5KVA/48V KEYE INVERTER', '1.5KVA SPECTRA INVERTER', '3.5KVA/48V PURESINEWAVE INVERTER', '2.5KVA/24V TRUE POWER INVERTER', '15KVA/48V YOHAKO INVERTER', '2KVA/12V 500VDC NOVEL HYBRID INVERTER', '3.5KVA/48V AQUA BLUES INVERTER', '5KVA/96V AQUA BLUES INVERTER', '300W WAKATEK FLOODLIGHT', '100W LANDLIGHT FLOODLIGHT', '200W LANDLIGHT FLOODLIGHT', '250W LANDLIGHT FLOODLIGHT', '100W MORNYRAY FLOODLIGHT', '150W MORNYRAY FLOODLIGHT BLACK', '200W MORNYRAY FLOODLIGHT WHITE', '100W NOVEL FLOODLIGHT', '200W NOVELSOLAR FLOODLIGHT', '200W SQUARELIGHT FLOODLIGHT', '200W SUPERFLUXE FLOODLIGHT', '200W SMS SKYLIGHT FLOODLIGHT', '100W MORNYRAY CITYLIGHT STREETLIGHT', '50W CHINESE STREETLIGHT', '90W SUNFIELD STREETLIGHT', '90W U TORCH STREETLIGHT', '90W SMS STREETLIGHT', '150W SMS STREETLIGHT', '200W SMS STREETLIGHT', '50W DC AMSTON STREETLIGHT', '30W DC AMSTON STREETLIGHT', '36W ROYSOLAR DC STREETLIGHT', '20W DC AMSTON STREETLIGHT', '200W SOLAR LIGHT PRIVATE STREETLIGHT', '250W SUNLUX STREETLIGHT', '180W LED SOLAR STREETLIGHT', '50W WINWIN STREETLIGHT', '30W LED STREETLIGHT', '40W SMS STREETLIGHT', 'JD-19150W', 'JD-A200', '1000W ALL IN ONE SOLAR STREETLIGHT', '150W ROADLIGHT FLOODLIGHT', '60W WAKATEK STREETLIGHT', '50A FAMICARE BATTERY CHARGER', '30A FAMICARE BATTERY CHARGER', '10A SUOER BATTERY CHARGER', '1230 FOUR PHASE SMART BATTERY CHARGER', 'SC-1000 SMART CHARGER 4 IN 1 POWER INVERTER', '30A SUOER BATTERY CHARGER', '20A SUOER BATTERY CHARGER', '10KVA DEBULL STABILIZER', '20KVA DEBULL STABILIZER', '19 BLUE GATE TV', 'NOVEL SOUNDBAR SYSTEM', 'NOVEL SOUNDBAR TV SYSTEM', '32 LG DC TV', '24" LG DC TV', 'MAXI TELEVISION 24', '8 TUBULAR BATTERY RACK', '4 TUBULAR BATTERY RACK', '2 TUBULAR BATTERY RACK', '1 TUBULAR', ' BATTERY RACK', '8 DRY CELL BATTERY RACK', '6 DRY CELL BATTERY RACK', '4 DRYCELL BATTERY RACK', '2 DRYCELL BATTERY RACK', '1 DRYCELL BATTERY RACK', 'LUMINOUS TUBULAR BATTERY RACK', 'SUKAM SMILEY TROLLEY', '2.5MM 4 CORE AC CABLE', '0.5 FLEXIBLE CABLE', '0.5MM 2CORE AC CABLE', '2.5MM AC CABLE 2 CORE', '2.5MM 3CORE AC CABLE', '2.5MM AC CABLE', '6MM DC CABLE', '6MM 2 CORE DC CABLE', '8MM DC CABLE', '6MM 2CORE DC CABLE', '4MM 4 CORE AC CABLE', '4MM DC CABLE', '4MM 2 CORE DC CABLE', '4MM 2 CORE AC/DC CABLE', '10MM DC CABLE', '10MM 2 CORE DC CABLE', '12MM DC CABLE', '16MM SINGLE CORE', '16MM DOUBLE CORE', '16MM DC CABLE', '25MM 1CORE DC CABLE', 'LG AIR CONDITIONER INDOOR UNIT 1HP', 'LG AIR CONDITIONER OUTDOOR UNIT 1HP', '1.5HP AC INVERTER', '48V BATTERY EQUALIZER', 'YOHAKO COMBINER BOX', 'SIMBA SOLAR WATER HEATER', 'NO NAME SOLAR WATER HEATER', 'SINGLE PANEL FLOODLIGHT HANGER', 'BOSCON ELECTRIC OVEN', '63A DC BREAKER', '63A SINGLE POLE DC BREAKER', '63A 2POLE DC BREAKER', '63A 2POLE AC BREAKER', '63A SINGLE POLE AC BREAKER', '32AH DC BREAKER 2POLE', '32A AC BREAKER MINI MCB DP WITH ENCLOSURE', 'DP C32 BATTERY GAUGE', 'TERMINAL BOX', '1LITRE RALLY DISTILLED WATER', '4000ML RALLY DISTILLED WATER', '5LITRES DISTILLED WATER', '100A AC BREAKER', 'INPUT PROTECTION', 'OUTPUT PROTECTION', '200A KNIFE SWITCH', '100A KNIFE SWITCH', '225A KNIFE SWITCH', 'BREAKER BOX', '100A 2POLE DC BREAKER', '12V SOLAR PANEL RACK', '24V SOLAR PANEL RACK', 'DC SURGE PROTECTOR', '25MM CABLE LOCK', '16MM CABLE LOCK', 'STREETLIGHT POLE HANGER', 'DOUBLE PANEL FLOODLIGHT HANGER CONCRETE POLE', 'DOUBLE PANEL FLOODLIGHT HANGER GALVANIZED', 'FLOODLIGHT POLE', 'MC4 CONNECTOR MALE & FEMALE', '4-WAY BOX', '50X50MM TRUNKING PIPE', '25X40MM TRUNKING PIPE', '40X25MM TRUNKING PIPE', '32A DOUBLE POLE DC BREAKER', '2 WAY BREAKER BOX', 'COMPLETE AC SURGE PROTECTION', 'COMPLETE DC SURGE PROTECTION', '13A PLUG', '13A SOCKET TIMER', 'WOODEN SCREW SHORT', 'WOODEN SCREW LONG', 'FLASH BOUND', 'TONERDO NAIL LONG', 'TONERDO NAIL SHORT', '2MP SONY VISION INDOOR CAMERA', '2MP SONY VISION OUTDOOR CAMERA', '5MP SONY VISION OUTDOOR CAMERA', '4MP 8 CHANNEL HIK VISION DVR', '4MP 4 CHANNEL HIK VISION DVR', '4MP 16 CHANNEL HIK DVR', '2MP 16 CHANNEL HIK VISION DVR', 'V380 SPY BULB', '200W FLOOD LIGHT WITH CAMERA', '300W FLOOD LIGHT WITH CAMERA', 'NVR 8 CHANNEL', 'P2P DVR FIVE IN ONE 16 CHANNEL', '4 CHANNEL DVR', 'NVR D LINK 9 CHANNEL', '18 WAYS POWER BOX', '100W FLOOD LIGHT WITH CAMERA', 'SECURITY ALARM', 'VR CAM', '2MP ELCO VISION OUTDOOR CAMERA', '5MP HYBRID IP OUTDOOR CAMERA', '5MP NOVEL IP CAMERA', 'TOP VISION BATTERY CAMERA NO PANEL', '3K HIKVISION SMART DUAL LIGHT CAMERA', 'COLORVU 3K HIKVISION OUTTDOOR CAMERA', 'COLORVU 3K HIKVISION INDOOR CAMERA', '2MP HIK VISION INDOOR CAMERA', '5MP HIK VISION INDOOR CAMERA', '5MP HIK VISION INDOOR/OUTDOOR CAMERA', '2MP HIK VISION INDOOR/OUTDOOR CAMERA', '5MP HYBRID HD INDOOR CAMERA', '5MP HYBRID HD OUTDOOR CAMERA', '5MP HYBRID HD PTZ OUTDOOR CAMERA', 'HIK VISION DOOR PHONE', 'HIK VISION 8 CHANNEL NVR', 'V380 WIFI SOALR PTZ CAMERA OLD', 'V380 4G SOLAR PTZ CAMERA OLD', 'V380 PRO SOLAR CAMERA', 'TOP VISION SOLAR CAMERA OLD', '4 WAYS POWER BOX', 'GSM/GPRS/GPS TRACKER', 'SMART NET WIFI CAMERA PTZ', 'SMART NET WIFI CAMERA', '4G WIFI ROUTER', 'D-LINK 4MP 4 CHANNEL CLOUD NVR', 'D-LINK WIRELESS CLOUD CAMERA', 'D-LINK WIFI ROUTER', '2TB SURVEILLANCE HARD DRIVE', '1TB SURVEILLANCE HARD DRIVE', '4TB SURVEILLANCE HARD DRIVE', '10M HDMI CABLE', '5M HDMI CABLE', 'VOICE ACTIVATED SECURITY SOCKET', 'NOVEL OUTDOOR PTZ CAMERA', 'JIANG DIGITAL COLOR CCD CAMERA', 'WEATHER PROOF IR CAMERA', '1.3MP AHD OUTDOOR CAMERA', '2MP AHD OUTDOOR CAMERA', '4MP ELCO VISION INDOOR CAMERA', 'SMOKE ALARM', 'PHOTO ELECTRIC SMOKE DETECTOR', 'MULTIPURPOSE SMOKE DETECTOR', 'EMERGENCY FIRE ALARM', 'HIGH SENSITIVITY CCD CAMERA', 'MINI CAMERA', 'SIREN HORN', 'CAMERA CCD', '32GB SD CARD', '64GB SD CARD', '2MP AHD 8 CAMERA KIT', 'AHD/DVR/NVR 4 CHANNEL', 'DS-7200 SERIES HIK VISION DVR', '2MP HD 4 CAMERA KIT', 'GREEN CARTON 16 CHANNEL DVR', 'BLACK CARTON 8 CHANNEL DVR', 'ZKT ECO BIOMETRIC MACHINE', 'HDCVI TRANSRECEIVER', 'V380 WIFI 4G SOLAR CAMERA', 'TUYA SMART CAMERA', 'TOP VISION DOUBLE LENS SOLAR CAMERA', '2MP HIKVISION SMART HYBRID LIGHT CAMERA', 'V380 DOUBLE LENS SOLAR CAMERA', '128GB SD CARD', '64G MEMORY CARD', 'V30 PRO DOUBLE LENS SOLAR CAMERA', 'TOP VISION 4G SOLAR CAMERA', '1.5KVA/24V SPECTRAL INVERTER', '1KVA/24V OFF-GRID INVERTER', '2.4KVA/48V OFF-GRID INVERTER', '15KVA DEBULL STABILIZER', '3.5KVA/48V SAFEPOWER INVERTER', '1KVA/24V NOVEL INVERTER', '10KVA/96V SUKAN INVERTER', '2.5KVA/36V NEXUS INVERTER', '5KVA/96V GENUS INVERTER', '3KVA/48V SUKAM INVERTER', '200AH NOVEL DRY CELL', '200AH SOELIX BATTERY', '180W/12V MONO PANEL', '200AH OKAYA BATTERY', '160AH MONOLITE BATTERY', '200AH QUANTA BATTERY', '100W MORNYRAY FLOODLIGHT LIGHT', 'AC GLOCIAL LIGHT', '100W SOLAR LIGHT NO PANEL', 'SALPHA HOME LIGHTING KIT', 'BOSCON HOME LIGHTING KIT', '1230 SOLAR GENERATOR', '1230 BOSCON SOLAR GENERATOR', '260W MONO PANEL', '40A/48V MPPT CHARGE CONTROLLER', '250W/24V POLY PANEL', '300W/24V MONO PANEL', '305W/24V MONO PANEL', '325W/24V MONO PANEL', '300W BROKEN PANEL', '200W BROKEN PANEL', '20A/24V LITTIUM BATTERY CHARGE CONTROLLER', '30A/24V LITTIUM BATTERY CHARGE CONTROLLER', '30A/48V PWM CHARGE CONTROLLER', '30A/24V PWM CHARGE CONTROLLER BC', '40A/24V SULUX CHARGE CONTROLLER', '150W PANEL', '220W POWER INVERTER', '100W AC LED LIGHT', 'BEYOND STANDING FAN', '320W SOLAR STREET LIGHT', '90W SOLAR STREET LIGHT', '100W SOLAR STREET LIGHT', '80W SOLAR STREET LIGHT BROKEN PANEL', '60W ROY SOLAR STREET LIGHT', '90W SOLAR STREET LIGHT', '40W ROYSOLAR STREET LIGHT', '60W POWERSTAR STREET LIGHT', '200W FMS SOLAR STREET LIGHT', '230W/24V CANADIAN PANEL', '235W/24V CANADIAN PANEL', '170W/24V CANADIAN PANEL', '175W/24V CANADIAN PANEL', '190W/24V CANADIAN PANEL', '250W MONO SOLAR PANEL'];


        function AddMore() {
        var container = document.createElement("div");
        container.classList.add("input-group", "col-xl-6", "mb-4");

        var stock_name = document.createElement("input");
        stock_name.type = "text";
        stock_name.name = "stock_name_" + FieldAmount;
        stock_name.classList.add("js-search", "form-control");
        stock_name.placeholder = "Stock Sold";
        stock_name.setAttribute("oninput", "searchItem(event)"); // Corrected function name
        stock_name.required = true;

        var suggestionsContainer = document.createElement("div");
        suggestionsContainer.classList.add("suggestions-container"); // Moved this line to create suggestions container

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

        var categoryOption2 = document.createElement("option");
        categoryOption2.value = "panel";
        categoryOption2.textContent = "Panel";
        stock_category.appendChild(categoryOption2);

        var categoryOption3 = document.createElement("option");
        categoryOption3.value = "inverters";
        categoryOption3.textContent = "Inverters";
        stock_category.appendChild(categoryOption3);

        var categoryOption4 = document.createElement("option");
        categoryOption4.value = "kits";
        categoryOption4.textContent = "Kits";
        stock_category.appendChild(categoryOption4);


        var categoryOption4 = document.createElement("option");
        categoryOption4.value = "bulb";
        categoryOption4.textContent = "Bulb";
        stock_category.appendChild(categoryOption4);

        var categoryOption4 = document.createElement("option");
        categoryOption4.value = "flood light";
        categoryOption4.textContent = "Flood Light";
        stock_category.appendChild(categoryOption4);

        var categoryOption4 = document.createElement("option");
        categoryOption4.value = "fan";
        categoryOption4.textContent = "Fan";
        stock_category.appendChild(categoryOption4);

        var categoryOption4 = document.createElement("option");
        categoryOption4.value = "panel rack";
        categoryOption4.textContent = "Panel Rack";
        stock_category.appendChild(categoryOption4);

        var categoryOption4 = document.createElement("option");
        categoryOption4.value = "solar freezer";
        categoryOption4.textContent = "Solar Freezer";
        stock_category.appendChild(categoryOption4);
        
        var categoryOption4 = document.createElement("option");
        categoryOption4.value = "battery";
        categoryOption4.textContent = "battery";
        stock_category.appendChild(categoryOption4);
        
        var categoryOption4 = document.createElement("option");
        categoryOption4.value = "solar camera";
        categoryOption4.textContent = "Solar camera";
        stock_category.appendChild(categoryOption4);
        
        var categoryOption4 = document.createElement("option");
        categoryOption4.value = "cable";
        categoryOption4.textContent = "cable";
        stock_category.appendChild(categoryOption4);

        var categoryOption4 = document.createElement("option");
        categoryOption4.value = "stabilizer";
        categoryOption4.textContent = "stabilizer";
        stock_category.appendChild(categoryOption4);

        
        var categoryOption4 = document.createElement("option");
        categoryOption4.value = "power inverter";
        categoryOption4.textContent = "power inverter";
        stock_category.appendChild(categoryOption4);
        
        var categoryOption4 = document.createElement("option");
        categoryOption4.value = "distilled water";
        categoryOption4.textContent = "distilled water";
        stock_category.appendChild(categoryOption4);
        
        var categoryOption4 = document.createElement("option");
        categoryOption4.value = "trunking pipe";
        categoryOption4.textContent = "trunking pipe";
        stock_category.appendChild(categoryOption4);
        
        var categoryOption4 = document.createElement("option");
        categoryOption4.value = "breaker";
        categoryOption4.textContent = "breaker";
        stock_category.appendChild(categoryOption4);
        
        var categoryOption4 = document.createElement("option");
        categoryOption4.value = "knife switch";
        categoryOption4.textContent = "knife switch";
        stock_category.appendChild(categoryOption4);

        var categoryOption5 = document.createElement("option");
        categoryOption5.value = "others";
        categoryOption5.textContent = "Others";
        stock_category.appendChild(categoryOption5);

        var stock_serial_number = document.createElement("input");
        stock_serial_number.type = "text";
        stock_serial_number.name = "stock_serial_number_" + FieldAmount;
        stock_serial_number.classList.add("stock_serial_number", "form-control");
        stock_serial_number.placeholder = "Stock Serial Number";

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
        container.appendChild(stock_serial_number);
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
