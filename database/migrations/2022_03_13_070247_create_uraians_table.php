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
        Schema::create('uraians', function (Blueprint $table) {
            $table->id();
            $table->string('kode_rek',25);
            $table->string('sub_id',25);
            $table->foreign('sub_id')->references('kode_rek')
                ->on('subkegiatans')->onUpdate('cascade')->onDelete('cascade');
            $table->text('nama_uraian');
            $table->string('jumlah',12);
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uraians');
    }
};
