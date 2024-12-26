<?php

/**
 * Order Class
 */
class electrical_recieved_from_supplier extends Model
{
	public $table = "electrical_recieved_from_supplier";


	public $allowed_columns = [
            'recieved_stock_id',
            'branch_name',
			'supplier_name',
			'date',
			'recieved_by',
			'delivered_by',
			'stock_name',
			'qty',
			'category',
			'number_of_stock_ordered',
			'created_by'
			];

}

