<?php require_once views_path('partials/header');?>
<style>
	
	.hide{

		display: none;
	}

	@keyframes appear{

		0%{opacity: 0; transform: translateY(-100px);}
		100%{opacity: 1; transform: translateY(0px);}
	}
</style>
<!-- Main body container starts here -->
	<div class="d-flex">
		<!-- Items container starts here -->
		<div style="height: 580px;" class="shadow col-8 p-4">
			<div class="input-group mb-3">
			  <h4>Items</h4>
			  <input type="text" onkeyup="check_for_enter_key(event)" oninput="search_item(event)" class="ms-4 form-control js-search" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1" autofocus>
			   <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
			</div>
			<!-- all the cards items -->
			<div onclick="add_item(event)" class="js-products d-flex" style="overflow-y: scroll; height: 90%; flex-wrap: wrap;">
				
				<!-- Singdle item -->
				
				<!-- Singdle item end-->

			</div>
			<!-- all the cards items end-->

		</div>
		<!-- Items container ends here -->

		<!-- Cart container starts here -->
		<div class="col-4 bg-light p-4 pt-1">
			<div>
				<center><h4><i class="fa fa-cart-plus"></i> Cart <span class="js-item-count badge bg-primary rounded-circle">0</span></h4></center>
			</div>
			<div class="table-responsive" style="height: 360px; overflow-y: scroll;">
				<table class="table table-striped table-hover">
					<tr>
						<th>Image</th>
						<th>Decription</th>
						<th>Amount</th>
					</tr>
					<tbody class="js-items">
					<!-- Item in the cart -->
						


					<!-- Item in the cart end -->
					</tbody>
				</table>
			</div>
			<div class="js-gtotal alert alert-danger py-0 mt-2" style="font-size: 23px;">
				Total: &#x20A6;0.00
			</div>
			<div class="row">
				<button onclick="show_model('amount-paid')" class="btn btn-success mb-1 py-3">Checkout</button>
				<button onclick="clear_all()" class="btn btn-primary py-2">Clear All</button>
			</div>
		</div>
		<!-- Cart container ends here -->
	</div>
<!-- Items container ends here -->


<!--Model Start-->
	<!--Enter Amount Model Start-->
	<div role="close-button" onclick="hide_model(event, 'amount-paid')" class="js-amount-paid-modal hide" style="animation: appear .5s ease; background-color: #000000bb; width: 100%; height: 100%; position: fixed; left: 0px; top: 0px; z-index: 4;">
		<div style="width: 500px; min-height: 180px; background-color: white; padding: 10px; margin: auto; margin-top: 120px; border-radius: 10px;">
			<h3 class="text-muted">Preparing To Checkout... 
			<button role="close-button" onclick="hide_model(event, 'amount-paid')" class="btn btn-danger btn-sm float-end" style="font-weight: bold;">X</button></h3>
			<input onkeyup="if(event.keyCode == 13){validate_amount_paid(event)}" type="text" class="form-control my-3 js-amount-paid-input" placeholder="Enter Amount Paid" name="">
			<button role="close-button" class="btn btn-success float-end" onclick="validate_amount_paid(event)">Next</button>
			<button role="close-button" onclick="hide_model(event, 'amount-paid')" class="btn btn-danger">Cancel</button><br><br>
			
		</div>
	</div>
	
	<!--Change Model Start-->
	<div role="close-button" onclick="hide_model(event, 'change')" class="js-change-modal hide" style="animation: appear .5s ease; background-color: #000000bb; width: 100%; height: 100%; position: fixed; left: 0px; top: 0px; z-index: 4;">
		<div style="width: 500px; min-height: 180px; background-color: white; padding: 10px; margin: auto; margin-top: 120px; border-radius: 10px;">
			<h3 class="text-muted">Customer's Change.
			<button role="close-button" onclick="hide_model(event, 'change')" class="btn btn-danger btn-sm float-end" style="font-weight: bold;">X</button></h3>
			<div class="form-control my-3 js-change-input text-center" style="font-size: 50px;">
				&#x20A6;0.00
			</div>
			<center>
				<button role="close-button" onclick="hide_model(event, 'change')" class="js-btn-close-change btn btn-lg btn-success">Continue</button><br><br>
			</center>
			
		</div>
	</div>
	<!--End Change Model Start-->

<!--Model End-->
<script>

	let PRODUCTS 	= [];
	let ITEMS 		= [];
	let BARCODE		= false;
	let GTOTAL 		= 0;
	let CHANGE 		= 0;
	let RECEIPT_WINDOW = null;

	let main_input = document.querySelector(".js-search");
	function search_item(ev)
	{
		let text = ev.target.value.trim();
		let data = {};

		data.data_type = "search";
		data.text = text;

		send_data(data);
	}

	function send_data(data)
	{

		let ajax = new XMLHttpRequest();

		ajax.addEventListener('readystatechange', function(ev){
			
			if(ajax.readyState == 4)
			{	
						
				if(ajax.status == 200)
				{
					if(ajax.responseText.trim() != "") 
					{
						handle_result(ajax.responseText);
					
					}else{

						if(BARCODE) 
						{
							alert("That item was not found");
						}
					}
					
				}else{

					console.log("An Error Occured. Error Code: "+ajax.status+"; Error Message: "+ajax.statusText);
				}

				/*Clear the main input if enter was pressed*/
				if(BARCODE) 
				{
					main_input.value = "";
					main_input.focus();
				}
				BARCODE = false;
			}

		});

		ajax.open('post', 'index.php?pg=ajax', true);
		data = JSON.stringify(data);
		ajax.send(data);
	}


	function handle_result(result)
	{
		//console.log(result);
		let obj = JSON.parse(result);

		if(typeof obj != "undefined")
		{
			//Valid Json
			if(obj.data_type == "search") 
			{	
				let productDiv = document.querySelector(".js-products");
				productDiv.innerHTML = "";
				PRODUCTS = [];

				if(obj.data != "") 
				{
					PRODUCTS = obj.data;
					for (var i = 0; i < obj.data.length; i++) 
					{
						productDiv.innerHTML += product_html(obj.data[i], i);
					}

					if(BARCODE) 
					{
						add_item_from_index(0);
					}
				
				}
				
			}
			
			
		}
	}


	function product_html(data, index)
	{
		return	`<div class="card m-3 border-0 mx-auto" style="max-width: 190px; min-width: 190px;">
					<a href="#">
						<img index="${index}" src="${data.image}" class="w-100 rounded border">
					</a>
					<div class="p-2">
						<div class="text-muted">${data.description}</div>
						<div class="" style="font-size: 20px;"><b>&#x20A6;${data.amount}</b></div>
					</div>
				</div>`;
	}


	function item_html(data, index)
	{
		return	`<tr>
					<td style="width: 110px;"><img src="${data.image}" class="rounded border" style="width: 100px; height: 100px;"></td>
					<td class="text-primary">
						${data.description}

						<div class="input-group mt-4" style="max-width: 150px">
						  <span index="${index}" onclick="change_qty('down', event)" class="input-group-text" style="cursor: pointer;"><i class="fa fa-minus text-primary"></i></span>
						  <input index="${index}" onblur="change_qty('input', event)" type="text" class="form-control text-primary" placeholder="1" value="${data.qty}">
						  <span index="${index}" onclick="change_qty('up', event)" class="input-group-text" style="cursor: pointer;"><i class="fa fa-plus text-primary"></i></span>
						</div>
					</td>
					<td style="font-size: 20px;">
					<b>&#x20A6;${data.amount}</b>
					<button onclick="remove_item(${index})" class="btn btn-danger btn-sm float-end mt-5"><i class="fa fa-times"></i></button>
					</td>
				</tr>`;


	}

	function add_item_from_index(index)
	{
		//check if the items exists
		for (var i = ITEMS.length - 1; i >= 0; i--) 
		{
			if(ITEMS[i].id == PRODUCTS[index].id)
			{
				ITEMS[i].qty += 1; 
				refresh_items_display();
				return;
			}
		}

		let temp = PRODUCTS[index];
		temp.qty = 1;
		ITEMS.push(temp);
		refresh_items_display();
	}
	
	function add_item(ev)
	{	
		if(ev.target.tagName == "IMG")
		{
			let index = ev.target.getAttribute("index");

			add_item_from_index(index)
		}
	}


	function refresh_items_display()
	{
		let item_count = document.querySelector(".js-item-count");
		item_count.innerHTML = ITEMS.length;

		let items_div = document.querySelector(".js-items");
		items_div.innerHTML = "";

		let grand_total = 0;
		for (var i = ITEMS.length - 1; i >= 0; i--) 
		{
			items_div.innerHTML += item_html(ITEMS[i], i);
			grand_total += (ITEMS[i].qty * ITEMS[i].amount);
		}
		
		let gtotal_div = document.querySelector(".js-gtotal");
		gtotal_div.innerHTML = "Total: &#x20A6;" + grand_total.toFixed(2);
		GTOTAL = grand_total;
	}


	function clear_all()
	{
		if(!confirm("Are you sure you want to clear all items in the list??!!")) 
		{
			return;
		}

		ITEMS = [];
		refresh_items_display()
	}


	function remove_item(index)
	{
		if(!confirm("Are you sure you want to remove this item ??!!")) 
		{
			return;
		}

		ITEMS.splice(index, 1);
		refresh_items_display()
	}


	function change_qty(direction, ev)
	{
		let index = ev.currentTarget.getAttribute("index");
		if(direction == "up") 
		{
			ITEMS[index].qty += 1;

		}else if(direction == "down")
		{
			ITEMS[index].qty -= 1;

		}else{

			ITEMS[index].qty = parseInt(ev.currentTarget.value);
		}



		/** Make sure that it's not less than 1 **/
		if(ITEMS[index].qty < 1) 
		{
			ITEMS[index].qty = 1;
		}

		refresh_items_display();
	}

	function check_for_enter_key(ev)
	{
		if(ev.keyCode == 13) 
		{
			BARCODE = true;
			search_item(ev);
		}
	}


	function show_model(model)
	{
		if(model == "amount-paid")
		{
			if(ITEMS.length == 0)
			{
				alert("Please add something to the cart");
				return; 
			}
			let mydiv = document.querySelector(".js-amount-paid-modal");
			mydiv.classList.remove("hide");	

			mydiv.querySelector('.js-amount-paid-input').value = '';
			mydiv.querySelector('.js-amount-paid-input').focus();
		
		}else if(model == "change")
		{
			let mydiv = document.querySelector(".js-change-modal");
			mydiv.classList.remove("hide");	

			mydiv.querySelector('.js-change-input').innerHTML = `<b>&#x20A6;${CHANGE}</b>`;
			mydiv.querySelector('.js-btn-close-change').focus();
		}
	}


	function hide_model(ev, model)
	{
		if(ev == true || ev.target.getAttribute("role") == "close-button") 
		{
			if(model == "amount-paid")
			{
				let mydiv = document.querySelector(".js-amount-paid-modal");
				mydiv.classList.add("hide");
			
			}else if(model == "change")
			{
				let mydiv = document.querySelector(".js-change-modal");
				mydiv.classList.add("hide");
			
			}
		}
		
	}

	function validate_amount_paid(ev)
	{
		let amount = ev.currentTarget.parentNode.querySelector(".js-amount-paid-input").value.trim();
		
		if(amount == "") 
		{
			alert("Please enter a valid amount");
			document.querySelector(".js-amount-paid-input").focus();
			return;
		}

		amount = parseFloat(amount);

		if(amount < GTOTAL) 
		{
			alert("Amount must be greater than or equals to TOTAL");
			return;
		}

	
		CHANGE = amount - GTOTAL;
		CHANGE = CHANGE.toFixed(2);
		// you can put true instead of ev, it will also work
		hide_model(true,'amount-paid');
		show_model('change');

		//remove unwanted informations
		let ITEMS_NEW = [];
		for (var i = 0; i < ITEMS.length; i++) 
		{
			let tmp = {};
			tmp.id = ITEMS[i]['id'];
			tmp.qty = ITEMS[i]['qty'];
			//tmp.description = ITEMS[i]['description'];

			ITEMS_NEW.push(tmp);
		}

		//send cart data through ajax
		send_data({
			
			data_type: "checkout",
			text: ITEMS_NEW

		});
		
		//open reciept page
		print_receipt({
			company:"GSALE POS", 
			amount:amount, 
			change:CHANGE, 
			gtotal:GTOTAL, 
			data:ITEMS
		});

		//clear items
		ITEMS = [];
		refresh_items_display();

		//reload product
		send_data({

			data_type: "search",
			text:""
		});
	}


	function print_receipt(obj)
	{
		let vars = JSON.stringify(obj)
		let RECEIPT_WINDOW = window.open("index.php?pg=print&vars=" + vars,"printpage","width=500px;");

		setTimeout(function(){

			RECEIPT_WINDOW.close();

		},1000);

	}

	send_data({

		data_type: "search",
		text:""
	});




</script>
<!-- vegan, greenmart -->


<?php require_once views_path('partials/footer');?>






























