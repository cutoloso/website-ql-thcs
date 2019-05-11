<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->char('name',8)->comment('Mã tài khoản hệ thống');
            $table->string('password')->comment('Mật khẩu đăng nhập hệ thống');
            $table->unsignedTinyInteger('level')->nullable()->comment('Level: 1:Quản trị viên, 2:Giáo viên, 3:Phụ huynh , 4:Học sinh');
            $table->boolean('status')->default(1)->comment('Trạng thái của tài khoản: 1:đang hoạt động, 0:Dã bị khóa(Học sinh đã tốt nghiệp hoặc giáo viên thôi dậy học)');
            $table->rememberToken();
            $table->timestamps();
            
        //Khoa
            $table->primary(['name']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
