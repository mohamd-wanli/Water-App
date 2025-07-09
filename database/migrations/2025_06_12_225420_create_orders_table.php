<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consumer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('distributor_id')->constrained('distributors')->onDelete('cascade');
            $table->string('status')->default(\App\Types\OrderTypes::Pending);
            $table->decimal('deliver_cost',8,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
