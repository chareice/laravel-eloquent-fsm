<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('state_machine_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('from');
            $table->string('to');

            $table->string('event');

            $table->unsignedInteger('fsmable_id');
            $table->string('fsmable_type');

            $table->jsonb('meta')->nullable();

            $table->timestamps();
            $table->index(['fsmable_id', 'fsmable_type']);
        });
    }
};
