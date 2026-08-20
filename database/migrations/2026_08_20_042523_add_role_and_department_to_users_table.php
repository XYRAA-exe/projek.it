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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')
                  ->after('password')
                  ->constrained('roles')
                  ->restrictOnDelete();
                 
            $table->foreignId('department_id')
                  ->after('role_id')
                  ->constrained('departments')
                  ->restrictOnDelete();
                     
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['department_id']);

            $table->dropcolum(['role_id', 'department_id']);
        
        });
    }
};
