<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChudeGvHsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ChuDe_GV_HS', function (Blueprint $table) {
            $table->increments('cd_gvhs_ma')->comment('Mã chủ đề');
            $table->string('cd_gvhs_ten')->comment('Tên chủ đề');
            $table->char('hs_ma',8)->comment('Mã học sinh');
            $table->char('gv_ma',8)->comment('Mã giáo viên');
        //khóa
            // $table->primary(['cd_gvhs_ma','hs_ma','gv_ma']);
            $table->foreign('hs_ma')->references('hs_ma')->on('HocSinh')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('ChuDe_GV_HS');
    }
}
