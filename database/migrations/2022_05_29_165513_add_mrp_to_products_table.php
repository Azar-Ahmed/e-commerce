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
        Schema::table('products', function (Blueprint $table) {
            $table->integer('mrp')->nullable()->after('image');
            $table->integer('price')->nullable()->after('mrp');
            $table->string('size')->nullable()->after('price');
            $table->string('color')->nullable()->after('size');
            $table->integer('qty')->nullable()->after('color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('mrp');
            $table->dropColumn('price');
            $table->dropColumn('size');
            $table->dropColumn('color');
            $table->dropColumn('qty');
        });
    }
};
