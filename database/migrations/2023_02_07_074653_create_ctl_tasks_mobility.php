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
            $table->foreignId('ctl_source_task_id')->constrained('ctl_tasks');
            $table->foreignId('ctl_target_task_id')->constrained('ctl_tasks');
            $table->unique(['ctl_source_task_id', 'ctl_target_task_id']);
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
