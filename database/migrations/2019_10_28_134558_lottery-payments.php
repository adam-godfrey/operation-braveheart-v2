<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LotteryPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lottery-payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('player_id')->nullable();
            $table->date('draw_date')->nullable();
            $table->enum('draw_type', ['UK', 'Local']);
            $table->tinyInteger('paid')->default('0')->nullable();
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
        Schema::dropIfExists('lottery-payments');
    }
}
