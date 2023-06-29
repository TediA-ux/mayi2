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
        Schema::table('member_info', function (Blueprint $table) {
            $table->string("alt_contact")->nullable();
            $table->string("photo")->nullable();
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('member_info', function (Blueprint $table) {
            $table->dropColumn('alt_contact');
            $table->dropColumn('photo');
        });
    }
};
