<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThongbaolopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ThongBaoLop', function (Blueprint $table) {
            $table->increments('tbl_ma')->comment('Mã thông báo lớp');
            $table->date('tbl_ngayBD')->comment('Ngày bắt đầu thông báo');
            $table->date('tbl_ngayKT')->comment('Ngày kết thúc thông báo');

            // $table->timestamp('tbl_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm tạo mới');
            // $table->timestamp('tbl_capnhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm cập nhật gần nhất');
            $table->string('tbl_tieuDe')->comment('Tiêu đề thông báo');
            $table->string('tbl_noiDung')->comment('Nội dung thông báo');
            $table->char('l_ma',3)->comment('Mã lớp');
            $table->char('kh_khoaHoc',4)->comment('Niên khóa');
            $table->char('gv_ma',8)->comment('Mã giáo viên');

        // khóa
            //$table->primary(['tbl_ma']);
            $table->foreign(['l_ma','kh_khoaHoc'])->references(['l_ma','kh_khoaHoc'])->on('Lop')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('ThongBaoLop');
    }
}
