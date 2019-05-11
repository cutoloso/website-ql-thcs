<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiemdanhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DiemDanh', function (Blueprint $table) {
            $table->char('hs_ma',8)->comment('Mã học sinh');
            $table->date('dd_ngay')->comment('Ngày học sinh vắng');
            // khóa
            $table->primary(['hs_ma','dd_ngay']);
            
            $table->foreign('hs_ma')->references('hs_ma')->on('HocSinh')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DiemDanh');
    }
}
