<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')
                ->references('id')->on('courses')
                ->onDelete('cascade');
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')
                ->references('id')->on('locations')
                ->onDelete('cascade');
            $table->unsignedBigInteger('unity_id');
            $table->foreign('unity_id')
                ->references('id')->on('unities')
                ->onDelete('cascade');;
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');;
            $table->string('address');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('time');
            $table->integer('slot');

            // Campos historicos de la tabla curso.
            $table->string('name')->nullable();
            $table->string('hours')->nullable();
            $table->string('grade_min')->nullable();
            $table->decimal('price',6,2)->nullable();
            $table->string('free')->nullable();
            $table->string('validity')->nullable();
            $table->string('type_validity')->nullable();
            $table->string('certificate')->nullable();

            $table->bigInteger('user_created')->nullable();
            $table->bigInteger('user_modified')->nullable();
            $table->bigInteger('user_deleted')->nullable();
            $table->string('state')->default(1);
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
        Schema::dropIfExists('inscriptions');
    }
}
