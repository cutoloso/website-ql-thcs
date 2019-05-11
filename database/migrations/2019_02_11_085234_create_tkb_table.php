<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTkbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TKB', function (Blueprint $table) {
            $table->unsignedTinyInteger('th_stt')->comment('Số thứ tự tiết học');
            $table->string('th_buoi')->comment('Buổi học (Sáng - Chiều) của tiết học');
            $table->string('t_ma')->comment('Mã thứ');
            $table->char('l_ma',3)->comment('Mã lớp');
            $table->char('mh_ma',6)->comment('Mã môn học');
            $table->char('gv_ma',8)->comment('Mã giáo viên');
            $table->char('kh_khoaHoc',4)->comment('Niên khóa');
            $table->string('hk_hocKy')->comment('Học kỳ trong năm học');
            $table->string('hk_namHoc')->comment('Năm học');
            
            // khóa
            $table->primary(['th_stt','th_buoi','t_ma','l_ma','mh_ma','gv_ma','kh_khoaHoc','hk_hocKy','hk_namHoc'],'tkb_primaryKey');

            $table->foreign(['mh_ma','l_ma','kh_khoaHoc','gv_ma'])->references(['mh_ma','l_ma','kh_khoaHoc','gv_ma'])->on('Day')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign(['th_stt','th_buoi'])->references(['th_stt','th_buoi'])->on('TietHoc')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('t_ma')->references('t_ma')->on('Thu')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign(['hk_hocKy','hk_namHoc'])->references(['hk_hocKy','hk_namHoc'])->on('HocKy')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TKB');
    }
}
