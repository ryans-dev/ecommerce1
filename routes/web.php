<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CheckoutPaymentController;
use App\Http\Controllers\CheckoutSuccessController;
use App\Http\Controllers\DataAnalyticsController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

// Static pages
Route::get('/shipping-information', [PageController::class, 'shippingInformation'])->name('shipping.information');
Route::get('/returns-exchange', [PageController::class, 'returnsExchange'])->name('returns.exchange');
Route::get('/terms-conditions', [PageController::class, 'termsConditions'])->name('terms.conditions');
Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/faqs', [PageController::class, 'faqs'])->name('faqs');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::get('/store', [ProductController::class, 'index'])->name('store.index');
Route::get('/shop', [ProductController::class, 'index'])->name('shop.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('/details/{id}', [DetailController::class, 'index'])->name('store.details');
Route::get('/details/{id}', [DetailController::class, 'index'])->name('shop.details');

Route::middleware(['auth'])->group(function () {
    Route::get('/data-analytics', [DataAnalyticsController::class, 'index'])->name('data.analytics');
    // Printable version
    Route::get('/data-analytics/printable', [DataAnalyticsController::class, 'printable'])->name('data.analytics.printable');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::put('/cart', [CartController::class, 'store'])->name('cart.store');

    Route::get('/cart/add/{id}', [CartController::class, 'addToCartFromStore'])->name('cart.addfromstorepage');

    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

    Route::post('/checkout/points', [CheckoutController::class, 'points'])->name('checkout.points');

    Route::post('/checkout/payment/{payment}/1', [CheckoutPaymentController::class, 'index'])->name('checkout.stripe');

    Route::get('/checkout/{payment}/testing', [CheckoutPaymentController::class, 'index'])->name('checkout.success.testing');

    Route::get('/checkout/success/{id}', [CheckoutSuccessController::class, 'index'])->name('checkout.success');

    // Route to show all orders
    Route::get('/order-history', [OrderHistoryController::class, 'index'])->name('order-history.index');

    // Route to show details for an order
    Route::get('/order-history/{id}', [OrderHistoryController::class, 'show'])->name('order-history.show');

    // User profile gamification page
    Route::get('/profile', [ProfileController::class, 'gamification'])->name('gamification');
});


include('filament-routes.php');

// BotMan Chatbot Routes
Route::post('/botman/chat', function () {
    $botman = app('botman');

    // Register the plant chatbot conversation
    $botman->hears('.*', function (\BotMan\BotMan\BotMan $bot) {
        $bot->startConversation(new \App\Conversations\PlantChatbotConversation());
    });

    // Process incoming message
    $botman->listen();

    // Return success (BotMan handles response internally)
    return response()->json(['status' => 'ok']);
});

Route::get('/botman/init', [App\Http\Controllers\ChatbotAPIController::class, 'initialize'])->name('botman.init');

Route::prefix('user')->middleware(['auth'])->name('user.')->group(function () {
    // Subscriptions goes here
    Route::get('/tiers', [App\Http\Controllers\tiers\TierController::class, 'index'])->name('tiers.index');
});
