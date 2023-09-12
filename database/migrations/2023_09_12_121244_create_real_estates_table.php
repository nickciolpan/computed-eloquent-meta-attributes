<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealEstatesTable extends Migration
{
    public function up()
    {
        Schema::create(
            'real_estates', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->decimal('value');
                $table->foreignId('llc_id')->constrained('llcs')->onDelete('cascade');
                $table->timestamps();
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('real_estates');
    }
}
