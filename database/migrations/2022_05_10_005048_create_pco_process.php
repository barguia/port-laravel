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
            $table->foreignId('pco_object_id')->constrained('pco_objects')->cascadeOnDelete();
            $table->foreignId('ctl_process_id')->constrained('ctl_process')->cascadeOnDelete();
            $table->unsignedInteger('aging_in_days')->nullable();
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
