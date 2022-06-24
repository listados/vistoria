<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFielsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('adm')->nullable();
            $table->integer('status')->nullable()->default(1);
            $table->string('avatar', 150)->nullable();
            $table->integer('id_profile')->nullable();
            $table->string('nick', 50)->nullable();
            $table->string('receive_proposal', 50)->nullable();
            $table->string('phone', 25)->nullable();
            $table->string('cpf', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('adm');
            $table->dropColumn('status');
            $table->dropColumn('avatar');
            $table->dropColumn('id_profile');
            $table->dropColumn('nick');
            $table->dropColumn('receive_proposal');
            $table->dropColumn('phone');
            $table->dropColumn('cpf');
        });
    }
}
