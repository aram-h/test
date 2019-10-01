<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 150);
            $table->text('description');
            $table->tinyInteger('bedroom');
            $table->tinyInteger('bathroom');
            $table->unsignedInteger('property_type_id');
            $table->unsignedTinyInteger('status_id');
            $table->unsignedTinyInteger('for_sale_id');
            $table->unsignedTinyInteger('for_rent_id');
            $table->unsignedInteger('project_name_id');
            $table->unsignedInteger('region_id');
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
        Schema::dropIfExists('properties');
    }
}
