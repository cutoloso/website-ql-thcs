<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChudeGvPhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ChuDe_GV_PH', function (Blueprint $table) {
            $table->increments('cd_gvph_ma')->comment('Mã chủ đề');
            $table->string('cd_gvph_ten')->comment('Tên chủ đề');
            $table->char('ph_ma',8)->comment('Mã phụ huynh');
            $table->char('gv_ma',8)->comment('Mã giáo viên');
            
        //khóa
            // $table->primary(['cd_gvph_ma','ph_ma','gv_ma']);
            $table->foreign('ph_ma')->references('ph_ma')->on('PhuHuynh')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('gv_ma')->references('gv_ma')->on('GiaoVien')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ChuDe_GV_PH');
    }
}
