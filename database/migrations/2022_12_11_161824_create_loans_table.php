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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('loan_code',100);
            $table->integer('amount');
            $table->foreignId('user_id')->constrained();
            $table->string('reciver');
            $table->date('start_date');
            $table->tinyInteger('number_of_instalments');
            $table->tinyText('reminder');
            $table->tinyInteger('how_many_days_earlier');
            $table->tinyInteger('what_time');
            $table->softDeletes();
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
        Schema::dropIfExists('loans');
    }
};
