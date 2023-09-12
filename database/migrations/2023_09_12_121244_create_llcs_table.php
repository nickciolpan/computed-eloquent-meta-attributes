<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLLCsTable extends Migration
{
    public function up()
    {
        Schema::create(
            'llcs', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->decimal('value');
                $table->timestamps();
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('llcs');
    }
}
