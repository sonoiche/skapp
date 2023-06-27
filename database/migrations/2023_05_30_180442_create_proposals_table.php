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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('document_file')->nullable();
            $table->string('committee_id')->nullable();
            $table->enum('status', ['Pending','Approved','Declined'])->nullable();
            $table->integer('user_action')->nullable();
            $table->decimal('budget', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
