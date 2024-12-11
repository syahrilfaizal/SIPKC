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
        Schema::create('report_category', function (Blueprint $table) {
           $table->unsignedBigInteger('report_id');
           $table->unsignedBigInteger('category_id');
           $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');
           $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
