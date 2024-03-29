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
        Schema::create('lessons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('module_id')->index();
            $table->string('name')->unique();
            $table->string('url')->unique();
            $table->text('description')->nullable();
            $table->string('embed')->unique();
            $table->string('duration')->nullable();
            $table->string('plataform', 20)->nullable();

            $table->foreign('module_id')
            ->references('id')
            ->on('modules');
            
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
        Schema::dropIfExists('lessons');
    }
};
