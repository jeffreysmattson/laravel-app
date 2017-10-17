<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VisitorsMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('UserIp', 15);
            $table->string('host', 100);
            $table->string('UserAgent', 255);
            $table->string('FirstName', 20);
            $table->string('LastName', 20);
            $table->string('Email', 50);
            $table->string('Accept', 255);
            $table->string('AcceptLanguage', 255);
            $table->string('AcceptEncoding', 255);
            $table->string('Cookie', 255);
            $table->string('Cookie2', 255);
            $table->string('Cookie3', 255);
            $table->string('Connection', 50);
            $table->string('UpgradeInsecureRequests', 255);
            $table->text('SessionHeaderArray');
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
        Schema::drop('visitors_meta');
    }
}
