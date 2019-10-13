<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMailerEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailer_emails', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->text('body')->nullable();
            $table->unsignedInteger('mailer_campaign_id')->index();
            $table->boolean('draft')->default(true)->index();
            $table->dateTime('send_datetime')->nullable()->index();
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
