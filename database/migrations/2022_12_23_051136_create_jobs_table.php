<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->Text('short_description')->nullable();
            $table->Text('long_description')->nullable();
            $table->Text('job_description')->nullable();
            $table->Text('requirement')->nullable();
            $table->Text('tags')->nullable();
            $table->Text('job_types')->nullable();
            $table->Text('job_category')->nullable();
            $table->Text('job_product_group')->nullable();
            $table->string('job_time')->nullable();
            $table->string('location')->nullable();
            $table->string('file');
            $table->string('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
