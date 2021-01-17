<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Colection extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colections', function (Blueprint $table) {
            $table->id();
            $table->string('name_colection');
            $table->string('simbol');
            $table->date('date');
            $table->timestamps();

    });
    Schema::table('cards',function(Blueprint $table){
            $table->foreignId('colection_id')->nullable()->constrained();
        });
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cards', function (Blueprint $table) {
            //
            $table->dropForeign(['colection_id']);
            $table->dropColumn('colection_id');
        });

        Schema::dropIfExists('colections');
    }
}
