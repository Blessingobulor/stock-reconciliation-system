<?php require_once views_path('partials/header');?>

<div class="container-fluid border rounded p-3 m-5 col-lg-4 mx-auto shadow">
    <form method="post" enctype="multipart/form-data">
        <h3><i class="fa fa-dolly text-primary"></i> Add Product</h3>
        

        <div class="mb-3 mt-3">
            <label for="stocknameControlInput1" class="form-label">Stock Name <small class="text-muted">(optional)</small></label>
            <input type="text" name="stock_name" class="form-control <?=!empty($errors['stock_name'])?'border-danger':''?>" id="stocknameControlInput1" placeholder="stock name" r>
            <?php if(!empty($errors['stock_name'])):?>
                <small class="text-danger"><?=$errors['stock_name']?></small>
            <?php endif;?>
        </div>


         <div class="input-group mb-3">
            <span class="input-group-text">Quantity: </span>
            <input name="qty" value="1" type="number" class="form-control <?=!empty($errors['qty'])?'border-danger':''?>" placeholder="Quantity" aria-label="Quantity" require_onced>
        </div>
        <?php if(!empty($errors['qty'])):?>
            <small class="text-danger"><?=$errors['qty']?></small>
        <?php endif;?>


        <div class="mb-3 mt-3">
        <label for="categoryControlInput1" class="form-label">Stock Category</label>
        <select name="category" class="form-control <?=!empty($errors['category'])?'border-danger':''?>" id="categoryControlInput1" >
        <option hidden>Select Category...</option>
         <option value="panel">Panel</option>
         <option value="inverters">Inverters</option>
         <option value="kits">Kits</option>
         <option value="others">Others</option>

    </select>
    <?php if(!empty($errors['category'])):?>
        <small class="text-danger"><?=$errors['category']?></small>
    <?php endif;?>
    </div>



        <div class="input-group mb-3">
            <span class="input-group-text">Quantity: </span>
            <input name="qty" value="1" type="number" class="form-control <?=!empty($errors['qty'])?'border-danger':''?>" placeholder="Quantity" aria-label="Quantity" require_onced>
        </div>
        <?php if(!empty($errors['qty'])):?>
            <small class="text-danger"><?=$errors['qty']?></small>
        <?php endif;?>
        

        <div class="mb-3 mt-3">
        <label for="branchnameControlInput1" class="form-label">Branch Name</label>
        <select name="branch_name" class="form-control <?=!empty($errors['branch_name'])?'border-danger':''?>" id="branchnameControlInput1" >
                <option selected>Choose...</option>
                <option>Sangotedo Lagos</option>
                <option>Akinjide Central Branch Ibadan</option>
                <option>Ore</option>
                <option>Elegushi Lagos</option>
                <option>Ikota</option>
                <option>Ikeja lagos</option>
                <option>Ondo</option>
                <option>Ado Ekiti</option>
                <option>Ile ife</option>
                <option>Ilesa</option>
                <option>Benin 1</option>
                <option>Benin 2</option>
                <option>Osogbo Oyo State</option>
                <option>Oyo Ibadan</option>
                <option>Ogbomoso Oyo State</option>
                <option>Oke ilewo </option>
                <option>Obantoko Ogun State</option>
                <option>Ijebu ode Ogun State</option>
                <option>Abuja maraba</option>
                <option>Abuja kubwa</option>
                <option>Kaduna Kaduna State</option>
                <option>Kano Kano State</option>
                <option>Iwo road Ibadan</option>
                <option>Bodija Ibadan</option>
                <option>Gw ilorin</option>
                <option>Tipper garage</option>
                <option>Gw Akure</option>
                <option>Asaba</option>    
            </select>


            </select>
    <?php if(!empty($errors['branch_name'])):?>
        <small class="text-danger"><?=$errors['branch_name']?></small>
    <?php endif;?>
    </div>

        <br>
        <button class="btn btn-success float-end">Save</button>
        <a href="index.php?pg=stock&tab=stock">
            <button type="button" class="btn btn-primary">Cancel</button>
        </a>
    </form>
</div>

<?php require_once views_path('partials/footer');?>

