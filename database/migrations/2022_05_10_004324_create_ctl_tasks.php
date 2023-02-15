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
        Schema::create('ctl_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task');
            $table->foreignId('ctl_process_id')->nullable()->constrained('ctl_process');
            $table->foreignId('ctl_default_state_id')->nullable()->constrained('ctl_states');
            $table->unique(['task', 'ctl_process_id']);
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
        Schema::dropIfExists('ctl_tasks');
    }
};
