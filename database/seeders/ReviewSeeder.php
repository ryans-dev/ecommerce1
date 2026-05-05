<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        $users = User::all();

        // Realistic review comments
        $reviewComments = [
            'Great product! Exactly as described. Very satisfied with my purchase.',
            'Good quality and fast shipping. Would recommend to friends.',
            'Beautiful item, well packaged. The care instructions were very helpful.',
            'Excellent customer service. Had a question and got a quick response.',
            'Love this! It arrived in perfect condition and looks amazing.',
            'Good value for money. Better than expected quality.',
            'Perfect for what I needed. Very pleased with this purchase.',
            'Fast delivery and great packaging. Item is as shown in photos.',
            'Highly recommend! Great quality and exactly what I was looking for.',
            'Very happy with this purchase. Will definitely buy again.',
            'Item arrived quickly and was well protected. Great experience.',
            'Beautiful craftsmanship. Worth every penny.',
            'Exceeded my expectations. Very happy with the quality.',
            'Great communication from seller. Item is perfect.',
            'Love the design and quality. Very satisfied customer.',
            'Arrived on time and in excellent condition. Thank you!',
            'Fantastic product. Better than I imagined.',
            'Good quality product at a reasonable price.',
            'Very pleased with my order. Will shop here again.',
            'Item is gorgeous and exactly as advertised.',
            'Quick shipping and excellent packaging. Five stars!',
            'Amazing quality. I\'m very impressed.',
            'Perfect condition when it arrived. Great seller.',
            'Love this item! It\'s even better in person.',
            'Great purchase. Fast delivery and good quality.',
            'Very satisfied. The product is high quality.',
            'Beautiful item. Arrived safely and quickly.',
            'Excellent service and product. Highly recommend.',
            'Item is perfect. Exactly what I wanted.',
            'Great experience shopping here. Will return.',
            'Quality product and fast shipping. Thank you!',
        ];

        $names = [
            'John Smith',
            'Sarah Johnson',
            'Michael Brown',
            'Emily Davis',
            'David Wilson',
            'Lisa Garcia',
            'James Miller',
            'Jennifer Martinez',
            'Robert Anderson',
            'Maria Taylor',
            'William Thomas',
            'Jessica Hernandez',
            'Christopher Moore',
            'Amanda Jackson',
            'Daniel Martin',
            'Ashley Thompson',
            'Matthew Garcia',
            'Brittany Rodriguez',
            'Joseph Lee',
            'Samantha Perez',
            'Andrew White',
            'Rachel Harris',
            'Joshua Clark',
            'Nicole Lewis',
            'Ryan Robinson',
            'Stephanie Walker',
            'Kevin Hall',
            'Heather Young',
            'Brandon Allen',
            'Megan King'
        ];

        $emails = [
            'john.smith@email.com',
            'sarah.j@email.com',
            'mike.brown@email.com',
            'emily.d@email.com',
            'david.wilson@email.com',
            'lisa.garcia@email.com',
            'james.miller@email.com',
            'jennifer.m@email.com',
            'robert.a@email.com',
            'maria.taylor@email.com',
            'william.t@email.com',
            'jessica.h@email.com',
            'chris.moore@email.com',
            'amanda.j@email.com',
            'daniel.martin@email.com',
            'ashley.t@email.com',
            'matthew.g@email.com',
            'brittany.r@email.com',
            'joseph.lee@email.com',
            'samantha.p@email.com',
            'andrew.white@email.com',
            'rachel.h@email.com',
            'joshua.c@email.com',
            'nicole.l@email.com',
            'ryan.robinson@email.com',
            'stephanie.w@email.com',
            'kevin.hall@email.com',
            'heather.y@email.com',
            'brandon.a@email.com',
            'megan.king@email.com'
        ];

        foreach ($products as $product) {
            // Generate 0-8 reviews per product (some products might have no reviews)
            $numReviews = rand(0, 8);

            for ($i = 0; $i < $numReviews; $i++) {
                $isGuest = rand(0, 1); // 50% chance of guest review

                if ($isGuest || $users->isEmpty()) {
                    // Guest review
                    $name = $names[array_rand($names)];
                    $email = $emails[array_rand($emails)];
                    $userId = null;
                } else {
                    // Authenticated user review
                    $user = $users->random();
                    $name = $user->name;
                    $email = $user->email;
                    $userId = $user->id;
                }

                Review::create([
                    'product_id' => $product->id,
                    'user_id' => $userId,
                    'name' => $name,
                    'email' => $email,
                    'rating' => rand(3, 5), // Mostly positive reviews (3-5 stars)
                    'comment' => $reviewComments[array_rand($reviewComments)],
                    'created_at' => now()->subDays(rand(1, 365)), // Random date within last year
                ]);
            }
        }
    }
}
