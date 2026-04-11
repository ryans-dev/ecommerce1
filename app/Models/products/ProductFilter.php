<?php

namespace App\Models\products;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFilter extends Product
{
    use HasFactory;

    protected $table = 'products';

    public function scopeFilter($query, $values = [])
    {
        $query->searchTitle($values['search'] ?? '')
        ;
    }

    public function scopeSearchTitle($query, $value)
    {
        if(!empty($value)) {
            $query->where('title', 'LIKE', '%'.$value.'%');
        }
    }

}
