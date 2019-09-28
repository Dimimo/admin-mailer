<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailerCampaignMailerListPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailer_campaign_mailer_list', function (Blueprint $table) {
            $table->integer('mailer_campaign_id')->unsigned()->index('mailer_campaign_id_primary');
            $table->foreign('mailer_campaign_id', 'mailer_campaign_id_foreign')->references('id')->on('mailer_campaigns')->onDelete('cascade');
            $table->integer('mailer_list_id')->unsigned()->index('mailer_list_id_primary');
            $table->foreign('mailer_list_id', 'mailer_list_id_foreign')->references('id')->on('mailer_lists')->onDelete('cascade');
            $table->primary(['mailer_campaign_id', 'mailer_list_id'], 'mailer_campaign_list_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mailer_campaign_mailer_list');
    }
}
