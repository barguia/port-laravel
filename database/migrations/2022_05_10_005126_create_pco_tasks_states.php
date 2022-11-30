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
        Schema::create('pco_tasks_states', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ctl_task_state_id')->constrained('ctl_tasks_states')
                ->cascadeOnDelete();
            $table->foreignId('pco_task_id')->constrained('pco_tasks')
                ->cascadeOnDelete();
            $table->unsignedInteger('aging_in_days')->nullable();
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
        Schema::dropIfExists('pco_tasks_states');
    }
};
