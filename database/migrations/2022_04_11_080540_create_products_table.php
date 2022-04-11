<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('products', static function (Blueprint $table) {
            $table->id()->autoIncrement()->unsigned();
            $table->string('productname', 128)
                ->nullable(false)->comment('Название продукта.');
            $table->decimal('price', 8, 2, true)
                ->nullable(false)->comment('Стоимость продукта.');
            $table->enum('published', [0,1])
                ->nullable(false)->comment('Признак публикации продукта.');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
