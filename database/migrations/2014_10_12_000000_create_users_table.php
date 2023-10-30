<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('contact_number')->nullable();
            $table->enum('role', ['Admin', 'Committee', 'User'])->nullable();
            $table->enum('gender', ['Male','Female'])->nullable();
            $table->enum('status', ['Active', 'Inactive'])->nullable();
            $table->string('photo')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->bigInteger('zip_code')->nullable();
            $table->boolean('committee')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        $data = [
            ['fname' => 'Admin', 'lname' => 'User', 'email' => 'admin@gmail.com', 'password' => bcrypt('12345678'), 'role' => 'Admin', 'status' => 'Active', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['fname' => 'Juan',  'lname' => 'Dela Cruz', 'email' => 'juan@gmail.com', 'password' => bcrypt('12345678'), 'role' => 'User', 'status' => 'Active', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        ];

        DB::table('users')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
