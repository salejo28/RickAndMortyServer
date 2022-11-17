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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('');
            $table->string('status')->default('');
            $table->string('species')->default('');
            $table->string('type')->default('');
            $table->string('gender')->default('');
            $table->json('origin')->default('');
            $table->json('location')->default('');
            $table->text('image')->default('');
            $table->text('episode')->default('');
            $table->text('url')->default('');
            $table->string('created');
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
        Schema::dropIfExists('characters');
    }
};
