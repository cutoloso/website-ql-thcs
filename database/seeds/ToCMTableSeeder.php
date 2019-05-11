<?php

use Illuminate\Database\Seeder;

class ToCMTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('ToCM')->insert([
            ['cm_ma'=>'GT','cm_moTa'=>'Gíam thị'],
        	['cm_ma'=>'T','cm_moTa'=>'Toán học'],
        	['cm_ma'=>'VL','cm_moTa'=>'Vật lý'],
        	['cm_ma'=>'HH','cm_moTa'=>'Hóa học (dành cho học sinh lớp 8, 9)'],
        	['cm_ma'=>'SH','cm_moTa'=>'Sinh học'],
        	['cm_ma'=>'CN','cm_moTa'=>'Công nghệ'],
        	['cm_ma'=>'NV','cm_moTa'=>'Ngữ văn'],
        	['cm_ma'=>'LS','cm_moTa'=>'Lịch sử'],
            ['cm_ma'=>'DL','cm_moTa'=>'Địa lý'],
            ['cm_ma'=>'CD','cm_moTa'=>'Giáo dục công dân'],
            ['cm_ma'=>'NN','cm_moTa'=>'Ngoại ngữ (Anh, Pháp, Nga, Trung, Nhật)'],
            ['cm_ma'=>'TD','cm_moTa'=>'Thể dục'],
            ['cm_ma'=>'AN','cm_moTa'=>'Âm nhạc'],
            ['cm_ma'=>'MT','cm_moTa'=>'Mỹ thuật'],
            ['cm_ma'=>'TH','cm_moTa'=>'Tin học'],
        ]);
    }
}
