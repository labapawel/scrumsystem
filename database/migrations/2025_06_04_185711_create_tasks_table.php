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
         Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task_id')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['backlog', 'todo', 'progress', 'testing', 'done'])->default('backlog');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->integer('story_points')->default(0);
            $table->string('assignee_name')->nullable();
            $table->string('assignee_avatar')->nullable();
            $table->foreignId('sprint_id')->constrained()->cascadeOnDelete();
            $table->integer('position')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'position']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
