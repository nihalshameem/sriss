<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingText extends Model
{
    protected $table    ='shopping_text';
    protected $fillable =[	'type',
    						'category',
    						'subcategory',
    						'product_name',
    						'description',
    						'amount',
    						'quantity',
    						'image',
    						'link',
    						];
}
