<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrangthaithongbaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TrangThaiThongBao', function (Blueprint $table) {
            $table->unsignedInteger('tbcn_ma')->comment('Mã thông báo cá nhân');
            $table->char('name',8)->comment('Mã tài khoản hệ thống');          
            $table->boolean('tt_trangThai')->comment('Trạng thái: 1: Đã xem - 0: Chưa Xem')->default(0);
        // Khóa
            $table->primary(['tbcn_ma','name']);

            $table->foreign('tbcn_ma')->references('tbcn_ma')->on('ThongBaoCaNhan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('name')->references('name')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TrangThaiThongBao');
    }
}
