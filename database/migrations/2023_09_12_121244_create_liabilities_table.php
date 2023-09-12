<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiabilitiesTable extends Migration
{
    public function up()
    {
        Schema::create(
            'liabilities', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->decimal('value');
                $table->foreignId('real_estate_id')->constrained('real_estates')->onDelete('cascade');
                $table->timestamps();
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('liabilities');
    }
}
