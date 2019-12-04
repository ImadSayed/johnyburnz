<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('users')->insert(
            array(
                'id' => '1',
                'name' => 'John Burns',
                'email' => 'jb@johnburns.com',
                'username' => 'Johny Burnz',
                'password' => bcrypt('qwertyui')
            )
        );


        Schema::create('profiles', function (Blueprint $ptable) {
            $ptable->bigIncrements('id');
            $ptable->unsignedBigInteger('user_id');
            $ptable->string('title')->nullable();
            $ptable->string('instrument')->nullable();
            $ptable->text('description')->nullable();
            $ptable->string('image')->nullable();
            $ptable->timestamps();

            $ptable->index('user_id');
        });

        \Illuminate\Support\Facades\DB::table('profiles')->insert(
            array(
                'id' => '1',
                'user_id' => '1',
                'title' => 'Johny Burnz',
            )
        );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('profiles');
    }
}
