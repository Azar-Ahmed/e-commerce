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
        Schema::table('coupons', function (Blueprint $table) {
            $table->enum('type', ['Value', 'Percentage'])->nullable()->after('value');;
            $table->integer('min_order_amt')->nullable()->after('type');
            $table->integer('uses_time')->nullable()->after('min_order_amt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('min_order_amt');
            $table->dropColumn('uses_time');
        });
    }
};
