<?php

/**
 * Stock Class
 */
class stock extends Model
{
    public $table = "stock";

    public $allowed_columns = [
        'stock_name',
        'qty',
        'category',
        'branch_name',
        'created_by',

    ];

}