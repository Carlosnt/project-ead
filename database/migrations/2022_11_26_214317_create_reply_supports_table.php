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
        Schema::create('reply_support', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('support_id')->index();
            $table->uuid('user_id')->nullable();
            $table->uuid('admin_id')->nullable();
            $table->text('description');

            $table->foreign('support_id')
                    ->references('id')
                    ->on('supports');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('admin_id')
                ->references('id')
                ->on('admins');

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
        Schema::dropIfExists('reply_support');
    }
};
