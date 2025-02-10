<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('log_harians', function (Blueprint $table) {
            $table->timestamp('verified_at')->nullable()->after('status');
        });
    }
    
    public function down()
    {
        Schema::table('log_harians', function (Blueprint $table) {
            $table->dropColumn('verified_at');
        });
    }    
};
