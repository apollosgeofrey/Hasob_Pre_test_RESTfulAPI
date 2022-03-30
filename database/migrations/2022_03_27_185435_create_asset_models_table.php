    <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_models', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('type');
            $table->string('serialNumber')->unique();
            $table->text('description');
            $table->string('fixed_movable')->nullable();
            $table->string('picturePath')->nullable();
            $table->string('purchaseDate')->nullable();
            $table->string('startUseDate')->nullable();
            $table->string('purchasePrice');
            $table->string('warrantyExpiryDate')->nullable();  
            $table->string('degradationInYears')->nullable(); 
            $table->string('currentValueInNaira')->nullable();
            $table->text('location')->nullable();
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
        Schema::dropIfExists('asset_models');
    }
}
