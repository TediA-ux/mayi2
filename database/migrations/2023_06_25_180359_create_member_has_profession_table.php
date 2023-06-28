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
        Schema::create('member_has_profession', function (Blueprint $table) {
            $table->foreignId('member_id')->constrained('member_info')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('profession_id')->constrained('profession')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_has_profession');
    }
};
