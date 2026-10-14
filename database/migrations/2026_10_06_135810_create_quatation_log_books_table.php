<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quatation_log_books', function (Blueprint $table) {
            $table->id();

            $table->string('project_name');
            $table->text('project_address')->nullable();
            $table->json('contact_numbers')->nullable();
            $table->json('contact_persons')->nullable();

            $table->string('lift_size')->nullable();
            $table->unsignedInteger('capacity_kg')->nullable();
            $table->unsignedSmallInteger('passengers')->nullable();
            $table->unsignedSmallInteger('floors')->nullable();
            $table->unsignedSmallInteger('lift_quantity')->default(1);

            $table->json('offers')->nullable(); // [{"brand":"HIDOKS-10P","price":3100}]

            $table->string('sub_station')->nullable();
            $table->string('generator')->nullable();

            $table->string('pq_taken_by')->nullable();
            $table->date('pq_date')->nullable();
            $table->text('remarks')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('project_name');
            $table->index('pq_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quatation_log_books');
    }
};