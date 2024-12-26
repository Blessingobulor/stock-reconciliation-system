
<style>
  /* Add this style to create the animated line under each nav item */
  .navbar-nav .nav-item {
    position: relative;
  }

  .navbar-nav .nav-item::after {
    content: "";
    display: block;
    position: absolute;
    width: 0;
    height: 3px;
    background-color: blue; /* Change the color as needed */
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    transition: width 0.3s ease-in-out;
  }

  .navbar-nav .nav-item:hover::after {
    width: 100%;
  }

  /* Additional styles for larger screens */
  @media (min-width: 992px) {
    .navbar-nav {
      display: flex;
      justify-content: space-between; /* Distribute items evenly */
    }

    .navbar-nav .nav-item {
      position: relative;
      padding: 0 15px; /* Adjust the padding as needed */
    }

    .navbar-nav .nav-item::after {
      left: 0;
      transform: none;
    }
  }
</style>



<nav class="navbar navbar-expand-lg navbar-light bg-light" style="min-width: 350px; font-size: 16px; background-color: black;">
	  <div class="container-fluid">
	    <a class="navbar-brand" href="index.php?pg=home"><b><?=esc(APP_NAME)?></b></a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
	        <!-- <li class="nav-item">
	          <a class="nav-link active" aria-current="page" href="index.php?pg=home">Point Of Sale</a>
	        </li>
 -->
			<!-- <li class="nav-item">
	          <a class="nav-link" aria-current="page" href="index.php?pg=order">Order Form</a>
	        </li> -->

	        <li class="nav-item">
	          <a class="nav-link" aria-current="page" href="index.php?pg=stock">Stock</a>
	        </li>

	        <li class="nav-item dropdown">
		          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
		            Branches Reconcilation 
		          </a>
		          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
		            <li><hr class="dropdown-divider"></li>
		             <li><a class="dropdown-item" href="index.php?pg=recieve-central-store-new">Recieved From Central Store</a></li>
		             <li><hr class="dropdown-divider"></li>
		             <li><a class="dropdown-item" href="index.php?pg=branch-sales-new">Sales</a></li>

		             <li><hr class="dropdown-divider"></li>
		             <li><a class="dropdown-item" href="index.php?pg=return-stock-new">Return Stock</a></li>

		             <li><hr class="dropdown-divider"></li>
		             <li><a class="dropdown-item" href="index.php?pg=recieve-from-branch-new">Recieved From Branches</a></li>

		              <li><hr class="dropdown-divider"></li>
		              <li><a class="dropdown-item" href="index.php?pg=transfer-to-branch-new">Transfer To Branches</a></li>

		              <li><hr class="dropdown-divider"></li>
		              <li><a class="dropdown-item" href="index.php?pg=admin-transfer-new">Admin Transfer</a></li>


		            <li>
		            	<!-- <a class="dropdown-item" href="index.php?pg=edit-user&id=<?=Auth::get('id')?>">Profile Setting</a> -->
		            </li>
		          </ul> 
		        </li>


<li class="nav-item dropdown">
		          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
		            Central Store Reconcilation 
		          </a>
		          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
		            <li><hr class="dropdown-divider"></li>
		             <li><a class="dropdown-item" href="index.php?pg=recieved-from-supplier-new">Recieved From Supplier</a></li>
		             <li><hr class="dropdown-divider"></li>
		              <li><a class="dropdown-item" href="index.php?pg=central-store-transfer-to-branch-new">Central Store Transfer To Branches</a>

		              	<li><hr class="dropdown-divider"></li>
		              <li><a class="dropdown-item" href="index.php?pg=central-store-recieve-from-branch-new">Central Store Recieve From Branches</a></li>
		              
		              	<li><hr class="dropdown-divider"></li>
		              <li><a class="dropdown-item" href="index.php?pg=central-store-stock-new">Central Store stock</a></li>


		              <li><hr class="dropdown-divider"></li>
		              <li><a class="dropdown-item" href="index.php?pg=central-store-recieve-new">Central Store Recieved Stock</a></li>


		              <li><hr class="dropdown-divider"></li>
		              <li><a class="dropdown-item" href="index.php ?pg=central-store-transfer-new">Central Store Transfer Stock</a></li>

		              </li>

		            <li>
		            	<!-- <a class="dropdown-item" href="index.php?pg=edit-user&id=<?=Auth::get('id')?>">Profile Setting</a> -->
		            </li>
		          </ul>
		        </li>


		        <li class="nav-item dropdown">
		          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
		            Akinjide Stock Reconcilation 
		          </a>
		          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
		           
		           <li><hr class="dropdown-divider"></li>
		            <li><a class="dropdown-item" href="index.php?pg=return-inward-new">Customer Stock Return Inward</a></li>

		              </li>
		             <li><hr class="dropdown-divider"></li>
		              <li><a class="dropdown-item" href="index.php?pg=akinjide-sales-new">Akinjide Store Sales</a></li>
		              	<li><hr class="dropdown-divider"></li>
		              <li><a class="dropdown-item" href="index.php?pg=akinjide-store-stock-new">Akinjide Store stock</a></li>

		              <li><hr class="dropdown-divider"></li>
		              <li><a class="dropdown-item" href="index.php?pg=transfer-akinjide-new">Akinjide Stock Transfer</a></li>

 									 <li><hr class="dropdown-divider"></li>
 									 <li><a class="dropdown-item" href="index.php?pg=recieve-akinjide-new">Akinjide Stock Recieved</a></li>

		            <li>
		            	<!-- <a class="dropdown-item" href="index.php?pg=edit-user&id=<?=Auth::get('id')?>">Profile Setting</a> -->
		            </li>
		          </ul>
		        </li>



		        <li class="nav-item dropdown">
		          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
		           Electrical Reconcilation 
		          </a>
		          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
		              
		              	<li><hr class="dropdown-divider"></li>
 						 <li><a class="dropdown-item" href="index.php?pg=electrical-recieved-from-supplier-new">Electrical Stock Recieved From Supplier</a></li>
 						 
 						 
 						 <li><hr class="dropdown-divider"></li>
		              <li><a class="dropdown-item" href="index.php?pg=electrical-store-transfer-to-branch-new">Electrical Stock Transfer</a></li>

		           
		           <li><hr class="dropdown-divider"></li>
		            <li><a class="dropdown-item" href="index.php?pg=electrical-store-stock-new">Electrical Stock Items</a></li>


 <li>
		            	<!-- <a class="dropdown-item" href="index.php?pg=edit-user&id=<?=Auth::get('id')?>">Profile Setting</a> -->
		            </li>
		          </ul>
		        </li>


				<li class="nav-item dropdown">
		          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
		            CCTV Reconcilation
		          </a>
		          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
		           
		           <li><hr class="dropdown-divider"></li>
		            <li><a class="dropdown-item" href="index.php?pg=cctv-return-inward-new">CCTV Customer Return Inward</a></li>

		              </li>
		             <li><hr class="dropdown-divider"></li>
		              <li><a class="dropdown-item" href="index.php?pg=cctv-sales-new">CCTV Sales</a></li>
		              	<li><hr class="dropdown-divider"></li>
		              <li><a class="dropdown-item" href="index.php?pg=cctv-store-stock-new">CCTV Stock</a></li>

		              <li><hr class="dropdown-divider"></li>
		              <li><a class="dropdown-item" href="index.php?pg=transfer-cctv-new">CCTV Stock Transfer</a></li>

 									 <li><hr class="dropdown-divider"></li>
 									 <li><a class="dropdown-item" href="index.php?pg=recieve-cctv-new">CCTV Stock Recieved</a></li>

		            <li>
		            	<!-- <a class="dropdown-item" href="index.php?pg=edit-user&id=<?=Auth::get('id')?>">Profile Setting</a> -->
		            </li>
		          </ul>
		        </li>
	         


				<li class="nav-item dropdown">
		          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
		           Electronics Reconcilation
		          </a>
		          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
		           
		           <li><hr class="dropdown-divider"></li>
		            <li><a class="dropdown-item" href="index.php?pg=electronics-return-inward-new">Electronics Customer Return Inward</a></li>

		              </li>
		             <li><hr class="dropdown-divider"></li>
		              <li><a class="dropdown-item" href="index.php?pg=electronics-sales-new">Electronics Sales</a></li>
		              	<li><hr class="dropdown-divider"></li>
		              <li><a class="dropdown-item" href="index.php?pg=electronics-store-stock-new">Electronics Stock</a></li>

		              <li><hr class="dropdown-divider"></li>
		              <li><a class="dropdown-item" href="index.php?pg=transfer-electronics-new">Electronics Stock Transfer</a></li>

 									 <li><hr class="dropdown-divider"></li>
 									 <li><a class="dropdown-item" href="index.php?pg=electroniscs-cctv-new">Electronics Stock Recieved</a></li>

		            <li>
		            	<!-- <a class="dropdown-item" href="index.php?pg=edit-user&id=<?=Auth::get('id')?>">Profile Setting</a> -->
		            </li>
		          </ul>
		        </li>
	         
 
			<!-- <li class="nav-item">
  			<a class="nav-link" aria-current="page" href="index.php?pg=recieved-from-supplier-new">Recieved From Supplier</a>
			</li> -->

	        <?php if(Auth::access('supervisor')):?>

		        <li class="nav-item">
		          <a class="nav-link" href="index.php?pg=admin">Admin</a>
		        </li>

		        
				<?php if(Auth::access('admin')):?>
			        <li class="nav-item">
			          <a class="nav-link" href="index.php?pg=signup">Create User</a>
			        </li>
		        <?php endif;?>
	       
	    	<?php endif;?>

	    	<?php if(!Auth::logged_in()):?>

		        <li class="nav-item">
		          <a class="nav-link" href="index.php?pg=login">Login</a>
		        </li>

		    <?php else:?>

		        <li class="nav-item dropdown">
		          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
		            Hi, <?=ucfirst(Auth::get("username"))?> (<?=ucfirst(Auth::get("role"))?>)
		          </a>
		          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
		            <li>
		            	<a class="dropdown-item" href="index.php?pg=profile">Profile</a>
		            </li>
		            <li>
		            	<a class="dropdown-item" href="index.php?pg=edit-user&id=<?=Auth::get('id')?>">Profile Setting</a>
		            </li>
		            <li><hr class="dropdown-divider"></li>
		            <li><a class="dropdown-item" href="index.php?pg=logout">Logout</a></li>
		          </ul>
		        </li>
		      
	      <?php endif;?>
	  	</ul>

	     
	    </div>
	  </div>
	</nav>
