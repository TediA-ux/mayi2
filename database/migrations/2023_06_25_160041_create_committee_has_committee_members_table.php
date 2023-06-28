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
        Schema::create('committee_has_committee_members', function (Blueprint $table) {
            $table->foreignId('committee_id')->constrained('committees')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('committee_member_id')->constrained('committee_members')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('committee_has_committee_members');
    }
};
