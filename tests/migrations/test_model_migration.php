<?php

use Chareice\LaravelEloquentFSM\Tests\TestModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('state')->default(TestModel::defaultState()->value);
            $table->timestamps();
        });
    }
};
