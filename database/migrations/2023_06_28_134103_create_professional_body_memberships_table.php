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
        Schema::create('professional_body_memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('member_info')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('professional_body_id')->constrained('professional_bodies')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('membership_type',['Full','Associate','Fellow','Other'])->default('Full');
            // $table->foreignId('updated_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreignId('created_by')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professional_body_memberships');
    }
};
