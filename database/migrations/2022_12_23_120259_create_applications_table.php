<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->int('job_id');
            $table->string('r_first_name')->nullable();
            $table->Text('r_last_name')->nullable();
            $table->Text('r_email')->nullable();
            $table->string('first_name')->nullable();
            $table->Text('last_name')->nullable();
            $table->Text('dob')->nullable();
            $table->Text('email')->nullable();
            $table->Text('phone_no')->nullable();
            $table->Text('resume')->nullable();
            $table->Text('attachment')->nullable();
            $table->Text('portfolio')->nullable();
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
        Schema::dropIfExists('applications');
    }
}
