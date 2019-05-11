<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiethocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TietHoc', function (Blueprint $table) {
            $table->unsignedTinyInteger('th_stt')->comment('Số thứ tự tiết học');
            $table->string('th_buoi')->comment('Buổi học (Sáng - Chiều) của tiết học');
            $table->time('th_gio')->comment('Thời gian bắt đầu tiết học');
            // $table->timestamp('th_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm tạo mới');

            // $table->timestamp('th_capnhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm cập nhật gần nhất');
        // khóa
            $table->primary(['th_stt','th_buoi']);
            $table->unique(['th_gio']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TietHoc');
    }
}
