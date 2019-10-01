<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->foreign('project_name_id')->references('id')->on('project_names')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('property_type_id')->references('id')->on('property_types')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('for_sale_id')->references('id')->on('for_sales')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('for_rent_id')->references('id')->on('for_rents')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign('properties_project_name_id_foreign');
            $table->dropForeign('properties_property_type_id_foreign');
            $table->dropForeign('properties_status_id_foreign');
            $table->dropForeign('properties_for_sale_id_foreign');
            $table->dropForeign('properties_for_rent_id_foreign');
            $table->dropForeign('properties_region_id_foreign');
        });
    }
}
