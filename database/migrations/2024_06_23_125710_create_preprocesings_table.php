<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('preprocesings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dataset_id');
            $table->text('cleaning')->nullable();
            $table->text('tokenizing')->nullable();
            $table->text('slangword')->nullable();
            $table->text('stopword')->nullable();
            $table->text('steming')->nullable();
            $table->text('label')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preprocesings');
    }
};
