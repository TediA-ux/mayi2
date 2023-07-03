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
        // Drop the foreign key constraint
        Schema::table('members_hobbies', function (Blueprint $table) {
            $table->dropForeign('members_hobbies_hobby_id_foreign');
        });

        // Drop the 'hobby_id' column
        Schema::table('members_hobbies', function (Blueprint $table) {
            $table->dropColumn('hobby_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members_hobbies', function (Blueprint $table) {
            //
        });
    }
};
