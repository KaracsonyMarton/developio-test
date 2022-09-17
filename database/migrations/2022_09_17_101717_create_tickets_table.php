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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('message');
            $table->date('due_date');
            $table->timestamps();

            $table->unsignedBigInteger('person_id');
            $table
                ->foreign('person_id')
                ->references('id')
                ->on('people')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['person_id']);
        });
    }
};
