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
        Schema::create('course_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_year_id')->constrained();
            $table->foreignId('subject_id')->constrained();
            $table->foreignId('course_id')->constrained();
            $table->boolean('active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_programs');
    }
};
