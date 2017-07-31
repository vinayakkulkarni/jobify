<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id')->unique();
            $table->char('job_id')->index();

            $table->string('name')->nullable()->index();
            $table->string('email')->nullable()->index();
            $table->string('web_address')->nullable()->index();
            $table->text('cover')->nullable();

            $table->string('resume')->nullable();

            $table->ipAddress('ip_address')->nullable();
            $table->integer('rating')->default(0)->nullable();

            $table->boolean('like_working')->default(0)->index();
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
