<?php

use Illuminate\Database\Seeder;

class MonHocTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=6; $i <= 9; $i++) { 
    		DB::table('MonHoc')->insert([
    			['mh_ma'=>'T'.$i,'mh_ten'=>'Toán lớp '.$i],
    			['mh_ma'=>'VL'.$i,'mh_ten'=>'Lý lớp '.$i],
    			['mh_ma'=>'SH'.$i,'mh_ten'=>'Sinh lớp '.$i],
    			['mh_ma'=>'CN'.$i,'mh_ten'=>'Công nghệ lớp '.$i],
    			['mh_ma'=>'NV'.$i,'mh_ten'=>'Văn lớp '.$i],
    			['mh_ma'=>'LS'.$i,'mh_ten'=>'Sử lớp '.$i],
    			['mh_ma'=>'DL'.$i,'mh_ten'=>'Địa lớp '.$i],
    			['mh_ma'=>'CD'.$i,'mh_ten'=>'Giáo dục công dân lớp '.$i],
    			['mh_ma'=>'NN'.$i,'mh_ten'=>'Ngoại ngữ (Anh, Pháp, Nga, Trung, Nhật) lớp '.$i],
    			['mh_ma'=>'TD'.$i,'mh_ten'=>'Thể dục lớp '.$i],
    			['mh_ma'=>'AN'.$i,'mh_ten'=>'Âm nhạc lớp '.$i],
    			['mh_ma'=>'MT'.$i,'mh_ten'=>'Mỹ thuật lớp '.$i],
    			['mh_ma'=>'TH'.$i,'mh_ten'=>'Tin học lớp '.$i],
    		]);
    		if ($i>=8) {
    			DB::table('MonHoc')->insert(['mh_ma'=>'HH'.$i,'mh_ten'=>'Hóa lớp '.$i]);
    		}
    	}

        DB::table('MonHoc')->insert(['mh_ma'=>'CC','mh_ten'=>'Chào cờ']);
        DB::table('MonHoc')->insert(['mh_ma'=>'SHL','mh_ten'=>'Sinh Hoạt lớp']);
        DB::table('MonHoc')->insert(['mh_ma'=>'HDNGLL','mh_ten'=>'Hoạt động ngoài giờ lên lớp']);
    }
  }
