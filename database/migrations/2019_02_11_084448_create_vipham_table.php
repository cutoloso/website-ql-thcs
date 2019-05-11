<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViphamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ViPham', function (Blueprint $table) {
            $table->char('hs_ma',8)->comment('Mã học sinh');
            $table->date('vp_ngay')->comment('Ngày học sinh vắng');
            $table->text('vp_noiDung')->comment('Nội dung vi phạm');
            // khóa
            $table->primary(['hs_ma','vp_ngay']);
            
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
        Schema::dropIfExists('ViPham');
    }
}
