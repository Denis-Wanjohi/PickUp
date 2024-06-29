<?php

use App\Models\User;
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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class,'user_id');
            $table->string('product');
            $table->string('quantity');
            $table->string('price');
            $table->string('company');
            $table->string('shop');
            $table->text('extraInformation')->nullable();
            $table->string('total');
            $table->string('destination')->nullable();
            $table->string('cartTotal')->nullable();
            $table->string('transport')->nullable();
            $table->string('confirmed')->nullable();
            $table->string('amount')->nullable();
            $table->string('mpesaNumber')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('mpesaCode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
