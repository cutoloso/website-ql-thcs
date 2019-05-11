<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThongBaoCaNhanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ThongBaoCaNhan', function (Blueprint $table) {
            $table->increments('tbcn_ma')->comment('Mã thông báo cá nhân');;
            $table->timestamp('tbcn_tGian')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời gian thông báo');
            $table->string('tbcn_tieuDe')->comment('Tiêu đề thông báo');
            $table->string('tbcn_noiDung')->comment('Đường dẫn đến nội dung thông báo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ThongBaoCaNhan');
    }
}
