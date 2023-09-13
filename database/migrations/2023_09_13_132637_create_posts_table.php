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
        Schema::create('posts', function (Blueprint $table) {
            $table->id()->index();
            $table->string('title')->index();
            $table->string('slug')->unique()->index();
            $table->boolean('published')->index()->default(false);
            $table->longText('content')->nullable();
            $table->unsignedBigInteger('author_id')->index();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('author_id')->references('id')
                ->on('authors')->onDelete('cascade'); // cascade|set null

            $table->index('created_at');
            $table->index('updated_at');
            $table->index('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
