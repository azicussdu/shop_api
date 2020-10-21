<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->double('volume', 10, 3);
            $table->double('weight', 10, 3);
            $table->enum('status',['0','1'])->default(1);
            $table->string('name');
            $table->string('alias')->unique();
            $table->string('description')->nullable();
            $table->text('content')->nullable();
            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onUpdate('cascade')->onDelete('cascade');
            $table->float('price', 18, 2)->default(0);
            $table->string('keywords')->nullable();
            $table->boolean('is_hit')->default(false);
            $table->string('image')->default('no_image.jpg');
            $table->integer('pieces_left')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
