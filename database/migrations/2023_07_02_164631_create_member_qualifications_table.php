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
        Schema::create('member_qualifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('member_info')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('award_id')->constrained('qualifications')->onUpdate('cascade')->onDelete('cascade');
            $table->string('institution')->nullable();
            $table->string('year')->nullable();
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
        Schema::dropIfExists('member_qualifications');
    }
};
