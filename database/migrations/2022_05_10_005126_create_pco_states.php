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
        Schema::create('pco_states', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ctl_state_id')->constrained('ctl_states')
                ->cascadeOnDelete();
            $table->foreignId('pco_task_id')->constrained('pco_tasks')
                ->cascadeOnDelete();
            $table->foreignId('pco_order_id')->constrained('pco_orders')
                ->cascadeOnDelete();
            $table->foreignId('pco_last_state_id')->nullable()->constrained('pco_states')
                ->cascadeOnDelete();
            $table->foreignId('pco_macro_state_id')->nullable()->constrained('pco_states')
                ->cascadeOnDelete();
            $table->unsignedInteger('aging')->nullable();
            $table->foreignId('user_id')->constrained('users')
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
        Schema::dropIfExists('pco_states');
    }
};
