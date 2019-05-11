<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuantriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('QuanTri', function (Blueprint $table) {
            $table->char('qt_ma',8)->comment('Mã quản trị viên');
            // $table->string('qt_matKhau',32)->comment('Mật khẩu đăng nhập');
            $table->string('qt_hoTen',100)->comment('Họ tên quản trị viên');
            $table->date('qt_ngaySinh')->comment('Ngày sinh quản trị viên');
            $table->boolean('qt_phai')->comment('phái: 1: Nam - 0: Nu')->default(1);
            $table->string('qt_diaChi')->comment('Địa chỉ quản trị viên');
            $table->string('qt_email')->nullable()->comment('Email quản trị viên');
            $table->string('qt_dienThoai',10)->comment('Số điện thoại liên lạc');
            $table->timestamp('qt_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm tạo mới');

            // $table->timestamp('qt_capnhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm cập nhật gần nhất');
        // khóa
            $table->primary(['qt_ma']);            
            $table->foreign('qt_ma')->references('name')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('QuanTri');
    }
}
