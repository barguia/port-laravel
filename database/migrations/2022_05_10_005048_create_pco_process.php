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
        Schema::create('pco_process', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pco_order_id')->constrained('pco_orders')->cascadeOnDelete();
            $table->unsignedBigInteger('pco_process_id')->nullable();
            $table->foreignId('ctl_process_id')->constrained('ctl_process')->cascadeOnDelete();
            $table->unsignedInteger('aging')->nullable();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
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
        Schema::dropIfExists('pco_process');
    }
};
