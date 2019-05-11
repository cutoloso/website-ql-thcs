<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGopyGvPhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('GopY_GV_PH', function (Blueprint $table) {
            $table->unsignedInteger('cd_gvph_ma')->comment('Mã chủ đề');
            $table->timestamp('gy_gvph_tGian')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời gian đưa ra góp ý');
            $table->text('gy_gvph_noiDung')->comment('Nội dung góp ý');  
            $table->char('gy_nguoiGY',8)->comment('Mã người góp ý');

        //khóa
            $table->primary(['cd_gvph_ma','gy_gvph_tGian']);

            $table->foreign('cd_gvph_ma')->references('cd_gvph_ma')->on('ChuDe_GV_PH')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('ph_ma')->references('ph_ma')->on('PhuHuynh')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('GopY_GV_PH');
    }
}
