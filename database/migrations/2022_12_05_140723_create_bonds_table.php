<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBondsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonds', function (Blueprint $table) {
            $table->id();
            $table->decimal('nominal_price');
            $table->integer('frequency_of_payment_coupons');
            $table->integer('interest_calculation_period');
            $table->decimal('coupon_percent');
            $table->string('currency');
            $table->date('issue_date');
            $table->date('last_circulation_date');

            // I prefer not to delete the actual data completely. That's why I always use softDeletes
            $table->softDeletes();
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
        Schema::dropIfExists('bonds');
    }
}
