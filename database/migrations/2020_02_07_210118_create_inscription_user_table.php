<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscriptionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscription_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('inscription_id');
            $table->foreign('inscription_id')->references('id')->on('inscriptions')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('assistance', 1)->nullable();
            $table->unsignedSmallInteger('grade');
            $table->unsignedSmallInteger('grade_min');
            $table->unsignedSmallInteger('grade_start')->nullable();
            $table->string('type');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('unity_id');
            $table->string('state',1)->default('1');
            $table->unsignedBigInteger('user_created');
            $table->unsignedBigInteger('user_modified');
            $table->unsignedBigInteger('user_deleted');
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
        Schema::dropIfExists('inscription_user');
    }
}
