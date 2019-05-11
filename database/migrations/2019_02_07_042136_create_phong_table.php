<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Phong', function (Blueprint $table) {
            $table->char('p_ma',3)->comment('Mã phòng');
            $table->unsignedSmallInteger('p_sucChua')->nullable()->comment('Sức chứa của phòng');
            $table->string('p_ghiChu')->nullable()->comment('Ghi chú phòng');
            // $table->timestamp('p_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm tạo mới');

            // $table->timestamp('p_capnhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm cập nhật gần nhất');
        // khóa
            $table->primary(['p_ma']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Phong');
    }
}
