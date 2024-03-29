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
        Schema::create('ctl_process', function (Blueprint $table) {
            $table->id();
            $table->string('process')->unique();
            $table->unsignedBigInteger('ctl_process_id')->nullable();
            $table->foreignId('ctl_process_hierarchy_id')
                ->constrained('ctl_process_hierarchies')
                ->cascadeOnDelete();
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
        Schema::dropIfExists('ctl_process');
    }
};
