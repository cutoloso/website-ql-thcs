<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTocmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ToCM', function (Blueprint $table) {

            $table->char('cm_ma',3)->comment('Mã tổ chuyên môn');

            $table->string('cm_moTa',100)->comment('Tên chuyên môn');

            // $table->timestamp('cm_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm tạo mới');

            // $table->timestamp('cm_capnhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm cập nhật gần nhất');
        // khóa
            $table->primary(['cm_ma']);
            $table->unique(['cm_moTa']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ToCM');
    }
}
