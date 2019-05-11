<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGopyGvHsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('GopY_GV_HS', function (Blueprint $table) {
            $table->unsignedInteger('cd_gvhs_ma')->comment('Mã chủ đề');
            $table->timestamp('gy_gvhs_tGian')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời gian đưa ra góp ý');
            $table->text('gy_gvhs_noiDung')->comment('Nội dung góp ý');
            $table->char('gy_nguoiGY',8)->comment('Mã người góp ý');

        //khóa
            $table->primary(['gy_gvhs_tGian','cd_gvhs_ma']);

            $table->foreign('cd_gvhs_ma')->references('cd_gvhs_ma')->on('ChuDe_GV_HS')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('hs_ma')->references('hs_ma')->on('HocSinh')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('gv_ma')->references('gv_ma')->on('Giaovien')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('GopY_GV_HS');
    }
}
