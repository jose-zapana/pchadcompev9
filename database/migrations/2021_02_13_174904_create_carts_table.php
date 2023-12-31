<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->decimal('total', 8, 2);

            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('shop_id');
            $table->foreign('customer_id')
                ->references('id')->on('customers');
            $table->foreign('shop_id')
                ->references('id')->on('shops');
            $table->enum('state', ['on', 'off']);
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
        Schema::dropIfExists('carts');
    }
}
