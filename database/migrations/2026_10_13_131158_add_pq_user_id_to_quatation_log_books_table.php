<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quatation_log_books', function (Blueprint $table) {
            $table->foreignId('pq_user_id')->nullable()->after('generator')
                ->constrained('users')->nullOnDelete();
        });

        // পুরনো ডাটা: নাম মিললে user id বসাও
        DB::statement('
            UPDATE quatation_log_books q
            JOIN users u ON TRIM(u.name) = TRIM(q.pq_taken_by)
            SET q.pq_user_id = u.id
            WHERE q.pq_user_id IS NULL
        ');
    }

    public function down(): void
    {
        Schema::table('quatation_log_books', function (Blueprint $table) {
            $table->dropConstrainedForeignId('pq_user_id');
        });
    }
};