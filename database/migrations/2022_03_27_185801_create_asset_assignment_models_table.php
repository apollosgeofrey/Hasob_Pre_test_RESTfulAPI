<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetAssignmentModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_assignment_models', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('assetId');
            $table->string('assignmentDate')->nullable();;
            $table->string('status')->nullable();;
            $table->string('isDue')->nullable();;
            $table->string('dueDate')->nullable();;
            $table->string('assignedUserId');
            $table->string('assignedBy');
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
        Schema::dropIfExists('asset_assignment_models');
    }
}
