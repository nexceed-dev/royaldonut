<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('donuts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->decimal('price', 4, 1);
            $table->tinyInteger('seal_of_approval')->unsigned(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donuts');
    }
};
