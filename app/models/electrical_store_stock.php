<?php

/**
 * Order Class
 */
class electrical_store_stock extends Model
{
	public $table = "electrical_store_stock";


	public $allowed_columns = [
            'stock_id',
            'branch_name',
			'source',
			'date',
			'stock_name',
			'qty',
			'category',
			'created_by'
			];

}
