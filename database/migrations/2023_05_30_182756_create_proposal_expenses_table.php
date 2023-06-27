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
        Schema::create('proposal_expenses', function (Blueprint $table) {
            $table->id();
            $table->integer('proposal_id');
            $table->string('name')->nullable();
            $table->integer('user_id');
            $table->decimal('amount', 8, 2)->nullable();
            $table->string('document_file')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_expenses');
    }
};
