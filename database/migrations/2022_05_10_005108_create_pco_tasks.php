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
        Schema::create('pco_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pco_order_id')->constrained('pco_orders')->cascadeOnDelete();
            $table->foreignId('ctl_task_id')->constrained('ctl_tasks')
                ->cascadeOnDelete();
            $table->foreignId('pco_process_id')->nullable()->constrained('pco_process')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('pco_state_id')->nullable();
            $table->unsignedInteger('aging')->nullable();
            $table->foreignId('user_id')->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('user_treatment_id')->nullable()->constrained('users')
                ->cascadeOnDelete();
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
        Schema::dropIfExists('pco_tasks');
    }
};
