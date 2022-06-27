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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('cat_id')->nullable();
            $table->string('name')->nullable();
            $table->string('brand')->nullable();
            $table->longText('desc')->nullable();
            $table->text('keyword')->nullable();
            $table->text('features')->nullable();
            $table->string('warrenty')->nullable();
            $table->string('image')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('products');
    }
};
