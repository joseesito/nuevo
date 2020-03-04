<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ruc')->unique();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('state')->default(1);
            $table->string('phone')->nullable();
            $table->timestamps();
        });

        Schema::create('unities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('state')->default(1);
            $table->timestamps();
        });


        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')
                ->references('id')->on('companies')
                ->onDelete('cascade');
            $table->unsignedBigInteger('unity_id');
            $table->foreign('unity_id')
                ->references('id')->on('unities')
                ->onDelete('cascade');
            $table->string('type_document');
            $table->string('document');
            $table->string('last_name');
            $table->string('name');
            $table->string('position')->nullable();
            $table->string('area')->nullable();
            $table->string('management')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('state')->default(1);
            $table->bigInteger('user_created')->nullable();
            $table->bigInteger('user_modified')->nullable();
            $table->bigInteger('user_deleted')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('unities');
        Schema::dropIfExists('companies');
    }
}
