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
        return $query->searchTitle($values['search'] ?? '')
            ->priceGreaterThan($values['greater_than'] ?? 0)
            ->priceLowerThan($values['lower_than'] ?? 0)
            ->categoryFor($values['category'] ?? '')
            ->sortBy($values['sort'] ?? 'id')
        ;
    }

    public function scopeSearchTitle($query, $value)
    {
        if (!empty($value)) {
            $query->where('title', 'LIKE', '%' . $value . '%');
        }
    }

    public function scopePriceGreaterThan($query, $value)
    {
        if (!empty($value)) {
            $query->where('price', '>=', $value);
        }
    }

    public function scopePriceLowerThan($query, $value)
{
    if (!empty($value) && $value > 0) {
        return $query->where('price', '<=', $value);
    }
}

    public function scopeCategoryFor($query, $value)
    {
        if (!empty($value)) {
            $query->where('category', $value);
        }
    }

    public function scopeSortBy($query, $value = 'id')
    {
        switch ($value) {
            case 'title_asc':
                $query->reorder('title');
                break;

            case 'price_asc':
                $query->reorder('price');
                break;

            case 'price_desc':
                $query->reorder('price', 'desc');
                break;

            case 'category':
                $query->reorder('category');
                break;

            default:
                $query->reorder('id');
                break;
        }
        return $query;
    }
}
