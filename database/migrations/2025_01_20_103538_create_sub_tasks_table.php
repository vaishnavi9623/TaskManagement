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
        Schema::create('sub_tasks', function (Blueprint $table) {
            $table->id();  // Primary Key
            $table->integer('task_id');  // Foreign Key reference to the task table
            $table->string('title');  // Title of the sub-task
            $table->enum('status', ['Pending', 'In Progress', 'Completed']);  // Status of the sub-task
            $table->foreignId('assigned_to')->nullable()->constrained('users');  // Assigned user (nullable in case not assigned)
            $table->enum('priority', ['Low', 'Medium', 'High']);  // Priority level
            $table->date('due_date')->nullable();  // Due date of the sub-task
            $table->date('start_date')->nullable();  // Start date of the sub-task
            $table->timestamp('completed_at')->nullable();  // Timestamp when completed
            $table->foreignId('created_by')->constrained('users');  // Created by user
            $table->foreignId('updated_by')->constrained('users');  // Updated by user
            $table->timestamps();  // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_tasks');
    }
};
