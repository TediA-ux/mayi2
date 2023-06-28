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
        Schema::create('mp_work_experience', function (Blueprint $table) {
            $table->id();
            $table->string("job_title")->nullable();
            $table->string("organization")->nullable();
            $table->string("period")->nullable();
            $table->foreignId('profession_id')->nullable()->constrained('profession')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mp_work_experience');
    }
};
