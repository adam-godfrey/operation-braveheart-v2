<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LotteryDraw extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lottery-draws', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->date('draw_date')->nullable();
            $table->integer('first')->nullable();
            $table->integer('second')->nullable();
            $table->integer('third')->nullable();
            $table->integer('fourth')->nullable();
            $table->char('active', 1)->default('1')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lottery-draws');
    }
}
