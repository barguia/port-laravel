<?php

use App\Models\PcoProcess;
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
        Schema::table('ctl_process', function(Blueprint $table) {
            $table->foreignId('ctl_process_id')->nullable()
                ->after('id')->constrained('ctl_process')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ctl_process', function(Blueprint $table) {

            if (DB::getDriverName() !== 'sqlite') {
                $table->dropForeign(['ctl_process_id']);
            }

            $table->dropColumn(['ctl_process_id']);
        });
    }
};
