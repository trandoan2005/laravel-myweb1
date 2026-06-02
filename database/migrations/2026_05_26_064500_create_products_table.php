<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('productname', 200)->unique();
            $table->string('slug', 250)->unique();
            $table->unsignedInteger('cateid');          // FK -> categories.cateid
            $table->unsignedBigInteger('brand_id');     // FK -> brands.id
            $table->decimal('price', 15, 2)->default(0);
            $table->decimal('price_sale', 15, 2)->nullable(); // giá khuyến mãi
            $table->string('image', 255)->nullable();   // ảnh đại diện
            $table->integer('quantity')->default(0);    // tồn kho
            $table->tinyInteger('status')->default(1);  // 1: hiện, 0: ẩn
            $table->integer('sort_order')->default(0);
            $table->text('description')->nullable();    // mô tả ngắn
            $table->longText('detail')->nullable();     // mô tả chi tiết
            $table->timestamps();

            // Khoá ngoại
            $table->foreign('cateid')
                  ->references('cateid')
                  ->on('categories')
                  ->onDelete('restrict');

            $table->foreign('brand_id')
                  ->references('id')
                  ->on('brands')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
