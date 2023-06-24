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
        Schema::create('ctl_tasks_mobilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ctl_source_task_id');
            $table->unsignedBigInteger('ctl_target_task_id');
            $table->foreign('ctl_source_task_id', 'fk_ctl_tasks_mobilities_source_task_id')
                ->on('ctl_tasks')
                ->references('id');
            $table->foreign('ctl_target_task_id', 'fk_ctl_tasks_mobilities_target_task_id')
                ->on('ctl_tasks')
                ->references('id');
            $table->unique(['ctl_source_task_id', 'ctl_target_task_id'], 'unique_task_source_target');
            $table->foreignId('user_id')->constrained('users');
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
        Schema::dropIfExists('ctl_tasks_mobilities');
    }
};
