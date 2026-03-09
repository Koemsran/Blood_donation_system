<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donors', function (Blueprint $table) {
            if (Schema::hasColumn('donors', 'age')) {
                $table->dropColumn('age');
            }
            if (!Schema::hasColumn('donors', 'date_of_birth')) {
                $table->date('date_of_birth')->after('name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('donors', function (Blueprint $table) {
            if (Schema::hasColumn('donors', 'date_of_birth')) {
                $table->dropColumn('date_of_birth');
            }
            if (!Schema::hasColumn('donors', 'age')) {
                $table->integer('age')->after('name');
            }
        });
    }
};
