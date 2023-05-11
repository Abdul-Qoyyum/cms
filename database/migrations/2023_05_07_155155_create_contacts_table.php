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
        Schema::create('contacts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('address')->nullable();
            $table->string('state');
            $table->string('city');
            $table->string('country');
            $table->string('photo')->default(env('APP_URL') . '/public/src/images/3d-rendering-zoom-call-avatar.jpg');
            $table->string('lat')->nullable()->default(0);
            $table->string('long')->nullable()->default(0);
            $table->string('zip_code');
            $table->uuid('user_id');
            $table->uuid('category_id');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');
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
        Schema::dropIfExists('contacts');
    }
};
