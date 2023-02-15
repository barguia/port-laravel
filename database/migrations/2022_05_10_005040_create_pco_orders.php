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
        Schema::create('pco_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ctl_product_id')->constrained('ctl_products');
            $table->float('price')->unsigned();
            $table->unsignedInteger('aging')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
            $table->timestamp('finalized_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pco_orders');
    }
};
