<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMailerLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailer_logs', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('uuid', 32);
            $table->unsignedInteger('mailer_customer_id')->index();
            $table->unsignedInteger('mailer_email_id')->index();
            $table->boolean('is_send')->default('0')->index();
            $table->dateTime('read_datetime')->nullable()->index();
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
        Schema::dropIfExists('mailer_logs');
    }
}
