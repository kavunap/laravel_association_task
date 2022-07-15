<?php

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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('line_1');
            $table->string('line_2');
            $table->string('line_3');
            $table->string('city');
            $table->string('prefecture');
            $table->string('postalcode');
            $table->integer('commentable_id');
            $table->string('commentable_type');
            $table->timestamps();
        });
        Schema::table('shops', function (Blueprint $table) {
            $table->dropForeign('shops_city_id_foreign');
            $table->dropColumn('city_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
        Schema::table('shops', function (Blueprint $table) {
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }
};
