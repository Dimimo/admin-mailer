<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailerEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailer_emails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('body')->nullable();
            $table->unsignedInteger('mailer_campaign_id')->index();
            $table->boolean('draft')->default(true)->index();
            $table->dateTime('send_datetime');
            $table->unsignedInteger('created_by')->index();
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
        Schema::dropIfExists('mailer_emails');
    }
}
