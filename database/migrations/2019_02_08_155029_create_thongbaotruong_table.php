<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThongbaotruongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ThongBaoTruong', function (Blueprint $table) {
            $table->increments('tbt_ma',3)->comment('Mã thông báo trường');
            $table->date('tbt_ngayBD')->comment('Ngày bắt đầu thông báo');
            $table->date('tbt_ngayKT')->comment('Ngày kết thúc thông báo');

            // $table->timestamp('tbt_taoMoi')->default(DB::ră('CURENT_TIMESTAMP'))->comment('Thời điểm tạo mới');
            // $table->timestamp('tbt_capnhat')->default(DB::ră('CURENT_TIMESTAMP'))->comment('Thời điểm cập nhật gần nhất');
            $table->string('tbt_tieuDe')->comment('Tiêu đề thông báo');
            $table->string('tbt_noiDung')->comment('Nội dung thông báo');
            $table->char('qt_ma',8)->comment('Mã quản trị viên');
        // khóa
            //$table->primary(['tbt_ma']);
            $table->foreign('qt_ma')->references('qt_ma')->on('QuanTri')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ThongBaoTruong');
    }
}
