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
        Schema::create('proposal_tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('proposal_id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('document_file')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('assigned_user')->nullable();
            $table->enum('status', ['In Progress', 'Completed'])->nullable();
            $table->date('due_date')->nullable();
            $table->date('date_completed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_tasks');
    }
};
