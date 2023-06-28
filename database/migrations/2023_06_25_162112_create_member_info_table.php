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
        Schema::create('member_info', function (Blueprint $table) {
            $table->id();
            $table->string("title")->nullable();
            $table->string("surname")->nullable();
            $table->string("other_names")->nullable();
            $table->string("email")->nullable();
            $table->date('dob')->nullable();
            $table->string("religion")->nullable();
            $table->string("marital_status")->nullable();
            $table->string("phone_number")->nullable();
            $table->string("postal_address")->nullable();
            $table->string("landline")->nullable();
            $table->string("gender")->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id')
              ->references('id')->on('districts')->onDelete('cascade');
            $table->foreignId('party_id')->nullable()->constrained('political_party')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_info');
    }
};
