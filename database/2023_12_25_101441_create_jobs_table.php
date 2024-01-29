<?php
// In create_jobs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('timesheet_id')->nullable()->constrained();
            $table->string('venue');
            $table->string('customer');
            $table->string('callType');
            $table->text('remark');
            $table->string('userLocation');
            $table->string('userEmail');
            $table->string('status'); // 'clock_in'
            $table->string('image');
            $table->timestamps(); // Adds 'created_at' and 'updated_at' columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
