<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilieresProfessorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filieres_professors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('filiere_id');
            $table->unsignedBigInteger('professor_id');
            $table->foreign('filiere_id')->references('id')
                  ->on('filieres')->onDelete('cascade');
            $table->foreign('professor_id')->references('id')
                  ->on('professors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filieres_professors');
    }
}
