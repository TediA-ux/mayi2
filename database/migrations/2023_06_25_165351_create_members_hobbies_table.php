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
        Schema::create('members_hobbies', function (Blueprint $table) {
            $table->foreignId('member_id')->constrained('member_info')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('hobby_id')->constrained('hobbies')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members_hobbies');
    }
};
