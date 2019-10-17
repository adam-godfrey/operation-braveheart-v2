<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmailAttachments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email-attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid')->nullable();
            $table->string('attachmentid')->nullable();
            $table->string('filename')->nullable();
            $table->string('original')->nullable();
            $table->string('mime')->nullable();
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
        Schema::dropIfExists('email-attachments');
    }
}
