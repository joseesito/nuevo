<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('type_course_id');
            $table->foreign('type_course_id')
                ->references('id')->on('type_courses')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('hours');
            $table->string('grade_min');
            $table->decimal('price',6,2)->nullable();
            $table->string('free')->default(0);
            $table->string('module');
            $table->string('validity');
            $table->string('type_validity');
            $table->string('certificate')->default(1);
            $table->bigInteger('user_created')->nullable();
            $table->bigInteger('user_modified')->nullable();
            $table->bigInteger('user_deleted')->nullable();
            $table->string('state');
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
        Schema::dropIfExists('courses');
    }
}
