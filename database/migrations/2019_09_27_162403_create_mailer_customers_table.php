<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailerCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailer_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid', 32)->unique()->index('mailer_customers_uuid_unique');
            $table->string('name');
            $table->string('email')->unique()->index('mailer_customers_email_unique');
            $table->unsignedInteger('mailer_list_id')->nullable()->index();
            $table->string('real_name')->nullable();
            $table->boolean('accepts_mail')->default(true)->index();
            $table->boolean('reads_mail')->default(false)->index();
            $table->string('url')->nullable();
            $table->string('wikipedia')->nullable();
            $table->string('faccebook')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('site_id')->nullable();
            $table->unsignedInteger('service_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id', 'site_id', 'service_id', 'city_id'], 'mailer_customers_user_info_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mailer_customers');
    }
}
