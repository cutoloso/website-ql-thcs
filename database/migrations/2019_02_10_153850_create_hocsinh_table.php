<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHocsinhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HocSinh', function (Blueprint $table) {
            $table->char('hs_ma',8)->comment('Mã học sinh');
            // $table->string('hs_matKhau',32)->comment('Mật khẩu đăng nhập');
            $table->string('hs_hoTen',100)->comment('Họ tên học sinh');
            $table->date('hs_ngaySinh')->comment('Ngày sinh học sinh');
            $table->boolean('hs_phai')->comment('hsái: 1: Nam - 0: Nu')->default(1);
            $table->string('hs_diaChi')->comment('Địa chỉ học sinh');
            // $table->string('hs_trangThai')->comment('Trạng thái tốt nghiệp: 0:chưa tốt nghiệp , 1:đã tốt nghiệp');
            $table->char('l_ma',3)->comment('Mã lớp');
            $table->string('kh_khoaHoc')->comment('Niên khóa');
            $table->char('ph_ma',8)->nullable()->comment('Mã phụ huynh');

            // $table->unsignedInteger('tk_ma')->comment('Mã tài khoản')->unique();
            // $table->timestamp('hs_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm tạo mới');

            // $table->timestamp('hs_capnhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm cập nhật gần nhất');
        // khóa
            $table->primary(['hs_ma']);
            $table->foreign('hs_ma')->references('name')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign(['l_ma','kh_khoaHoc'])->references(['l_ma','kh_khoaHoc'])->on('Lop')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ph_ma')->references('ph_ma')->on('PhuHuynh')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HocSinh');
    }
}
