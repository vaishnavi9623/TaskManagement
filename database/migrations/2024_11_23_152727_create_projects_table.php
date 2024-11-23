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
        Schema::create('projects', function (Blueprint $table) {
            $table->id(); 
            $table->string('name'); 
            $table->text('description')->nullable(); 
            $table->date('start_date'); 
            $table->date('end_date')->nullable(); 
            $table->enum('status', ['pending', 'ongoing', 'completed', 'on_hold'])->default('pending'); 
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium'); 
            $table->string('client_name');
            $table->string('client_contact')->nullable(); 
            $table->string('project_manager'); 
            $table->string('assigned_team')->nullable(); 
            $table->integer('budget')->nullable(); 
            $table->text('notes')->nullable(); 
            $table->timestamps(); // Created and updated timestamps

           
            // Optional: Metadata for attachments or project-specific codes
            $table->json('attachments')->nullable(); 
            $table->string('project_code')->nullable(); //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
