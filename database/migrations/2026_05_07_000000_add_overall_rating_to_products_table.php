<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'overall_rating')) {
                $table->decimal('overall_rating', 2, 1)->default(0)->after('status')->comment('Rating from 0 to 5');
            }
            if (!Schema::hasColumn('products', 'total_reviews')) {
                $table->integer('total_reviews')->default(0)->after('overall_rating')->comment('Total number of reviews');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['overall_rating', 'total_reviews']);
        });
    }
};
