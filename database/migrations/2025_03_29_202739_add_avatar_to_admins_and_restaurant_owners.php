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
        Schema::table('admins', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('id');
        });

        Schema::table('restaurant_owners', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('id');
        });

        Schema::table('restaurant_owners', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('id');
        });
    }
};
