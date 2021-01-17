<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('name_cards');
            $table->string('description');
            $table->string('collection');
            $table->timestamps();
        });
          Schema::table('ventas',function(Blueprint $table){
            $table->foreignId('cards_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ventas', function (Blueprint $table) {
            //
            $table->dropForeign(['cards_id']);
            $table->dropColumn('cards_id');
        });
        Schema::dropIfExists('cards');
    }
}