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
        Schema::create('ctl_products', function (Blueprint $table) {
            $table->id();
            $table->string('product')->unique();
            $table->string('description')->nullable();
            $table->float('price')->unsigned();
            $table->foreignId('ctl_default_task_id')->nullable()->constrained('ctl_tasks');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ctl_products');
    }
};
