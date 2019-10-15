<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlaqueOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plaque-orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('plaque_id');
            $table->string('charge_id', 50)->nullable();
            $table->decimal('amount', 4, 2)->nullable();
            $table->tinyInteger('paid')->nullable()->default(1);
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
        Schema::dropIfExists('plaque-orders');
    }
}
