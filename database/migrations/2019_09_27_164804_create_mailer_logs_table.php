<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailerLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailer_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid', 32);
            $table->unsignedInteger('mailer_customer_id')->index();
            $table->unsignedInteger('mailer_email_id')->index();
            $table->dateTime('read_datetime');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mailer_logs');
    }
}
