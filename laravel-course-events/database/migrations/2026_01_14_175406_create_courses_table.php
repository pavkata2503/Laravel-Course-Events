<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // create_courses_table.php
public function up(): void
{
    Schema::create('courses', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Име на курса
        $table->date('start_date'); // Дата на провеждане
        $table->integer('duration_hours'); // Времетраене (примерно в часове)
        $table->text('description')->nullable();
        
        // Връзките (Foreign Keys)
        $table->foreignId('lecturer_id')->constrained()->cascadeOnDelete();
        $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
        $table->foreignId('location_id')->constrained()->cascadeOnDelete();
        
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
