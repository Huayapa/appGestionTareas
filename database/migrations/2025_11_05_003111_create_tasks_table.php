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
        Schema::connection('mongodb')->create('tasks', function (Blueprint $collection) {
            $collection->id();
            $collection->string('title');
            $collection->text('description')->nullable();
            $collection->enum('status', ['pendiente', 'en progreso', 'completada'])->default('pendiente');
            $collection->date('due_date');
            $collection->string('user_assigned')->nullable();
            $collection->timestamps();  
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mongodb')->dropIfExists('tasks');
    }
};
