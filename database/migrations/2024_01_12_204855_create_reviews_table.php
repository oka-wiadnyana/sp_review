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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->date('review_date');
            $table->integer('service_id');
            $table->string('name');
            $table->string('phone_number');
            $table->integer('time_suitability');
            $table->text('time_review')->nullable();
            $table->integer('term_suitability');
            $table->text('term_review')->nullable();
            $table->integer('cost_suitability');
            $table->text('cost_review')->nullable();
            $table->integer('complaint_suitability');
            $table->text('complaint_review')->nullable();
            $table->integer('service_hours_suitability');
            $table->text('service_hours_review')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
