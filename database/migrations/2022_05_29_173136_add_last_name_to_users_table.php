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
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name')->nullable()->after('first_name');
            $table->integer('mobile')->nullable()->after('email');
            $table->text('address')->nullable()->after('mobile');
            $table->string('city')->nullable()->after('address');
            $table->string('state')->nullable()->after('city');
            $table->string('country')->nullable()->after('state');
            $table->integer('pincode')->nullable()->after('country');
            $table->string('avatar')->nullable()->after('pincode');
            $table->integer('status')->default(1)->after('password');   
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
            $table->dropColumn('last_name');
            $table->dropColumn('mobile');
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('country');
            $table->dropColumn('pincode');
            $table->dropColumn('avatar');
            $table->dropColumn('status');
        });
    }
};
