<?php

use App\Enums\UserRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->nullable()->after('password')->index();
            $table->foreignId('teacher_id')->nullable()->after('role')->unique()->constrained()->nullOnDelete();
        });

        DB::table('users')->whereNull('role')->update(['role' => UserRole::SuperAdmin->value]);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('teacher_id');
            $table->dropColumn('role');
        });
    }
};
