<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServerLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_logs', function (Blueprint $table) {
            $table->id();
            $table->boolean('available');
            $table->integer('http_code')->nullable();
            $table->float('duration_request',8,6)->nullable();
            $table->float('duration_dns', 8,8)->nullable();
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
        Schema::dropIfExists('server_logs');
    }
}
