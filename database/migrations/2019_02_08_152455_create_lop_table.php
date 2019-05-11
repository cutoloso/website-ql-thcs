<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Lop', function (Blueprint $table) {
            $table->char('l_ma',3)->comment('Mã lớp');
            $table->char('kh_khoaHoc',4)->comment('Niên khóa');
            $table->string('p_ma',3)->comment('Mã phòng');
            $table->char('gv_ma',8)->comment('Mã giáo viên chủ nhiệm');
        // khóa
            $table->primary(['l_ma','kh_khoaHoc']);
            
            $table->foreign('kh_khoaHoc')->references('kh_khoaHoc')->on('KhoaHoc')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('p_ma')->references('p_ma')->on('Phong')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('Lop');
    }
}
