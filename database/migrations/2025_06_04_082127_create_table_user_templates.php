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
        Schema::create('user_templates', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Just once
            $table->text('description')->nullable();
            $table->string('domain')->nullable();
            $table->string('design')->nullable(); // Design name (e.g., modern, minimal)
            $table->unsignedBigInteger('template_id'); // Template ID (foreign-style, even if JSON)
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
        Schema::dropIfExists('table_user_templates');
    }
};
