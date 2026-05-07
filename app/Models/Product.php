<?php

namespace App\Models;

use App\Helpers\ProductCollectionHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array<int, \Illuminate\Database\Eloquent\Model>  $models
     * @return \Illuminate\Database\Eloquent\Collection<int, \Illuminate\Database\Eloquent\Model>
     */
    public function newCollection(array $models = []): Collection
    {
        return new ProductCollectionHelper($models);
    }

    /**
     *  =============== RELATIONSHIPS  ===============
     */


    /**
     *  =============== SCOPES  ===============
     */

    public function scopeWithPrices(Builder $query, array $group_ids = [1])
    {
        $query->where('products.id', '>', 0);
    }

    public function scopeSingleProduct(Builder $query, int $id)
    {
        $query->where('products.id', $id);
    }

    public function scopeFilter($query, $values = [])
    {
        $query->searchTitle($values['search'] ?? '');
    }

    public function scopeSearchTitle($query, $value)
    {
        if (!empty($value)) {
            $query->where('title', 'like', "%{$value}%");
        }
    }


    /**
     *  =============== FUNCTIONS  ===============
     */
    public function getImage()
    {
        return asset('storage' . $this->image_path . $this->image_name);
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getStockPrice()
    {
        return $this->price;
    }

    public function getCartQuantityPrice()
    {
        return $this->getPrice() * $this->pivot->quantity;
    }

    public function getLink()
    {
        return route('shop.details', ['id' => $this->id]);
    }

    /**
     * Get the overall rating for the product
     */
    public function getRating()
    {
        // If no rating set, generate a realistic one based on product attributes
        if ($this->overall_rating == 0) {
            $this->generateRealisticRating();
        }
        return $this->overall_rating;
    }

    /**
     * Get the number of reviews
     */
    public function getReviewCount()
    {
        return $this->total_reviews ?? 0;
    }

    /**
     * Generate a realistic rating based on product characteristics
     */
    public function generateRealisticRating()
    {
        // Base rating varies by category
        $baseRatings = [
            'monstera' => 4.6,
            'pothos' => 4.7,
            'snake' => 4.8,
            'fern' => 4.5,
            'succulent' => 4.4,
            'cactus' => 4.3,
            'orchid' => 4.2,
            'lily' => 4.1,
        ];

        $base = 4.0; // Default base rating
        foreach ($baseRatings as $key => $rating) {
            if (stripos($this->title, $key) !== false || stripos($this->category, $key) !== false) {
                $base = $rating;
                break;
            }
        }

        // Add slight variation to make it realistic (±0.3)
        $variation = (rand(0, 100) / 100) * 0.6 - 0.3;
        $rating = round($base + $variation, 1);

        // Ensure rating is between 3.5 and 5.0
        $rating = max(3.5, min(5.0, $rating));

        // Generate realistic review count
        $reviewCount = rand(15, 200);

        // Higher rated products tend to have more reviews
        if ($rating >= 4.7) {
            $reviewCount = rand(80, 250);
        } elseif ($rating >= 4.5) {
            $reviewCount = rand(50, 180);
        } elseif ($rating >= 4.0) {
            $reviewCount = rand(25, 100);
        }

        $this->overall_rating = $rating;
        $this->total_reviews = $reviewCount;
        $this->save();

        return $rating;
    }

    /**
     * Get star rating HTML
     */
    public function getStarRating()
    {
        $rating = $this->getRating();
        $fullStars = floor($rating);
        $hasHalfStar = ($rating - $fullStars) >= 0.5;
        $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);

        $html = '';

        // Full stars
        for ($i = 0; $i < $fullStars; $i++) {
            $html .= '<span class="ion-ios-star"></span>';
        }

        // Half star
        if ($hasHalfStar) {
            $html .= '<span class="ion-ios-star-half"></span>';
        }

        // Empty stars
        for ($i = 0; $i < $emptyStars; $i++) {
            $html .= '<span class="ion-ios-star-outline"></span>';
        }

        return $html;
    }
}
