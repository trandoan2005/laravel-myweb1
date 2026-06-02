<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200)->unique();
            $table->string('slug', 250)->unique();
            $table->unsignedBigInteger('user_id');
            $table->text('content')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            // Foreign Key
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
