<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings_site_title', function (Blueprint $table) {
            $table->id();
            $table->string('site_title')->nullable();
            $table->string('site_description')->nullable();
            $table->string('site_keywords')->nullable();
            $table->string('site_logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('site_title_color')->default('#000000');
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
        Schema::dropIfExists('settings_site_title');
    }
};
