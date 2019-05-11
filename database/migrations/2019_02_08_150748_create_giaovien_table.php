<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiaovienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('GiaoVien', function (Blueprint $table) {
            $table->char('gv_ma',8)->comment('Mã giáo viên');
            // $table->string('gv_matKhau',32)->comment('Mật khẩu đăng nhập');
            $table->string('gv_hoTen',100)->comment('Họ tên giáo viên');
            $table->date('gv_ngaySinh')->format('d-m-Y')->comment('Ngày sinh giáo viên');
            $table->boolean('gv_phai')->comment('phái: 1: Nam - 0: Nu')->default(1);
            $table->string('gv_diaChi')->comment('Địa chỉ gíao viên');
            $table->string('gv_email')->nullable()->comment('Email giáo viên');
            $table->string('gv_dienThoai',10)->comment('Số điện thoại liên lạc');
            $table->char('cm_ma',3)->comment('Mã chuyên môn');
            $table->timestamp('gv_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm tạo mới');

        // khóa            
            $table->primary(['gv_ma']);

            $table->foreign('gv_ma')->references('name')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
            $table->foreign('cm_ma')->references('cm_ma')->on('ToCM')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('GiaoVien');
    }
}
